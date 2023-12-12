@php use App\Http\Services\PrinterService;use App\Http\Services\ResourceService; @endphp
@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.inventory_count') }}</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="p-1">
                        <input type="text" id="barcode_here" style="width: 100%;padding: 0.7rem;border-radius: 5px;border: 1px solid #e5e4e5;outline: none;" class="form-group">
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('messages.resource_in_barcode') }}</th>
                            <th>{{ __('messages.show_resources_name') }}</th>
                            <th>{{ __('messages.resource_in_amount') }}</th>
                        </tr>
                        </thead>
                        <tbody id="appendhere">

                        </tbody>

                    </table>

                </div>

            </div>
            <div class="card">
                <div class="card-body p-0">

                        <button style="width:100%" type="submit" id="accept-inventory-count"
                                class="btn btn-success">{{ __('messages.accept_inventory_count') }}</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-0">

                        <button style="width:100%" type="submit" id="delete-inventory-count"
                                class="btn btn-danger">{{ __('messages.delete_inventory_count') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("site-specific")
    <script>
    $("#barcode_here").focus();
    function renderTable() {
        $.ajax({
            url: "/inventory_count/get_inventory_table_data",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if(data.message = "successfull") {
                    $text = "";
                    $.each(data.data, function (index, value) {
                        $text += "<tr>";
                        $text += "<td>"+value.barcode+"</td>"
                        $text += "<td>"+value.name+"</td>"
                        $text += "<td>"+value.amount+"</td>"
                        $text += "</tr>";
                    });
                    $("#appendhere").empty();
                    $("#appendhere").append($text);
                }
            }
        });
    }
    renderTable();
    $(document).on("keypress", "#barcode_here", function(e){
        if(e.which == 13){
            var inputVal = $(this).val();
            
            $.ajax({
                statusCode: {
                    500: function() {
                        alert("{{__("messages.error_barcode_not_found")}}");
                        return;
                    }
                },
                url: "/inventory_count/save_row",
                data: {barcode: inputVal},
                type: "POST",
                dataType: "json",
                success: function(data) {
                    if(data.message == "save_successfull") {
                        renderTable();
                        $("#barcode_here").val('');
                        $("#barcode_here").focus();
                    }

                }
            });


        }
    });
    $("#accept-inventory-count").click(function() {
        $.ajax({
            url: "/inventory_count/accept",
            type: "POST",
            success: function() {
                location.reload();
            }
        });
    });
    $("#delete-inventory-count").click(function() {
        $.ajax({
            url: "/inventory_count/delete",
            type: "POST",
            success: function() {
                location.reload();
            }
        });
    });
    </script>
@endsection
