<?php 
namespace App\Controllers\Siswa;

use CodeIgniter\Controller;

class Pendaftaran extends BaseController
{
	public function index()
	{
		$data = [   'title'     	=> 'Data Pendaftaran',
					'description'   => 'Data Pendaftaran',
                    'keywords'      => 'Data Pendaftaran',
					'content'		=> 'siswa/pendaftaran/index'
                ];
        return view('siswa/layout/wrapper',$data);
	}
}