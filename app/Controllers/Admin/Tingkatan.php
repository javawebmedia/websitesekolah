<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Tingkatan_model;

class Tingkatan extends BaseController
{

	// mainpage
	public function index()
	{
		$this->simple_login->checklogin();
		$m_tingkatan 	= new Tingkatan_model();
		$tingkatan 		= $m_tingkatan->listing();
		$total 			= $m_tingkatan->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_tingkatan' 	=> 'required',
				'gambar'	 		=> [
							                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
							                'max_size[gambar,4096]',
		            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_tingkatanbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_tingkatanbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_tingkatanbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_tingkatanbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_tingkatan')));
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'slug_tingkatan'		=> $slug,
							'jenis_tingkatan'		=> $this->request->getPost('jenis_tingkatan'),
							'nama_tingkatan'		=> $this->request->getPost('nama_tingkatan'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_tingkatan'		=> $this->request->getPost('status_tingkatan'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_tingkatanbaru,
							'tanggal_post'			=> date('Y-m-d H:i:s')
						];
				$m_tingkatan->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/tingkatan'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_tingkatan')));
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'slug_tingkatan'		=> $slug,
							'jenis_tingkatan'		=> $this->request->getPost('jenis_tingkatan'),
							'nama_tingkatan'		=> $this->request->getPost('nama_tingkatan'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_tingkatan'		=> $this->request->getPost('status_tingkatan'),
							'urutan'				=> $this->request->getPost('urutan'),
							'tanggal_post'			=> date('Y-m-d H:i:s')
						];
				$m_tingkatan->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/tingkatan'));
			}
	    }else{
			$data = [	'title'			=> 'Data Tingkatan Pesilat: '.$total->total,
						'tingkatan'		=> $tingkatan,
						'm_tingkatan'	=> $m_tingkatan,
						'content'		=> 'admin/tingkatan/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_tingkatan)
	{
		$this->simple_login->checklogin();
		$m_tingkatan 	= new Tingkatan_model();
		$tingkatan 	= $m_tingkatan->detail($id_tingkatan);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_tingkatan' 	=> 'required',
				'gambar'	 		=> [
							                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
							                'max_size[gambar,4096]',
		            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_tingkatanbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_tingkatanbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_tingkatanbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_tingkatanbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_tingkatan')));
				$data = [	'id_tingkatan'		=> $id_tingkatan,
							'id_user'			=> $this->session->get('id_user'),
							'slug_tingkatan'	=> $slug,
							'jenis_tingkatan'	=> $this->request->getPost('jenis_tingkatan'),
							'nama_tingkatan'	=> $this->request->getPost('nama_tingkatan'),
							'keterangan'		=> $this->request->getPost('keterangan'),
							'status_tingkatan'	=> $this->request->getPost('status_tingkatan'),
							'urutan'			=> $this->request->getPost('urutan'),
							'gambar'			=> $nama_tingkatanbaru
						];
				$m_tingkatan->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/tingkatan'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_tingkatan')));
				$data = [	'id_tingkatan'		=> $id_tingkatan,
							'id_user'			=> $this->session->get('id_user'),
							'slug_tingkatan'	=> $slug,
							'jenis_tingkatan'	=> $this->request->getPost('jenis_tingkatan'),
							'nama_tingkatan'	=> $this->request->getPost('nama_tingkatan'),
							'keterangan'		=> $this->request->getPost('keterangan'),
							'status_tingkatan'	=> $this->request->getPost('status_tingkatan'),
							'urutan'			=> $this->request->getPost('urutan'),
						];
				$m_tingkatan->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/tingkatan'));
			}
	    }else{
			$data = [	'title'		=> 'Edit Tingkatan Pesilat: '.$tingkatan->nama_tingkatan,
						'tingkatan'	=> $tingkatan,
						'content'	=> 'admin/tingkatan/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_tingkatan)
	{
		$this->simple_login->checklogin();
		$m_tingkatan = new Tingkatan_model();
		$data = ['id_tingkatan'	=> $id_tingkatan];
		$m_tingkatan->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/tingkatan'));
	}
}