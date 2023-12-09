<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPrinterRequest;
use Illuminate\Http\RedirectResponse;

use App\Http\Services\PrinterService;
use App\Http\Services\SessionMsgService;

class PrinterController extends Controller {
    public function add_printer_submit(AddPrinterRequest $req): RedirectResponse {
        PrinterService::create($req->validated());
        SessionMsgService::flash(msg: __("messages.successfull_printer_add"), prefix: "success");
        return redirect("/add_printer");

    }
}
