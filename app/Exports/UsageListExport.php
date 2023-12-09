<?php

namespace App\Exports;

use App\Http\Services\ResourceService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsageListExport implements FromView
{

    /**
     * @inheritDoc
     */
    public function view(): View
    {
        $usage = ResourceService::get_used_resource_in_this_month();
        return view("export.usage_list",["usage" => $usage]);
    }
}
