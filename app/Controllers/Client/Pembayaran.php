<?php 
namespace App\Controllers\Client;

use CodeIgniter\Controller;

class Pembayaran extends BaseController
{
	// index
	public function index()
	{
		$this->simple_login->checklogin_client();
		$data = [   'title'     	=> 'Data Pembayaran',
					'description'   => 'Data Pembayaran',
                    'keywords'      => 'Data Pembayaran',
					'content'		=> 'client/pembayaran/index'
                ];
        return view('client/layout/wrapper',$data);
	}

	// konfirmasi
	public function konfirmasi()
	{
		$this->simple_login->checklogin_client();
		$data = [   'title'     	=> 'Konfirmasi Pembayaran',
					'description'   => 'Konfirmasi Pembayaran',
                    'keywords'      => 'Konfirmasi Pembayaran',
					'content'		=> 'client/pembayaran/konfirmasi'
                ];
        return view('client/layout/wrapper',$data);
	}
}