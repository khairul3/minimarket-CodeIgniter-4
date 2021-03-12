<?php

namespace App\Controllers;

use App\Models\M_pengguna;

use Dompdf\Dompdf;

class Pengguna extends BaseController
{
	public function __construct()
	{
		if (session()->login['role'] != 'kasir' && session()->login['role'] != 'admin');
		return redirect()->to('login');
	}

	public function index()
	{
		$m_pengguna = new M_pengguna();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Managemen Pengguna hanya untuk admin!');
			return redirect()->to('penjualan');
		}

		$this->data['title'] = 'Data Pengguna';
		$this->data['all_pengguna'] = $m_pengguna->findAll();
		$this->data['no'] = 1;
		$this->data['aktif'] = 'pengguna';

		echo view('pengguna/lihat', $this->data);
	}

	public function tambah()
	{
		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Tambah data hanya untuk admin!');
			return redirect()->to('penjualan');
		}
		$this->data['aktif'] = 'pengguna';
		$this->data['title'] = 'Tambah Pengguna';

		echo view('pengguna/tambah', $this->data);
	}

	public function proses_tambah()
	{
		$m_pengguna = new M_pengguna();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Tambah data hanya untuk admin!');
			return redirect()->to('penjualan');
		}

		$data = [
			'kode_pengguna' => $this->request->getPost('kode_pengguna'),
			'nama_pengguna' => $this->request->getPost('nama_pengguna'),
			'username_pengguna' => $this->request->getPost('username_pengguna'),
			'password_pengguna' => $this->request->getPost('password_pengguna'),
		];

		if ($m_pengguna->tambah($data)) {
			session()->setFlashdata('success', 'Data Pengguna <strong>Berhasil</strong> Ditambahkan!');
			return redirect()->to(base_url('pengguna'));
		} else {
			session()->setFlashdata('error', 'Data Pengguna <strong>Gagal</strong> Ditambahkan!');
			return redirect()->to(base_url('pengguna'));
		}
	}

	public function ubah($id)
	{
		$m_pengguna = new M_pengguna();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to('penjualan');
		}

		$this->data['title'] = 'Ubah Pengguna';
		$this->data['pengguna'] = $m_pengguna->lihat_id($id);
		$this->data['aktif'] = 'pengguna';

		echo view('pengguna/ubah', $this->data);
	}

	public function proses_ubah($id)
	{
		$m_pengguna = new M_pengguna();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to('penjualan');
		}

		$data = [
			'kode_pengguna' => $this->request->getPost('kode_pengguna'),
			'nama_pengguna' => $this->request->getPost('nama_pengguna'),
			'username_pengguna' => $this->request->getPost('username_pengguna'),
			'password_pengguna' => $this->request->getPost('password_pengguna'),
		];

		if ($m_pengguna->ubah($data, $id)) {
			session()->setFlashdata('success', 'Data Pengguna <strong>Berhasil</strong> Diubah!');
			return redirect()->to('pengguna');
		} else {
			session()->setFlashdata('error', 'Data Pengguna <strong>Gagal</strong> Diubah!');
			return redirect()->to('pengguna');
		}
	}

	public function hapus($id)
	{
		$m_pengguna = new M_pengguna();

		if (session()->login['role'] == 'kasir') {
			session()->setFlashdata('error', 'Ubah data hanya untuk admin!');
			return redirect()->to(base_url('penjualan'));
		}

		if ($m_pengguna->hapus($id)) {
			session()->setFlashdata('success', 'Data Pengguna <strong>Berhasil</strong> Dihapus!');
			return redirect()->to(base_url('pengguna'));
		} else {
			session()->setFlashdata('error', 'Data Pengguna <strong>Gagal</strong> Dihapus!');
			return redirect()->to(base_url('pengguna'));
		}
	}

	public function export()
	{
		$m_pengguna = new M_pengguna();

		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_pengguna'] = $m_pengguna->lihat();
		$this->data['title'] = 'Laporan Data Pengguna';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = view('pengguna/report', $this->data,);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengguna Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
