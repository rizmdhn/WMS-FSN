<!DOCTYPE html>
<html lang="en">

<head>

    @include('templates.head')
    <title>Sistem Informasi Pergudangan</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>

</head>


<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @include('templates.sidebar')
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            @include('templates.header')

            <div class="container-fluid">
                <h3 class="mt-4">Selamat Datang di Sistem Informasi Pergudangan</h3>

            </div>
            <section class="content mt-2">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <br>
                            <h3 class="box-title">LAPORAN HASIL FSN</h3>
                            @if ($pesan != null)
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($pesan as $item)
                                        <b>Stock Menipis</b> : {{ $item }}
                                    @endforeach
                                </div>
                            @endif
                            <select name="tanggal" id="tanggal">
                                <option value="0">--- Choose a date ---</option>
                                {{-- @for ($i = count($tanggal); $i <= (count($tanggal)-3); $i--)
                                    <option value="{{ $tanggal[$i] }}">{{ $tanggal[$i] }}</option>

                                @endfor
                                 --}}
                                @foreach ($tanggal as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            {{-- @foreach ($record as $object) --}}
                            <div style="height: 300px">
                                <canvas id="myChart"></canvas>
                            </div>
                            
                            <table id="table_id" class="display">
                                <thead>
                                    <tr>
                                        <th>Column 1</th>
                                        <th>Column 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Row 1 Data 1</td>
                                        <td>Row 1 Data 2</td>
                                    </tr>
                                    <tr>
                                        <td>Row 2 Data 1</td>
                                        <td>Row 2 Data 2</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <hr>

                            {{-- @endforeach --}}

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </section>

            @include('templates.scripts')

            <!-- page script -->
            <script>
                var label = [@foreach ($product as $item)
                "{{ $item->nama_produk }}",
                @endforeach]
                var data = "{{ $chartdata }}";
                var dataset = JSON.parse(data.replace(/&quot;/g,'"'));
                var databulan = dataset['12-2021'];
                const qty_keluar = [];
                const qty_masuk = [];
                const qty_stok = [];
                const qty_stokawal = [];
                for (var j in databulan){
                    qty_keluar.push(databulan[j].qty_keluar);
                    qty_stokawal.push(databulan[j].stokawal_produk);
                    qty_masuk.push(databulan[j].qty_masuk);
                    qty_stok.push(databulan[j].stokakhir_produk);
                }
                const ctx = document.getElementById('myChart');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Stok Awal',
                            data: qty_stokawal,
                            backgroundColor: [
                                'rgba(54, 162, 235)',
                            ],
                            borderWidth: 3
                        },{
                            label: 'Kuantitas Keluar',
                            data: qty_keluar,
                            backgroundColor: [
                                'rgba(255, 99, 132)',
                            ],
                            borderWidth: 3
                        },{
                            label: 'Kuantitas Masuk',
                            data: qty_masuk,
                            backgroundColor: [
                                'rgba(255, 206, 86)',
                            ],
                            borderWidth: 3},{
                            label: 'Stok Akhir',
                            data: qty_stok,
                            backgroundColor: [
                                'rgba(75, 192, 192)',
                            ],
                            borderWidth: 3}]
                    },
                    options: {
                        responsive:true,
                        maintainAspectRatio	:false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                $(document).ready( function () {
                    $('#example1').DataTable();
                } );
            </script>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    @include('templates.scripts')

</body>

</html>
