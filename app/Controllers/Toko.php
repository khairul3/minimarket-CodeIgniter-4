<?php

namespace App\Controllers;

use App\Models\M_toko;

class Toko extends BaseController
{
	public function __construct()
	{
		$this->data['aktif'] = 'toko';
	}

	public function index()
	{
		$this->m_toko = new M_toko();
		$this->data['title'] = 'Profil Toko';
		$this->data['toko'] = $this->m_toko->lihat();
		echo view('toko', $this->data);
	}

	public function proses_ubah()
	{
		$this->m_toko = new M_toko();

		$data = [
			'nama_toko' => $this->request->getPost('nama_toko'),
			'nama_pemilik' => $this->request->getPost('nama_pemilik'),
			'no_telepon' => $this->request->getPost('no_telepon'),
			'alamat' => $this->request->getPost('alamat'),
		];

		if ($this->m_toko->ubah($data)) {
			session()->setFlashdata('success', 'Profil Toko <strong>Berhasil</strong> Diubah!');
			return redirect()->to(base_url('toko'));
		} else {
			session()->setFlashdata('error', 'Profil Toko <strong>Gagal</strong> Diubah!');
			return redirect()->to(base_url('toko'));
		}
	}
}
