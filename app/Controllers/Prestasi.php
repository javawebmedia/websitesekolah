<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Prestasi_model;
use App\Models\Kategori_prestasi_model;

class Prestasi extends BaseController
{
	// Prestasi
	public function index()
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_prestasi				= new Prestasi_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$status_prestasi 		= 'Publish';
		$total          		= $m_prestasi->total_status_prestasi($status_prestasi);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $prestasi         		= $m_prestasi->status_prestasi($perPage, $page,$status_prestasi);

		$data = [	'title'			=> 'Prestasi '.$konfigurasi->namaweb,
					'description'	=> 'Prestasi '.$konfigurasi->namaweb,
					'keywords'		=> 'Prestasi '.$konfigurasi->namaweb,
					'prestasi'		=> $prestasi,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'prestasi/index'
				];
		echo view('layout/wrapper',$data);
	}

	// kategori
	public function kategori($slug_kategori_prestasi)
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_prestasi				= new Prestasi_model();
		$m_kategori_prestasi	= new Kategori_prestasi_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$kategori_prestasi 		= $m_kategori_prestasi->read($slug_kategori_prestasi);
		$status_prestasi 		= 'Publish';
		$id_kategori_prestasi 	= $kategori_prestasi->id_kategori_prestasi;
		$total          		= $m_prestasi->total_kategori_prestasi_status($id_kategori_prestasi,$status_prestasi);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $prestasi         		= $m_prestasi->kategori_prestasi_status($perPage, $page,$id_kategori_prestasi,$status_prestasi);

		$data = [	'title'			=> $kategori_prestasi->nama_kategori_prestasi,
					'description'	=> $kategori_prestasi->nama_kategori_prestasi,
					'keywords'		=> $kategori_prestasi->nama_kategori_prestasi,
					'prestasi'		=> $prestasi,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'prestasi/index'
				];
		echo view('layout/wrapper',$data);
	}

	// oleh
	public function oleh($prestasi_oleh)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_prestasi		= new Prestasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$prestasi 		= $m_prestasi->prestasi_oleh($prestasi_oleh);

		$data = [	'title'			=> 'Prestasi '.$prestasi_oleh,
					'description'	=> 'Prestasi '.$prestasi_oleh,
					'keywords'		=> 'Prestasi '.$prestasi_oleh,
					'prestasi'		=> $prestasi,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'prestasi/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function read($slug_prestasi)
	{
		$m_prestasi 	= new Prestasi_model();
		$prestasi 		= $m_prestasi->read($slug_prestasi);
		$prestasi_list 	= $m_prestasi->home(10,'Publish');
		// Update hits
		$data = [ 	'id_prestasi'	=> $prestasi->id_prestasi,
					'hits'			=> $prestasi->hits+1
				];
		$m_prestasi->edit($data);
		// Update hits
		$data = [	'title'			=> $prestasi->judul_prestasi,
					'description'	=> $prestasi->judul_prestasi,
					'keywords'		=> $prestasi->judul_prestasi,
					'prestasi'		=> $prestasi,
					'prestasi_list'	=> $prestasi_list,
					'content'		=> 'prestasi/read'
				];
		echo view('layout/wrapper',$data);
	}
}