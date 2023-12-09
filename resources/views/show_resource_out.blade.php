@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.resource_out') }}</h3>
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
                <form method="POST" action="{{ route('resource_out.submit') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="barcode">{{ __('messages.resource_out_barcode') }}</label>
                            <input type="text" class="form-control" id="barcode" name="barcode"
                                value="{{ old('barcode') }}">
                        </div>
                        <div class="form-group" id="appendhere">
                            <label for="amount">{{ __('messages.resource_out_printer') }}</label>

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
                $("#printer_selector").remove();
                $.post(
                    '{{ route('resource_out.get_printers') }}', {
                        barcode: $(this).val()
                    },
                    function(response) {
                        if (response == "") {
                            alert("Nincs ilyen vonalkód az adatbázisban!");

                        } else {
                            $text = '<select name="printer" class="form-control" id="printer_selector">';
                            $.each(response, function(i, val) {
                                $text += '<option value="' + val.id + '">' + val.name + ' (' + val
                                    .brand +
                                    ' ' + val.type + ')</option>';

                            });
                            $text += "</select>";
                            $("#appendhere").append($text);
                        }
                    }

                );
            }
        });
    </script>
@endsection
