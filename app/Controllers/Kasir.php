<?php

namespace App\Controllers;

use App\Models\M_kasir;
use Dompdf\Dompdf;

class Kasir extends BaseController
{
	public function __construct()
	{
		if (session()->login['role'] != 'kasir' && session()->login['role'] != 'admin');
		return redirect()->to(base_url('login'));
	}

	public function index()
	{
		$this->m_kasir = new M_kasir();
		$data = [
			'title' => 'Data kasir',
			'all_kasir' => $this->m_kasir->findAll(),
			'no' => '1',
			'aktif' => 'kasir'
		];

		return view('kasir/lihat', $data);
	}

	public function tambah()
	{
		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Tambah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$this->data['title'] = 'Tambah Kasir';
		$this->data['aktif'] = 'kasir';


		echo view('kasir/tambah', $this->data);
	}

	public function proses_tambah()
	{
		$this->m_kasir = new M_kasir();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Tambah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$data = [
			'kode_kasir' => $this->request->getPost('kode_kasir'),
			'nama_kasir' => $this->request->getPost('nama_kasir'),
			'username_kasir' => $this->request->getPost('username_kasir'),
			'password_kasir' => $this->request->getPost('password_kasir'),
		];

		if ($this->m_kasir->tambah($data)) {
			session()->setFlashdata('success', 'Data Kasir <strong>Berhasil</strong> Ditambahkan!');
			return redirect()->to(base_url('kasir'));
		} else {
			session()->setFlashdata('error', 'Data Kasir <strong>Gagal</strong> Ditambahkan!');
			return redirect()->to(base_url('kasir'));
		}
	}

	public function ubah($id)
	{
		$this->m_kasir = new M_kasir();
		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$this->data['title'] = 'Ubah Kasir';
		$this->data['kasir'] = $this->m_kasir->lihat_id($id);
		$this->data['aktif'] = 'kasir';



		echo view('kasir/ubah', $this->data);
	}

	public function proses_ubah($id)
	{
		$this->m_kasir = new M_kasir();
		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		$data = [
			'kode_kasir' => $this->request->getPost('kode_kasir'),
			'nama_kasir' => $this->request->getPost('nama_kasir'),
			'username_kasir' => $this->request->getPost('username_kasir'),
			'password_kasir' => $this->request->getPost('password_kasir'),
		];

		if ($this->m_kasir->ubah($data, $id)) {
			session()->setFlashdata('success', 'Data Kasir <strong>Berhasil</strong> Diubah!');
			return redirect()->to(base_url('kasir'));
		} else {
			session()->setFlashdata('error', 'Data Kasir <strong>Gagal</strong> Diubah!');
			return redirect()->to(base_url('kasir'));
		}
	}

	public function hapus($id)
	{
		$this->m_kasir = new M_kasir();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Hapus data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		if ($this->m_kasir->hapus($id)) {
			session()->setFlashdata('success', 'Data Kasir <strong>Berhasil</strong> Dihapus!');
			return redirect()->to(base_url('kasir'));
		} else {
			session()->setFlashdata('error', 'Data Kasir <strong>Gagal</strong> Dihapus!');
			return redirect()->to(base_url('kasir'));
		}
	}

	public function export()
	{
		$this->m_kasir = new M_kasir();

		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_kasir'] = $this->m_kasir->findAll();
		$this->data['title'] = 'Laporan Data Kasir';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = view('kasir/report', $this->data,);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Kasir Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
