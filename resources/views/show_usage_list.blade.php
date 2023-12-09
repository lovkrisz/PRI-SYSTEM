@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.usage_list') }}</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('messages.show_printer_name') }}</th>
                            <th>{{ __('messages.show_resources_name') }}</th>
                            <th>{{ __('messages.show_date') }}</th>
                        </tr>
                        </thead>
                        @foreach($data as $d)
                            <tr>
                                <td>{{\App\Http\Services\PrinterService::get_name_by_id($d->printer_id)}} {{\App\Http\Services\PrinterService::get_brand_by_id($d->printer_id)}} {{\App\Http\Services\PrinterService::get_type_by_id($d->printer_id)}}</td>
                                <td>{{\App\Http\Services\ResourceService::get_name_by_barcode($d->resource_barcode)}} {{\App\Http\Services\ResourceService::get_color_by_barcode($d->resource_barcode)}} {{\App\Http\Services\ResourceService::get_capacity_by_barcode($d->resource_barcode)}}</td>
                                <td>{{$d->created_at}}</td>
                            </tr>
                        @endforeach

                    </table>

                </div>

            </div>
            <div class="card">
                <div class="card-body p-0">
                    <button style="width:100%" type="submit" class="btn btn-success">{{ __('messages.export_pdf') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
