<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Client_model;
use App\Models\Berita_model;

class Clients extends BaseController
{
	// Client
	public function index()
	{
		$pager          = service('pager'); 
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_client		= new Client_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		// client
		$total          = $m_client->total_status('Publish');
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total->total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $client         = $m_client->semua('Publish',$perPage, $page);

		$data = [	'title'			=> 'Client Kami',
					'description'	=> 'Client Kami '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Client Kami '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'client'		=> $client,
					'pagination'    => $pager_links,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'clients/index'
				];
		echo view('layout/wrapper',$data);
	}
}