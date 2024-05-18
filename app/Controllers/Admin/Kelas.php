<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kelas_model;
use App\Models\Jenjang_model;

class Kelas extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kelas 		= new Kelas_model();
		$m_jenjang 		= new Jenjang_model();
		$jenjang 		= $m_jenjang->listing();
		$kelas 			= $m_kelas->all_jenjang();
		$total 			= $m_kelas->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kelas' 	=> 'required|min_length[1]|is_unique[kelas.nama_kelas]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'id_jenjang'	=> $this->request->getPost('id_jenjang'),
						'nama_kelas'	=> $this->request->getPost('nama_kelas'),
						'status_kelas'	=> $this->request->getPost('status_kelas'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan')
					];
			$m_kelas->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/kelas#jenjang'.$this->request->getPost('id_jenjang')));
	    }else{
			$data = [	'title'		=> 'Master Kelas: '.$total->total,
						'jenjang'	=> $jenjang,
						'kelas'		=> $kelas,
						'm_kelas'	=> $m_kelas,
						'content'	=> 'admin/kelas/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kelas)
	{
		
		$m_kelas 	= new Kelas_model();
		$m_jenjang 	= new Jenjang_model();
		$kelas 		= $m_kelas->detail($id_kelas);
		$jenjang 	= $m_jenjang->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_kelas' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_kelas'		=> $id_kelas,
						'id_user'		=> $this->session->get('id_user'),
						'id_jenjang'	=> $this->request->getPost('id_jenjang'),
						'nama_kelas'	=> $this->request->getPost('nama_kelas'),
						'status_kelas'	=> $this->request->getPost('status_kelas'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan')
				];
			$m_kelas->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/kelas#jenjang'.$this->request->getPost('id_jenjang')));
	    }else{
			$data = [	'title'		=> 'Edit Kelas: '.$kelas->nama_kelas,
						'kelas'		=> $kelas,
						'jenjang'	=> $jenjang,
						'content'	=> 'admin/kelas/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kelas)
	{
		
		$m_kelas = new Kelas_model();
		$data = ['id_kelas'	=> $id_kelas];
		$m_kelas->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kelas'));
	}
}