@php use App\Http\Services\PrinterService;use App\Http\Services\ResourceService; @endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>{{ __('messages.show_printer_name') }}</th>
            <th>{{ __('messages.show_resources_name') }}</th>
            <th>{{ __('messages.show_date') }}</th>
        </tr>
        @foreach($usage as $u)
            <tr>
                <td>{{PrinterService::get_name_by_id($u->printer_id)}} {{PrinterService::get_brand_by_id($u->printer_id)}} {{PrinterService::get_type_by_id($u->printer_id)}}</td>
                <td>{{ResourceService::get_name_by_barcode($u->resource_barcode)}} {{ResourceService::get_color_by_barcode($u->resource_barcode)}} {{ResourceService::get_capacity_by_barcode($u->resource_barcode)}}</td>
                <td>{{$u->created_at}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
