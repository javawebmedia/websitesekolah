<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Portfolio_model;
use App\Models\Kategori_portfolio_model;

class Portfolio extends BaseController
{
	// Portfolio
	public function index()
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_portfolio				= new Portfolio_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$status_portfolio 		= 'Publish';
		$total          		= $m_portfolio->total_status_portfolio($status_portfolio);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $portfolio         		= $m_portfolio->status_portfolio($perPage, $page,$status_portfolio);

		$data = [	'title'			=> 'Portfolio '.$konfigurasi->namaweb,
					'description'	=> 'Portfolio '.$konfigurasi->namaweb,
					'keywords'		=> 'Portfolio '.$konfigurasi->namaweb,
					'portfolio'		=> $portfolio,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'portfolio/index'
				];
		echo view('layout/wrapper',$data);
	}

	// kategori
	public function kategori($slug_kategori_portfolio)
	{
		$pager          		= service('pager'); 
		$m_konfigurasi 			= new Konfigurasi_model();
		$m_portfolio				= new Portfolio_model();
		$m_kategori_portfolio	= new Kategori_portfolio_model();
		$konfigurasi 			= $m_konfigurasi->listing();
		$kategori_portfolio 		= $m_kategori_portfolio->read($slug_kategori_portfolio);
		$status_portfolio 		= 'Publish';
		$id_kategori_portfolio 	= $kategori_portfolio->id_kategori_portfolio;
		$total          		= $m_portfolio->total_kategori_portfolio_status($id_kategori_portfolio,$status_portfolio);
        $page           		= (int) ($this->request->getGet('page') ?? 1);
        $perPage        		= $this->website->paginasi_depan();
        $total          		= $total;
        $pager_links    		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           		= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $portfolio         		= $m_portfolio->kategori_portfolio_status($perPage, $page,$id_kategori_portfolio,$status_portfolio);

		$data = [	'title'			=> $kategori_portfolio->nama_kategori_portfolio,
					'description'	=> $kategori_portfolio->nama_kategori_portfolio,
					'keywords'		=> $kategori_portfolio->nama_kategori_portfolio,
					'portfolio'		=> $portfolio,
					'konfigurasi'	=> $konfigurasi,
					'pagination'    => $pager_links,
					'content'		=> 'portfolio/index'
				];
		echo view('layout/wrapper',$data);
	}

	// oleh
	public function oleh($portfolio_oleh)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_portfolio		= new Portfolio_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$portfolio 		= $m_portfolio->portfolio_oleh($portfolio_oleh);

		$data = [	'title'			=> 'Portfolio '.$portfolio_oleh,
					'description'	=> 'Portfolio '.$portfolio_oleh,
					'keywords'		=> 'Portfolio '.$portfolio_oleh,
					'portfolio'		=> $portfolio,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'portfolio/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function read($id_portfolio)
	{
		$m_portfolio 	= new Portfolio_model();
		$portfolio 		= $m_portfolio->detail($id_portfolio);
		$portfolio_list 	= $m_portfolio->home(10,'Publish');
		// Update hits
		$data = [ 	'id_portfolio'	=> $portfolio->id_portfolio,
					'hits'			=> $portfolio->hits+1
				];
		$m_portfolio->edit($data);
		// Update hits
		$data = [	'title'			=> $portfolio->judul_portfolio,
					'description'	=> $portfolio->judul_portfolio,
					'keywords'		=> $portfolio->judul_portfolio,
					'portfolio'		=> $portfolio,
					'portfolio_list'	=> $portfolio_list,
					'content'		=> 'portfolio/read'
				];
		echo view('layout/wrapper',$data);
	}
}