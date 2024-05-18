<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_prestasi_model;

class Kategori_prestasi extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_prestasi 	= new Kategori_prestasi_model();
		$kategori_prestasi 	= $m_kategori_prestasi->listing();
		$total 				= $m_kategori_prestasi->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_prestasi' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_prestasibaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_prestasibaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_prestasibaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_prestasibaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_prestasi')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_prestasi'		=> $slug,
							'nama_kategori_prestasi'		=> $this->request->getPost('nama_kategori_prestasi'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_prestasi'		=> $this->request->getPost('status_kategori_prestasi'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_prestasibaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_prestasi->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_prestasi'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_prestasi')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_prestasi'		=> $slug,
							'nama_kategori_prestasi'		=> $this->request->getPost('nama_kategori_prestasi'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_prestasi'		=> $this->request->getPost('status_kategori_prestasi'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_prestasi->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_prestasi'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Prestasi: '.$total->total,
						'kategori_prestasi'	=> $kategori_prestasi,
						'm_kategori_prestasi'	=> $m_kategori_prestasi,
						'content'			=> 'admin/kategori_prestasi/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_prestasi)
	{
		
		$m_kategori_prestasi 	= new Kategori_prestasi_model();
		$kategori_prestasi 	= $m_kategori_prestasi->detail($id_kategori_prestasi);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_prestasi' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_prestasibaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_prestasibaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_prestasibaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_prestasibaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_prestasi')));
				$data = [	'id_kategori_prestasi'		=> $id_kategori_prestasi,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_prestasi'	=> $slug,
							'nama_kategori_prestasi'	=> $this->request->getPost('nama_kategori_prestasi'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_prestasi'	=> $this->request->getPost('status_kategori_prestasi'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_prestasibaru
						];
				$m_kategori_prestasi->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_prestasi'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_prestasi')));
				$data = [	'id_kategori_prestasi'		=> $id_kategori_prestasi,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_prestasi'	=> $slug,
							'nama_kategori_prestasi'	=> $this->request->getPost('nama_kategori_prestasi'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_prestasi'	=> $this->request->getPost('status_kategori_prestasi'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_prestasi->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_prestasi'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Prestasi: '.$kategori_prestasi->nama_kategori_prestasi,
						'kategori_prestasi'=> $kategori_prestasi,
						'content'		=> 'admin/kategori_prestasi/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_prestasi)
	{
		
		$m_kategori_prestasi = new Kategori_prestasi_model();
		$data = ['id_kategori_prestasi'	=> $id_kategori_prestasi];
		$m_kategori_prestasi->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_prestasi'));
	}
}