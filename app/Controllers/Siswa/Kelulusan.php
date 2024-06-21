<?php 
namespace App\Controllers\Siswa;

use CodeIgniter\Controller;

class Kelulusan extends BaseController
{
	public function index()
	{
		$data = [   'title'     	=> 'Data Kelulusan',
					'description'   => 'Data Kelulusan',
                    'keywords'      => 'Data Kelulusan',
					'content'		=> 'siswa/kelulusan/index'
                ];
        return view('siswa/layout/wrapper',$data);
	}
}