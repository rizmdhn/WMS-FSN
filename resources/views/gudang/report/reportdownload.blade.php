<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset("js/filesaver.js")}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    @include('templates.scripts')

</head>

<body>
    <div class="container mt-5 ">
        <pre id="json"></pre>
    </div>
    <script>
        $(document).ready(function() {
            var data = "{{ $data }}";
            var dataset = JSON.parse(data.replace(/&quot;/g, '"'));
            const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
            const EXCEL_EXTENSION = '.xlsx';

            const worksheet = XLSX.utils.json_to_sheet(dataset);
            const workbook = { 
                Sheets: { 'data': worksheet }, 
                SheetNames: ['data'] };
            const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
            console.log(excelBuffer);
            saveAs(new Blob([excelBuffer], { type: EXCEL_TYPE }), 'Report' + new Date().toLocaleString() + EXCEL_EXTENSION);
            window.history.back();
        });


</script>
</body>
{{-- <script src="{{ asset("js/json-excel.js")}}"></script> --}}


</html>