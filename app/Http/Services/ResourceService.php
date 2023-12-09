<?php

namespace App\Http\Services;

use App\Models\Resource;
use Illuminate\Pagination\LengthAwarePaginator;

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
    static public function get_all()
    {
        return Resource::all();
    }
    static public function update(array $validated_data): bool
    {
        $resource = Resource::where("barcode", $validated_data["barcode"])->increment("quantity", $validated_data["amount"]);
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
}
