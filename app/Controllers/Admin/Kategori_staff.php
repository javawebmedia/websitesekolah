<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_staff_model;

class Kategori_staff extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_staff 	= new Kategori_staff_model();
		$kategori_staff 	= $m_kategori_staff->listing();
		$total 				= $m_kategori_staff->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_staff' 	=> 'required',
				'gambar'	 			=> [
								                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_staffbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_staffbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_staffbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_staffbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_staff')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_staff'		=> $slug,
							'nama_kategori_staff'		=> $this->request->getPost('nama_kategori_staff'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_staff'		=> $this->request->getPost('status_kategori_staff'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_staffbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_staff->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_staff'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_staff')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_staff'		=> $slug,
							'nama_kategori_staff'		=> $this->request->getPost('nama_kategori_staff'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_staff'		=> $this->request->getPost('status_kategori_staff'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_staff->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_staff'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Staff: '.$total->total,
						'kategori_staff'	=> $kategori_staff,
						'm_kategori_staff'	=> $m_kategori_staff,
						'content'			=> 'admin/kategori_staff/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_staff)
	{
		
		$m_kategori_staff 	= new Kategori_staff_model();
		$kategori_staff 	= $m_kategori_staff->detail($id_kategori_staff);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_staff' 	=> 'required',
				'gambar'	 			=> [
								                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_staffbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_staffbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_staffbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_staffbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_staff')));
				$data = [	'id_kategori_staff'		=> $id_kategori_staff,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_staff'	=> $slug,
							'nama_kategori_staff'	=> $this->request->getPost('nama_kategori_staff'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_staff'	=> $this->request->getPost('status_kategori_staff'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_staffbaru
						];
				$m_kategori_staff->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_staff'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_staff')));
				$data = [	'id_kategori_staff'		=> $id_kategori_staff,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_staff'	=> $slug,
							'nama_kategori_staff'	=> $this->request->getPost('nama_kategori_staff'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_staff'	=> $this->request->getPost('status_kategori_staff'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_staff->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_staff'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Staff: '.$kategori_staff->nama_kategori_staff,
						'kategori_staff'=> $kategori_staff,
						'content'		=> 'admin/kategori_staff/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_staff)
	{
		
		$m_kategori_staff = new Kategori_staff_model();
		$data = ['id_kategori_staff'	=> $id_kategori_staff];
		$m_kategori_staff->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_staff'));
	}
}