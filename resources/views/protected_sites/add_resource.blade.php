@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.add_resource') }}</h3>
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
                <form method="POST" action="{{ route('add_resource.submit') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('messages.resource_name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="color">{{ __('messages.resource_color') }}</label>
                            <input type="text" class="form-control" id="color" name="color"
                                value="{{ old('color') }}">
                        </div>
                        <div class="form-group">
                            <label for="capacity">{{ __('messages.resource_capacity') }}</label>
                            <input type="text" class="form-control" id="capacity" name="capacity"
                                value="{{ old('capacity') }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{ __('messages.resource_quantity') }}</label>
                            <input type="text" class="form-control" id="quantity" name="quantity"
                                value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            <label for="barcode">{{ __('messages.resource_barcode') }}</label>
                            <input type="text" class="form-control" id="barcode" name="barcode"
                                value="{{ old('barcode') }}">
                        </div>
                        <div class="form-group">
                            <label for="amount_to_operate">{{ __('messages.resource_amount_to_operate') }}</label>
                            <input type="text" class="form-control" id="amount_to_operate" name="amount_to_operate"
                                value="{{ old('amount_to_operate') }}">
                        </div>
                        <div class="form-group">
                            <label for="usablebyprinters">{{ __('messages.resource_usablebyprinters') }}</label>
                            <select multiple="" class="form-control" id="usablebyprinters" name="usablebyprinters[]">
                                @foreach (\App\Models\Printer::select(["type", "brand"])->distinct()->get() as $p)
                                    <option value="{{ $p->type }}">{{ $p->brand }} {{ $p->type }}
                                    </option>
                                @endforeach
                            </select>
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
@section('site-specific')
    <script>
        $(document).on("keypress", "#barcode", function(e) {
            if (e.which == 13) {
                e.preventDefault();
                var self = $(this),
                    form = self.parents('form:eq(0)'),
                    focusable, next;
                focusable = form.find('input').filter(':visible');
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                }
                return false;
            }
        });
    </script>
@endsection
