<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_jurusan_model;

class Kategori_jurusan extends BaseController
{
	// mainpage
	public function index()
	{
		
		$m_kategori_jurusan = new Kategori_jurusan_model();
		$kategori_jurusan 	= $m_kategori_jurusan->listing();
		$total 	= $m_kategori_jurusan->total();

		// Start validasi
		if($this->request->getMethod() === 'POST' && $this->validate(
			[
				'nama_kategori_jurusan' 		=> 'required',
				'gambar'	 		=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  			= $this->request->getFile('gambar');
				$nama_kategori_jurusanbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/kategori_jurusan/',$nama_kategori_jurusanbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/kategori_jurusan/'.$nama_kategori_jurusanbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/kategori_jurusan/thumbs/'.$nama_kategori_jurusanbaru);
	        	// masuk database
	        	// masuk database
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_jurusan'		=> strtolower(url_title($this->request->getVar('nama_kategori_jurusan'))),
							'nama_kategori_jurusan'		=> $this->request->getPost('nama_kategori_jurusan'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_jurusan'	=> $this->request->getPost('status_kategori_jurusan'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_jurusanbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_jurusan->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_jurusan'));
			}else{
				// masuk database
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_jurusan'		=> strtolower(url_title($this->request->getVar('nama_kategori_jurusan'))),
							'nama_kategori_jurusan'		=> $this->request->getPost('nama_kategori_jurusan'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_jurusan'	=> $this->request->getPost('status_kategori_jurusan'),
							'urutan'					=> $this->request->getPost('urutan'),
							// 'gambar'					=> $nama_kategori_jurusanbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_jurusan->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_jurusan'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Jurusan: '.$total['total'],
						'kategori_jurusan'	=> $kategori_jurusan,
						'content'			=> 'admin/kategori_jurusan/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_jurusan)
	{
		
		$m_kategori_jurusan 	= new Kategori_jurusan_model();
		$kategori_jurusan 	= $m_kategori_jurusan->detail($id_kategori_jurusan);

		// Start validasi
		if($this->request->getMethod() === 'POST' && $this->validate(
			[
				'nama_kategori_jurusan' 		=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_jurusanbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/kategori_jurusan/',$nama_kategori_jurusanbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/kategori_jurusan/'.$nama_kategori_jurusanbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/kategori_jurusan/thumbs/'.$nama_kategori_jurusanbaru);
	        	// masuk database
	        	// masuk database
				$data = [	'id_kategori_jurusan'		=> $id_kategori_jurusan,
							'id_user'		=> $this->session->get('id_user'),
							'slug_kategori_jurusan'	=> strtolower(url_title($this->request->getVar('nama_kategori_jurusan'))),
							'nama_kategori_jurusan'	=> $this->request->getPost('nama_kategori_jurusan'),
							'keterangan'	=> $this->request->getPost('keterangan'),
							'status_kategori_jurusan'	=> $this->request->getPost('status_kategori_jurusan'),
							'urutan'		=> $this->request->getPost('urutan'),
							'gambar'		=> $nama_kategori_jurusanbaru
						];
				$m_kategori_jurusan->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_jurusan'));
			}else{
				// masuk database
				$data = [	'id_kategori_jurusan'		=> $id_kategori_jurusan,
							'id_user'		=> $this->session->get('id_user'),
							'slug_kategori_jurusan'	=> strtolower(url_title($this->request->getVar('nama_kategori_jurusan'))),
							'nama_kategori_jurusan'	=> $this->request->getPost('nama_kategori_jurusan'),
							'keterangan'	=> $this->request->getPost('keterangan'),
							'status_kategori_jurusan'	=> $this->request->getPost('status_kategori_jurusan'),
							'urutan'		=> $this->request->getPost('urutan'),
							// 'gambar'		=> $nama_kategori_jurusanbaru,
						];
				$m_kategori_jurusan->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_jurusan'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Data Kategori Jurusan: '.$kategori_jurusan['nama_kategori_jurusan'],
						'kategori_jurusan'		=> $kategori_jurusan,
						'content'		=> 'admin/kategori_jurusan/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_jurusan)
	{
		
		$m_kategori_jurusan = new Kategori_jurusan_model();
		$data = ['id_kategori_jurusan'	=> $id_kategori_jurusan];
		$m_kategori_jurusan->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_jurusan'));
	}
}