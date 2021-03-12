<!DOCTYPE html>
<html lang="en">

<head>
	<?php echo view('partials/head.php') ?>
	<!– bootstrap css –>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php echo view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">

			<div id="content" data-url="<?= base_url('pengguna') ?>">
				<!-- load Topbar -->
				<?php echo view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('pengguna/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>

							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalForm">
								<i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
							</button>
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
						<div class="card-header"><strong>Daftar Pengguna</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>No</td>
											<td>Kode Pengguna</td>
											<td>Nama Pengguna</td>
											<td>Username</td>
											<td>Password</td>
											<td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_pengguna as $pengguna) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $pengguna["kode_pengguna"] ?></td>
												<td><?= $pengguna["nama_pengguna"] ?></td>
												<td><?= $pengguna["username_pengguna"] ?></td>
												<td><?= $pengguna["password_pengguna"] ?></td>
												<td>
													<a href="<?= base_url('pengguna/ubah/' . $pengguna["id"]) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>

													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('pengguna/hapus/' . $pengguna["id"]) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<!– Modal –>
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
															<h4 class="modal-title" id="labelModalKu">Tambah Pengguna</h4>
															<p class="statusMsg"></p>
															<form role="form" action="<?= base_url('pengguna/proses_tambah') ?>" id="form-tambah" method="POST">
																<div class="form-group">
																	<label for="masukkanNama">Kode Pengguna</label>
																	<input type="text" class="form-control" id="masukkanKode" name="kode_pengguna" placeholder="Masukkan nama Anda" value="PGN<?= mt_rand(10, 99) ?> " maxlength="8" readonly />
																</div>
																<div class="form-group">
																	<label for="masukkanNama">Nama Pengguna</label>
																	<input type="text" class="form-control" id="masukkanNama" name="nama_pengguna" placeholder="Masukkan nama Anda" />
																</div>
																<div class="form-group">
																	<label for="masukkanUsername">Usename</label>
																	<input type="text" class="form-control" id="masukkanUsername" name="username_pengguna" autocomplete="off" placeholder="Masukkan Username" />
																</div>
																<div class="form-group">
																	<label for="masukkanPassword">Password</label>
																	<input type="password" class="form-control" id="masukkanPassword" name="password_pengguna" autocomplete="off" placeholder="Masukkan Password" />
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

</html>