<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddResourceRequest;
use App\Http\Requests\ResourceInRequest;
use App\Http\Requests\ResourceOutGetPrintersRequest;
use App\Http\Requests\ResourceOutRequest;
use App\Http\Services\ResourceService;
use App\Http\Services\PrinterService;
use App\Http\Services\SessionMsgService;
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
        $printer_id_list = ResourceService::find_by_barcode(barcode: $validated["barcode"]);
        if (!empty($printer_id_list)) {
            return PrinterService::get_all_printer_by_id(idarray: $printer_id_list);
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
}
