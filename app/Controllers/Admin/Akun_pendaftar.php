<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenis_dokumen_model;
use App\Models\Dokumen_model;
use App\Models\Agama_model;
use App\Models\Akun_model;

class Akun_pendaftar extends BaseController
{
	public function index()
	{
		$data = [   'title'     => 'Data Akun Pendaftar',
					'content'	=> 'admin/akun_pendaftar/index'
                ];
        return view('admin/layout/wrapper',$data);
	}
}