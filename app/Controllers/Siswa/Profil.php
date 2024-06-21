<?php 
namespace App\Controllers\Siswa;

use CodeIgniter\Controller;

class Profil extends BaseController
{
	public function index()
	{
		$data = [   'title'     	=> 'Data Profil',
					'description'   => 'Data Profil',
                    'keywords'      => 'Data Profil',
					'content'		=> 'siswa/profil/index'
                ];
        return view('siswa/layout/wrapper',$data);
	}
}