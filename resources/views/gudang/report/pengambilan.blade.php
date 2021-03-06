<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.head')
    <title>Laporan Pengambilan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        @media print {
            .tambah {
                display: none;
            }

        }
    </style>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js">
    </script>
    <script src="{{ asset('js/json-excel') }}"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="tambah">
            @include('templates.sidebar')

        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @include('templates.header')

            <!-- Main content -->
            <section class="content mt-2">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Laporan Barang Keluar</h3>
                        </div>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row page-title-header">
                                    <div class="col-12">
                                        <div class="pb-2" >
                                                <button id="btnLap" data-toggle="modal" data-target="#modalLaporan"
                                                    style="float:right; margin-left:5px;" type="submit"
                                                    class="btn btn-outline-warning btn-sm">Laporan Barang Keluar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade " id="modalLaporan">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Masukan Tanggal Laporan</h5>
                                                <form method="POST" action="/report-export">
                                                    {{ csrf_field() }}
                                                    <input id="start_date" name="start_date" type="date" required>
                                                    s/d
                                                    <input id="end_date" name='end_date' type="date" required>
                                                    <input type="hidden" name="type" id="type" value="xlsx">
                                                    <button type="submit" style="margin-top: -1px;"
                                                        class="btn btn-outline-info"><i
                                                            style="margin: -1px;"></i>Print</button>
                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <?php $no = 1; ?>
                                            <tr style="background-color: rgb(230, 230, 230);">
                                                <th>No</th>
                                                <th>Tanggal Pengambilan</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Diambil oleh</th>
                                                <th>Keterangan</th>
                                                @if (Auth::user()->akses === 'admin')
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sells as $sell)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $sell->tgl_sell }}</td>
                                                    <td>{{ $sell->products->kode_produk }}</td>
                                                    <td>{{ $sell->products->nama_produk }}</td>
                                                    <td>{{ $sell->qty }}</td>
                                                    <td>{{ $sell->users->name }}</td>
                                                    <td>{{ $sell->products->ket_produk }}</td>
                                                    @if (Auth::user()->akses === 'admin')
                                                    <td>
                                                        <form action="{{ url('report') }}/{{ $sell->id_sell }}"
                                                            method="post">
                                                            {{ method_field('delete') }}
                                                            {{ csrf_field() }}
                                                            <input class="btn btn-danger btn-sm" type="submit"
                                                                name="submit" value="Delete">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="DELETE">
                                                        </form>
                                                    </td>               
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    @include('templates.scripts')

    <!-- page script -->
    <script>
        $(document).ready(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false,

            });



        });
    </script>

    <!-- modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: rgb(200, 200, 200)">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form action="{{ route('report.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body" style="background-color: rgb(230, 230, 230)">
                        <p class="text-center">Apakah anda yakin akan menghapus ini?</p>
                        <input type="hidden" name="id_sell" id="del_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Ya, hapus ini</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak, kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('templates.modal')
</body>

</html>
