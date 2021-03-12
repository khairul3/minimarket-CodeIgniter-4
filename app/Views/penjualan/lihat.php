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
			<div id="content" data-url="<?= base_url('penjualan') ?>">
				<!-- load Topbar -->
				<?php echo view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('penjualan/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>

							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalForm">
								<i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Penjualan</a>
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
						<div class="card-header"><strong>Daftar Penjualan</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>No Penjualan</td>
											<td>Nama Kasir</td>
											<td>Tanggal Penjualan</td>
											<td>Total</td>
											<td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_penjualan as $penjualan) : ?>
											<tr>
												<td><?= $penjualan["no_penjualan"] ?></td>
												<td><?= $penjualan["nama_kasir"] ?></td>
												<td><?= $penjualan["tgl_penjualan"] ?> Pukul <?= $penjualan["jam_penjualan"] ?></td>
												<td>Rp <?= number_format($penjualan["total"], 0, ',', '.') ?></td>
												<td>
													<a href="<?= base_url('penjualan/detail/' . $penjualan["no_penjualan"]) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('penjualan/hapus/' . $penjualan["no_penjualan"]) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
								<!– Modal –>
									<div class="modal fade" id="modalForm" role="dialog">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<!– Modal Header –>
													<div class="modal-header">
														<h4 class="modal-title" id="labelModalKu" style="text-align: center;">Tambah Penjualan</h4>
														<button type="button" class="close" data-dismiss="modal">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<!– Modal Body –>
														<div class="modal-body">
															<p class="statusMsg"></p>
															<form role="form" action="<?= base_url('penjualan/proses_tambah') ?>" id="form-tambah" method="POST">
																<h5>Data Kasir</h5>
																<hr>
																<div class="form-row">
																	<div class="form-group col-3">
																		<label>No. Penjualan</label>
																		<input type="text" name="no_penjualan" value="PJ<?= time() ?>" readonly class="form-control">
																	</div>
																	<div class="form-group col-2">
																		<label>Kode Kasir</label>
																		<input type="text" name="kode_kasir" value="<?= session()->login['kode'] ?>" readonly class="form-control">
																	</div>
																	<div class="form-group col-3">
																		<label>Nama Kasir</label>
																		<input type="text" name="nama_kasir" value="<?= session()->login['nama'] ?>" readonly class="form-control">
																	</div>
																	<div class="form-group col-2">
																		<label>Tanggal</label>
																		<input type="text" name="tgl_penjualan" value="<?= date('d/m/Y') ?>" readonly class="form-control">
																	</div>
																	<div class="form-group col-2">
																		<label>Jam</label>
																		<input type="text" name="jam_penjualan" value="<?= date('H:i:s') ?>" readonly class="form-control">
																	</div>
																</div>
																<h5>Pilih Barang</h5>
																<hr>
																<div class="form-row">
																	<div class="form-group col-3">
																		<label for="nama_barang">Nama Barang</label>
																		<select name="nama_barang" id="nama_barang" class="form-control">
																			<option value="">Pilih Barang</option>
																			<?php foreach ($all_barang as $barang) : ?>
																				<option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
																			<?php endforeach ?>
																		</select>
																	</div>
																	<div class="form-group col-3">
																		<label>Kode Barang</label>
																		<input type="text" name="kode_barang" value="" readonly class="form-control">
																	</div>
																	<div class="form-group col-2">
																		<label>Harga Barang</label>
																		<input type="text" name="harga_barang" value="" readonly class="form-control">
																	</div>
																	<div class="form-group col-2">
																		<label>Jumlah</label>
																		<input type="number" name="jumlah" value="" class="form-control" readonly min='1'>
																	</div>
																	<div class="form-group col-2">
																		<label>Sub Total</label>
																		<input type="number" name="sub_total" value="" class="form-control" readonly>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-3">
																		<button type="submit" id="tambah" class="btn btn-primary"> simpan</button>
																		<button type="reset" class="btn btn-danger"></i> reset</button>
																	</div>
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
	<!-- jquery -->
	<script>
		$(document).ready(function() {
			$('tfoot').hide()

			$(document).keypress(function(event) {
				if (event.which == '13') {
					event.preventDefault();
				}
			})

			$('#nama_barang').on('change', function() {
				if ($(this).val() == '') reset()
				else {
					const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					$.ajax({
						url: url_get_all_barang,
						type: 'POST',
						dataType: 'json',
						data: {
							nama_barang: $(this).val()
						},
						success: function(data) {
							$('input[name="kode_barang"]').val(data.kode_barang)
							$('input[name="harga_barang"]').val(data.harga_jual)
							$('input[name="jumlah"]').val(1)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())

							$('input[name="jumlah"]').on('keydown keyup change blur', function() {
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					})
				}
			})


		})
	</script>
</body>

</html>