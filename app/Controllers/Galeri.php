<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Galeri_model;
use App\Models\Menu_model;

class Galeri extends BaseController
{
	// Galeri
	public function index()
	{
		$pager          = service('pager'); 
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_galeri		= new Galeri_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$total          = $m_galeri->total();
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $galeri         = $m_galeri->paginasi_admin($perPage, $page);

		$data = [	'title'			=> 'Galeri Gambar',
					'description'	=> 'Galeri Gambar '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Galeri Gambar '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'galeri'		=> $galeri,
					'pagination'    => $pager_links,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'galeri/index'
				];
		echo view('layout/wrapper',$data);
	}

	// Read
	public function read($id_galeri)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_galeri		= new Galeri_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$galeri 		= $m_galeri->detail($id_galeri);
		$galeri_list 	= $m_galeri->home($this->website->paginasi_depan());

		// Update hits
		$data = [ 	'id_galeri'	=> $galeri->id_galeri,
					'hits'		=> $galeri->hits+1
				];
		$m_galeri->edit($data);
		// Update hits
		
		$data = [	'title'			=> $galeri->judul_galeri,
					'description'	=> $galeri->judul_galeri,
					'keywords'		=> $galeri->judul_galeri,
					'galeri'		=> $galeri,
					'galeri_list'	=> $galeri_list,
					'content'		=> 'galeri/read'
				];
		echo view('layout/wrapper',$data);
	}

}