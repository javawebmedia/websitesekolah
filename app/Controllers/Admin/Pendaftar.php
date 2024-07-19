<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenis_dokumen_model;
use App\Models\Dokumen_model;
use App\Models\Agama_model;
use App\Models\Akun_model;
use App\Models\Gelombang_model;
use App\Models\Siswa_model;

class Pendaftar extends BaseController
{
	public function index()
	{
		$m_gelombang 	= new Gelombang_model();
		$gelombang 		= $m_gelombang->listing();

		$data = [   'title'     	=> 'Data Pendaftar',
					'gelombang'		=> $gelombang,
					'm_siswa'		=> new Siswa_model(),
					'content'		=> 'admin/pendaftar/index'
                ];
        return view('admin/layout/wrapper',$data);
	}

	// gelombang
	public function gelombang($id_gelombang,$status_siswa)
	{
		$m_gelombang 	= new Gelombang_model();
		$m_siswa 		= new Siswa_model();
		$gelombang 		= $m_gelombang->detail($id_gelombang);
		$siswa 			= $m_siswa->gelombang_status_siswa($id_gelombang,$status_siswa);
		$total_siswa	= $m_siswa->status_siswa_gelombang($status_siswa,$id_gelombang);

		$data = [   'title'     	=> 'Data Pendaftar: '.$gelombang->judul,
					'gelombang'		=> $gelombang,
					'm_siswa'		=> new Siswa_model(),
					'siswa'			=> $siswa,
					'content'		=> 'admin/pendaftar/gelombang'
                ];
        return view('admin/layout/wrapper',$data);
	}
}