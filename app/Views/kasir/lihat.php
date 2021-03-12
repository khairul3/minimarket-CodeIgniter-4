<!DOCTYPE html>
<html lang="en">

<head>
	<?php echo view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php echo view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php echo view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<?php if (session()->login['role'] == 'admin') : ?>
								<a href="<?= base_url('kasir/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
								<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalForm">
									<i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
								</button>
							<?php endif ?>
						</div>
					</div>
					<hr>
					<?php if (session()->getFlashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= session()->getFlashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif (session()->getFlashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= session()->getFlashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>
					<div class="card shadow">
						<div class="card-header"><strong>Daftar Kasir</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>No</td>
											<td>Kode Kasir</td>
											<td>Nama Kasir</td>
											<td>Username</td>
											<?php if (session()->login['role'] == 'admin') : ?>
												<td>Password</td>
												<td>Aksi</td>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_kasir as $kasir) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $kasir["kode_kasir"]; ?></td>
												<td><?= $kasir["nama_kasir"] ?></td>
												<td><?= $kasir["username_kasir"] ?></td>
												<?php if (session()->login['role'] == 'admin') : ?>
													<td><?= $kasir["password_kasir"] ?></td>
													<td>
														<a href="<?= base_url('kasir/ubah/' . $kasir["id"]) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
														<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('kasir/hapus/' . $kasir["id"]) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
													</td>
												<?php endif ?>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<div class="modal fade" id="modalForm" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<!– Modal Header –>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">
														<span aria-hidden="true">&times;</span>
														<span class="sr-only">Tutup</span>
													</button>
												</div>
												<!– Modal Body –>
													<div class="modal-body">
														<h4 class="modal-title" id="labelModalKu">Tambah Kasir</h4>
														<p class="statusMsg"></p>
														<form role="form" action="<?= base_url('kasir/proses_tambah') ?>" id="form-tambah" method="POST">
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label for="kode_kasir"><strong>Kode Kasir</strong></label>
																	<input type="text" name="kode_kasir" placeholder="Masukkan Kode Kasir" autocomplete="off" class="form-control" required value="KASIR - <?= mt_rand(10, 99) ?>" maxlength="8" readonly>
																</div>
																<div class="form-group col-md-6">
																	<label for="nama_kasir"><strong>Nama Kasir</strong></label>
																	<input type="text" name="nama_kasir" placeholder="Masukkan Nama Kasir" autocomplete="off" class="form-control" required>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label for="username_kasir"><strong>Username</strong></label>
																	<input type="text" name="username_kasir" placeholder="Masukkan Username" autocomplete="off" class="form-control" required readonly>
																</div>
																<div class="form-group col-md-6">
																	<label for="password_kasir"><strong>Password</strong></label>
																	<input type="text" name="password_kasir" placeholder="Masukkan Password" autocomplete="off" class="form-control" required>
																</div>
															</div>
															<!– Modal Footer –>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php echo view('partials/footer.php') ?>
		</div>
	</div>
	<?php echo view('partials/js.php') ?>
	<script src="sb-admin/js/demo/datatables-demo.js"></script>
	<script src="sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
<script>
	$(document).ready(function() {
		let username_kasir = $('input[name="kode_kasir"]').val().split(' - ');
		username_kasir = 'KSR' + username_kasir[1]
		$('input[name="username_kasir"]').val(username_kasir)
	})
</script>

</html>