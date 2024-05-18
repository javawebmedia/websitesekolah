<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Media_model;

class Media extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_media = new Media_model();
		$media 	= $m_media->listing();
		$total 	= $m_media->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_media' 	=> 'required|min_length[1]|is_unique[media.nama_media]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'nama_media'	=> $this->request->getPost('nama_media'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
						'status_aktif'	=> $this->request->getPost('status_aktif')
					];
			$m_media->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/media'));
	    }else{
			$data = [	'title'			=> 'Master Media/Kelompok Pendidikan: '.$total->total,
						'media'		=> $media,
						'content'		=> 'admin/media/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	public function unggah2()
	{
		echo $_FILES['file']['name'];
	}

	// unggah
	public function unggah()
	{
		
		$m_media 			= new Media_model();

		// Start tambah
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'file'	 	=> [
									'uploaded[file]',
					                'ext_in[file,jpg,jpeg,png,gif,zip,rar,doc,docx,xls,xlsx,ppt,pptx,pdf]',
					                'max_size[file,24096]',
            					],
        	])) {
			if(!empty($_FILES['file']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('file');
				$namabaru 	= $avatar->getRandomName();
				$file_ext 	= $avatar->guessExtension();
				$file_size 	= $avatar->getSizeByUnit('mb');
	            $avatar->move(WRITEPATH . '../assets/upload/file/',$namabaru);
	        	// masuk database
			    $data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'gambar' 				=> $namabaru,
					'file_ext' 				=> $file_ext,
					'file_size' 			=> $file_size,
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_media->tambah($data);
        		echo json_encode($data);
			}
		}
		// end database
	}

	// Show all
	public function show()
	{
		header('Content-Type: application/json');
		$this->simple_login->checklogin();
		$m_media	= new Media_model();
		$data 		= $m_media->all();
		echo json_encode($data);
	}

	// edit
	public function edit($id_media)
	{
		
		$m_media = new Media_model();
		$media 	= $m_media->detail($id_media);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_media' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_media'	=> $id_media,
						'id_user'		=> $this->session->get('id_user'),
						'nama_media'	=> $this->request->getPost('nama_media'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
						'status_aktif'	=> $this->request->getPost('status_aktif')
				];
			$m_media->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/media'));
	    }else{
			$data = [	'title'			=> 'Edit Media/Kelompok Pendidikan: '.$media->nama_media,
						'media'		=> $media,
						'content'		=> 'admin/media/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_media)
	{
		
		$m_media = new Media_model();
		$data = ['id_media'	=> $id_media];
		$m_media->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/media'));
	}
}