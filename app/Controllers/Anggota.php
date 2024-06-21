<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
// load model
use App\Models\Konfigurasi_model;
use App\Models\Anggota_model;
use App\Models\Menu_model;

class Anggota extends BaseController
{
	// Anggota
	public function index()
	{
		$pager          = service('pager'); 
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_anggota		= new Anggota_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$total          = $m_anggota->total();
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $anggota         = $m_anggota->paginasi_admin($perPage, $page);

		$data = [	'title'			=> 'Anggota Gambar',
					'description'	=> 'Anggota Gambar '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Anggota Gambar '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'anggota'		=> $anggota,
					'pagination'    => $pager_links,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'anggota/index'
				];
		echo view('layout/wrapper',$data);
	}

	// Read
	public function read($id_anggota)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_anggota		= new Anggota_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$anggota 		= $m_anggota->detail($id_anggota);

		// Update hits
		$data = [ 	'id_anggota'	=> $anggota['id_anggota'],
					'hits'		=> $anggota['hits']+1
				];
		$m_anggota->edit($data);
		// Update hits
		
		$data = [	'title'			=> $anggota['judul_anggota'],
					'description'	=> $anggota['judul_anggota'],
					'keywords'		=> $anggota['judul_anggota'],
					'anggota'		=> $anggota,
					'content'		=> 'anggota/read'
				];
		echo view('layout/wrapper',$data);
	}

}
