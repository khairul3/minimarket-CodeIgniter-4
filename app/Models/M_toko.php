<?php

namespace App\Models;

use CodeIgniter\Model;

class M_toko extends Model
{
	protected $_table = 'data_toko';

	public function lihat()
	{
		// return $this->db->get_where($this->_table, ['id' => 1])->row();

		return $this->db->table('data_toko')->where(['id' => 1])->get()->getRow();
	}

	public function ubah($data)
	{
		// $query = $this->db->set($data);
		// $query = $this->db->where(['id' => 1]);
		// $query = $this->db->update($this->_table);
		// return $query;

		return $this->db->table('data_toko')->update($data, ['id' => 1]);
	}
}
