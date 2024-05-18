<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_download_model;

class Kategori_download extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_download 	= new Kategori_download_model();
		$kategori_download 	= $m_kategori_download->listing();
		$total 				= $m_kategori_download->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_download' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_downloadbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_downloadbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_downloadbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_downloadbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_download')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_download'		=> $slug,
							'nama_kategori_download'		=> $this->request->getPost('nama_kategori_download'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_download'		=> $this->request->getPost('status_kategori_download'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_downloadbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_download->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_download'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_download')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_download'		=> $slug,
							'nama_kategori_download'		=> $this->request->getPost('nama_kategori_download'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_download'		=> $this->request->getPost('status_kategori_download'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_download->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_download'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Download: '.$total->total,
						'kategori_download'	=> $kategori_download,
						'm_kategori_download'	=> $m_kategori_download,
						'content'			=> 'admin/kategori_download/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_download)
	{
		
		$m_kategori_download 	= new Kategori_download_model();
		$kategori_download 	= $m_kategori_download->detail($id_kategori_download);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_download' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_downloadbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_downloadbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_downloadbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_downloadbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_download')));
				$data = [	'id_kategori_download'		=> $id_kategori_download,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_download'	=> $slug,
							'nama_kategori_download'	=> $this->request->getPost('nama_kategori_download'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_download'	=> $this->request->getPost('status_kategori_download'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_downloadbaru
						];
				$m_kategori_download->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_download'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_download')));
				$data = [	'id_kategori_download'		=> $id_kategori_download,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_download'	=> $slug,
							'nama_kategori_download'	=> $this->request->getPost('nama_kategori_download'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_download'	=> $this->request->getPost('status_kategori_download'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_download->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_download'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Download: '.$kategori_download->nama_kategori_download,
						'kategori_download'=> $kategori_download,
						'content'		=> 'admin/kategori_download/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_download)
	{
		
		$m_kategori_download = new Kategori_download_model();
		$data = ['id_kategori_download'	=> $id_kategori_download];
		$m_kategori_download->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_download'));
	}
}