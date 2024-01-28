<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Karya_model;
use App\Models\Kategori_karya_model;

class Karya extends BaseController
{
	// Karya
	public function index()
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_karya				= new Karya_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$status_karya 		= 'Publish';
		$total          		= $m_karya->total_status_karya($status_karya);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $karya         		= $m_karya->status_karya($perPage, $page,$status_karya);

		$data = [	'title'			=> 'Karya '.$konfigurasi->namaweb,
					'description'	=> 'Karya '.$konfigurasi->namaweb,
					'keywords'		=> 'Karya '.$konfigurasi->namaweb,
					'karya'		=> $karya,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'karya/index'
				];
		echo view('layout/wrapper',$data);
	}

	// kategori
	public function kategori($slug_kategori_karya)
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_karya				= new Karya_model();
		$m_kategori_karya	= new Kategori_karya_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$kategori_karya 		= $m_kategori_karya->read($slug_kategori_karya);
		$status_karya 		= 'Publish';
		$id_kategori_karya 	= $kategori_karya->id_kategori_karya;
		$total          		= $m_karya->total_kategori_karya_status($id_kategori_karya,$status_karya);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $karya         		= $m_karya->kategori_karya_status($perPage, $page,$id_kategori_karya,$status_karya);

		$data = [	'title'			=> $kategori_karya->nama_kategori_karya,
					'description'	=> $kategori_karya->nama_kategori_karya,
					'keywords'		=> $kategori_karya->nama_kategori_karya,
					'karya'		=> $karya,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'karya/index'
				];
		echo view('layout/wrapper',$data);
	}

	// oleh
	public function oleh($karya_oleh)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_karya		= new Karya_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$karya 		= $m_karya->karya_oleh($karya_oleh);

		$data = [	'title'			=> 'Karya '.$karya_oleh,
					'description'	=> 'Karya '.$karya_oleh,
					'keywords'		=> 'Karya '.$karya_oleh,
					'karya'		=> $karya,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'karya/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function read($slug_karya)
	{
		$m_karya 	= new Karya_model();
		$karya 		= $m_karya->read($slug_karya);
		$karya_list 	= $m_karya->home(10,'Publish');
		// Update hits
		$data = [ 	'id_karya'	=> $karya->id_karya,
					'hits'			=> $karya->hits+1
				];
		$m_karya->edit($data);
		// Update hits
		$data = [	'title'			=> $karya->judul_karya,
					'description'	=> $karya->judul_karya,
					'keywords'		=> $karya->judul_karya,
					'karya'		=> $karya,
					'karya_list'	=> $karya_list,
					'content'		=> 'karya/read'
				];
		echo view('layout/wrapper',$data);
	}
}