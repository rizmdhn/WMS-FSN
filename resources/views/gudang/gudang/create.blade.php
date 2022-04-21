<!DOCTYPE html>
<html lang="en">

<head>

  @include('templates.head')
  <title>Tambah Barang</title>

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
	            			<div class="box-header">
				              <h5 class="box-title">Tambah data barang gudang</h5>
				            </div>
				            <div class="box-body">
				            	@include('gudang/validation')
				            	@include('gudang/notification')
				            	<form action="{{ url('/gudang') }}" method="post" enctype="multipart/form-data">
				            		<div class="row">			            				
				            			<div class="col-md-6 pl-3 pr-3">
											<div class="form-group">
												<label>Kode Gudang</label>
												<input required="" class="form-control" type="text" name="kode_gudang">
											</div>
											<div class="form-group">
												<label>Nama Gudang</label>
												<input required="" class="form-control" type="text" name="nama_gudang">
											</div>
											<div class="form-group">
												<label>Kapasitas Gudang Total</label>
												<input required="" class="form-control" type="number" name="KapasitasGudangTotal">
											</div>
											<div class="form-group">
												<label>Kapasitas Barang F</label>
												<input required="" class="form-control" type="number" name="KapasitasBarangF">
											</div>
											<div class="form-group">
												<label>Kapasitas Barang S</label>
												<input required="" class="form-control" type="number" name="KapasitasBarangS">
											</div>
											<div class="form-group">
												<label>Kapasitas Barang N</label>
												<input required="" class="form-control" type="number" name="KapasitasBarangN">
											</div>
											<div>
												<input class="btn btn-primary" type="submit" name="submit" value="Tambahkan">
												{{csrf_field()}}
												<input type="reset" class="btn btn-danger" value="Reset">
											</div>	
				            			</div>
				            		</div>
				            	</form>
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
