<?php

namespace App\Http\Controllers;

use App\Exports\UsageListExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Http\Services\PrinterService;
use App\Http\Services\ResourceService;
use Maatwebsite\Excel\Facades\Excel;

class RouteController extends Controller
{
    public function login_route(): View
    {
        if (Auth::check())
            return view("dashboard");
        else
            return view("login");
    }
    public function add_printer_page(): View
    {
        return view("protected_sites.add_printer");
    }
    public function add_resource_page(): View
    {
        return view("protected_sites.add_resource");
    }
    public function show_printer_list(): View
    {
        $printers = PrinterService::get_all_by_name_paginated(env("PAGINATION_MAX_ROW", 10));
        return view("show_printer_list")->with("printers", $printers);
    }
    public function show_resources_list(): View
    {
        $resources = ResourceService::get_all_by_name_paginated(env("PAGINATION_MAX_ROW", 10));
        return view("show_resources_list")->with("resources", $resources);
    }
    public function show_resource_in(): View
    {
        return view("show_resource_in");
    }
    public function show_resource_out(): View
    {
        return view("show_resource_out");
    }
    public function show_usage_list():View {
        $usage = ResourceService::get_used_resource_in_this_month();
        return view("show_usage_list")->with("data", $usage);
    }
    public function downloadexcel() {
        $date = date("Y_m_d");
        return Excel::download(new UsageListExport(), 'resource_usage'.$date.'.xlsx');
    }
    public function inventory_count() {
        return view("inventory_count");
    }
}
