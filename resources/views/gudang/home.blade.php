<!DOCTYPE html>
<html lang="en">

<head>

    @include('templates.head')
    <title>Sistem Informasi Pergudangan</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
                               @foreach ($tanggal as $item)
                               <option value="{{ $item }}">{{ $item }}</option>
                               @endforeach
                            </select>
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            {{-- @foreach ($record as $object) --}}
                            <div style="height: 200px">
                                <canvas id="myChart"></canvas>
                           
                                    
                            </div>
                            @foreach ($chartdata as $item)
                            {{ $item }} 
                            @endforeach
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <?php $no = 1; ?>
                                    <tr style="background-color: rgb(230, 230, 230);">
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stock Awal</th>
                                        <th>Masuk Terakhir</th>
                                        <th>Keluar Terakhir</th>
                                        <th>Stock Terakhir</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($object as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->kode_produk }}</td>
                      <td>{{ $data->nama_produk }}</td>
                      <td>{{ $data->stokawal_produk }}</td>
                      <td>Pada {{ $data->Tanggal .' Sejumlah '. $data->qty_masuk}}</td>
                      <td>Pada {{ $data->Tanggal .' Sejumlah '. $data->qty_keluar}}</td>
                      <td>{{ $data->stokakhir_produk }}</td>
                    </tr>
                    @endforeach --}}
                                    </tr>
                                </tbody>
                            </table>
                            <strong>Hasil Perhitungan Data : </strong>
                            <br>

                            {{-- @foreach ($object as $data)
                 <strong>Per Tanggal {{ $data->Tanggal }}</strong> 
                 <strong>Persediaan Rata-Rata : </strong> {{ $data->Rata2_persediaan }} 
                 <strong>TOR Partial : </strong> {{ $data->TOR_partial }} 
                 <strong>WSP : </strong> {{ $data->WSP }} 
                 <strong>TOR : </strong> {{ $data->TOR }} 
                 <br>
                 @endforeach --}}
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
            <script type="text/javascript">
                var selected = 
                if
                var ctx = document.getElementById('myChart');
                var myChart = echarts.init(ctx);
                myChart.setOption({
                    type: 'bar',
                    data: {
                        labels: [
                            'january'
                        ],
                        datasets: [{
                            label: 'Jumlah Masuk',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'Jumlah Keluar',
                            data : [10,2,4,2,3,1],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                $(function() {
                    $('#example1').DataTable()
                    $('#example2').DataTable({
                        'paging': true,
                        'lengthChange': false,
                        'searching': false,
                        'ordering': true,
                        'info': true,
                        'autoWidth': false
                    })
                })
            </script>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    @include('templates.scripts')

</body>

</html>
