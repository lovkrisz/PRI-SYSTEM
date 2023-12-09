@php use App\Http\Services\PrinterService;use App\Http\Services\ResourceService; @endphp
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
                    {{--                    <div class="dateselector">--}}
                    {{--                        <p class="dateselector__header">{{__("messages.choose_month")}}</p>--}}
                    {{--                        <p class="dateselector__year">{{__("messages.year")}}</p>--}}
                    {{--                        <select class="dateselector__year__select" name="year">--}}
                    {{--                            @php--}}
                    {{--                                $year = date("Y");--}}
                    {{--                                $month = date("m");--}}
                    {{--                            @endphp--}}

                    {{--                            @for($i = $year-5; $i <= $year+10; $i++)--}}
                    {{--                                @if($i == $year)--}}
                    {{--                                    <option selected value="{{$i}}">{{$i}}</option>--}}
                    {{--                                @else--}}
                    {{--                                    <option value="{{$i}}">{{$i}}</option>--}}
                    {{--                                @endif--}}
                    {{--                            @endfor--}}
                    {{--                        </select>--}}
                    {{--                            <p class="dateselector__month">{{__("messages.month")}}</p>--}}
                    {{--                        <select name="month" class="dateselector__month__select">--}}
                    {{--                            @for($i = 1; $i <= 12; $i++)--}}
                    {{--                                @if($i == $month)--}}
                    {{--                                    <option selected value="{{$i}}">{{$i}}</option>--}}
                    {{--                                @else--}}
                    {{--                                    <option value="{{$i}}">{{$i}}</option>--}}
                    {{--                                @endif--}}
                    {{--                            @endfor--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
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
                                <td>{{PrinterService::get_name_by_id($d->printer_id)}} {{PrinterService::get_brand_by_id($d->printer_id)}} {{PrinterService::get_type_by_id($d->printer_id)}}</td>
                                <td>{{ResourceService::get_name_by_barcode($d->resource_barcode)}} {{ResourceService::get_color_by_barcode($d->resource_barcode)}} {{ResourceService::get_capacity_by_barcode($d->resource_barcode)}}</td>
                                <td>{{$d->created_at}}</td>
                            </tr>
                        @endforeach

                    </table>

                </div>

            </div>
            <div class="card">
                <div class="card-body p-0">
                    <a href="/download_used_list">
                        <button style="width:100%" type="submit"
                                class="btn btn-success">{{ __('messages.export_xlsx') }}</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
@section("site-specific")

@endsection
