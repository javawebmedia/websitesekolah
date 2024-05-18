<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Ekstrakurikuler_model;
use App\Models\Kategori_ekstrakurikuler_model;

class Ekstrakurikuler extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_ekstrakurikuler 			= new Ekstrakurikuler_model();
		$m_kategori_ekstrakurikuler 	= new Kategori_ekstrakurikuler_model();
		$kategori_ekstrakurikuler 	= $m_kategori_ekstrakurikuler->listing();
		$pager 				= service('pager'); 
		// ekstrakurikuler
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_ekstrakurikuler->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $ekstrakurikuler 		= $m_ekstrakurikuler->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_ekstrakurikuler->total();
			$title 			= 'Ekstrakurikuler  ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $ekstrakurikuler 		= $m_ekstrakurikuler->paginasi_admin($perPage, $page);
		}
		// end ekstrakurikuler

		$data = [	'title'						=> $title,
					'ekstrakurikuler'			=> $ekstrakurikuler,
					'kategori_ekstrakurikuler'	=> $kategori_ekstrakurikuler,
					'pagination'				=> $pager_links,
					'content'					=> 'admin/ekstrakurikuler/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_ekstrakurikuler 			= new Ekstrakurikuler_model();
		$m_kategori_ekstrakurikuler	= new Kategori_ekstrakurikuler_model();
		$kategori_ekstrakurikuler 	= $m_kategori_ekstrakurikuler->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_ekstrakurikuler' 	=> 'required|is_unique[ekstrakurikuler.judul_ekstrakurikuler]',
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
	        		'id_user'						=> $this->session->get('id_user'),
					'id_kategori_ekstrakurikuler'	=> $this->request->getVar('id_kategori_ekstrakurikuler'),
					'slug_ekstrakurikuler'			=> strtolower(url_title($this->request->getVar('judul_ekstrakurikuler'))),
					'judul_ekstrakurikuler'			=> $this->request->getVar('judul_ekstrakurikuler'),
					'nama_penanggung_jawab'			=> $this->request->getVar('nama_penanggung_jawab'),
					'isi'							=> $this->request->getVar('isi'),
					'gambar' 						=> $namabaru,
					'website'						=> $this->request->getVar('website'),
					'text_website'					=> $this->request->getVar('text_website'),
					'status_text'					=> $this->request->getVar('status_text'),
					'status_ekstrakurikuler'		=> $this->request->getVar('status_ekstrakurikuler'),
					'tanggal_post'					=> date('Y-m-d H:i:s')
	        	);
	        	$m_ekstrakurikuler->tambah($data);
        		return redirect()->to(base_url('admin/ekstrakurikuler'))->with('sukses', 'Data Berhasil di Simpan');
        	}else{
        		$data = array(
	        		'id_user'						=> $this->session->get('id_user'),
					'id_kategori_ekstrakurikuler'	=> $this->request->getVar('id_kategori_ekstrakurikuler'),
					'slug_ekstrakurikuler'			=> strtolower(url_title($this->request->getVar('judul_ekstrakurikuler'))),
					'judul_ekstrakurikuler'			=> $this->request->getVar('judul_ekstrakurikuler'),
					'nama_penanggung_jawab'			=> $this->request->getVar('nama_penanggung_jawab'),
					'isi'							=> $this->request->getVar('isi'),
					'website'						=> $this->request->getVar('website'),
					'text_website'					=> $this->request->getVar('text_website'),
					'status_text'					=> $this->request->getVar('status_text'),
					'status_ekstrakurikuler'		=> $this->request->getVar('status_ekstrakurikuler'),
					'tanggal_post'					=> date('Y-m-d H:i:s')
	        	);
	        	$m_ekstrakurikuler->tambah($data);
        		return redirect()->to(base_url('admin/ekstrakurikuler'))->with('sukses', 'Data Berhasil di Simpan');
        	}
        }

		$data = [	'title'						=> 'Tambah Ekstrakurikuler ',
					'kategori_ekstrakurikuler'	=> $kategori_ekstrakurikuler,
					'content'					=> 'admin/ekstrakurikuler/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_kategori 		= new Kategori_ekstrakurikuler_model();
		$m_ekstrakurikuler	= new Ekstrakurikuler_model();
		// proses
		$pengalihan 		= $this->request->getVar('pengalihan');
		$submit 			= $this->request->getVar('submit');
		$id_ekstrakurikuler 	= $this->request->getVar('id_ekstrakurikuler');
		// check ekstrakurikuler
		if(empty($this->request->getVar('id_ekstrakurikuler')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih ekstrakurikuler. Pilih salah satu ekstrakurikuler');
		}
		// end check ekstrakurikuler
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_ekstrakurikuler);$i++) {
				$data = array(	'id_ekstrakurikuler'			=> $id_ekstrakurikuler[$i],
								'id_user'						=> $this->session->get('id_user'),
								'id_kategori_ekstrakurikuler'	=> $this->request->getVar('id_kategori_ekstrakurikuler')
							);
   				$m_ekstrakurikuler->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Ekstrakurikuler berhasil diupdate jenis ekstrakurikulernya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_ekstrakurikuler);$i++) {
				$data = array(	'id_ekstrakurikuler'		=> $id_ekstrakurikuler[$i],
								'id_user'					=> $this->session->get('id_user'),
								'status_ekstrakurikuler'	=> 'Publish'
							);
   				$m_ekstrakurikuler->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Ekstrakurikuler berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_ekstrakurikuler);$i++) {
				$data = array(	'id_ekstrakurikuler'		=> $id_ekstrakurikuler[$i],
								'id_user'					=> $this->session->get('id_user'),
								'status_ekstrakurikuler'	=> 'Draft'
							);
   				$m_ekstrakurikuler->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Ekstrakurikuler berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_ekstrakurikuler);$i++) {
				$data = array(	'id_ekstrakurikuler'	=> $id_ekstrakurikuler[$i]);
   				$m_ekstrakurikuler->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// edit
	public function edit($id_ekstrakurikuler)
	{
		
		$m_kategori_ekstrakurikuler	= new Kategori_ekstrakurikuler_model();
		$m_ekstrakurikuler 			= new Ekstrakurikuler_model();
		$kategori_ekstrakurikuler 	= $m_kategori_ekstrakurikuler->listing();
		$ekstrakurikuler 			= $m_ekstrakurikuler->detail($id_ekstrakurikuler);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_ekstrakurikuler' 	=> 'required',
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
	        		'id_ekstrakurikuler'			=> $id_ekstrakurikuler,
	        		'id_user'						=> $this->session->get('id_user'),
					'id_kategori_ekstrakurikuler'	=> $this->request->getVar('id_kategori_ekstrakurikuler'),
					'slug_ekstrakurikuler'			=> strtolower(url_title($this->request->getVar('judul_ekstrakurikuler'))),
					'judul_ekstrakurikuler'			=> $this->request->getVar('judul_ekstrakurikuler'),
					'nama_penanggung_jawab'			=> $this->request->getVar('nama_penanggung_jawab'),
					'isi'							=> $this->request->getVar('isi'),
					'gambar' 						=> $namabaru,
					'website'						=> $this->request->getVar('website'),
					'text_website'					=> $this->request->getVar('text_website'),
					'status_text'					=> $this->request->getVar('status_text'),
					'status_ekstrakurikuler'		=> $this->request->getVar('status_ekstrakurikuler'),
	        	);
	        	$m_ekstrakurikuler->edit($data);
        		return redirect()->to(base_url('admin/ekstrakurikuler'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_ekstrakurikuler'			=> $id_ekstrakurikuler,
	        		'id_user'						=> $this->session->get('id_user'),
					'id_kategori_ekstrakurikuler'	=> $this->request->getVar('id_kategori_ekstrakurikuler'),
					'slug_ekstrakurikuler'			=> strtolower(url_title($this->request->getVar('judul_ekstrakurikuler'))),
					'judul_ekstrakurikuler'			=> $this->request->getVar('judul_ekstrakurikuler'),
					'nama_penanggung_jawab'			=> $this->request->getVar('nama_penanggung_jawab'),
					'isi'							=> $this->request->getVar('isi'),
					'website'						=> $this->request->getVar('website'),
					'text_website'					=> $this->request->getVar('text_website'),
					'status_text'					=> $this->request->getVar('status_text'),
					'status_ekstrakurikuler'		=> $this->request->getVar('status_ekstrakurikuler'),
	        	);
	        	$m_ekstrakurikuler->edit($data);
        		return redirect()->to(base_url('admin/ekstrakurikuler'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}

		$data = [	'title'						=> 'Edit Ekstrakurikuler: '.$ekstrakurikuler->judul_ekstrakurikuler,
					'kategori_ekstrakurikuler'	=> $kategori_ekstrakurikuler,
					'ekstrakurikuler'			=> $ekstrakurikuler,
					'content'					=> 'admin/ekstrakurikuler/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Delete
	public function delete($id_ekstrakurikuler)
	{
		
		$m_ekstrakurikuler = new Ekstrakurikuler_model();
		$data = ['id_ekstrakurikuler'	=> $id_ekstrakurikuler];
		$m_ekstrakurikuler->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/ekstrakurikuler'));
	}
}