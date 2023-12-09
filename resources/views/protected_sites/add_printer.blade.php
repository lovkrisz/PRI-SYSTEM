@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.add_printer') }}</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12">
                            @if (Session::has('success'))
                                <div style="text-align: center;" class="alert alert-success alert-dismissible">
                                    {{ Session::get('success') }}</div>
                            @endif
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('add_printer.submit') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('messages.printer_name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('messages.printer_ip') }}</label>
                            <input type="text" class="form-control" id="ip" name="ip_addr"
                                value="{{ old('ip_addr') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('messages.printer_brand') }}</label>
                            <input type="text" class="form-control" id="brand" name="brand"
                                value="{{ old('brand') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('messages.printer_type') }}</label>
                            <input type="text" class="form-control" id="type" name="type"
                                value="{{ old('type') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('messages.printer_location') }}</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ old('location') }}">
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('messages.save_button') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
