<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenis_dokumen_model;

class Jenis_dokumen extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_jenis_dokumen 	= new Jenis_dokumen_model();
		$jenis_dokumen 	= $m_jenis_dokumen->listing();
		$total 				= $m_jenis_dokumen->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_jenis_dokumen' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_jenis_dokumenbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_jenis_dokumenbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_jenis_dokumenbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_jenis_dokumenbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_jenis_dokumen')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_jenis_dokumen'		=> $slug,
							'nama_jenis_dokumen'		=> $this->request->getPost('nama_jenis_dokumen'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_jenis_dokumen'		=> $this->request->getPost('status_jenis_dokumen'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_jenis_dokumenbaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_jenis_dokumen->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/jenis_dokumen'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_jenis_dokumen')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_jenis_dokumen'		=> $slug,
							'nama_jenis_dokumen'		=> $this->request->getPost('nama_jenis_dokumen'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_jenis_dokumen'		=> $this->request->getPost('status_jenis_dokumen'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_jenis_dokumen->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/jenis_dokumen'));
			}
	    }else{
			$data = [	'title'				=> 'Data Jenis Dokumen Pendaftaran: '.$total->total,
						'jenis_dokumen'	=> $jenis_dokumen,
						'm_jenis_dokumen'	=> $m_jenis_dokumen,
						'content'			=> 'admin/jenis_dokumen/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_jenis_dokumen)
	{
		
		$m_jenis_dokumen 	= new Jenis_dokumen_model();
		$jenis_dokumen 	= $m_jenis_dokumen->detail($id_jenis_dokumen);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_jenis_dokumen' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_jenis_dokumenbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_jenis_dokumenbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_jenis_dokumenbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_jenis_dokumenbaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_jenis_dokumen')));
				$data = [	'id_jenis_dokumen'		=> $id_jenis_dokumen,
							'id_user'				=> $this->session->get('id_user'),
							'slug_jenis_dokumen'	=> $slug,
							'nama_jenis_dokumen'	=> $this->request->getPost('nama_jenis_dokumen'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_jenis_dokumen'	=> $this->request->getPost('status_jenis_dokumen'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_jenis_dokumenbaru
						];
				$m_jenis_dokumen->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/jenis_dokumen'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_jenis_dokumen')));
				$data = [	'id_jenis_dokumen'		=> $id_jenis_dokumen,
							'id_user'				=> $this->session->get('id_user'),
							'slug_jenis_dokumen'	=> $slug,
							'nama_jenis_dokumen'	=> $this->request->getPost('nama_jenis_dokumen'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_jenis_dokumen'	=> $this->request->getPost('status_jenis_dokumen'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_jenis_dokumen->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/jenis_dokumen'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Jenis Dokumen Pendaftaran: '.$jenis_dokumen->nama_jenis_dokumen,
						'jenis_dokumen'=> $jenis_dokumen,
						'content'		=> 'admin/jenis_dokumen/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_jenis_dokumen)
	{
		
		$m_jenis_dokumen = new Jenis_dokumen_model();
		$data = ['id_jenis_dokumen'	=> $id_jenis_dokumen];
		$m_jenis_dokumen->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/jenis_dokumen'));
	}
}