<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\User_model;

class Berita extends BaseController
{
	
	// index
	public function index()
	{
		$this->simple_login->checklogin();
		$m_berita 		= new Berita_model();
		$m_kategori 	= new Kategori_model();
		$kategori 		= $m_kategori->listing();
		$pager 			= service('pager'); 
		// berita
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_berita->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $berita 		= $m_berita->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_berita->total();
			$title 			= 'Berita, Profil dan Layanan ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $berita 		= $m_berita->paginasi_admin($perPage, $page);
		}
		// end berita
		
		$data = [	'title'			=> $title,
					'berita'		=> $berita,
					'pagination'	=> $pager_links,
					'kategori'		=> $kategori,
					'content'		=> 'admin/berita/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// kategori
	public function kategori($id_kategori)
	{
		$this->simple_login->checklogin();
		$m_berita 		= new Berita_model();
		$m_kategori 	= new Kategori_model();
		$kategori 		= $m_kategori->detail($id_kategori);
		$total 			= $m_berita->total_kategori($id_kategori);
		$pager 			= service('pager');
        $page    		= (int) ($this->request->getGet('page') ?? 1);
        $perPage 		= $this->website->paginasi();
        $total   		= $total;
        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $berita 		= $m_berita->kategori_all($id_kategori,$perPage, $page);

		$data = [	'title'			=> $kategori->nama_kategori.' ('.$total.')',
					'berita'		=> $berita,
					'content'		=> 'admin/berita/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jenis_berita
	public function jenis_berita($jenis_berita)
	{
		$this->simple_login->checklogin();
		$m_berita 		= new Berita_model();
		$m_kategori 	= new Kategori_model();
		$total 			= $m_berita->total_jenis_berita($jenis_berita);
		$pager 			= service('pager');
        $page    		= (int) ($this->request->getGet('page') ?? 1);
        $perPage 		= $this->website->paginasi();
        $total   		= $total;
        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $berita 		= $m_berita->jenis_berita_all($jenis_berita,$perPage, $page);

		$data = [	'title'			=> $jenis_berita.' ('.$total.')',
					'berita'		=> $berita,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/berita/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// status_berita
	public function status_berita($status_berita)
	{
		$this->simple_login->checklogin();
		$m_berita 		= new Berita_model();
		$m_kategori 	= new Kategori_model();
		$total 			= $m_berita->total_status_berita($status_berita);
		$pager 			= service('pager');
        $page    		= (int) ($this->request->getGet('page') ?? 1);
        $perPage 		= $this->website->paginasi();
        $total   		= $total;
        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $berita 		= $m_berita->status_berita_all($status_berita,$perPage, $page);

		$data = [	'title'			=> $status_berita.' ('.$total.')',
					'berita'		=> $berita,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/berita/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// author
	public function author($id_user)
	{
		$this->simple_login->checklogin();
		$m_berita 		= new Berita_model();
		$m_kategori 	= new Kategori_model();
		$m_user 		= new User_model();
		$user 			= $m_user->detail($id_user);
		$berita 		= $m_berita->author_all($id_user);
		$total 			= $m_berita->total_author($id_user);

		$data = [	'title'			=> $user->nama.' ('.$total.')',
					'berita'		=> $berita,
					'content'		=> 'admin/berita/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		$this->simple_login->checklogin();
		$m_kategori 	= new Kategori_model();
		$m_berita 		= new Berita_model();
		$kategori 		= $m_kategori->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_berita' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori'		=> $this->request->getVar('id_kategori'),
					'slug_berita'		=> strtolower(url_title($this->request->getVar('judul_berita'))),
					'judul_berita'		=> $this->request->getVar('judul_berita'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_berita'		=> $this->request->getVar('status_berita'),
					'jenis_berita'		=> $this->request->getVar('jenis_berita'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'gambar' 			=> $namabaru,
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_post'		=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_berita->tambah($data);
	        	return redirect()->to(base_url('admin/berita/jenis_berita/'.$this->request->getVar('jenis_berita')))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori'		=> $this->request->getVar('id_kategori'),
					'slug_berita'		=> strtolower(url_title($this->request->getVar('judul_berita'))),
					'judul_berita'		=> $this->request->getVar('judul_berita'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_berita'		=> $this->request->getVar('status_berita'),
					'jenis_berita'		=> $this->request->getVar('jenis_berita'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_post'		=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_berita->tambah($data);
	        	return redirect()->to(base_url('admin/berita/jenis_berita/'.$this->request->getVar('jenis_berita')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }


		$data = [	'title'			=> 'Tambah Berita',
					'kategori'		=> $kategori,
					'content'		=> 'admin/berita/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_berita)
	{
		$this->simple_login->checklogin();
		$m_kategori 	= new Kategori_model();
		$m_berita 		= new Berita_model();
		$kategori 		= $m_kategori->listing();
		$berita 		= $m_berita->detail($id_berita);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_berita' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_berita'			=> $id_berita,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori'		=> $this->request->getVar('id_kategori'),
					'slug_berita'		=> strtolower(url_title($this->request->getVar('judul_berita'))),
					'judul_berita'		=> $this->request->getVar('judul_berita'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_berita'		=> $this->request->getVar('status_berita'),
					'jenis_berita'		=> $this->request->getVar('jenis_berita'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'gambar' 			=> $namabaru,
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_berita->edit($data);
       		 	return redirect()->to(base_url('admin/berita/jenis_berita/'.$this->request->getVar('jenis_berita')))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_berita'			=> $id_berita,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori'		=> $this->request->getVar('id_kategori'),
					'slug_berita'		=> strtolower(url_title($this->request->getVar('judul_berita'))),
					'judul_berita'		=> $this->request->getVar('judul_berita'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_berita'		=> $this->request->getVar('status_berita'),
					'jenis_berita'		=> $this->request->getVar('jenis_berita'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_berita->edit($data);
       		 	return redirect()->to(base_url('admin/berita/jenis_berita/'.$this->request->getVar('jenis_berita')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'			=> 'Edit Berita: '.$berita->judul_berita,
					'kategori'		=> $kategori,
					'berita'		=> $berita,
					'content'		=> 'admin/berita/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		$this->simple_login->checklogin();
		$m_kategori 	= new Kategori_model();
		$m_berita 		= new Berita_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_berita 	= $this->request->getVar('id_berita');
		// check berita
		if(empty($this->request->getVar('id_berita')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih berita. Pilih salah satu berita');
		}
		// end check berita
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_berita);$i++) {
				$data = array(	'id_berita'		=> $id_berita[$i],
								'id_user'		=> $this->session->get('id_user'),
								'jenis_berita'	=> $this->request->getVar('jenis_berita')
							);
   				$m_berita->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Berita berhasil diupdate jenis beritanya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_berita);$i++) {
				$data = array(	'id_berita'		=> $id_berita[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_berita'	=> 'Publish'
							);
   				$m_berita->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Berita berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_berita);$i++) {
				$data = array(	'id_berita'		=> $id_berita[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_berita'	=> 'Draft'
							);
   				$m_berita->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Berita berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_berita);$i++) {
				$data = array(	'id_berita'	=> $id_berita[$i]);
   				$m_berita->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}
	
	// Delete
	public function delete($id_berita)
	{
		$this->simple_login->checklogin();
		$m_berita = new Berita_model();
		$data = ['id_berita'	=> $id_berita];
		$m_berita->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/berita'));
	}
}