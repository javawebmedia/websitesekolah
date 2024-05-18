<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_galeri_model;

class Kategori_galeri extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_galeri 	= new Kategori_galeri_model();
		$kategori_galeri 	= $m_kategori_galeri->listing();
		$total 				= $m_kategori_galeri->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_galeri' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_galeribaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_galeribaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_galeribaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_galeribaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_galeri')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_galeri'		=> $slug,
							'nama_kategori_galeri'		=> $this->request->getPost('nama_kategori_galeri'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_galeri'		=> $this->request->getPost('status_kategori_galeri'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_galeribaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_galeri->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_galeri'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_galeri')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_galeri'		=> $slug,
							'nama_kategori_galeri'		=> $this->request->getPost('nama_kategori_galeri'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_galeri'		=> $this->request->getPost('status_kategori_galeri'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_galeri->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_galeri'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Galeri: '.$total->total,
						'kategori_galeri'	=> $kategori_galeri,
						'm_kategori_galeri'	=> $m_kategori_galeri,
						'content'			=> 'admin/kategori_galeri/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_galeri)
	{
		
		$m_kategori_galeri 	= new Kategori_galeri_model();
		$kategori_galeri 	= $m_kategori_galeri->detail($id_kategori_galeri);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_galeri' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_galeribaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_galeribaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_galeribaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_galeribaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_galeri')));
				$data = [	'id_kategori_galeri'		=> $id_kategori_galeri,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_galeri'	=> $slug,
							'nama_kategori_galeri'	=> $this->request->getPost('nama_kategori_galeri'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_galeri'	=> $this->request->getPost('status_kategori_galeri'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_galeribaru
						];
				$m_kategori_galeri->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_galeri'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_galeri')));
				$data = [	'id_kategori_galeri'		=> $id_kategori_galeri,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_galeri'	=> $slug,
							'nama_kategori_galeri'	=> $this->request->getPost('nama_kategori_galeri'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_galeri'	=> $this->request->getPost('status_kategori_galeri'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_galeri->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_galeri'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Galeri: '.$kategori_galeri->nama_kategori_galeri,
						'kategori_galeri'=> $kategori_galeri,
						'content'		=> 'admin/kategori_galeri/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_galeri)
	{
		
		$m_kategori_galeri = new Kategori_galeri_model();
		$data = ['id_kategori_galeri'	=> $id_kategori_galeri];
		$m_kategori_galeri->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_galeri'));
	}
}