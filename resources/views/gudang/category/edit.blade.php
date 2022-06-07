<!DOCTYPE html>
<html lang="en">
<head>
  @include('templates.head')
  <title>Edit Kategori</title>
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
				              <h5 class="box-title">Edit kategori training</h5>
				            </div>
				            <div class="box-body">
				            	@include('gudang/validation')
				            	@include('gudang/notification')
				            	<form action="{{ url('/category') }}/{{ $categories->id_kategori }}" method="POST">
									{{csrf_field()}}
									{{ method_field('PUT') }}
				            		<div class="form-group">
										<label>Kategori</label>
										<input class="form-control" type="text" name="nama_kategori" value="{{ $categories->nama_kategori }}">
										@if ($categories->has_expired)
										<input type="checkbox" id="has_expired" name="has_expired" checked value="1">
										<label for="has_expired"> Barang memiliki tanggal kadaluarsa</label><br>

										@else
										<input type="checkbox" id="has_expired" name="has_expired" value="1">
										<label for="has_expired"> Barang memiliki tanggal kadaluarsa</label><br>

										@endif

									</div>								
									<div class="form-group">
										<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
										<script>
											document.write('<a href="' + document.referrer + '" class="btn btn-warning">Go Back</a>');
										</script>
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