<?php

namespace App\Controllers;

use App\Models\M_penjualan;
use App\Models\M_barang;
use App\Models\M_detail_penjualan;
use Dompdf\Dompdf;

class Penjualan extends BaseController
{
	public function __construct()
	{
		if (session()->login['role'] != 'kasir' && session()->login['role'] != 'admin');
		return redirect()->to('login');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$m_penjualan = new M_penjualan();
		$m_barang = new M_barang();
		$this->data['title'] = 'Data Penjualan';
		$this->data['all_penjualan'] = $m_penjualan->findAll();
		$this->data['aktif'] = 'penjualan';
		$this->data['all_barang'] = $m_barang->lihat_stok();

		echo view('penjualan/lihat', $this->data);
	}

	public function tambah()
	{
		echo view('penjualan/lihat', $this->data);
	}

	public function proses_tambah()
	{
		// $jumlah_barang_dibeli = count($this->request->getPost('nama_barang_hidden'));

		$data_penjualan = [
			'no_penjualan' => $this->request->getPost('no_penjualan'),
			'nama_kasir' => $this->request->getPost('nama_kasir'),
			'tgl_penjualan' => $this->request->getPost('tgl_penjualan'),
			'jam_penjualan' => $this->request->getPost('jam_penjualan'),
			'total' => $this->request->getPost('total_hidden'),
		];

		$data_detail_penjualan = [
			'no_penjualan' => $this->request->getPost('no_penjualan'),
			'nama_barang' => $this->request->getPost('nama_barang'),
			'harga_barang' => $this->request->getPost('harga_barang'),
			'jumlah_barang' => $this->request->getPost('jumlah'),
			'satuan' => $this->request->getPost('satuan'),
			'sub_total' => $this->request->getPost('sub_total'),
		];

		$data_detail_penjualan['nama_barang'] = $this->request->getPost('nama_barang_hidden');
		$data_detail_penjualan['no_penjualan'] = $this->request->getPost('no_penjualan');
		$data_detail_penjualan['harga_barang'] = $this->request->getPost('harga_barang_hidden');
		$data_detail_penjualan['jumlah_barang'] = $this->request->getPost('jumlah_hidden');
		$data_detail_penjualan['satuan'] = $this->request->getPost('satuan_hidden');
		$data_detail_penjualan['sub_total'] = $this->request->getPost('sub_total_hidden');


		$m_penjualan = new M_penjualan();
		$m_detail_penjualan = new M_detail_penjualan();
		if ($m_penjualan->tambah($data_penjualan) && $m_detail_penjualan->tambah($data_detail_penjualan)) {
			session()->setFlashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			return redirect()->to(base_url('penjualan'));
		} else {
			session()->setFlashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			return redirect()->to(base_url('penjualan'));
		}
	}

	public function detail($no_penjualan)
	{
		$m_penjualan = new M_penjualan();
		$m_detail_penjualan = new M_detail_penjualan();
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $m_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['no'] = 1;
		$this->data['aktif'] = 'penjualan';

		return view('penjualan/detail', $this->data);
	}

	public function hapus($no_penjualan)
	{
		$m_penjualan = new M_penjualan();
		$m_detail_penjualan = new M_detail_penjualan();
		if ($m_penjualan->hapus($no_penjualan) && $m_detail_penjualan->hapus($no_penjualan)) {
			session()->setFlashdata('success', 'Invoice Penjualan <strong>Berhasil</strong> Dihapus!');
			return redirect()->to(base_url('penjualan'));
		} else {
			session()->setFlashdata('error', 'Invoice Penjualan <strong>Gagal</strong> Dihapus!');
			return redirect()->to(base_url('penjualan'));
		}
	}


	public function get_all_barang()
	{
		$m_barang = new M_barang();

		$data = $m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang()
	{
		echo view('penjualan/keranjang');
	}

	public function export()
	{
		$dompdf = new Dompdf();
		$m_penjualan = new M_penjualan();

		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_penjualan'] = $m_penjualan->findAll();
		$this->data['title'] = 'Laporan Data Penjualan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = view('penjualan/report', $this->data,);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penjualan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_penjualan)
	{
		$dompdf = new Dompdf();
		$m_penjualan = new M_penjualan();
		$m_detail_penjualan = new M_detail_penjualan();


		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penjualan'] = $m_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['title'] = 'Laporan Detail Penjualan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = view('penjualan/detail_report', $this->data,);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penjualan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
