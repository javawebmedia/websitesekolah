<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Prestasi_model;
use App\Models\Kategori_prestasi_model;

class Prestasi extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_prestasi 			= new Prestasi_model();
		$m_kategori_prestasi 	= new Kategori_prestasi_model();
		$kategori_prestasi 	= $m_kategori_prestasi->listing();
		$pager 				= service('pager'); 
		// prestasi
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_prestasi->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $prestasi 		= $m_prestasi->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_prestasi->total();
			$title 			= 'Prestasi dan Penghargaan ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $prestasi 		= $m_prestasi->paginasi_admin($perPage, $page);
		}
		// end prestasi

		$data = [	'title'				=> $title,
					'prestasi'			=> $prestasi,
					'kategori_prestasi'	=> $kategori_prestasi,
					'pagination'		=> $pager_links,
					'content'			=> 'admin/prestasi/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_prestasi 			= new Prestasi_model();
		$m_kategori_prestasi 	= new Kategori_prestasi_model();
		$kategori_prestasi 	= $m_kategori_prestasi->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_prestasi' 	=> 'required|is_unique[prestasi.judul_prestasi]',
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
			    ->fit(300,200, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_prestasi'	=> $this->request->getVar('id_kategori_prestasi'),
					'slug_prestasi'			=> strtolower(url_title($this->request->getVar('judul_prestasi'))),
					'judul_prestasi'		=> $this->request->getVar('judul_prestasi'),
					'nama_penerima'			=> $this->request->getVar('nama_penerima'),
					'penyelenggara'			=> $this->request->getVar('penyelenggara'),
					'hadiah_prestasi'		=> $this->request->getVar('hadiah_prestasi'),
					'jenjang_prestasi'		=> $this->request->getVar('jenjang_prestasi'),
					'tahun_prestasi'		=> $this->request->getVar('tahun_prestasi'),
					'tanggal_prestasi'		=> $this->website->tanggal_input($this->request->getVar('tanggal_prestasi')),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_prestasi'		=> $this->request->getVar('status_prestasi'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_prestasi->tambah($data);
        		return redirect()->to(base_url('admin/prestasi'))->with('sukses', 'Data Berhasil di Simpan');
        	}else{
        		$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_prestasi'	=> $this->request->getVar('id_kategori_prestasi'),
					'slug_prestasi'			=> strtolower(url_title($this->request->getVar('judul_prestasi'))),
					'judul_prestasi'		=> $this->request->getVar('judul_prestasi'),
					'nama_penerima'			=> $this->request->getVar('nama_penerima'),
					'penyelenggara'			=> $this->request->getVar('penyelenggara'),
					'hadiah_prestasi'		=> $this->request->getVar('hadiah_prestasi'),
					'jenjang_prestasi'		=> $this->request->getVar('jenjang_prestasi'),
					'tahun_prestasi'		=> $this->request->getVar('tahun_prestasi'),
					'tanggal_prestasi'		=> $this->website->tanggal_input($this->request->getVar('tanggal_prestasi')),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_prestasi'		=> $this->request->getVar('status_prestasi'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_prestasi->tambah($data);
        		return redirect()->to(base_url('admin/prestasi'))->with('sukses', 'Data Berhasil di Simpan');
        	}
        }

		$data = [	'title'				=> 'Tambah Prestasi dan Penghargaan',
					'kategori_prestasi'	=> $kategori_prestasi,
					'content'			=> 'admin/prestasi/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_kategori 	= new Kategori_prestasi_model();
		$m_prestasi 		= new Prestasi_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_prestasi 	= $this->request->getVar('id_prestasi');
		// check prestasi
		if(empty($this->request->getVar('id_prestasi')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih prestasi. Pilih salah satu prestasi');
		}
		// end check prestasi
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_prestasi);$i++) {
				$data = array(	'id_prestasi'				=> $id_prestasi[$i],
								'id_user'				=> $this->session->get('id_user'),
								'id_kategori_prestasi'	=> $this->request->getVar('id_kategori_prestasi')
							);
   				$m_prestasi->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Prestasi berhasil diupdate jenis prestasinya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_prestasi);$i++) {
				$data = array(	'id_prestasi'		=> $id_prestasi[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_prestasi'	=> 'Publish'
							);
   				$m_prestasi->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Prestasi berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_prestasi);$i++) {
				$data = array(	'id_prestasi'		=> $id_prestasi[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_prestasi'	=> 'Draft'
							);
   				$m_prestasi->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Prestasi berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_prestasi);$i++) {
				$data = array(	'id_prestasi'	=> $id_prestasi[$i]);
   				$m_prestasi->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// edit
	public function edit($id_prestasi)
	{
		
		$m_kategori_prestasi 	= new Kategori_prestasi_model();
		$m_prestasi 			= new Prestasi_model();
		$kategori_prestasi 	= $m_kategori_prestasi->listing();
		$prestasi 			= $m_prestasi->detail($id_prestasi);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_prestasi' 	=> 'required',
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
			    ->fit(300,200, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
			    $data = array(
	        		'id_prestasi'			=> $id_prestasi,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_prestasi'	=> $this->request->getVar('id_kategori_prestasi'),
					'slug_prestasi'			=> strtolower(url_title($this->request->getVar('judul_prestasi'))),
					'judul_prestasi'		=> $this->request->getVar('judul_prestasi'),
					'nama_penerima'			=> $this->request->getVar('nama_penerima'),
					'penyelenggara'			=> $this->request->getVar('penyelenggara'),
					'hadiah_prestasi'		=> $this->request->getVar('hadiah_prestasi'),
					'jenjang_prestasi'		=> $this->request->getVar('jenjang_prestasi'),
					'tahun_prestasi'		=> $this->request->getVar('tahun_prestasi'),
					'tanggal_prestasi'		=> $this->website->tanggal_input($this->request->getVar('tanggal_prestasi')),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_prestasi'		=> $this->request->getVar('status_prestasi'),
	        	);
	        	$m_prestasi->edit($data);
        		return redirect()->to(base_url('admin/prestasi'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_prestasi'			=> $id_prestasi,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_prestasi'	=> $this->request->getVar('id_kategori_prestasi'),
					'slug_prestasi'			=> strtolower(url_title($this->request->getVar('judul_prestasi'))),
					'judul_prestasi'		=> $this->request->getVar('judul_prestasi'),
					'nama_penerima'			=> $this->request->getVar('nama_penerima'),
					'penyelenggara'			=> $this->request->getVar('penyelenggara'),
					'hadiah_prestasi'		=> $this->request->getVar('hadiah_prestasi'),
					'jenjang_prestasi'		=> $this->request->getVar('jenjang_prestasi'),
					'tahun_prestasi'		=> $this->request->getVar('tahun_prestasi'),
					'tanggal_prestasi'		=> $this->website->tanggal_input($this->request->getVar('tanggal_prestasi')),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_prestasi'		=> $this->request->getVar('status_prestasi'),
	        	);
	        	$m_prestasi->edit($data);
        		return redirect()->to(base_url('admin/prestasi'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}

		$data = [	'title'				=> 'Edit Prestasi dan Penghargaan: '.$prestasi->judul_prestasi,
					'kategori_prestasi'	=> $kategori_prestasi,
					'prestasi'			=> $prestasi,
					'content'			=> 'admin/prestasi/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Delete
	public function delete($id_prestasi)
	{
		
		$m_prestasi = new Prestasi_model();
		$data = ['id_prestasi'	=> $id_prestasi];
		$m_prestasi->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/prestasi'));
	}
}