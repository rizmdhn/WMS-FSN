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
                                       {{  $item  }}
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

                            <table id="table_id" class="w-100">
                                <thead>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Stok Akhir</th>
                                    <th>TOR</th>
                                    <th>Kategori Barang</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <br>
                            <hr>
                            <h3 class="box-title">Kapasitas Gudang</h3>
                            <table id="table_gudang" class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Total enodes</th>
                                        <td>{{ $gudang->Kapasitas_GT }}</td>
                                    </tr>
                                    <tr>
                                        <th>Enodes Barang F</th>
                                        <td>{{ $gudang->Kapasitas_F - $pemakaian['F'] }} /
                                            {{ $gudang->Kapasitas_F }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Enodes Barang S</th>
                                        <td>{{ $gudang->Kapasitas_S - $pemakaian['S'] }} /
                                            {{ $gudang->Kapasitas_S }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Enodse Barang N</th>
                                        <td>{{ $gudang->Kapasitas_N - $pemakaian['N'] }} /
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
            var valueSelected = $('#tanggal').val();
            var label = [
                @foreach ($product as $item)
                    "{{ $item->nama_produk }}",
                @endforeach
            ]
            var data = "{{ $chartdata }}";
            var data_gudang = "{{ $gudang }}";
            var dataset = JSON.parse(data.replace(/&quot;/g, '"'));
            var gudang = JSON.parse(data_gudang.replace(/&quot;/g, '"'));
            var databulan = dataset[valueSelected];
            const qty_keluar = [];
            const qty_masuk = [];
            const qty_stok = [];
            const qty_stokawal = [];
            for (var j in databulan) {
                qty_keluar.push(databulan[j].qty_keluar);
                qty_stokawal.push(databulan[j].stokawal_produk);
                qty_masuk.push(databulan[j].qty_masuk);
                qty_stok.push(databulan[j].stokakhir_produk);
                if (databulan[j].TOR > 3) {
                    databulan[j]['kategori'] = 'F';
                } else if (databulan[j].TOR > 1) {
                    databulan[j]['kategori'] = 'S';
                } else {
                    databulan[j]['kategori'] = 'N';
                }
            }
            const ctx = document.getElementById('myChart');
            myChart = new Chart(ctx, {
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
                    }, {
                        label: 'Kuantitas Keluar',
                        data: qty_keluar,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Kuantitas Masuk',
                        data: qty_masuk,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Stok Akhir',
                        data: qty_stok,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
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
                    }, {
                        data: 'kategori'
                    },

                ],
                "createdRow": function(row, data, dataIndex) {
                    if (data['kategori'] == "F") {
                        $(row).addClass('bg-danger');
                        $(row).addClass('text-white');
                    }
                    if (data['kategori'] == "S") {
                        $(row).addClass('bg-success');
                        $(row).addClass('text-white');
                    }
                    if (data['kategori'] == "N") {
                        $(row).addClass('bg-warning');
                        $(row).addClass('text-white');
                    }
                },

            });

        });

        // perubahan 
        $('#tanggal').on('change', function(e) {
            myChart.destroy();
            resetCanvas();
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            var label = [
                @foreach ($product as $item)
                    "{{ $item->nama_produk }}",
                @endforeach
            ]
            var data = "{{ $chartdata }}";
            var dataset = JSON.parse(data.replace(/&quot;/g, '"'));
            var databulan = dataset[valueSelected];
            const qty_keluar = [];
            const qty_masuk = [];
            const qty_stok = [];
            const qty_stokawal = [];
            for (var j in databulan) {
                qty_keluar.push(databulan[j].qty_keluar);
                qty_stokawal.push(databulan[j].stokawal_produk);
                qty_masuk.push(databulan[j].qty_masuk);
                qty_stok.push(databulan[j].stokakhir_produk);
                if (databulan[j].TOR > 3) {
                    databulan[j]['kategori'] = 'F';
                } else if (databulan[j].TOR > 1) {
                    databulan[j]['kategori'] = 'S';
                } else {
                    databulan[j]['kategori'] = 'N';
                }
            }
            const ctx = document.getElementById('myChart');

            myChart = new Chart(ctx, {
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
                    }, {
                        label: 'Kuantitas Keluar',
                        data: qty_keluar,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Kuantitas Masuk',
                        data: qty_masuk,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 3
                    }, {
                        label: 'Stok Akhir',
                        data: qty_stok,
                        backgroundColor: [
                            'rgba(54, 162, 235)',
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
                }, {
                    data: 'kategori'
                }, ],
                "createdRow": function(row, data, dataIndex) {
                    if (data['kategori'] == "F") {
                        $(row).addClass('bg-danger');
                        $(row).addClass('text-white');
                    }
                    if (data['kategori'] == "S") {
                        $(row).addClass('bg-success');
                        $(row).addClass('text-white');
                    }
                    if (data['kategori'] == "N") {
                        $(row).addClass('bg-warning');
                        $(row).addClass('text-white');
                    }
                },
            });
        });
    </script>
    <!-- Bootstrap core JavaScript -->
    @include('templates.scripts')
    @include('templates.modal')

</body>

</html>
