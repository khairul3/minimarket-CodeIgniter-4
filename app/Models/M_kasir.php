<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kasir extends Model
{
	protected $table = 'kasir';

	public function lihat()
	{
		return $this->db->table('kasir');
	}

	public function jumlah()
	{
		$sql = "SELECT COUNT(*) as Count FROM kasir";

		//Execute the query and assign the result to the $row variable
		$result = $this->db->query($sql);
		$row = $result->getRow();

		//Get the count from the $row variable and return the result to the caller
		return $row->Count;
	}

	public function lihat_id($id)
	{
		return $this->db->table('kasir')->where(['id' => $id])->get()->getRow();
	}

	public function lihat_username($username_kasir)
	{
		return $this->db->table('kasir')->where(['username_kasir' => $username_kasir])->get()->getRow();
	}

	public function tambah($data)
	{
		return $this->db->table('kasir')->insert($data);
	}

	public function ubah($data, $id)
	{

		return $this->db->table('kasir')->update($data, ['id' => $id]);
	}

	public function hapus($id)
	{
		return $this->db->table('kasir')->delete(['id' => $id]);
	}
}
