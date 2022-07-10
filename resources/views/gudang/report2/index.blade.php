<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.head')
    <title>Laporan Pengambilan</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @include('templates.sidebar')
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @include('templates.header')

            <!-- Main content -->
            <section class="content mt-2">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Laporan Barang Masuk</h3>
                        </div>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row page-title-header">
                                    <div class="col-12">
                                        <div class="page-header">
                                                <button id="btnLap" data-toggle="modal" data-target="#modalLaporan"
                                                    style="float:right; margin-left:5px;" type="submit"
                                                    class="btn btn-outline-warning btn-sm">Laporan Barang Masuk</button>
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
                                                <form method="POST" action="/report2-export">
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
                            @include('gudang/notification')
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <?php $no = 1; ?>
                                    <tr style="background-color: rgb(230, 230, 230);">
                                        <th>Tanggal Masuk</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Expired</th>
                                        <th>Keterangan</th>
                                        {{-- @if (Auth::user()->akses !== 'admin')
                                            <th style="display: none;" class="none">Action</th>
                                        @else
                                            <th class="none">Action</th>
                                        @endif --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->tgl_purchase }}</td>
                                            <td>{{ $purchase->products->kode_produk }}</td>
                                            <td>{{ $purchase->products->nama_produk }}</td>
                                            <td>{{ $purchase->qty_purchase }}</td>
                                            <td>{{ $purchase->expired }}</td>
                                            <td>{{ $purchase->products->ket_produk }}</td>
                                            {{-- <td>
                                                <form action="{{ url('report2')}}/{{$purchase->id_purchase}}" method="post">
                                                  {{method_field('delete')}}
                                                  {{csrf_field()}}
                                                  <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                                                  {{csrf_field()}}
                                                  <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                              </td>                                                 --}}
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
        $(function() {
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'order': [0, 'desc'],
                'dom' : 'Bfrtip',
                'buttons' : [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            });
            })
           
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
                <form action="{{ route('report2.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body" style="background-color: rgb(230, 230, 230)">
                        <p class="text-center">Apakah anda yakin akan menghapus ini?</p>
                        <input type="hidden" name="id_purchase" id="del_id" value="">
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
