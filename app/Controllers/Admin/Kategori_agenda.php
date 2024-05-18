<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_agenda_model;

class Kategori_agenda extends BaseController
{
	// mainpage
	public function index()
	{
		
		$m_kategori_agenda = new Kategori_agenda_model();
		$kategori_agenda 	= $m_kategori_agenda->listing();
		$total 	= $m_kategori_agenda->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_agenda' 		=> 'required',
				'gambar'	 		=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  			= $this->request->getFile('gambar');
				$nama_kategori_agendabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/kategori_agenda/',$nama_kategori_agendabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/kategori_agenda/'.$nama_kategori_agendabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/kategori_agenda/thumbs/'.$nama_kategori_agendabaru);
	        	// masuk database
	        	// masuk database
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_agenda'		=> strtolower(url_title($this->request->getVar('nama_kategori_agenda'))),
							'nama_kategori_agenda'		=> $this->request->getPost('nama_kategori_agenda'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_agenda'	=> $this->request->getPost('status_kategori_agenda'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_agendabaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_agenda->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_agenda'));
			}else{
				// masuk database
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_agenda'		=> strtolower(url_title($this->request->getVar('nama_kategori_agenda'))),
							'nama_kategori_agenda'		=> $this->request->getPost('nama_kategori_agenda'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_agenda'	=> $this->request->getPost('status_kategori_agenda'),
							'urutan'					=> $this->request->getPost('urutan'),
							// 'gambar'					=> $nama_kategori_agendabaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_agenda->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_agenda'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Agenda: '.$total['total'],
						'kategori_agenda'	=> $kategori_agenda,
						'content'			=> 'admin/kategori_agenda/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_agenda)
	{
		
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$kategori_agenda 	= $m_kategori_agenda->detail($id_kategori_agenda);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_agenda' 		=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_agendabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/kategori_agenda/',$nama_kategori_agendabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/kategori_agenda/'.$nama_kategori_agendabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/kategori_agenda/thumbs/'.$nama_kategori_agendabaru);
	        	// masuk database
	        	// masuk database
				$data = [	'id_kategori_agenda'		=> $id_kategori_agenda,
							'id_user'		=> $this->session->get('id_user'),
							'slug_kategori_agenda'	=> strtolower(url_title($this->request->getVar('nama_kategori_agenda'))),
							'nama_kategori_agenda'	=> $this->request->getPost('nama_kategori_agenda'),
							'keterangan'	=> $this->request->getPost('keterangan'),
							'status_kategori_agenda'	=> $this->request->getPost('status_kategori_agenda'),
							'urutan'		=> $this->request->getPost('urutan'),
							'gambar'		=> $nama_kategori_agendabaru
						];
				$m_kategori_agenda->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_agenda'));
			}else{
				// masuk database
				$data = [	'id_kategori_agenda'		=> $id_kategori_agenda,
							'id_user'		=> $this->session->get('id_user'),
							'slug_kategori_agenda'	=> strtolower(url_title($this->request->getVar('nama_kategori_agenda'))),
							'nama_kategori_agenda'	=> $this->request->getPost('nama_kategori_agenda'),
							'keterangan'	=> $this->request->getPost('keterangan'),
							'status_kategori_agenda'	=> $this->request->getPost('status_kategori_agenda'),
							'urutan'		=> $this->request->getPost('urutan'),
							// 'gambar'		=> $nama_kategori_agendabaru,
						];
				$m_kategori_agenda->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_agenda'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Data Kategori Agenda: '.$kategori_agenda['nama_kategori_agenda'],
						'kategori_agenda'		=> $kategori_agenda,
						'content'		=> 'admin/kategori_agenda/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_agenda)
	{
		
		$m_kategori_agenda = new Kategori_agenda_model();
		$data = ['id_kategori_agenda'	=> $id_kategori_agenda];
		$m_kategori_agenda->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_agenda'));
	}
}