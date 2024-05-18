<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_cabang_model;

class Kategori_cabang extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$kategori_cabang 	= $m_kategori_cabang->listing();
		$total 				= $m_kategori_cabang->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_cabang' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_cabangbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_cabangbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_cabangbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_cabangbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_cabang')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_cabang'		=> $slug,
							'nama_kategori_cabang'		=> $this->request->getPost('nama_kategori_cabang'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_cabang'		=> $this->request->getPost('status_kategori_cabang'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_cabangbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_cabang->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_cabang'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_cabang')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_cabang'		=> $slug,
							'nama_kategori_cabang'		=> $this->request->getPost('nama_kategori_cabang'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_cabang'		=> $this->request->getPost('status_kategori_cabang'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_cabang->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_cabang'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Cabang: '.$total->total,
						'kategori_cabang'	=> $kategori_cabang,
						'm_kategori_cabang'	=> $m_kategori_cabang,
						'content'			=> 'admin/kategori_cabang/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_cabang)
	{
		
		$m_kategori_cabang 	= new Kategori_cabang_model();
		$kategori_cabang 	= $m_kategori_cabang->detail($id_kategori_cabang);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_cabang' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_cabangbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_cabangbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_cabangbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_cabangbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_cabang')));
				$data = [	'id_kategori_cabang'		=> $id_kategori_cabang,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_cabang'	=> $slug,
							'nama_kategori_cabang'	=> $this->request->getPost('nama_kategori_cabang'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_cabang'	=> $this->request->getPost('status_kategori_cabang'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_cabangbaru
						];
				$m_kategori_cabang->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_cabang'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_cabang')));
				$data = [	'id_kategori_cabang'		=> $id_kategori_cabang,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_cabang'	=> $slug,
							'nama_kategori_cabang'	=> $this->request->getPost('nama_kategori_cabang'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_cabang'	=> $this->request->getPost('status_kategori_cabang'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_cabang->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_cabang'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Cabang: '.$kategori_cabang->nama_kategori_cabang,
						'kategori_cabang'=> $kategori_cabang,
						'content'		=> 'admin/kategori_cabang/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_cabang)
	{
		
		$m_kategori_cabang = new Kategori_cabang_model();
		$data = ['id_kategori_cabang'	=> $id_kategori_cabang];
		$m_kategori_cabang->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_cabang'));
	}
}