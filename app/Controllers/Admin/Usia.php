<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Usia_model;

class Usia extends BaseController
{

	// mainpage
	public function index()
	{
		$this->simple_login->checklogin();
		$m_usia = new Usia_model();
		$usia 	= $m_usia->listing();
		$total 	= $m_usia->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_usia' 	=> 'required|min_length[1]|is_unique[usia.nama_usia]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'nama_usia'		=> $this->request->getPost('nama_usia'),
						'minimal'		=> $this->request->getPost('minimal'),
						'maksimal'		=> $this->request->getPost('maksimal'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
						'status_aktif'	=> $this->request->getPost('status_aktif')
					];
			$m_usia->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/usia'));
	    }else{
			$data = [	'title'			=> 'Master Kelompok Usia: '.$total->total,
						'usia'			=> $usia,
						'content'		=> 'admin/usia/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_usia)
	{
		$this->simple_login->checklogin();
		$m_usia = new Usia_model();
		$usia 	= $m_usia->detail($id_usia);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_usia' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_usia'		=> $id_usia,
						'id_user'		=> $this->session->get('id_user'),
						'nama_usia'		=> $this->request->getPost('nama_usia'),
						'minimal'		=> $this->request->getPost('minimal'),
						'maksimal'		=> $this->request->getPost('maksimal'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
						'status_aktif'	=> $this->request->getPost('status_aktif')
				];
			$m_usia->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/usia'));
	    }else{
			$data = [	'title'			=> 'Edit Kelompok Usia: '.$usia->nama_usia,
						'usia'			=> $usia,
						'content'		=> 'admin/usia/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_usia)
	{
		$this->simple_login->checklogin();
		$m_usia = new Usia_model();
		$data = ['id_usia'	=> $id_usia];
		$m_usia->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/usia'));
	}
}