<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Gelombang_model;

class Gelombang extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_gelombang 	= new Gelombang_model();
		$gelombang 	= $m_gelombang->listing();
		$total 				= $m_gelombang->total();

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
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'tahun_ajaran'				=> $this->request->getPost('tahun_ajaran'),
							'tahun'						=> $this->request->getPost('tahun'),
							'slug'						=> $slug,
							'judul'						=> $this->request->getPost('judul'),
							'isi'						=> $this->request->getPost('isi'),
							'tanggal_buka'				=> $this->website->tanggal_input($this->request->getPost('tanggal_buka')),
							'tanggal_tutup'				=> $this->website->tanggal_input($this->request->getPost('tanggal_tutup')),
							'tanggal_pengumuman'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pengumuman')),
							'status_gelombang'			=> $this->request->getPost('status_gelombang'),
							'gambar'					=> $judulbaru
						];
				$m_gelombang->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/gelombang'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('judul')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'tahun_ajaran'				=> $this->request->getPost('tahun_ajaran'),
							'tahun'						=> $this->request->getPost('tahun'),
							'slug'						=> $slug,
							'judul'						=> $this->request->getPost('judul'),
							'isi'						=> $this->request->getPost('isi'),
							'tanggal_buka'				=> $this->website->tanggal_input($this->request->getPost('tanggal_buka')),
							'tanggal_tutup'				=> $this->website->tanggal_input($this->request->getPost('tanggal_tutup')),
							'tanggal_pengumuman'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pengumuman')),
							'status_gelombang'			=> $this->request->getPost('status_gelombang')
						];
				$m_gelombang->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/gelombang'));
			}
	    }else{
			$data = [	'title'				=> 'Data Periode Pendaftaran PSB: '.$total->total,
						'gelombang'	=> $gelombang,
						'm_gelombang'	=> $m_gelombang,
						'content'			=> 'admin/gelombang/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_gelombang)
	{
		
		$m_gelombang 	= new Gelombang_model();
		$gelombang 	= $m_gelombang->detail($id_gelombang);

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
				$data = [	'id_gelombang'				=> $id_gelombang,
							'id_user'					=> $this->session->get('id_user'),
							'tahun_ajaran'				=> $this->request->getPost('tahun_ajaran'),
							'tahun'						=> $this->request->getPost('tahun'),
							'slug'						=> $slug,
							'judul'						=> $this->request->getPost('judul'),
							'isi'						=> $this->request->getPost('isi'),
							'tanggal_buka'				=> $this->website->tanggal_input($this->request->getPost('tanggal_buka')),
							'tanggal_tutup'				=> $this->website->tanggal_input($this->request->getPost('tanggal_tutup')),
							'tanggal_pengumuman'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pengumuman')),
							'status_gelombang'			=> $this->request->getPost('status_gelombang'),
							'gambar'					=> $judulbaru
						];
				$m_gelombang->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/gelombang'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('judul')));
				$data = [	'id_gelombang'				=> $id_gelombang,
							'id_user'					=> $this->session->get('id_user'),
							'tahun_ajaran'				=> $this->request->getPost('tahun_ajaran'),
							'tahun'						=> $this->request->getPost('tahun'),
							'slug'						=> $slug,
							'judul'						=> $this->request->getPost('judul'),
							'isi'						=> $this->request->getPost('isi'),
							'tanggal_buka'				=> $this->website->tanggal_input($this->request->getPost('tanggal_buka')),
							'tanggal_tutup'				=> $this->website->tanggal_input($this->request->getPost('tanggal_tutup')),
							'tanggal_pengumuman'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pengumuman')),
							'status_gelombang'			=> $this->request->getPost('status_gelombang')
						];
				$m_gelombang->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/gelombang'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Periode Pendaftaran PSB: '.$gelombang->judul,
						'gelombang'=> $gelombang,
						'content'		=> 'admin/gelombang/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_gelombang)
	{
		
		$m_gelombang = new Gelombang_model();
		$data = ['id_gelombang'	=> $id_gelombang];
		$m_gelombang->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/gelombang'));
	}
}