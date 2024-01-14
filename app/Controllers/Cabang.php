<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Cabang_model;
use App\Models\Menu_model;

class Cabang extends BaseController
{
	// Cabang
	public function index()
	{
		$pager          = service('pager'); 
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_cabang		= new Cabang_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$total          = $m_cabang->total();
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $cabang         = $m_cabang->paginasi_admin($perPage, $page);

		$data = [	'title'			=> 'Cabang Latihan',
					'description'	=> 'Cabang Latihan '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Cabang Latihan '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'cabang'		=> $cabang,
					'pagination'    => $pager_links,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'cabang/index'
				];
		echo view('layout/wrapper',$data);
	}

	// Read
	public function detail($slug_cabang)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_cabang		= new Cabang_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$cabang 		= $m_cabang->read($slug_cabang);

		// Update hits
		$data = [ 	'id_cabang'	=> $cabang->id_cabang,
					'hits'		=> $cabang->hits+1
				];
		$m_cabang->edit($data);
		// Update hits
		
		$data = [	'title'			=> $cabang->nama_cabang,
					'description'	=> $cabang->nama_cabang,
					'keywords'		=> $cabang->nama_cabang,
					'cabang'		=> $cabang,
					'content'		=> 'cabang/detail'
				];
		echo view('layout/wrapper',$data);
	}

}