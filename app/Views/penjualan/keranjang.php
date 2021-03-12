<tr class="row-keranjang">
	<td class="nama_barang">
		<?= $this->request->getPost('nama_barang') ?>
		<input type="hidden" name="nama_barang_hidden[]" value="<?= $this->request->getPost('nama_barang') ?>">
	</td>
	<td class="harga_barang">
		<?= $this->request->getPost('harga_barang') ?>
		<input type="hidden" name="harga_barang_hidden[]" value="<?= $this->request->getPost('harga_barang') ?>">
	</td>
	<td class="jumlah">
		<?= $this->request->getPost('jumlah') ?>
		<input type="hidden" name="jumlah_hidden[]" value="<?= $this->request->getPost('jumlah') ?>">
	</td>
	<td class="satuan">
		<?= strtoupper($this->request->getPost('satuan')) ?>
		<input type="hidden" name="satuan_hidden[]" value="<?= $this->request->getPost('satuan') ?>">
	</td>
	<td class="sub_total">
		<?= $this->request->getPost('sub_total') ?>
		<input type="hidden" name="sub_total_hidden[]" value="<?= $this->request->getPost('sub_total') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->request->getPost('nama_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>