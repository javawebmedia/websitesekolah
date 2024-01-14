<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Video_model;

class Video extends BaseController
{
	// Video
	public function index()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_video		= new Video_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$pager          = service('pager'); 
		$total          = $m_video->total();
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total->total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $video         	= $m_video->semua($perPage, $page);

		$data = [	'title'			=> 'Galeri Video',
					'description'	=> 'Galeri Video '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Galeri Video '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'video'			=> $video,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'video/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function read($slug_video)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_video		= new Video_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$video 			= $m_video->read($slug_video);

		$data = [	'title'			=> $video->judul,
					'description'	=> $video->judul,
					'keywords'		=> $video->judul,
					'video'			=> $video,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'video/read'
				];
		echo view('layout/wrapper',$data);
	}

}