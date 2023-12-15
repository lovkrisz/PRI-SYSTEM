<?php

namespace App\Http\Services;

use App\Models\Printer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PrinterService
{
    static public function create(array $validated_data): void
    {
        Printer::create($validated_data);
    }
    static public function get_all_by_name_paginated(int $max_rows_per_page): LengthAwarePaginator
    {
        return Printer::orderBy("name", "ASC")->paginate($max_rows_per_page);
    }
    static public function get_printer_by_model(string $model): array
    {
        $printer = Printer::where("type", $model)->get()->toArray();
        if (sizeof($printer) < 1)
            return [];
        else
            return $printer;
    }
    static function get_all()
    {
        return Printer::all();
    }
    static function get_all_printer_by_type(array $typearray): Collection
    {
        return Printer::whereIn("type", $typearray)->get();
    }
    public static function get_name_by_id(int $id): string {
        $printer = Printer::where("id", $id)->first();
        if ($printer) {
            return $printer["name"];
        } else
            return "";
    }
    public static function get_type_by_id(int $id): string {
        $printer = Printer::where("id", $id)->first();
        if ($printer) {
            return $printer["type"];
        } else
            return "";
    }
    public static function get_brand_by_id(int $id): string {
        $printer = Printer::where("id", $id)->first();
        if ($printer) {
            return $printer["brand"];
        } else
            return "";
    }


}
