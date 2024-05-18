<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_fasilitas_model;

class Kategori_fasilitas extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_fasilitas 	= new Kategori_fasilitas_model();
		$kategori_fasilitas 	= $m_kategori_fasilitas->listing();
		$total 				= $m_kategori_fasilitas->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_fasilitas' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_fasilitasbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_fasilitasbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_fasilitasbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_fasilitasbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_fasilitas')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_fasilitas'		=> $slug,
							'nama_kategori_fasilitas'		=> $this->request->getPost('nama_kategori_fasilitas'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_fasilitas'		=> $this->request->getPost('status_kategori_fasilitas'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_fasilitasbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_fasilitas->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_fasilitas'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_fasilitas')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_fasilitas'		=> $slug,
							'nama_kategori_fasilitas'		=> $this->request->getPost('nama_kategori_fasilitas'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_fasilitas'		=> $this->request->getPost('status_kategori_fasilitas'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_fasilitas->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_fasilitas'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Fasilitas: '.$total->total,
						'kategori_fasilitas'	=> $kategori_fasilitas,
						'm_kategori_fasilitas'	=> $m_kategori_fasilitas,
						'content'			=> 'admin/kategori_fasilitas/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_fasilitas)
	{
		
		$m_kategori_fasilitas 	= new Kategori_fasilitas_model();
		$kategori_fasilitas 	= $m_kategori_fasilitas->detail($id_kategori_fasilitas);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_fasilitas' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_fasilitasbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_fasilitasbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_fasilitasbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_fasilitasbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_fasilitas')));
				$data = [	'id_kategori_fasilitas'		=> $id_kategori_fasilitas,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_fasilitas'	=> $slug,
							'nama_kategori_fasilitas'	=> $this->request->getPost('nama_kategori_fasilitas'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_fasilitas'	=> $this->request->getPost('status_kategori_fasilitas'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_fasilitasbaru
						];
				$m_kategori_fasilitas->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_fasilitas'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_fasilitas')));
				$data = [	'id_kategori_fasilitas'		=> $id_kategori_fasilitas,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_fasilitas'	=> $slug,
							'nama_kategori_fasilitas'	=> $this->request->getPost('nama_kategori_fasilitas'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_fasilitas'	=> $this->request->getPost('status_kategori_fasilitas'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_fasilitas->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_fasilitas'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Fasilitas: '.$kategori_fasilitas->nama_kategori_fasilitas,
						'kategori_fasilitas'=> $kategori_fasilitas,
						'content'		=> 'admin/kategori_fasilitas/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_fasilitas)
	{
		
		$m_kategori_fasilitas = new Kategori_fasilitas_model();
		$data = ['id_kategori_fasilitas'	=> $id_kategori_fasilitas];
		$m_kategori_fasilitas->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_fasilitas'));
	}
}