<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Portfolio_model;
use App\Models\Kategori_portfolio_model;
use App\Models\Menu_model;

class Portfolio extends BaseController
{
	// Portfolio
	public function index()
	{
		$pager          = service('pager'); 
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_portfolio		= new Portfolio_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$total          = $m_portfolio->total();
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $portfolio         = $m_portfolio->paginasi_admin($perPage, $page);

		$data = [	'title'			=> 'Portfolio Gambar',
					'description'	=> 'Portfolio Gambar '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Portfolio Gambar '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'portfolio'		=> $portfolio,
					'pagination'    => $pager_links,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'portfolio/index'
				];
		echo view('layout/wrapper',$data);
	}

	// detail
	public function detail($slug_kategori_portfolio)
	{
		$pager          = service('pager'); 
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_portfolio	= new Portfolio_model();

		$m_kategori_portfolio 	= new Kategori_portfolio_model();
		$kategori_portfolio 	= $m_kategori_portfolio->read($slug_kategori_portfolio);
		$id_kategori_portfolio 	= $kategori_portfolio->id_kategori_portfolio;

		$konfigurasi 	= $m_konfigurasi->listing();

		$total          = $m_portfolio->total_kategori_portfolio($id_kategori_portfolio);

        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $portfolio         = $m_portfolio->kategori_portfolio($perPage, $page, $slug_kategori_portfolio);

		$data = [	'title'			=> $kategori_portfolio->nama_kategori_portfolio,
					'description'	=> $kategori_portfolio->nama_kategori_portfolio,
					'keywords'		=> $kategori_portfolio->nama_kategori_portfolio,
					'portfolio'		=> $portfolio,
					'pagination'    => $pager_links,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'portfolio/index'
				];
		echo view('layout/wrapper',$data);
	}

	// Read
	public function read($id_portfolio)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_portfolio		= new Portfolio_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$portfolio 		= $m_portfolio->detail($id_portfolio);

		// Update hits
		$data = [ 	'id_portfolio'	=> $portfolio['id_portfolio'],
					'hits'		=> $portfolio['hits']+1
				];
		$m_portfolio->edit($data);
		// Update hits
		
		$data = [	'title'			=> $portfolio['judul_portfolio'],
					'description'	=> $portfolio['judul_portfolio'],
					'keywords'		=> $portfolio['judul_portfolio'],
					'portfolio'		=> $portfolio,
					'content'		=> 'portfolio/read'
				];
		echo view('layout/wrapper',$data);
	}

}