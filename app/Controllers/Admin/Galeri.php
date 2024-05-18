<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Galeri_model;
use App\Models\Kategori_galeri_model;

class Galeri extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_galeri 			= new Galeri_model();
		$m_kategori_galeri 	= new Kategori_galeri_model();
		$kategori_galeri 	= $m_kategori_galeri->listing();
		$pager 				= service('pager'); 
		// galeri
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_galeri->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $galeri 		= $m_galeri->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_galeri->total();
			$title 			= 'Galeri Gambar ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $galeri 		= $m_galeri->paginasi_admin($perPage, $page);
		}
		// end galeri

		$data = [	'title'				=> $title,
					'galeri'			=> $galeri,
					'kategori_galeri'	=> $kategori_galeri,
					'pagination'		=> $pager_links,
					'content'			=> 'admin/galeri/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Show all
	public function show()
	{
		header('Content-Type: application/json; charset=utf-8');
		$this->simple_login->checklogin();
		$m_galeri	= new Galeri_model();
		$data 		= $m_galeri->listing();
		echo json_encode($data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_galeri 			= new Galeri_model();
		$m_kategori_galeri 	= new Kategori_galeri_model();
		$kategori_galeri 	= $m_kategori_galeri->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_galeri' 	=> 'required',
				'gambar'	 	=> [
					                'uploaded[gambar]',
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
			    ->fit(300, 300, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_galeri'=> $this->request->getVar('id_kategori_galeri'),
					'judul_galeri'		=> $this->request->getVar('judul_galeri'),
					'jenis_galeri'		=> $this->request->getVar('jenis_galeri'),
					'isi'				=> $this->request->getVar('isi'),
					'gambar' 			=> $namabaru,
					'website'			=> $this->request->getVar('website'),
					'text_website'		=> $this->request->getVar('text_website'),
					'status_text'		=> $this->request->getVar('status_text'),
					'tanggal_post'		=> date('Y-m-d H:i:s')
	        	);
	        	$m_galeri->tambah($data);
        		return redirect()->to(base_url('admin/galeri'))->with('sukses', 'Data Berhasil di Simpan');
        	}else{
        		$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_galeri'=> $this->request->getVar('id_kategori_galeri'),
					'judul_galeri'		=> $this->request->getVar('judul_galeri'),
					'jenis_galeri'		=> $this->request->getVar('jenis_galeri'),
					'isi'				=> $this->request->getVar('isi'),
					'website'			=> $this->request->getVar('website'),
					'text_website'		=> $this->request->getVar('text_website'),
					'status_text'		=> $this->request->getVar('status_text'),
					'tanggal_post'		=> date('Y-m-d H:i:s')
	        	);
	        	$m_galeri->tambah($data);
        		return redirect()->to(base_url('admin/galeri'))->with('sukses', 'Data Berhasil di Simpan');
        	}
        }

		$data = [	'title'				=> 'Tambah Galeri',
					'kategori_galeri'	=> $kategori_galeri,
					'content'			=> 'admin/galeri/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_kategori 	= new Kategori_galeri_model();
		$m_galeri 		= new Galeri_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_galeri 	= $this->request->getVar('id_galeri');
		// check galeri
		if(empty($this->request->getVar('id_galeri')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih galeri. Pilih salah satu galeri');
		}
		// end check galeri
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_galeri);$i++) {
				$data = array(	'id_galeri'				=> $id_galeri[$i],
								'id_user'				=> $this->session->get('id_user'),
								'id_kategori_galeri'	=> $this->request->getVar('id_kategori_galeri')
							);
   				$m_galeri->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Galeri berhasil diupdate jenis galerinya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_galeri);$i++) {
				$data = array(	'id_galeri'		=> $id_galeri[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_galeri'	=> 'Publish'
							);
   				$m_galeri->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Galeri berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_galeri);$i++) {
				$data = array(	'id_galeri'		=> $id_galeri[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_galeri'	=> 'Draft'
							);
   				$m_galeri->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Galeri berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_galeri);$i++) {
				$data = array(	'id_galeri'	=> $id_galeri[$i]);
   				$m_galeri->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// edit
	public function edit($id_galeri)
	{
		
		$m_kategori_galeri 	= new Kategori_galeri_model();
		$m_galeri 			= new Galeri_model();
		$kategori_galeri 	= $m_kategori_galeri->listing();
		$galeri 			= $m_galeri->detail($id_galeri);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_galeri' 	=> 'required',
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
			    ->fit(300, 300, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
			    $data = array(
	        		'id_galeri'			=> $id_galeri,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_galeri'=> $this->request->getVar('id_kategori_galeri'),
					'judul_galeri'		=> $this->request->getVar('judul_galeri'),
					'jenis_galeri'		=> $this->request->getVar('jenis_galeri'),
					'isi'				=> $this->request->getVar('isi'),
					'gambar' 			=> $namabaru,
					'website'			=> $this->request->getVar('website'),
					'text_website'		=> $this->request->getVar('text_website'),
					'status_text'		=> $this->request->getVar('status_text'),
	        	);
	        	$m_galeri->edit($data);
        		return redirect()->to(base_url('admin/galeri'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_galeri'			=> $id_galeri,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_galeri'=> $this->request->getVar('id_kategori_galeri'),
					'judul_galeri'		=> $this->request->getVar('judul_galeri'),
					'jenis_galeri'		=> $this->request->getVar('jenis_galeri'),
					'isi'				=> $this->request->getVar('isi'),
					'website'			=> $this->request->getVar('website'),
					'text_website'		=> $this->request->getVar('text_website'),
					'status_text'		=> $this->request->getVar('status_text'),
	        	);
	        	$m_galeri->edit($data);
        		return redirect()->to(base_url('admin/galeri'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}

		$data = [	'title'				=> 'Edit Galeri: '.$galeri->judul_galeri,
					'kategori_galeri'	=> $kategori_galeri,
					'galeri'			=> $galeri,
					'content'			=> 'admin/galeri/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Delete
	public function delete($id_galeri)
	{
		
		$m_galeri = new Galeri_model();
		$data = ['id_galeri'	=> $id_galeri];
		$m_galeri->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/galeri'));
	}
}