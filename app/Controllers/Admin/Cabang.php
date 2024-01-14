<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Cabang_model;
use App\Models\Kategori_cabang_model;
use App\Models\User_model;

class Cabang extends BaseController
{
	
	// index
	public function index()
	{
		$this->simple_login->checklogin();
		$m_cabang 			= new Cabang_model();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$kategori_cabang 	= $m_kategori_cabang->listing();
		$pager 				= service('pager'); 
		// cabang
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_cabang->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $cabang 		= $m_cabang->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_cabang->total();
			$title 			= 'Cabang Latihan ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $cabang 		= $m_cabang->paginasi_admin($perPage, $page);
		}
		// end cabang
		
		$data = [	'title'				=> $title,
					'cabang'			=> $cabang,
					'pagination'		=> $pager_links,
					'kategori_cabang'	=> $kategori_cabang,
					'content'			=> 'admin/cabang/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// kategori_cabang
	public function kategori_cabang($id_kategori_cabang)
	{
		$this->simple_login->checklogin();
		$m_cabang 			= new Cabang_model();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$kategori_cabang 	= $m_kategori_cabang->detail($id_kategori_cabang);
		$total 				= $m_cabang->total_kategori_cabang($id_kategori_cabang);
		$pager 				= service('pager');
        $page    			= (int) ($this->request->getGet('page') ?? 1);
        $perPage 			= $this->website->paginasi();
        $total   			= $total;
        $pager_links 		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 				= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $cabang 			= $m_cabang->kategori_cabang_all($id_kategori_cabang,$perPage, $page);

		$data = [	'title'			=> $kategori_cabang->nama_kategori_cabang.' ('.$total.')',
					'cabang'		=> $cabang,
					'content'		=> 'admin/cabang/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jenis_cabang
	public function jenis_cabang($jenis_cabang)
	{
		$this->simple_login->checklogin();
		$m_cabang 			= new Cabang_model();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$total 				= $m_cabang->total_jenis_cabang($jenis_cabang);
		$pager 				= service('pager');
        $page    			= (int) ($this->request->getGet('page') ?? 1);
        $perPage 			= $this->website->paginasi();
        $total   			= $total;
        $pager_links 		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 				= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $cabang 			= $m_cabang->jenis_cabang_all($jenis_cabang,$perPage, $page);

		$data = [	'title'			=> $jenis_cabang.' ('.$total.')',
					'cabang'		=> $cabang,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/cabang/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// status_cabang
	public function status_cabang($status_cabang)
	{
		$this->simple_login->checklogin();
		$m_cabang 			= new Cabang_model();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$total 				= $m_cabang->total_status_cabang($status_cabang);
		$pager 				= service('pager');
        $page    			= (int) ($this->request->getGet('page') ?? 1);
        $perPage 			= $this->website->paginasi();
        $total   			= $total;
        $pager_links 		= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 				= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $cabang 			= $m_cabang->status_cabang_all($status_cabang,$perPage, $page);

		$data = [	'title'			=> $status_cabang.' ('.$total.')',
					'cabang'		=> $cabang,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/cabang/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// author
	public function author($id_user)
	{
		$this->simple_login->checklogin();
		$m_cabang 			= new Cabang_model();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$m_user 			= new User_model();
		$user 				= $m_user->detail($id_user);
		$cabang 			= $m_cabang->author_all($id_user);
		$total 				= $m_cabang->total_author($id_user);

		$data = [	'title'			=> $user->nama.' ('.$total.')',
					'cabang'		=> $cabang,
					'content'		=> 'admin/cabang/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		$this->simple_login->checklogin();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$m_cabang 			= new Cabang_model();
		$kategori_cabang 	= $m_kategori_cabang->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_cabang' 	=> 'required',
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
					'id_kategori_cabang'=> $this->request->getVar('id_kategori_cabang'),
					'slug_cabang'		=> strtolower(url_title($this->request->getVar('nama_cabang'))),
					'nama_cabang'		=> $this->request->getVar('nama_cabang'),
					'singkatan'			=> $this->request->getVar('singkatan'),
					'nomor'				=> $this->request->getVar('nomor'),
					'alamat'			=> $this->request->getVar('alamat'),
					'nama_pelatih'		=> $this->request->getVar('nama_pelatih'),
					'email'				=> $this->request->getVar('email'),
					'telepon'			=> $this->request->getVar('telepon'),
					'google_map'		=> $this->request->getVar('google_map'),
					'isi'				=> $this->request->getVar('isi'),
					'status_cabang'		=> $this->request->getVar('status_cabang'),
					'jenis_cabang'		=> $this->request->getVar('jenis_cabang'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'gambar' 			=> $namabaru,
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_post'		=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_cabang->tambah($data);
	        	return redirect()->to(base_url('admin/cabang/jenis_cabang/'.$this->request->getVar('jenis_cabang')))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_cabang'=> $this->request->getVar('id_kategori_cabang'),
					'slug_cabang'		=> strtolower(url_title($this->request->getVar('nama_cabang'))),
					'nama_cabang'		=> $this->request->getVar('nama_cabang'),
					'singkatan'			=> $this->request->getVar('singkatan'),
					'nomor'				=> $this->request->getVar('nomor'),
					'alamat'			=> $this->request->getVar('alamat'),
					'nama_pelatih'		=> $this->request->getVar('nama_pelatih'),
					'email'				=> $this->request->getVar('email'),
					'telepon'			=> $this->request->getVar('telepon'),
					'google_map'		=> $this->request->getVar('google_map'),
					'isi'				=> $this->request->getVar('isi'),
					'status_cabang'		=> $this->request->getVar('status_cabang'),
					'jenis_cabang'		=> $this->request->getVar('jenis_cabang'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_post'		=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_cabang->tambah($data);
	        	return redirect()->to(base_url('admin/cabang/jenis_cabang/'.$this->request->getVar('jenis_cabang')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }


		$data = [	'title'				=> 'Tambah Cabang',
					'kategori_cabang'	=> $kategori_cabang,
					'content'			=> 'admin/cabang/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_cabang)
	{
		$this->simple_login->checklogin();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$m_cabang 			= new Cabang_model();
		$kategori_cabang 	= $m_kategori_cabang->listing();
		$cabang 			= $m_cabang->detail($id_cabang);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_cabang' 	=> 'required',
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
	        		'id_cabang'			=> $id_cabang,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_cabang'=> $this->request->getVar('id_kategori_cabang'),
					'slug_cabang'		=> strtolower(url_title($this->request->getVar('nama_cabang'))),
					'nama_cabang'		=> $this->request->getVar('nama_cabang'),
					'singkatan'			=> $this->request->getVar('singkatan'),
					'nomor'				=> $this->request->getVar('nomor'),
					'alamat'			=> $this->request->getVar('alamat'),
					'nama_pelatih'		=> $this->request->getVar('nama_pelatih'),
					'email'				=> $this->request->getVar('email'),
					'telepon'			=> $this->request->getVar('telepon'),
					'google_map'		=> $this->request->getVar('google_map'),
					'isi'				=> $this->request->getVar('isi'),
					'status_cabang'		=> $this->request->getVar('status_cabang'),
					'jenis_cabang'		=> $this->request->getVar('jenis_cabang'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'gambar' 			=> $namabaru,
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_cabang->edit($data);
       		 	return redirect()->to(base_url('admin/cabang/jenis_cabang/'.$this->request->getVar('jenis_cabang')))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_cabang'			=> $id_cabang,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_cabang'=> $this->request->getVar('id_kategori_cabang'),
					'slug_cabang'		=> strtolower(url_title($this->request->getVar('nama_cabang'))),
					'nama_cabang'		=> $this->request->getVar('nama_cabang'),
					'singkatan'			=> $this->request->getVar('singkatan'),
					'nomor'				=> $this->request->getVar('nomor'),
					'alamat'			=> $this->request->getVar('alamat'),
					'nama_pelatih'		=> $this->request->getVar('nama_pelatih'),
					'email'				=> $this->request->getVar('email'),
					'telepon'			=> $this->request->getVar('telepon'),
					'google_map'		=> $this->request->getVar('google_map'),
					'isi'				=> $this->request->getVar('isi'),
					'status_cabang'		=> $this->request->getVar('status_cabang'),
					'jenis_cabang'		=> $this->request->getVar('jenis_cabang'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_cabang->edit($data);
       		 	return redirect()->to(base_url('admin/cabang/jenis_cabang/'.$this->request->getVar('jenis_cabang')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'				=> 'Edit Cabang: '.$cabang->nama_cabang,
					'kategori_cabang'	=> $kategori_cabang,
					'cabang'			=> $cabang,
					'content'			=> 'admin/cabang/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		$this->simple_login->checklogin();
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$m_cabang 			= new Cabang_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_cabang 	= $this->request->getVar('id_cabang');
		// check cabang
		if(empty($this->request->getVar('id_cabang')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih cabang. Pilih salah satu cabang');
		}
		// end check cabang
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_cabang);$i++) {
				$data = array(	'id_cabang'		=> $id_cabang[$i],
								'id_user'		=> $this->session->get('id_user'),
								'jenis_cabang'	=> $this->request->getVar('jenis_cabang')
							);
   				$m_cabang->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Cabang berhasil diupdate jenis cabangnya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_cabang);$i++) {
				$data = array(	'id_cabang'		=> $id_cabang[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_cabang'	=> 'Publish'
							);
   				$m_cabang->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Cabang berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_cabang);$i++) {
				$data = array(	'id_cabang'		=> $id_cabang[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_cabang'	=> 'Draft'
							);
   				$m_cabang->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Cabang berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_cabang);$i++) {
				$data = array(	'id_cabang'	=> $id_cabang[$i]);
   				$m_cabang->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}
	
	// Delete
	public function delete($id_cabang)
	{
		$this->simple_login->checklogin();
		$m_cabang = new Cabang_model();
		$data = ['id_cabang'	=> $id_cabang];
		$m_cabang->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/cabang'));
	}
}