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
			<div id="content" data-url="<?= base_url('penjualan') ?>">
				<!-- load Topbar -->

				<div class="container-fluid">
					<div class="clearfix">
						<br>
						<div class="float-left">

							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('penjualan/export_detail/' . $penjualan->no_penjualan) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
							<a href="<?= base_url('penjualan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
						<div class="card-header"><strong>Detail Penjualan - <?= $penjualan->no_penjualan ?></strong></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<td><strong>No Penjualan</strong></td>
											<td>:</td>
											<td><?= $penjualan->no_penjualan ?></td>
										</tr>
										<tr>
											<td><strong>Nama Kasir</strong></td>
											<td>:</td>
											<td><?= $penjualan->nama_kasir ?></td>
										</tr>
										<tr>
											<td><strong>Waktu Penjualan</strong></td>
											<td>:</td>
											<td><?= $penjualan->tgl_penjualan ?> - <?= $penjualan->jam_penjualan ?></td>
										</tr>
									</table>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<td><strong>No</strong></td>
												<td><strong>Nama Barang</strong></td>
												<td><strong>Harga Barang</strong></td>
												<td><strong>Jumlah</strong></td>
												<td><strong>Sub Total</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($all_detail_penjualan as $detail_penjualan) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $detail_penjualan->nama_barang ?></td>
													<td>Rp <?= number_format($detail_penjualan->harga_barang, 0, ',', '.') ?></td>
													<td><?= $detail_penjualan->jumlah_barang ?> <?= strtoupper($detail_penjualan->satuan) ?></td>
													<td>Rp <?= number_format($detail_penjualan->sub_total, 0, ',', '.') ?></td>
												</tr>
											<?php endforeach ?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4" align="right"><strong>Total : </strong></td>
												<td>Rp <?= number_format($penjualan->total, 0, ',', '.') ?></td>
											</tr>
										</tfoot>
									</table>
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