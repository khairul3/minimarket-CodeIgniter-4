<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Auth extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->model = new ModelAuth();
    }
    public function register()
    {
        $data = [
            'title' => 'Registrasi'
        ];
        return view('auth/v_register', $data);
    }

    public function saveRegister()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'nama user',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'repassword' => [
                'label' => 'repassword',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'matches' => 'konfirmasi password tidak sesuai'

                ]
            ],
        ])) {
            //jika valid
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'level' => 2
            ];

            $this->model->saveRegister($data);
            session()->setFlashdata('pesan', 'Registrasi berhasil !!!');
            return redirect()->to(base_url('auth/register'));
        } else {
            //jika tidak valid
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'level' => 3
            ];
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }

        return view('');
    }
    public function login()
    {
        $data = [
            'title' => 'Registrasi'
        ];
        return view('auth/v_login', $data);
    }
    public function cekLogin()
    {
        if ($this->validate([
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
        ])) {
            //jika valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->model->login($email, $password);
            if ($cek) {
                //jika data cocok
                session()->set('log', true);
                session()->set('nama_user', $cek['nama_user']);
                session()->set('email', $cek['email']);
                session()->set('level', $cek['level']);
                session()->set('foto_user', $cek['foto_user']);
                return redirect()->to(base_url('bank/index'));
            } else {
                //jika tidak cocok
                session()->setFlashdata('pesan', 'Login gagal, Cek username dan password !!!');
                session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
                return redirect()->to(base_url('auth/login'));
            }
        } else {

            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/login'));
        }
    }
    public function logout()
    {
        session()->remove('log');
        session()->remove('nama_user');
        session()->remove('level');
        session()->remove('foto_user');
        session()->setFlashdata('pesan', 'Logout Berhasil');
        return redirect()->to(base_url('auth/login'));
    }
}
