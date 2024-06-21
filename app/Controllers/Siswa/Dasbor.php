<?php 
namespace App\Controllers\Siswa;

use CodeIgniter\Controller;

class Dasbor extends BaseController
{
	public function index()
	{
		$data = [   'title'     	=> 'Dasbor Pendaftar',
					'description'   => 'Dasbor Pendaftar',
                    'keywords'      => 'Dasbor Pendaftar',
					'content'		=> 'siswa/dasbor/index'
                ];
        return view('siswa/layout/wrapper',$data);
	}
}