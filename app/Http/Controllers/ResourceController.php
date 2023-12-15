<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddResourceRequest;
use App\Http\Requests\InventoryCountResRequest;
use App\Http\Requests\ResourceInRequest;
use App\Http\Requests\ResourceOutGetPrintersRequest;
use App\Http\Requests\ResourceOutRequest;
use App\Http\Services\ResourceService;
use App\Http\Services\PrinterService;
use App\Http\Services\SessionMsgService;
use App\Models\Leltar;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class ResourceController extends Controller
{
    public function add_resource_submit(AddResourceRequest $req)
    {
        ResourceService::create($req->validated());
        SessionMsgService::flash(msg: __("messages.successfull_resource_add"), prefix: "success");
        return redirect("/add_resource");

    }

    public function resource_in_submit(ResourceInRequest $req)
    {
        $hasinDB = ResourceService::update($req->validated(), "up");
        if ($hasinDB) {
            SessionMsgService::flash(msg: __("messages.successfull_resource_in"), prefix: "success");
            return redirect("/resource_in");
        } else {
            return Redirect::back()->withErrors(['msg' => __("messages.no_barcode_in_db")]);
        }
    }

    public function resource_out_get_printers(ResourceOutGetPrintersRequest $req): Collection
    {
        $validated = $req->validated();
        $printer_type_list = ResourceService::find_by_barcode(barcode: $validated["barcode"]);
        if (!empty($printer_type_list)) {
            return PrinterService::get_all_printer_by_type(typearray: $printer_type_list);
        }
        return Collection::empty();

    }

    public function resource_out_submit(ResourceOutRequest $req): RedirectResponse
    {
        $hasinDB = ResourceService::update($req->validated(), "down");
        if ($hasinDB) {
            ResourceService::add_usage($req->validated());
            SessionMsgService::flash(msg: __("messages.successfull_resource_out"), prefix: "success");
            return redirect("/resource_out");
        } else {
            return Redirect::back()->withErrors(['msg' => __("messages.no_barcode_in_db")]);
        }

    }

    public function api_resource_out_submit(ResourceOutRequest $req): JsonResponse
    {
        $hasinDB = ResourceService::update($req->validated(), "down");
        if ($hasinDB) {
            ResourceService::add_usage($req->validated());
            return response()->json([
                "message" => __("messages.successfull_resource_out")
            ], 200);
        } else {
            return response()->json(["message" => __("messages.no_barcode_in_db")], 500);
        }

    }

    public function api_resource_in_submit(ResourceInRequest $req): JsonResponse
    {
        $hasinDB = ResourceService::update($req->validated(), "up");
        if ($hasinDB) {
            return response()->json([
                "message" => __("messages.successfull_resource_in")
            ], 200);
        } else {
            return response()->json(["message" => __("messages.no_barcode_in_db")], 500);
        }

    }
    public function inventory_save_row(InventoryCountResRequest $req): JsonResponse {
        if(ResourceService::exists($req->validated()["barcode"])) {
            $inventory = Leltar::firstOrNew(["barcode" => $req->validated()["barcode"]]);
            $inventory->amount = ($inventory->amount + 1);
            $inventory->save();
            return response()->json(["message" => "save_successfull"],200);
        }
        else return response()->json(["message" => "Barcode Does not Exists"], 500);

    }
    public function get_inventory_table_data(): JsonResponse {
        $array = [];
        $i = 0;
        $leltar_table = Leltar::all();
        foreach($leltar_table as $row ) {
            $array[$i]["barcode"] = $row->barcode;
            $array[$i]["amount"] = $row->amount;
            $array[$i]["name"] = ResourceService::get_data_for_inventory($row->barcode);
            $i++;
        }
        return response()->json(["message" => "successfull", "data" => $array],200);
    }
    public function inventory_count_accept(): void {
        $leltar_table = Leltar::all();
        foreach($leltar_table as $row) {
            Resource::where("barcode", $row->barcode)->update(["quantity" => $row->amount]);
        }
        Leltar::truncate();
    }
    public function inventory_count_delete(): void {
        Leltar::truncate();
    }
}
