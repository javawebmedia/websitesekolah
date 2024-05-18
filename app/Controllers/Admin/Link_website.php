<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Link_website_model;

class Link_website extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_link_website 	= new Link_website_model();
		$link_website 		= $m_link_website->listing();
		$total 				= $m_link_website->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_link_website' 	=> 'required|is_unique[link_website.nama_link_website]',
				'link_website' 			=> 'required|is_unique[link_website.link_website]',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_link_websitebaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_link_websitebaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_link_websitebaru)
			    ->fit(300,200, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_link_websitebaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_link_website')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_link_website'			=> $slug,
							'nama_link_website'			=> $this->request->getPost('nama_link_website'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_link_website'		=> $this->request->getPost('status_link_website'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_link_websitebaru,
							'link_website'				=> $this->request->getPost('link_website'),
							'metode_link'				=> $this->request->getPost('metode_link'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_link_website->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/link_website'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_link_website')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_link_website'			=> $slug,
							'nama_link_website'			=> $this->request->getPost('nama_link_website'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_link_website'		=> $this->request->getPost('status_link_website'),
							'urutan'					=> $this->request->getPost('urutan'),
							'link_website'				=> $this->request->getPost('link_website'),
							'metode_link'				=> $this->request->getPost('metode_link'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_link_website->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/link_website'));
			}
	    }else{
			$data = [	'title'				=> 'Data Link Website: '.$total->total,
						'link_website'		=> $link_website,
						'm_link_website'	=> $m_link_website,
						'content'			=> 'admin/link_website/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_link_website)
	{
		
		$m_link_website 	= new Link_website_model();
		$link_website 	= $m_link_website->detail($id_link_website);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_link_website' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_link_websitebaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_link_websitebaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_link_websitebaru)
			    ->fit(300,200, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_link_websitebaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_link_website')));
				$data = [	'id_link_website'		=> $id_link_website,
							'id_user'				=> $this->session->get('id_user'),
							'slug_link_website'		=> $slug,
							'nama_link_website'		=> $this->request->getPost('nama_link_website'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_link_website'	=> $this->request->getPost('status_link_website'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_link_websitebaru,
							'link_website'			=> $this->request->getPost('link_website'),
							'metode_link'				=> $this->request->getPost('metode_link'),
						];
				$m_link_website->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/link_website'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_link_website')));
				$data = [	'id_link_website'		=> $id_link_website,
							'id_user'				=> $this->session->get('id_user'),
							'slug_link_website'		=> $slug,
							'nama_link_website'		=> $this->request->getPost('nama_link_website'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_link_website'	=> $this->request->getPost('status_link_website'),
							'urutan'				=> $this->request->getPost('urutan'),
							'link_website'			=> $this->request->getPost('link_website'),
							'metode_link'				=> $this->request->getPost('metode_link'),
						];
				$m_link_website->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/link_website'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Link Website: '.$link_website->nama_link_website,
						'link_website'	=> $link_website,
						'content'		=> 'admin/link_website/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_link_website)
	{
		
		$m_link_website = new Link_website_model();
		$data = ['id_link_website'	=> $id_link_website];
		$m_link_website->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/link_website'));
	}
}