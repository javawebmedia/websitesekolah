<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenis_dokumen_model;
use App\Models\Dokumen_model;
use App\Models\Agama_model;
use App\Models\Akun_model;

class Akun_pendaftar extends BaseController
{
	public function index()
	{
		$m_akun 		= new Akun_model();
		$pager 			= service('pager'); 
		// akun
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_akun->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $akun 			= $m_akun->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_akun->total();
			$title 			= 'Data Akun Pendaftar ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $akun 			= $m_akun->paginasi_admin($perPage, $page);
		}
		// end akun

		$data = [   'title'     	=> $title,
					'akun'			=> $akun,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/akun_pendaftar/index'
                ];
        return view('admin/layout/wrapper',$data);
	}
}