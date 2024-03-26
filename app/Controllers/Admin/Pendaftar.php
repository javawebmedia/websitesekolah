<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenis_dokumen_model;
use App\Models\Dokumen_model;
use App\Models\Agama_model;
use App\Models\Akun_model;

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