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
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php echo view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<?php if (session()->login['role'] == 'admin') : ?>
								<a href="<?= base_url('barang/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>

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
						<div class="card-header"><strong>Daftar Barang</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>No</td>
											<td>Kode Barang</td>
											<td>Nama Barang</td>
											<td>Harga Beli</td>
											<td>Harga Jual</td>
											<td>Stok</td>
											<?php if (session()->login['role'] == 'admin') : ?>
												<td>Aksi</td>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_barang as $barang) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $barang["kode_barang"] ?></td>
												<td><?= $barang["nama_barang"] ?></td>
												<td>Rp <?= number_format($barang["harga_beli"], 0, ',', '.') ?></td>
												<td>Rp <?= number_format($barang["harga_jual"], 0, ',', '.') ?></td>
												<td><?= $barang["stok"] ?> <?= strtoupper($barang["satuan"]) ?></td>
												<?php if (session()->login['role'] == 'admin') : ?>
													<td>
														<a href="<?= base_url('barang/ubah/' . $barang["kode_barang"]) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
														<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('barang/hapus/' . $barang["kode_barang"]) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

													<!– Modal Body –>
														<div class="modal-body">
															<h4 class="modal-title" id="labelModalKu">Tambah Barang</h4>
															<p class="statusMsg"></p>
															<form role="form form-control-lg" action="<?= base_url('barang/proses_tambah') ?>" id="form-tambah" method="POST">

																<div class="form-group">
																	<label for="kode_barang"><strong>Kode Barang</strong></label>
																	<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" readonly>
																</div>
																<div class="form-group">
																	<label for="nama_barang"><strong>Nama Barang</strong></label>
																	<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required>
																</div>

																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="harga_beli"><strong>Harga Beli</strong></label>
																		<input type="number" name="harga_beli" placeholder="Masukkan Harga Beli" autocomplete="off" class="form-control" required>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="harga_jual"><strong>Harga Jual</strong></label>
																		<input type="number" name="harga_jual" placeholder="Masukkan Harga Jual" autocomplete="off" class="form-control" required>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="stok"><strong>Stok</strong></label>
																		<input type="number" name="stok" placeholder="Masukkan Stok" autocomplete="off" class="form-control" required>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="satuan"><strong>Satuan</strong></label>
																		<select name="satuan" id="satuan" class="form-control" required>
																			<option value="">-- Silahkan Pilih --</option>
																			<option value="pcs">PCS</option>
																			<option value="sachet">SACHET</option>
																			<option value="renceng">RENCENG</option>
																			<option value="pak">PAK</option>
																			<option value="kg">KILOGRAM</option>
																			<option value="ons">ONS</option>
																		</select>
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