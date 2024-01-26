<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Berita_model;
use App\Models\Nav_model;
use App\Models\Kategori_model;
use App\Models\Galeri_model;

class Layanan extends BaseController
{
	// Kontak
	public function index()
	{
		$pager          = service('pager'); 
        $m_site         = new Konfigurasi_model();
        $site           = $m_site->listing();
        $m_berita       = new Berita_model();
        $status_berita  = 'Publish';
        $jenis_berita   = 'Layanan';
        $total          = $m_berita->total_jenis_status_berita($jenis_berita,$status_berita);
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $berita         = $m_berita->jenis_status_berita_all($jenis_berita,$status_berita,$perPage, $page);

		$data = [	'title'			=> 'Produk &amp; Layanan',
					'description'	=> 'Produk &amp; Layanan',
					'keywords'		=> 'Produk &amp; Layanan',
					'site'          => $site,
                    'berita'        => $berita,
                    'pagination'    => $pager_links,
					'content'		=> 'layanan/index'
				];
		echo view('layout/wrapper',$data);
	}

	// detail
    public function detail($slug_berita)
    {
        $m_berita   = new Berita_model();
        $m_nav     = new Nav_model();
        $berita     = $m_berita->read($slug_berita);
        $news       = $m_nav->profil('Layanan');

        $data = array(  'id_berita' => $berita->id_berita,
                        'hits'      => $berita->hits+1
                    );
        $m_berita->edit($data);

        $data = [   'title'         => $berita->judul_berita,
                    'description'   => $berita->ringkasan,
                    'keywords'      => $berita->judul_berita.', '.$berita->keywords,
                    'berita'        => $berita,
                    'news'          => $news,
                    'content'       => 'layanan/detail'
                ];
        return view('layout/wrapper',$data);
    }
}