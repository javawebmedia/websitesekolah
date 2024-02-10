<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Pendaftar extends BaseController
{
	public function index()
	{
		$this->simple_login->checklogin();
		$data = [   'title'     => 'Data Pendaftar',
					'content'	=> 'admin/pendaftar/index'
                ];
        return view('admin/layout/wrapper',$data);
	}
}