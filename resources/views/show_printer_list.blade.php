@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.printer_list') }}</h3>
                    <div class="card-tools">
                        {{ $printers->links() }}
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('messages.show_printer_name') }}</th>
                                <th>{{ __('messages.show_printer_ip') }}</th>
                                <th>{{ __('messages.show_printer_type') }}</th>
                                <th>{{ __('messages.show_printer_brand') }}</th>
                                <th>{{ __('messages.show_printer_location') }}</th>
                            </tr>
                        </thead>
                        @foreach ($printers as $p)
                            <tr>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->ip_addr }}</td>
                                <td>{{ $p->type }}</td>
                                <td>{{ $p->brand }}</td>
                                <td>{{ $p->location }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
