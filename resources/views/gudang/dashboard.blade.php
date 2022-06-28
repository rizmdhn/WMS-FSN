<!DOCTYPE html>
<html lang="en">

<head>

    @include('templates.head')
    <title>Sistem Informasi Pergudangan</title>

</head>


<body>
    @include('templates.scripts')

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
                            @if ($pesanstock != null)
                                <div class="alert alert-danger" role="alert">
                                    <b>Stock Barang Menipis</b> :
                                    @foreach ($pesanstock as $item)
                                        {{ $item }}
                                    @endforeach
                                </div>
                            @endif
                            @if ($pesanexpired != null)
                                <div class="alert alert-danger" role="alert">
                                    <b>Barang Sudah Expired Harap Segera Dihapus</b> :
                                    @foreach ($pesanexpired as $item)
                                        {{ $item }}
                                    @endforeach
                                </div>
                            @endif
                            <select name="tanggal" id="tanggal">
                                @foreach ($tanggal as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            {{-- @foreach ($record as $object) --}}
                            <div id="containercanvas" style="height: 300px">
                                <canvas id="myChart"></canvas>
                            </div>
                            <br/>
                            <table id="table_id" class="w-100">
                                <thead>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Stok Akhir</th>
                                    <th>TOR</th>
                                </thead>
                                <tbody>

                                </tbody>
                               
                            </table>
                            <br>
                            <hr style=" border-top: 3px dashed  black;
                            ">
                            <br/>
                            <h3 class="box-title">Hasil TOR 4 Bulanan</h3>
                            <table id="table_produkFSN" class="w-100">
                                <thead>
                                    <th>Nama Produk</th>
                                    <th>Kategori FSN</th>
                                    <th>TOR 4 Bulan</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <h5>Table Legend : </h5>
                            <ul class="list-group list-group-horizontal" >
                                <li class="list-group-item list-group-item-danger">Fast Moving</li>
                                <li class="list-group-item list-group-item-warning">Slow Moving</li>
                                <li class="list-group-item list-group-item-success">Not Moving</li>
                            </ul>
                            <br>
                            <hr style=" border-top: 3px dashed black;
                            ">
                            <h3 class="box-title">Kapasitas Gudang</h3>
                            @if ($pesangudang != null)
                                <div class="alert alert-danger" role="alert">
                                    <b>Enodes Gudang Menipis</b> :
                                    @foreach ($pesangudang as $item)
                                        {{ $item }}
                                    @endforeach
                                </div>
                            @endif
                            <table id="table_gudang" class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Total enodes</th>
                                        <td>{{ $gudang->Kapasitas_GT }}</td>
                                    </tr>
                                    <tr>
                                        <th>Enodes Barang F</th>
                                        <td>{{ $gudang->sisa_F }} /
                                            {{ $gudang->Kapasitas_F }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Enodes Barang S</th>
                                        <td>{{ $gudang->sisa_S  }} /
                                            {{ $gudang->Kapasitas_S }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Enodse Barang N</th>
                                        <td>{{ $gudang->sisa_N  }} /
                                            {{ $gudang->Kapasitas_N }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            {{-- @endforeach --}}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </section>


            <!-- page script -->


        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Menu Toggle Script -->

    <script>
        var myChart = new Chart();
        var resetCanvas = function() {
            $('#mychart').remove(); // this is my <canvas> element
            $('#containercanvas').append('<canvas id="mychart"><canvas>');
            canvas = document.querySelector('#mychart'); // why use jQuery?
            ctx = canvas.getContext('2d');
        };
        // Initialize 
        $(document).ready(function() {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
            var valueSelected = $('#tanggal').val();
            var data_product = "{{ $product }}";
            var data = "{{ $chartdata }}";
            var data_gudang = "{{ $gudang }}";
            var dataset = JSON.parse(data.replace(/&quot;/g, '"'));
            var gudang = JSON.parse(data_gudang.replace(/&quot;/g, '"'));
            var product = JSON.parse(data_product.replace(/&quot;/g, '"'));
            var databulan = dataset[valueSelected];
            const qty_keluar = [];
            const nama_produk = [];
            const qty_masuk = [];
            const qty_stok = [];
            const qty_stokawal = [];
            for (var j in databulan) {
                nama_produk.push(databulan[j].nama_produk);
                qty_keluar.push(databulan[j].qty_keluar);
                qty_stokawal.push(databulan[j].stokawal_produk);
                qty_masuk.push(databulan[j].qty_masuk);
                qty_stok.push(databulan[j].stokakhir_produk);
                if (databulan[j].TOR > 1) {
                    databulan[j]['kategori'] = 'F';
                } else if (databulan[j].TOR >= 0.33) {
                    databulan[j]['kategori'] = 'S';
                } else if(databulan[j].TOR < 0.3){
                    databulan[j]['kategori'] = 'N';
                }
            }
            const ctx = document.getElementById('myChart');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nama_produk,
                    datasets: [{
                        label: 'Stok Awal',
                        data: qty_stokawal,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Kuantitas Keluar',
                        data: qty_keluar,
                        backgroundColor: [
                            'rgba(255, 255, 0)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Kuantitas Masuk',
                        data: qty_masuk,
                        backgroundColor: [
                            'rgba(0, 162, 0)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Stok Akhir',
                        data: qty_stok,
                        backgroundColor: [
                            'rgba(255, 51, 51)',
                        ],
                        borderWidth: 3
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
            $('#table_produkFSN').DataTable({
                data : product,
                info: true,
                autowidth: false,
                columns: [ {
                        data: 'nama_produk'
                    }, {
                        data: 'Kategori_fsn',
                        "render" : function (data, type, row, meta) {
                            if (data == '1') {
                                return 'F';
                            } else if (data == '2') {
                                return 'S';
                            } else if (data == '3') {
                                return 'N';
                            }
                        }
                    }, {
                        data : 'TOR4Months'
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    if (data['Kategori_fsn'] == "1") {
                        $(row).addClass('bg-danger');
                        $(row).addClass('text-white');
                    }
                    if (data['Kategori_fsn'] == "2") {
                        $(row).addClass('bg-warning');
                        $(row).addClass('text-white');
                    }
                    if (data['Kategori_fsn'] == "3") {
                        $(row).addClass('bg-success');
                        $(row).addClass('text-white');
                    }
                },
            });
            $('#table_id').DataTable({
                data: databulan,
                info: true,
                autowidth: false,
                columns: [{
                        data: 'kode_produk'
                    }, {
                        data: 'nama_produk'
                    }, {
                        data: 'stokawal_produk'
                    }, {
                        data: 'qty_masuk'
                    }, {
                        data: 'qty_keluar'
                    }, {
                        data: 'stokakhir_produk'
                    }, {
                        data: 'TOR'
                    },

                ],
               

            });

        });

        // perubahan 
        $('#tanggal').on('change', function(e) {
            myChart.destroy();
            resetCanvas();
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            // var label = [
            //     @foreach ($product as $item)
            //         "{{ $item->nama_produk }}",
            //     @endforeach
            // ]
            var data = "{{ $chartdata }}";
            var dataset = JSON.parse(data.replace(/&quot;/g, '"'));
            var databulan = dataset[valueSelected];
            const qty_keluar = [];
            const nama_produk = [];
            const qty_masuk = [];
            const qty_stok = [];
            const qty_stokawal = [];
            for (var j in databulan) {
                nama_produk.push(databulan[j].nama_produk);
                qty_keluar.push(databulan[j].qty_keluar);
                qty_stokawal.push(databulan[j].stokawal_produk);
                qty_masuk.push(databulan[j].qty_masuk);
                qty_stok.push(databulan[j].stokakhir_produk);
                if (databulan[j].TOR > 1) {
                    databulan[j]['kategori'] = 'F';
                } else if (databulan[j].TOR >= 0.33) {
                    databulan[j]['kategori'] = 'S';
                } else if(databulan[j].TOR < 0.3){
                    databulan[j]['kategori'] = 'N';
                }
            }
            const ctx = document.getElementById('myChart');

            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nama_produk,
                    datasets: [{
                        label: 'Stok Awal',
                        data: qty_stokawal,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Kuantitas Keluar',
                        data: qty_keluar,
                        backgroundColor: [
                            'rgba(255, 255, 0)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Kuantitas Masuk',
                        data: qty_masuk,
                        backgroundColor: [
                            'rgba(0, 162, 0)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Stok Akhir',
                        data: qty_stok,
                        backgroundColor: [
                            'rgba(255, 51, 51)',
                        ],
                        borderWidth: 3
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
            $('#table_id').DataTable().destroy();

            $('#table_id').DataTable({
                data: databulan,
                autowidth: true,
                responsive: true,
                info: true,

                columns: [{
                    data: 'kode_produk'
                }, {
                    data: 'nama_produk'
                }, {
                    data: 'stokawal_produk'
                }, {
                    data: 'qty_masuk'
                }, {
                    data: 'qty_keluar'
                }, {
                    data: 'stokakhir_produk'
                }, {
                    data: 'TOR'
                },],
               
            });
        });
    </script>
    <!-- Bootstrap core JavaScript -->
    @include('templates.modal')

</body>

</html>
