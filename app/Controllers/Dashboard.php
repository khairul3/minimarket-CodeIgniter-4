<?php


namespace App\Controllers;

use App\Models\M_kasir;
use App\Models\M_pengguna;
use App\Models\M_barang;
use App\Models\M_toko;
use App\Models\M_penjualan;

class Dashboard extends BaseController
{
	public function __construct()
	{
		if (session()->login['role'] != 'kasir' && session()->login['role'] != 'admin');
		return redirect()->to('login');
	}
	public function index()
	{
		$this->m_barang = new M_barang();
		$this->m_kasir = new M_kasir();
		$this->m_pengguna = new M_pengguna();
		$this->m_penjualan = new M_penjualan();
		$this->m_toko = new M_toko();

		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_barang'] = $this->m_barang->jumlah();
		$this->data['jumlah_kasir'] = $this->m_kasir->jumlah();
		$this->data['jumlah_penjualan'] = $this->m_penjualan->jumlah();
		$this->data['jumlah_pengguna'] = $this->m_pengguna->jumlah();
		$this->data['toko'] = $this->m_toko->lihat();
		$this->data['aktif'] = 'dashboard';
		return view('dashboard', $this->data);
	}
}
