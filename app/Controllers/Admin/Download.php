<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Download_model;
use App\Models\Kategori_download_model;
use App\Models\User_model;

class Download extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_download 			= new Download_model();
		$m_kategori_download 	= new Kategori_download_model();
		$kategori_download 		= $m_kategori_download->listing();
		$pager 					= service('pager'); 
		// download
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_download->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $download 		= $m_download->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_download->total();
			$title 			= 'Download, Profil dan Layanan ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $download 		= $m_download->paginasi_admin($perPage, $page);
		}
		// end download
		
		$data = [	'title'					=> $title,
					'download'				=> $download,
					'pagination'			=> $pager_links,
					'kategori_download'		=> $kategori_download,
					'content'				=> 'admin/download/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Show all
	public function show()
	{
		header('Content-Type: application/json; charset=utf-8');
		$this->simple_login->checklogin();
		$m_download	= new Download_model();
		$data 		= $m_download->listing();
		echo json_encode($data);
	}

	// kategori_download
	public function kategori_download($id_kategori_download)
	{
		
		$m_download 			= new Download_model();
		$m_kategori_download 	= new Kategori_download_model();
		$kategori_download 		= $m_kategori_download->detail($id_kategori_download);
		$total 					= $m_download->total_kategori_download($id_kategori_download);
		$pager 					= service('pager');
        $page    				= (int) ($this->request->getGet('page') ?? 1);
        $perPage 				= $this->website->paginasi();
        $total   				= $total;
        $pager_links 			= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 					= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $download 				= $m_download->kategori_download_all($id_kategori_download,$perPage, $page);

		$data = [	'title'			=> $kategori_download->nama_kategori_download.' ('.$total.')',
					'download'		=> $download,
					'content'		=> 'admin/download/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jenis_download
	public function jenis_download($jenis_download)
	{
		
		$m_download 			= new Download_model();
		$m_kategori_download 	= new Kategori_download_model();
		$total 					= $m_download->total_jenis_download($jenis_download);
		$pager 					= service('pager');
        $page    				= (int) ($this->request->getGet('page') ?? 1);
        $perPage 				= $this->website->paginasi();
        $total   				= $total;
        $pager_links 			= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 					= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $download 				= $m_download->jenis_download_all($jenis_download,$perPage, $page);

		$data = [	'title'			=> $jenis_download.' ('.$total.')',
					'download'		=> $download,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/download/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// author
	public function author($id_user)
	{
		
		$m_download 			= new Download_model();
		$m_kategori_download 	= new Kategori_download_model();
		$m_user 				= new User_model();
		$user 					= $m_user->detail($id_user);
		$download 				= $m_download->author_all($id_user);
		$total 					= $m_download->total_author($id_user);

		$data = [	'title'			=> $user->nama.' ('.$total.')',
					'download'		=> $download,
					'content'		=> 'admin/download/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_kategori_download 	= new Kategori_download_model();
		$m_download 			= new Download_model();
		$kategori_download 		= $m_kategori_download->listing();

		// Start tambah
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_download' => 'required',
				'gambar'	 	=> [
									'uploaded[gambar]',
					                'ext_in[gambar,jpg,jpeg,png,gif,zip,rar,doc,docx,xls,xlsx,ppt,pptx,pdf]',
					                'max_size[gambar,24096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
				$file_ext 	= $avatar->guessExtension();
				$file_size 	= $avatar->getSizeByUnit('mb');
	            $avatar->move(WRITEPATH . '../assets/upload/file/',$namabaru);
	        	// masuk database
			    $data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
					'judul_download'		=> $this->request->getVar('judul_download'),
					'jenis_download'		=> $this->request->getVar('jenis_download'),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'file_ext' 				=> $file_ext,
					'file_size' 			=> $file_size,
					'website'				=> $this->request->getVar('website'),
					'status_download'		=> $this->request->getVar('status_download'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_download->tambah($data);
        		return redirect()->to(base_url('admin/download'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
					'judul_download'		=> $this->request->getVar('judul_download'),
					'jenis_download'		=> $this->request->getVar('jenis_download'),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'status_download'		=> $this->request->getVar('status_download'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_download->tambah($data);
        		return redirect()->to(base_url('admin/download'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}
		// end database

		$data = [	'title'				=> 'Tambah Download',
					'kategori_download'	=> $kategori_download,
					'content'			=> 'admin/download/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_download)
	{
		
		$m_kategori_download 	= new Kategori_download_model();
		$m_download 			= new Download_model();
		$kategori_download 		= $m_kategori_download->listing();
		$download 				= $m_download->detail($id_download);
		// Start database
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_download' => 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,png,gif,zip,rar,doc,docx,xls,xlsx,ppt,pptx,pdf]',
					                'max_size[gambar,24096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$file_ext 	= $avatar->guessExtension();
				$file_size 	= $avatar->getSizeByUnit('mb');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/file/',$namabaru);
	        	// masuk database
	            $data = array(
	            	'id_download'			=> $id_download,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
					'judul_download'		=> $this->request->getVar('judul_download'),
					'jenis_download'		=> $this->request->getVar('jenis_download'),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'file_ext' 				=> $file_ext,
					'file_size' 			=> $file_size,
					'status_download'		=> $this->request->getVar('status_download'),
	        	);
	        	$m_download->edit($data);
        		return redirect()->to(base_url('admin/download'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_download'			=> $id_download,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
					'judul_download'		=> $this->request->getVar('judul_download'),
					'jenis_download'		=> $this->request->getVar('jenis_download'),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'status_download'		=> $this->request->getVar('status_download'),
	        	);
	        	$m_download->edit($data);
        		return redirect()->to(base_url('admin/download'))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }
	    // end database
		$data = [	'title'				=> 'Edit Download: '.$download->judul_download,
					'kategori_download'	=> $kategori_download,
					'download'			=> $download,
					'content'			=> 'admin/download/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_kategori_download 	= new Kategori_download_model();
		$m_download 			= new Download_model();
		// proses
		$pengalihan 			= $this->request->getVar('pengalihan');
		$submit 				= $this->request->getVar('submit');
		$id_download 			= $this->request->getVar('id_download');
		// check download
		if(empty($this->request->getVar('id_download')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih download. Pilih salah satu download');
		}
		// end check download
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_download);$i++) {
				$data = array(	'id_download'		=> $id_download[$i],
								'id_user'			=> $this->session->get('id_user'),
								'jenis_download'	=> $this->request->getVar('jenis_download')
							);
   				$m_download->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Download berhasil diupdate jenis downloadnya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_download);$i++) {
				$data = array(	'id_download'		=> $id_download[$i],
								'id_user'			=> $this->session->get('id_user'),
								'status_download'	=> 'Publish'
							);
   				$m_download->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Download berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_download);$i++) {
				$data = array(	'id_download'		=> $id_download[$i],
								'id_user'			=> $this->session->get('id_user'),
								'status_download'	=> 'Draft'
							);
   				$m_download->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Download berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_download);$i++) {
				$data = array(	'id_download'	=> $id_download[$i]);
   				$m_download->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// unduh
	public function unduh($id_download)
	{
		
		$m_kategori_download 	= new Kategori_download_model();
		$m_download 			= new Download_model();
		$kategori_download 		= $m_kategori_download->listing();
		$download 				= $m_download->detail($id_download);
		if(!file_exists('../assets/upload/file/'.$download->gambar)) {
			$this->session->setFlashdata('warning','Mohon maaf, file tidak ditemukan.');
			return redirect()->to(base_url('admin/download'));
		}else{
			return $this->response->download('../assets/upload/file/'.$download->gambar, null);
		}
	}
	
	// Delete
	public function delete($id_download)
	{
		
		$m_download = new Download_model();
		$data = ['id_download'	=> $id_download];
		$m_download->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/download'));
	}
}