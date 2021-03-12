<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\M_barang;

class Barang extends BaseController
{
	public function __construct()
	{
		if (session()->login['role'] != 'kasir' && session()->login['role'] != 'admin') return redirect()->to('');
		$this->data['aktif'] = 'barang';
	}

	public function index()
	{
		$this->m_barang = new M_barang();
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = $this->m_barang->findAll();
		$this->data['no'] = 1;

		return view('barang/lihat', $this->data);
	}

	public function tambah()
	{
		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Tambah data hanya untuk admin!');
			return redirect()->to('penjualan');
		}

		$this->data['title'] = 'Tambah Barang';

		echo view('barang/tambah', $this->data);
	}

	public function proses_tambah()
	{
		$this->m_barang = new M_barang();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Tambah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$data = [
			'kode_barang' => $this->request->getPost('kode_barang'),
			'nama_barang' => $this->request->getPost('nama_barang'),
			'harga_beli' => $this->request->getPost('harga_beli'),
			'harga_jual' => $this->request->getPost('harga_jual'),
			'stok' => $this->request->getPost('stok'),
			'satuan' => $this->request->getPost('satuan'),
		];

		if ($this->m_barang->tambah($data)) {
			session()->setFlashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
			return redirect()->to(base_url('barang'));
		} else {
			session()->setFlashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
			return redirect()->to(base_url('barang'));
		}
	}

	public function ubah($kode_barang)
	{
		$this->m_barang = new M_barang();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		echo view('barang/ubah', $this->data);
	}

	public function proses_ubah($kode_barang)
	{
		$this->m_barang = new M_barang();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$data = [
			'kode_barang' => $this->request->getPost('kode_barang'),
			'nama_barang' => $this->request->getPost('nama_barang'),
			'harga_beli' => $this->request->getPost('harga_beli'),
			'harga_jual' => $this->request->getPost('harga_jual'),
			'stok' => $this->request->getPost('stok'),
			'satuan' => $this->request->getPost('satuan'),
		];

		if ($this->m_barang->ubah($data, $kode_barang)) {
			session()->setFlashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			return redirect()->to(base_url('barang'));
		} else {
			session()->setFlashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			return redirect()->to(base_url('barang'));
		}
	}

	public function hapus($kode_barang)
	{
		$this->m_barang = new M_barang();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Hapus data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		if ($this->m_barang->hapus($kode_barang)) {
			session()->setFlashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			return redirect()->to(base_url('barang'));
		} else {
			session()->setFlashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			return redirect()->to(base_url('barang'));
		}
	}

	public function export()
	{
		$this->m_barang = new M_barang();

		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_barang'] = $this->m_barang->findAll();
		$this->data['title'] = 'Laporan Data Barang';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = view('barang/report', $this->data,);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Barang Tanggal ' . date('d F Y') . ' Jam ' . date('H: i A'), array("Attachment" => false));
	}
}
