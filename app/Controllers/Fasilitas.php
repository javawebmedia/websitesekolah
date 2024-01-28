<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Fasilitas_model;
use App\Models\Kategori_fasilitas_model;

class Fasilitas extends BaseController
{
	// Fasilitas
	public function index()
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_fasilitas				= new Fasilitas_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$status_fasilitas 		= 'Publish';
		$total          		= $m_fasilitas->total_status_fasilitas($status_fasilitas);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $fasilitas         		= $m_fasilitas->status_fasilitas($perPage, $page,$status_fasilitas);

		$data = [	'title'			=> 'Fasilitas '.$konfigurasi->namaweb,
					'description'	=> 'Fasilitas '.$konfigurasi->namaweb,
					'keywords'		=> 'Fasilitas '.$konfigurasi->namaweb,
					'fasilitas'		=> $fasilitas,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'fasilitas/index'
				];
		echo view('layout/wrapper',$data);
	}

	// kategori
	public function kategori($slug_kategori_fasilitas)
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_fasilitas				= new Fasilitas_model();
		$m_kategori_fasilitas	= new Kategori_fasilitas_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$kategori_fasilitas 		= $m_kategori_fasilitas->read($slug_kategori_fasilitas);
		$status_fasilitas 		= 'Publish';
		$id_kategori_fasilitas 	= $kategori_fasilitas->id_kategori_fasilitas;
		$total          		= $m_fasilitas->total_kategori_fasilitas_status($id_kategori_fasilitas,$status_fasilitas);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $fasilitas         		= $m_fasilitas->kategori_fasilitas_status($perPage, $page,$id_kategori_fasilitas,$status_fasilitas);

		$data = [	'title'			=> $kategori_fasilitas->nama_kategori_fasilitas,
					'description'	=> $kategori_fasilitas->nama_kategori_fasilitas,
					'keywords'		=> $kategori_fasilitas->nama_kategori_fasilitas,
					'fasilitas'		=> $fasilitas,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'fasilitas/index'
				];
		echo view('layout/wrapper',$data);
	}

	// oleh
	public function oleh($fasilitas_oleh)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_fasilitas		= new Fasilitas_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$fasilitas 		= $m_fasilitas->fasilitas_oleh($fasilitas_oleh);

		$data = [	'title'			=> 'Fasilitas '.$fasilitas_oleh,
					'description'	=> 'Fasilitas '.$fasilitas_oleh,
					'keywords'		=> 'Fasilitas '.$fasilitas_oleh,
					'fasilitas'		=> $fasilitas,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'fasilitas/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function read($slug_fasilitas)
	{
		$m_fasilitas 	= new Fasilitas_model();
		$fasilitas 		= $m_fasilitas->read($slug_fasilitas);
		$fasilitas_list 	= $m_fasilitas->home(10,'Publish');
		// Update hits
		$data = [ 	'id_fasilitas'	=> $fasilitas->id_fasilitas,
					'hits'			=> $fasilitas->hits+1
				];
		$m_fasilitas->edit($data);
		// Update hits
		$data = [	'title'			=> $fasilitas->judul_fasilitas,
					'description'	=> $fasilitas->judul_fasilitas,
					'keywords'		=> $fasilitas->judul_fasilitas,
					'fasilitas'		=> $fasilitas,
					'fasilitas_list'	=> $fasilitas_list,
					'content'		=> 'fasilitas/read'
				];
		echo view('layout/wrapper',$data);
	}
}