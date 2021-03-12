<?php

namespace App\Models;

use CodeIgniter\Model;

class M_penjualan extends Model
{
	protected $table = 'penjualan';

	public function lihat()
	{
		// return $this->db->get($this->_table)->result();
		return $this->db->table('penjualan');
	}

	public function jumlah()
	{
		$sql = "SELECT COUNT(*) as Count FROM penjualan";

		//Execute the query and assign the result to the $row variable
		$result = $this->db->query($sql);
		$row = $result->getRow();

		//Get the count from the $row variable and return the result to the caller
		return $row->Count;
	}

	public function lihat_no_penjualan($no_penjualan)
	{
		// return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->row();


		return $this->db->table('penjualan')->where(['no_penjualan' => $no_penjualan])->get()->getRow();
	}

	public function tambah($data)
	{
		// return $this->db->insert($this->_table, $data);

		return $this->db->table('penjualan')->insert($data);
	}

	public function hapus($no_penjualan)
	{
		// return $this->db->delete($this->_table, ['no_penjualan' => $no_penjualan]);

		return $this->db->table('penjualan')->delete(['no_penjualan' => $no_penjualan]);
	}
}
