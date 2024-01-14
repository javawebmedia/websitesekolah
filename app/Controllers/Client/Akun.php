<?php 
namespace App\Controllers\Client;

use CodeIgniter\Controller;

class Akun extends BaseController
{
	public function index()
	{
		$this->simple_login->checklogin_client();
		$data = [   'title'     	=> 'Akun dan Profil Saya',
					'description'   => 'Akun dan Profil Saya',
                    'keywords'      => 'Akun dan Profil Saya',
					'content'		=> 'client/akun/index'
                ];
        return view('client/layout/wrapper',$data);
	}
}