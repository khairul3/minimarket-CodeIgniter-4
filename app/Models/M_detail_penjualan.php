<?php

namespace App\Models;

use CodeIgniter\Model;

class M_detail_penjualan extends Model
{
	protected $table = 'detail_penjualan';

	public function tambah($data)
	{

		return $this->db->table('detail_penjualan')->insert($data);
	}

	public function lihat_no_penjualan($no_penjualan)
	{
		// return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->result();

		return $this->db->table('detail_penjualan')->where(['no_penjualan' => $no_penjualan])->get()->getResult();
	}

	public function hapus($no_penjualan)
	{

		return $this->db->table('kasir')->delete(['no_penjualan' => $no_penjualan]);
	}
}
