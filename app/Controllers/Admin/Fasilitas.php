<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Fasilitas_model;
use App\Models\Kategori_fasilitas_model;

class Fasilitas extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_fasilitas 			= new Fasilitas_model();
		$m_kategori_fasilitas 	= new Kategori_fasilitas_model();
		$kategori_fasilitas 	= $m_kategori_fasilitas->listing();
		$pager 				= service('pager'); 
		// fasilitas
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_fasilitas->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $fasilitas 		= $m_fasilitas->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_fasilitas->total();
			$title 			= 'Fasilitas  ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $fasilitas 		= $m_fasilitas->paginasi_admin($perPage, $page);
		}
		// end fasilitas

		$data = [	'title'					=> $title,
					'fasilitas'				=> $fasilitas,
					'kategori_fasilitas'	=> $kategori_fasilitas,
					'pagination'			=> $pager_links,
					'content'				=> 'admin/fasilitas/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_fasilitas 			= new Fasilitas_model();
		$m_kategori_fasilitas 	= new Kategori_fasilitas_model();
		$kategori_fasilitas 	= $m_kategori_fasilitas->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_fasilitas' 	=> 'required|is_unique[fasilitas.judul_fasilitas]',
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
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_fasilitas'	=> $this->request->getVar('id_kategori_fasilitas'),
					'slug_fasilitas'		=> strtolower(url_title($this->request->getVar('judul_fasilitas'))),
					'judul_fasilitas'		=> $this->request->getVar('judul_fasilitas'),
					'kode_nomor_fasilitas'	=> $this->request->getVar('kode_nomor_fasilitas'),
					'kondisi_fasilitas'		=> $this->request->getVar('kondisi_fasilitas'),
					'tahun_fasilitas'		=> $this->request->getVar('tahun_fasilitas'),
					'tanggal_fasilitas'		=> $this->website->tanggal_input($this->request->getVar('tanggal_fasilitas')),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_fasilitas'		=> $this->request->getVar('status_fasilitas'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_fasilitas->tambah($data);
        		return redirect()->to(base_url('admin/fasilitas'))->with('sukses', 'Data Berhasil di Simpan');
        	}else{
        		$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_fasilitas'	=> $this->request->getVar('id_kategori_fasilitas'),
					'slug_fasilitas'		=> strtolower(url_title($this->request->getVar('judul_fasilitas'))),
					'judul_fasilitas'		=> $this->request->getVar('judul_fasilitas'),
					'kode_nomor_fasilitas'	=> $this->request->getVar('kode_nomor_fasilitas'),
					'kondisi_fasilitas'		=> $this->request->getVar('kondisi_fasilitas'),
					'tahun_fasilitas'		=> $this->request->getVar('tahun_fasilitas'),
					'tanggal_fasilitas'		=> $this->website->tanggal_input($this->request->getVar('tanggal_fasilitas')),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_fasilitas'		=> $this->request->getVar('status_fasilitas'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_fasilitas->tambah($data);
        		return redirect()->to(base_url('admin/fasilitas'))->with('sukses', 'Data Berhasil di Simpan');
        	}
        }

		$data = [	'title'					=> 'Tambah Fasilitas ',
					'kategori_fasilitas'	=> $kategori_fasilitas,
					'content'				=> 'admin/fasilitas/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_kategori 	= new Kategori_fasilitas_model();
		$m_fasilitas 		= new Fasilitas_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_fasilitas 	= $this->request->getVar('id_fasilitas');
		// check fasilitas
		if(empty($this->request->getVar('id_fasilitas')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih fasilitas. Pilih salah satu fasilitas');
		}
		// end check fasilitas
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_fasilitas);$i++) {
				$data = array(	'id_fasilitas'				=> $id_fasilitas[$i],
								'id_user'				=> $this->session->get('id_user'),
								'id_kategori_fasilitas'	=> $this->request->getVar('id_kategori_fasilitas')
							);
   				$m_fasilitas->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Fasilitas berhasil diupdate jenis fasilitasnya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_fasilitas);$i++) {
				$data = array(	'id_fasilitas'		=> $id_fasilitas[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_fasilitas'	=> 'Publish'
							);
   				$m_fasilitas->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Fasilitas berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_fasilitas);$i++) {
				$data = array(	'id_fasilitas'		=> $id_fasilitas[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_fasilitas'	=> 'Draft'
							);
   				$m_fasilitas->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Fasilitas berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_fasilitas);$i++) {
				$data = array(	'id_fasilitas'	=> $id_fasilitas[$i]);
   				$m_fasilitas->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// edit
	public function edit($id_fasilitas)
	{
		
		$m_kategori_fasilitas 	= new Kategori_fasilitas_model();
		$m_fasilitas 			= new Fasilitas_model();
		$kategori_fasilitas 	= $m_kategori_fasilitas->listing();
		$fasilitas 			= $m_fasilitas->detail($id_fasilitas);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_fasilitas' 	=> 'required',
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
	        		'id_fasilitas'			=> $id_fasilitas,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_fasilitas'	=> $this->request->getVar('id_kategori_fasilitas'),
					'slug_fasilitas'		=> strtolower(url_title($this->request->getVar('judul_fasilitas'))),
					'judul_fasilitas'		=> $this->request->getVar('judul_fasilitas'),
					'kode_nomor_fasilitas'	=> $this->request->getVar('kode_nomor_fasilitas'),
					'kondisi_fasilitas'		=> $this->request->getVar('kondisi_fasilitas'),
					'tahun_fasilitas'		=> $this->request->getVar('tahun_fasilitas'),
					'tanggal_fasilitas'		=> $this->website->tanggal_input($this->request->getVar('tanggal_fasilitas')),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_fasilitas'		=> $this->request->getVar('status_fasilitas'),
	        	);
	        	$m_fasilitas->edit($data);
        		return redirect()->to(base_url('admin/fasilitas'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_fasilitas'			=> $id_fasilitas,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_fasilitas'	=> $this->request->getVar('id_kategori_fasilitas'),
					'slug_fasilitas'		=> strtolower(url_title($this->request->getVar('judul_fasilitas'))),
					'judul_fasilitas'		=> $this->request->getVar('judul_fasilitas'),
					'kode_nomor_fasilitas'	=> $this->request->getVar('kode_nomor_fasilitas'),
					'kondisi_fasilitas'		=> $this->request->getVar('kondisi_fasilitas'),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_fasilitas'		=> $this->request->getVar('status_fasilitas'),
	        	);
	        	$m_fasilitas->edit($data);
        		return redirect()->to(base_url('admin/fasilitas'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}

		$data = [	'title'				=> 'Edit Fasilitas : '.$fasilitas->judul_fasilitas,
					'kategori_fasilitas'	=> $kategori_fasilitas,
					'fasilitas'			=> $fasilitas,
					'content'			=> 'admin/fasilitas/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Delete
	public function delete($id_fasilitas)
	{
		
		$m_fasilitas = new Fasilitas_model();
		$data = ['id_fasilitas'	=> $id_fasilitas];
		$m_fasilitas->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/fasilitas'));
	}
}