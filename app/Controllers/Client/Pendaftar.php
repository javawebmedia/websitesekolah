<?php 
namespace App\Controllers\Client;

use CodeIgniter\Controller;

class Pendaftar extends BaseController
{
	public function index()
	{
		$this->simple_login->checklogin_client();
		$data = [   'title'     	=> 'Data Pendaftaran',
					'description'   => 'Data Pendaftaran',
                    'keywords'      => 'Data Pendaftaran',
					'content'		=> 'client/pendaftar/index'
                ];
        return view('client/layout/wrapper',$data);
	}
}