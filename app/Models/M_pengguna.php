<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengguna extends Model
{
	protected $table = 'pengguna';

	public function lihat()
	{
		return $this->db->table('pengguna');
	}

	public function jumlah()
	{
		$sql = "SELECT COUNT(*) as Count FROM pengguna";

		//Execute the query and assign the result to the $row variable
		$result = $this->db->query($sql);
		$row = $result->getRow();

		//Get the count from the $row variable and return the result to the caller
		return $row->Count;
	}

	public function lihat_id($id)
	{
		return  $this->db->table('pengguna')->where(['id' => $id])->get()->getRow();
	}

	public function lihat_username($username_pengguna)
	{
		return $this->db->table('pengguna')->where(['username_pengguna' => $username_pengguna])->get()->getRow();
	}

	public function tambah($data)
	{
		return $this->db->table('pengguna')->insert($data);
	}

	public function ubah($data, $id)
	{

		return $this->db->table('pengguna')->update($data, ['id' => $id]);
	}

	public function hapus($id)
	{
		return $this->db->table('pengguna')->delete(['id' => $id]);
	}
}
