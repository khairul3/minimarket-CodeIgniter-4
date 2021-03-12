<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">

</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->

				<div class="container-fluid">

					<br>
					<div class="row">
						<div class="col-md-6">
							<div class="clearfix">
								<div class="float-left">
									<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
								</div>
								<div class="float-right">
									<a href="<?= base_url('kasir') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
								</div>
							</div>
							<br>
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('kasir/proses_ubah/' . $kasir->id) ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="kode_kasir"><strong>Kode Kasir</strong></label>
												<input type="text" name="kode_kasir" placeholder="Masukkan Kode Kasir" autocomplete="off" class="form-control" required value="<?= $kasir->kode_kasir ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_kasir"><strong>Nama Kasir</strong></label>
												<input type="text" name="nama_kasir" placeholder="Masukkan Nama Kasir" autocomplete="off" class="form-control" required value="<?= $kasir->nama_kasir ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="username_kasir"><strong>Username</strong></label>
												<input type="text" name="username_kasir" placeholder="Masukkan Username" autocomplete="off" class="form-control" required value="<?= $kasir->username_kasir ?>" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="password_kasir"><strong>Password</strong></label>
												<input type="text" name="password_kasir" placeholder="Masukkan Password" autocomplete="off" class="form-control" required value="<?= $kasir->password_kasir ?>">
											</div>
										</div>
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>


</html>