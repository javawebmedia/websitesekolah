<?php 
namespace App\Controllers\Client;

use CodeIgniter\Controller;

class Dasbor extends BaseController
{
	public function index()
	{
		$this->simple_login->checklogin_client();
		$data = [   'title'     	=> 'Dasbor Pendaftar',
					'description'   => 'Dasbor Pendaftar',
                    'keywords'      => 'Dasbor Pendaftar',
					'content'		=> 'client/dasbor/index'
                ];
        return view('client/layout/wrapper',$data);
	}
}