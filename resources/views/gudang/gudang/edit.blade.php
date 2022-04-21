<!DOCTYPE html>
<html lang="en">

<head>
  @include('templates.head')
  <title>Edit Barang</title>
  <style type="text/css">
  	section img{
  		width: 30%;
  		padding-bottom: 10px;
  	}
  </style>

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
			              <h5 class="box-title">Edit data gudang</h5>
			            </div>
			            <div class="box-body">
			            	@include('gudang/validation')
			            	{!! Form::model($gudang,['route'=>['gudang.update',$gudang->id_produk],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}

			            	<div class="row">
								<div class="col-md-6 pl-3 pr-3">
									<div class="form-group">
										<label>Kode Gudang</label>
										<input required="" class="form-control" type="text" name="kode_produk"  value="{{ $gudang->kode_produk }}>
									</div>
									<div class="form-group">
										<label>Nama Gudang</label>
										<input required="" class="form-control" type="text" name="Nama Gudang"  value="{{ $gudang->nama_produk }}>
									</div>
								<div class="col-md-6 pl-3 pr-3">
									<div class="form-group">
										<label>Kapasitas Gudang Total</label>
										<input required="" class="form-control" type="number" name="KapasitasGudangTotal"  value="{{ $gudang->Kapasitas_GT }}>
									</div>
									<div class="form-group">
										<label>Kapasitas Barang F</label>
										<input required="" class="form-control" type="number" name="KapasitasBarangF"  value="{{ $gudang->Kapasitas_F }}>
									</div>
									<div class="form-group">
										<label>Kapasitas Barang S</label>
										<input required="" class="form-control" type="number" name="KapasitasBarangS"  value="{{ $gudang->Kapasitas_S }}>
									</div>
									<div class="form-group">
										<label>Kapasitas Barang N</label>
										<input required="" class="form-control" type="number" name="KapasitasBarangN"  value="{{ $gudang->Kapasitas_N }}>
									</div>
									<div class="form-group">
										<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Simpan">
										{{csrf_field()}}
										<input type="reset" class="btn btn-danger" value="Reset">
									</div>	
								</div>
							</div>
									
		            			</div>
		            		</div>
			            </div>
        			</div>
	        	</div>
	        </section>
		</div>
		<!-- /.content-wrapper -->
	</div>
	@include('templates.scripts')
</body>
</html>
