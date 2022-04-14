<!DOCTYPE html>
<html lang="en">

<head>

    @include('templates.head')
    <title>Sistem Informasi Pergudangan</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
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
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Stok Akhir</th>
                                </thead>
                                <tbody>
                                   
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
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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
                    
                    $('#table_id').DataTable({
                    data: databulan,
                    autowidth: true,
                    columns: [{
                        data : 'kode_produk'
                        },{
                        data : 'nama_produk'
                        },{
                        data : 'stokawal_produk'
                        },{
                        data : 'qty_masuk'
                        },{
                        data : 'qty_keluar'
                        },{
                        data : 'stokakhir_produk'
                        },
                ]
                });
                } );
                    console.log(databulan);
            </script>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    @include('templates.scripts')

</body>

</html>
