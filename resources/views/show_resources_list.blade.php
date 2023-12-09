@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.resource_list') }}</h3>
                    <div class="card-tools">
                        {{ $resources->links() }}
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>{{ __('messages.show_resources_name') }}</th>
                                <th>{{ __('messages.show_resources_color') }}</th>
                                <th>{{ __('messages.show_resources_capacity') }}</th>
                                <th>{{ __('messages.show_resources_quantity') }}</th>
                                <th>{{ __('messages.show_resources_barcode') }}</th>
                                <th>{{ __('messages.show_resources_printers') }}</th>
                                <th>{{ __('messages.show_resources_minimum_amount') }}</th>
                            </tr>
                        </thead>
                        @foreach ($resources as $r)
                            @php
                                $printer_details = [];
                                $i = 0;
                                foreach ($r->usablebyprinters as $ubp) {
                                    $printer = \App\Http\Services\PrinterService::get_printer_by_id(id: $ubp);
                                    $printer_details[$i]['name'] = $printer->name;
                                    $printer_details[$i]['type'] = $printer->type;
                                    $printer_details[$i]['brand'] = $printer->brand;
                                    $i++;
                                }

                            @endphp
                            <tr style="background: {{ $r->quantity <= $r->amount_to_operate ? 'orange' : 'inherit' }}">
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->color }}</td>
                                <td>{{ $r->capacity }}</td>
                                <td>{{ $r->quantity }}</td>
                                <td>{{ $r->barcode }}</td>

                                <td>
                                    <ul>
                                        @foreach ($printer_details as $pd)
                                            <li>{{ $pd['name'] }} ({{ $pd['brand'] }} {{ $pd['type'] }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $r->amount_to_operate }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
