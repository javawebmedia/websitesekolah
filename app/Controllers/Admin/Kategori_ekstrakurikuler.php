<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_ekstrakurikuler_model;

class Kategori_ekstrakurikuler extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_ekstrakurikuler 	= new Kategori_ekstrakurikuler_model();
		$kategori_ekstrakurikuler 	= $m_kategori_ekstrakurikuler->listing();
		$total 				= $m_kategori_ekstrakurikuler->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_ekstrakurikuler' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_ekstrakurikulerbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_ekstrakurikulerbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_ekstrakurikulerbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_ekstrakurikulerbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_ekstrakurikuler')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_ekstrakurikuler'		=> $slug,
							'nama_kategori_ekstrakurikuler'		=> $this->request->getPost('nama_kategori_ekstrakurikuler'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_ekstrakurikuler'		=> $this->request->getPost('status_kategori_ekstrakurikuler'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_ekstrakurikulerbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_ekstrakurikuler->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_ekstrakurikuler'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_ekstrakurikuler')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_ekstrakurikuler'		=> $slug,
							'nama_kategori_ekstrakurikuler'		=> $this->request->getPost('nama_kategori_ekstrakurikuler'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_ekstrakurikuler'		=> $this->request->getPost('status_kategori_ekstrakurikuler'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_ekstrakurikuler->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_ekstrakurikuler'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Ekstrakurikuler: '.$total->total,
						'kategori_ekstrakurikuler'	=> $kategori_ekstrakurikuler,
						'm_kategori_ekstrakurikuler'	=> $m_kategori_ekstrakurikuler,
						'content'			=> 'admin/kategori_ekstrakurikuler/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_ekstrakurikuler)
	{
		
		$m_kategori_ekstrakurikuler 	= new Kategori_ekstrakurikuler_model();
		$kategori_ekstrakurikuler 	= $m_kategori_ekstrakurikuler->detail($id_kategori_ekstrakurikuler);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_ekstrakurikuler' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_ekstrakurikulerbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_ekstrakurikulerbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_ekstrakurikulerbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_ekstrakurikulerbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_ekstrakurikuler')));
				$data = [	'id_kategori_ekstrakurikuler'		=> $id_kategori_ekstrakurikuler,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_ekstrakurikuler'	=> $slug,
							'nama_kategori_ekstrakurikuler'	=> $this->request->getPost('nama_kategori_ekstrakurikuler'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_ekstrakurikuler'	=> $this->request->getPost('status_kategori_ekstrakurikuler'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_ekstrakurikulerbaru
						];
				$m_kategori_ekstrakurikuler->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_ekstrakurikuler'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_ekstrakurikuler')));
				$data = [	'id_kategori_ekstrakurikuler'		=> $id_kategori_ekstrakurikuler,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_ekstrakurikuler'	=> $slug,
							'nama_kategori_ekstrakurikuler'	=> $this->request->getPost('nama_kategori_ekstrakurikuler'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_ekstrakurikuler'	=> $this->request->getPost('status_kategori_ekstrakurikuler'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_ekstrakurikuler->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_ekstrakurikuler'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Ekstrakurikuler: '.$kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler,
						'kategori_ekstrakurikuler'=> $kategori_ekstrakurikuler,
						'content'		=> 'admin/kategori_ekstrakurikuler/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_ekstrakurikuler)
	{
		
		$m_kategori_ekstrakurikuler = new Kategori_ekstrakurikuler_model();
		$data = ['id_kategori_ekstrakurikuler'	=> $id_kategori_ekstrakurikuler];
		$m_kategori_ekstrakurikuler->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_ekstrakurikuler'));
	}
}