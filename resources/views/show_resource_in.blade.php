@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.resource_in') }}</h3>
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
                <form method="POST" action="{{ route('resource_in.submit') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="barcode">{{ __('messages.resource_in_barcode') }}</label>
                            <input type="text" class="form-control" id="barcode" name="barcode"
                                value="{{ old('barcode') }}">
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ __('messages.resource_in_amount') }}</label>
                            <input type="text" class="form-control" id="amount" name="amount"
                                value="{{ old('amount') }}">
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
