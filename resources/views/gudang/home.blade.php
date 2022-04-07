<!DOCTYPE html>
<html lang="en">

<head>

  @include('templates.head')
  <title>Sistem Informasi Pergudangan</title>

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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @foreach($record as $object)
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <?php $no=1; ?>
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
                  @foreach ($object as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->kode_produk }}</td>
                      <td>{{ $data->nama_produk }}</td>
                      <td>{{ $data->stokawal_produk }}</td>
                      <td>Pada {{ $data->Tanggal .' Sejumlah '. $data->qty_masuk}}</td>
                      <td>Pada {{ $data->Tanggal .' Sejumlah '. $data->qty_keluar}}</td>
                      <td>{{ $data->stokakhir_produk }}</td>
                    </tr>
                    
  

                    
                    @endforeach
                  </tr>
                </tbody>
              </table>
              <strong>Hasil Perhitungan Data : </strong>
              <br>

                 @foreach ($object as $data)
                 <strong>Per Tanggal {{ $data->Tanggal }}</strong> 
                 <strong>Persediaan Rata-Rata : </strong> {{ $data->Rata2_persediaan }} 
                 <strong>TOR Partial : </strong> {{ $data->TOR_partial }} 
                 <strong>WSP : </strong> {{ $data->WSP }} 
                 <strong>TOR : </strong> {{ $data->TOR }} 
                 <br>
                 @endforeach
                 <br>
                 <hr>

              @endforeach

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </section>

      @include('templates.scripts')

      <!-- page script -->
      <script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
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
