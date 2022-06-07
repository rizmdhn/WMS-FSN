<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.head')

    <title>Detail Barang</title>
    <style type="text/css">
        section {
            min-height: 1000px;
        }

    </style>
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

            <!-- Main content -->
            <section class="content mt-2">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Detail data barang</h3>
                        </div>
                        <!-- /.box-header -->
                        @include('gudang/notification')

                        <div class="box-body">
                            <div>
                                <a href="{{ url('/product') }}"> <button class="btn btn-primary btn-sm"><i
                                            class="#"></i> Kembali</button></a>
                            </div><br>
                            <div class="card" style="width: 22rem;">
                                <img class="card-img-top" src="{{ asset('image/' . $products->image) }}"
                                    style="width: 100%;margin-bottom: 10px;">
                                <div class="card-body">

                                    <p class="card-text"><b>{{ $products->kode_produk }} /
                                            {{ $products->nama_produk }}</b><br>
                                        {{ $products->categories->nama_kategori }}<br>
                                        Supplier : <b>{{ $products->suppliers->nama_supplier }}</b><br>
                                        stok : {{ $products->stok_produk }} {{ $products->units->nama_unit }}<br>
                                        lokasi : {{ $products->gudang->nama_gudang }}<br>
                                        Keterangan : {{ $products->ket_produk }}<br>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <hr>
                <div class="px-2 py-2">
                <h4>History</h4>
                <table id="table_id" class=" table w-100 px-5 py-2">
                    <?php $no = 1; ?>
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Expired</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($purchase as $item)
                            @if ($item->expired <= \Carbon\Carbon::now() && $item->expired != null && $item->is_deleted == false)
                                <tr class='bg-warning'>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->tgl_purchase }}</td>
                                    <td>{{ $item->qty_purchase }}</td>
                                    <td>{{ $item->expired }}</td>
                                    <td>
                                        <form action="{{ url('purchase') }}/notif/{{ $item->id_purchase }}"
                                            method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                            <input class="btn btn-danger btn-sm" type="submit" name="submit"
                                                value="Delete">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                  <td>{{ $no++ }}</td>
                                    <td>{{ $item->tgl_purchase }}</td>
                                    <td>{{ $item->qty_purchase }}</td>
                                    <td>{{ $item->expired }}</td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
              </div>

            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
<script>
     $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
</script>
</body>

</html>
