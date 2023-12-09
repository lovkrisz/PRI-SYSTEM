<?php

namespace App\Http\Services;

use App\Models\Printer;
use App\Models\Resource;
use App\Models\ResourceUsage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ResourceService
{
    static public function create(array $validated_data): void
    {
        if ($validated_data["amount_to_operate"] == null)
            $validated_data["amount_to_operate"] = sizeof($validated_data["usablebyprinters"]) * 2;

        Resource::create($validated_data);
    }

    static public function get_all_by_name_paginated(int $max_rows_per_page): LengthAwarePaginator
    {
        return Resource::orderBy("name", "ASC")->paginate($max_rows_per_page);
    }

    static public function update(array $validated_data, string $irany): bool
    {


        if ($irany == "up")
            $resource = Resource::where("barcode", $validated_data["barcode"])->increment("quantity", $validated_data["amount"]);
        else {
            $printer = Resource::where("usablebyprinters", 'like', '%"' . $validated_data["printer"] . '"%')->where("barcode", $validated_data["barcode"])->first();
            if (!$printer)
                return false;
            $resource = Resource::where("barcode", $validated_data["barcode"])->decrement("quantity", 1);
        }

        if ($resource)
            return true;
        else
            return false;
    }

    static function find_by_barcode(string $barcode): array
    {
        $resource = Resource::where("barcode", $barcode)->first();
        if ($resource) {
            return $resource["usablebyprinters"];
        } else
            return [];
    }

    public static function add_usage(array $validated): void
    {
        ResourceUsage::create([
            "printer_id" => $validated["printer"],
            "resource_barcode" => $validated["barcode"]
        ]);
    }

    public static function get_used_resource_in_this_month(): Collection
    {
        $date = date("Y-m");
        return ResourceUsage::where('created_at', 'like', '%' . $date . '%')->get();
    }

    public static function get_name_by_barcode(string $barcode): string
    {
        $resource = Resource::where("barcode", $barcode)->first();
        if ($resource) {
            return $resource["name"];
        } else
            return "";
    }

    public static function get_color_by_barcode(string $barcode): string
    {
        $resource = Resource::where("barcode", $barcode)->first();
        if ($resource) {
            return $resource["color"];
        } else
            return "";
    }

    public static function get_capacity_by_barcode(string $barcode): string
    {
        $resource = Resource::where("barcode", $barcode)->first();
        if ($resource) {
            return $resource["capacity"];
        } else
            return "";
    }
}
