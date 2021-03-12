<?php

namespace App\Models;

use CodeIgniter\Model;

class M_barang extends Model
{
	protected $table = 'barang';

	public function lihat()
	{
		return $this->db->table('barang');
	}

	public function jumlah()
	{
		$sql = "SELECT COUNT(*) as Count FROM barang";

		//Execute the query and assign the result to the $row variable
		$result = $this->db->query($sql);
		$row = $result->getRow();

		//Get the count from the $row variable and return the result to the caller
		return $row->Count;
	}

	public function lihat_stok()
	{

		return $this->db->table('barang')->where(['stok > 1'])->get()->getResult();
	}

	public function lihat_id($kode_barang)
	{

		return $this->db->table('barang')->where(['kode_barang' => $kode_barang])->get()->getRow();
	}

	public function lihat_nama_barang($nama_barang)
	{

		return $this->db->table('barang')->where(['nama_barang' => $nama_barang])->get()->getRow();
	}

	public function tambah($data)
	{
		// return $this->db->insert($this->_table, $data);
		return $this->db->table('barang')->insert($data);
	}

	public function min_stok($stok, $nama_barang)
	{
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang)
	{
		// $query = $this->db->set($data);
		// $query = $this->db->where(['kode_barang' => $kode_barang]);
		// $query = $this->db->update($this->_table);
		// return $query;

		return $this->db->table('barang')->update($data, ['kode_barang' => $kode_barang]);
	}

	public function hapus($kode_barang)
	{
		// return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
		return $this->db->table('barang')->delete(['kode_barang' => $kode_barang]);
	}
}
