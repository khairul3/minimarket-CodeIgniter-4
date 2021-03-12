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
			<div id="content" data-url="<?= base_url('barang') ?>">
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
									<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
								</div>
							</div>
							<br>
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('barang/proses_ubah/' . $barang->kode_barang) ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="kode_barang"><strong>Kode Barang</strong></label>
												<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= $barang->kode_barang ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_barang"><strong>Nama Barang</strong></label>
												<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required value="<?= $barang->nama_barang ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="harga_beli"><strong>Harga Beli</strong></label>
												<input type="number" name="harga_beli" placeholder="Masukkan Harga Beli" autocomplete="off" class="form-control" required value="<?= $barang->harga_beli ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="harga_jual"><strong>Harga Jual</strong></label>
												<input type="number" name="harga_jual" placeholder="Masukkan Harga Jual" autocomplete="off" class="form-control" required value="<?= $barang->harga_jual ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="stok"><strong>Stok</strong></label>
												<input type="number" name="stok" placeholder="Masukkan Stok" autocomplete="off" class="form-control" required value="<?= $barang->stok ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="satuan"><strong>Satuan</strong></label>
												<select name="satuan" id="satuan" class="form-control" required>
													<option value="">-- Silahkan Pilih --</option>
													<option value="pcs" <?= $barang->satuan == 'pcs' ? 'selected' : '' ?>>PCS</option>
													<option value="sachet" <?= $barang->satuan == 'sachet' ? 'selected' : '' ?>>SACHET</option>
													<option value="renceng" <?= $barang->satuan == 'renceng' ? 'selected' : '' ?>>RENCENG</option>
													<option value="pak" <?= $barang->satuan == 'pak' ? 'selected' : '' ?>>PAK</option>
													<option value="kg" <?= $barang->satuan == 'kg' ? 'selected' : '' ?>>KILOGRAM</option>
													<option value="ons" <?= $barang->satuan == 'ons' ? 'selected' : '' ?>>ONS</option>
												</select>
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
	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>


</html>