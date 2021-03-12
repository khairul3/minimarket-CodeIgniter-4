<?php

namespace App\Controllers;

use App\Models\M_kasir;
use App\Models\M_pengguna;

class Login extends BaseController
{

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		if (session()->login);
		return redirect()->to('dashboard');
	}

	public function index()
	{
		return view('login');
	}

	public function proses_login()
	{
		if ($this->request->getPost('role') === 'kasir') {

			$m_kasir = new M_kasir();
			$username = $this->request->getPost('username');
			$get_kasir = $m_kasir->lihat_username($username);
			if ($get_kasir) {
				if ($get_kasir->password_kasir == $this->request->getPost('password')) {
					$session = [
						'kode' => $get_kasir->kode_kasir,
						'nama' => $get_kasir->nama_kasir,
						'username' => $get_kasir->username_kasir,
						'password' => $get_kasir->password_kasir,
						'role' => $this->request->getPost('role'),
						'jam_masuk' => date('H:i:s')
					];

					session()->set('login', $session);
					session()->setFlashdata('success', '<strong>Login</strong> Berhasil!');
					return redirect()->to(base_url('dashboard'));
				} else {
					session()->setFlashdata('error', 'Password Salah!');
					return redirect()->to(base_url('login'));
				}
			} else {
				session()->setFlashdata('error', 'Username Salah!');
				return redirect()->to(base_url('login'));
			}
		} elseif ($this->request->getPost('role') === 'admin') {
			$m_pengguna = new M_pengguna();
			$username = $this->request->getPost('username');
			$get_pengguna = $m_pengguna->lihat_username($username);
			if ($get_pengguna) {
				if ($get_pengguna->password_pengguna == $this->request->getPost('password')) {
					$session = [
						'kode' => $get_pengguna->kode_pengguna,
						'nama' => $get_pengguna->nama_pengguna,
						'username' => $get_pengguna->username_pengguna,
						'password' => $get_pengguna->password_pengguna,
						'role' => $this->request->getPost('role'),
						'jam_masuk' => date('H:i:s')
					];

					session()->set('login', $session);
					session()->setFlashdata('success', '<strong>Login</strong> Berhasil!');
					return redirect()->to(base_url('dashboard'));
				} else {
					session()->setFlashdata('error', 'Password Salah!');
					return redirect()->to(base_url('login'));
				}
			} else {
				session()->setFlashdata('error', 'Username Salah!');
				return redirect()->to(base_url('login'));
			}
		} else {
?>
			<script>
				alert('role tidak tersedia!')
			</script>
			<?php return redirect()->to(base_url('login')); ?>
<?php
		}
	}
}
