<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_client_model;

class Kategori_client extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_client 	= new Kategori_client_model();
		$kategori_client 	= $m_kategori_client->listing();
		$total 				= $m_kategori_client->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_client' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_clientbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_clientbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_clientbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_clientbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_client')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_client'		=> $slug,
							'nama_kategori_client'		=> $this->request->getPost('nama_kategori_client'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_client'		=> $this->request->getPost('status_kategori_client'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_clientbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_client->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_client'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_client')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_client'		=> $slug,
							'nama_kategori_client'		=> $this->request->getPost('nama_kategori_client'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_client'		=> $this->request->getPost('status_kategori_client'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_client->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_client'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Client: '.$total->total,
						'kategori_client'	=> $kategori_client,
						'm_kategori_client'	=> $m_kategori_client,
						'content'			=> 'admin/kategori_client/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_client)
	{
		
		$m_kategori_client 	= new Kategori_client_model();
		$kategori_client 	= $m_kategori_client->detail($id_kategori_client);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_client' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_clientbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_clientbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_clientbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_clientbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_client')));
				$data = [	'id_kategori_client'		=> $id_kategori_client,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_client'	=> $slug,
							'nama_kategori_client'	=> $this->request->getPost('nama_kategori_client'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_client'	=> $this->request->getPost('status_kategori_client'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_clientbaru
						];
				$m_kategori_client->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_client'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_client')));
				$data = [	'id_kategori_client'		=> $id_kategori_client,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_client'	=> $slug,
							'nama_kategori_client'	=> $this->request->getPost('nama_kategori_client'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_client'	=> $this->request->getPost('status_kategori_client'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_client->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_client'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Client: '.$kategori_client->nama_kategori_client,
						'kategori_client'=> $kategori_client,
						'content'		=> 'admin/kategori_client/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_client)
	{
		
		$m_kategori_client = new Kategori_client_model();
		$data = ['id_kategori_client'	=> $id_kategori_client];
		$m_kategori_client->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_client'));
	}
}