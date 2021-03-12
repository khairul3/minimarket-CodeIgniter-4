<?php

namespace App\Controllers;

class Logout extends BaseController
{
	public function index()
	{
		session()->destroy();
		return redirect()->to('login');
	}
}
