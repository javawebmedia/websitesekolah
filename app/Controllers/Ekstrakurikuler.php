<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Ekstrakurikuler_model;
use App\Models\Kategori_ekstrakurikuler_model;

class Ekstrakurikuler extends BaseController
{
	// Ekstrakurikuler
	public function index()
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_ekstrakurikuler				= new Ekstrakurikuler_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$status_ekstrakurikuler 		= 'Publish';
		$total          		= $m_ekstrakurikuler->total_status_ekstrakurikuler($status_ekstrakurikuler);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $ekstrakurikuler         		= $m_ekstrakurikuler->status_ekstrakurikuler($perPage, $page,$status_ekstrakurikuler);

		$data = [	'title'			=> 'Ekstrakurikuler '.$konfigurasi->namaweb,
					'description'	=> 'Ekstrakurikuler '.$konfigurasi->namaweb,
					'keywords'		=> 'Ekstrakurikuler '.$konfigurasi->namaweb,
					'ekstrakurikuler'		=> $ekstrakurikuler,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'ekstrakurikuler/index'
				];
		echo view('layout/wrapper',$data);
	}

	// kategori
	public function kategori($slug_kategori_ekstrakurikuler)
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_ekstrakurikuler				= new Ekstrakurikuler_model();
		$m_kategori_ekstrakurikuler	= new Kategori_ekstrakurikuler_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$kategori_ekstrakurikuler 		= $m_kategori_ekstrakurikuler->read($slug_kategori_ekstrakurikuler);
		$status_ekstrakurikuler 		= 'Publish';
		$id_kategori_ekstrakurikuler 	= $kategori_ekstrakurikuler->id_kategori_ekstrakurikuler;
		$total          		= $m_ekstrakurikuler->total_kategori_ekstrakurikuler_status($id_kategori_ekstrakurikuler,$status_ekstrakurikuler);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $ekstrakurikuler         		= $m_ekstrakurikuler->kategori_ekstrakurikuler_status($perPage, $page,$id_kategori_ekstrakurikuler,$status_ekstrakurikuler);

		$data = [	'title'			=> $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler,
					'description'	=> $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler,
					'keywords'		=> $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler,
					'ekstrakurikuler'		=> $ekstrakurikuler,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'ekstrakurikuler/index'
				];
		echo view('layout/wrapper',$data);
	}

	// oleh
	public function oleh($ekstrakurikuler_oleh)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_ekstrakurikuler		= new Ekstrakurikuler_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$ekstrakurikuler 		= $m_ekstrakurikuler->ekstrakurikuler_oleh($ekstrakurikuler_oleh);

		$data = [	'title'			=> 'Ekstrakurikuler '.$ekstrakurikuler_oleh,
					'description'	=> 'Ekstrakurikuler '.$ekstrakurikuler_oleh,
					'keywords'		=> 'Ekstrakurikuler '.$ekstrakurikuler_oleh,
					'ekstrakurikuler'		=> $ekstrakurikuler,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'ekstrakurikuler/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function read($slug_ekstrakurikuler)
	{
		$m_ekstrakurikuler 	= new Ekstrakurikuler_model();
		$ekstrakurikuler 		= $m_ekstrakurikuler->read($slug_ekstrakurikuler);
		$ekstrakurikuler_list 	= $m_ekstrakurikuler->home(10,'Publish');
		// Update hits
		$data = [ 	'id_ekstrakurikuler'	=> $ekstrakurikuler->id_ekstrakurikuler,
					'hits'			=> $ekstrakurikuler->hits+1
				];
		$m_ekstrakurikuler->edit($data);
		// Update hits
		$data = [	'title'			=> $ekstrakurikuler->judul_ekstrakurikuler,
					'description'	=> $ekstrakurikuler->judul_ekstrakurikuler,
					'keywords'		=> $ekstrakurikuler->judul_ekstrakurikuler,
					'ekstrakurikuler'		=> $ekstrakurikuler,
					'ekstrakurikuler_list'	=> $ekstrakurikuler_list,
					'content'		=> 'ekstrakurikuler/read'
				];
		echo view('layout/wrapper',$data);
	}
}