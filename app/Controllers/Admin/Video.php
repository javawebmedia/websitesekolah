<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Video_model;

class Video extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_video 	= new Video_model();
		$video 		= $m_video->listing();
		$total 		= $m_video->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$judulbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$judulbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$judulbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$judulbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('judul')));
				$data = [	'id_user'			=> $this->session->get('id_user'),
							'slug_video'		=> $slug,
							'judul'				=> $this->request->getPost('judul'),
							'keterangan'		=> $this->request->getPost('keterangan'),
							'video'				=> $this->request->getPost('video'),
							'status_video'		=> $this->request->getPost('status_video'),
							'posisi_video'		=> $this->request->getPost('posisi_video'),
							'urutan'			=> $this->request->getPost('urutan'),
							'gambar'			=> $judulbaru,
							'tanggal_post'		=> date('Y-m-d H:i:s')
						];
				$m_video->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/video'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('judul')));
				$data = [	'id_user'			=> $this->session->get('id_user'),
							'slug_video'		=> $slug,
							'judul'				=> $this->request->getPost('judul'),
							'keterangan'		=> $this->request->getPost('keterangan'),
							'video'				=> $this->request->getPost('video'),
							'status_video'		=> $this->request->getPost('status_video'),
							'posisi_video'		=> $this->request->getPost('posisi_video'),
							'urutan'			=> $this->request->getPost('urutan'),
							'tanggal_post'		=> date('Y-m-d H:i:s')
						];
				$m_video->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/video'));
			}
	    }else{
			$data = [	'title'		=> 'Data Video: '.$total->total,
						'video'		=> $video,
						'm_video'	=> $m_video,
						'content'	=> 'admin/video/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_video)
	{
		
		$m_video 	= new Video_model();
		$video 	= $m_video->detail($id_video);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$judulbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$judulbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$judulbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$judulbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('judul')));
				$data = [	'id_video'		=> $id_video,
							'id_user'		=> $this->session->get('id_user'),
							'slug_video'	=> $slug,
							'judul'			=> $this->request->getPost('judul'),
							'keterangan'	=> $this->request->getPost('keterangan'),
							'video'			=> $this->request->getPost('video'),
							'status_video'	=> $this->request->getPost('status_video'),
							'posisi_video'	=> $this->request->getPost('posisi_video'),
							'urutan'		=> $this->request->getPost('urutan'),
							'gambar'		=> $judulbaru
						];
				$m_video->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/video'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('judul')));
				$data = [	'id_video'		=> $id_video,
							'id_user'		=> $this->session->get('id_user'),
							'slug_video'	=> $slug,
							'judul'			=> $this->request->getPost('judul'),
							'keterangan'	=> $this->request->getPost('keterangan'),
							'video'			=> $this->request->getPost('video'),
							'status_video'	=> $this->request->getPost('status_video'),
							'posisi_video'	=> $this->request->getPost('posisi_video'),
							'urutan'		=> $this->request->getPost('urutan'),
						];
				$m_video->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/video'));
			}
	    }else{
			$data = [	'title'		=> 'Edit Video: '.$video->judul,
						'video'		=> $video,
						'content'	=> 'admin/video/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_video)
	{
		
		$m_video = new Video_model();
		$data = ['id_video'	=> $id_video];
		$m_video->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/video'));
	}
}