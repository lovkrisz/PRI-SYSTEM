<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddResourceRequest;
use App\Http\Requests\ResourceInRequest;
use App\Http\Requests\ResourceOutGetPrintersRequest;
use App\Http\Services\ResourceService;
use App\Http\Services\PrinterService;
use App\Http\Services\SessionMsgService;
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
        $hasinDB = ResourceService::update($req->validated());
        if ($hasinDB) {
            SessionMsgService::flash(msg: __("messages.successfull_resource_in"), prefix: "success");
            return redirect("/resource_in");
        } else {
            return Redirect::back()->withErrors(['msg' => __("messages.no_barcode_in_db")]);
        }
    }
    public function resource_out_get_printers(ResourceOutGetPrintersRequest $req)
    {
        $validated = $req->validated();
        $barcode = $validated["barcode"];
        $printer_id_list = ResourceService::find_by_barcode(barcode: $validated["barcode"]);
        if (!empty($printer_id_list)) {
            $printers = PrinterService::get_all_printer_by_id(idarray: $printer_id_list);
            return $printers;
        }

    }
}
