<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenjang_model;

class Jenjang extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_jenjang = new Jenjang_model();
		$jenjang 	= $m_jenjang->listing();
		$total 	= $m_jenjang->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_jenjang' 	=> 'required|min_length[1]|is_unique[jenjang.nama_jenjang]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'nama_jenjang'	=> $this->request->getPost('nama_jenjang'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
						'status_aktif'	=> $this->request->getPost('status_aktif')
					];
			$m_jenjang->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/jenjang'));
	    }else{
			$data = [	'title'			=> 'Master Jenjang/Kelompok Pendidikan: '.$total->total,
						'jenjang'		=> $jenjang,
						'content'		=> 'admin/jenjang/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_jenjang)
	{
		
		$m_jenjang = new Jenjang_model();
		$jenjang 	= $m_jenjang->detail($id_jenjang);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_jenjang' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_jenjang'	=> $id_jenjang,
						'id_user'		=> $this->session->get('id_user'),
						'nama_jenjang'	=> $this->request->getPost('nama_jenjang'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
						'status_aktif'	=> $this->request->getPost('status_aktif')
				];
			$m_jenjang->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/jenjang'));
	    }else{
			$data = [	'title'			=> 'Edit Jenjang/Kelompok Pendidikan: '.$jenjang->nama_jenjang,
						'jenjang'		=> $jenjang,
						'content'		=> 'admin/jenjang/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_jenjang)
	{
		
		$m_jenjang = new Jenjang_model();
		$data = ['id_jenjang'	=> $id_jenjang];
		$m_jenjang->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/jenjang'));
	}
}