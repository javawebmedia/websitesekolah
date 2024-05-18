<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Pekerjaan_model;

class Pekerjaan extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_pekerjaan = new Pekerjaan_model();
		$pekerjaan 	= $m_pekerjaan->listing();
		$total 	= $m_pekerjaan->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_pekerjaan' 	=> 'required|min_length[3]|is_unique[pekerjaan.nama_pekerjaan]',
        	])) {
			// masuk database
			$data = [	'id_user'			=> $this->session->get('id_user'),
						'nama_pekerjaan'	=> $this->request->getPost('nama_pekerjaan'),
						'urutan'			=> $this->request->getPost('urutan'),
					];
			$m_pekerjaan->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/pekerjaan'));
	    }else{
			$data = [	'title'			=> 'Master Pekerjaan: '.$total->total,
						'pekerjaan'		=> $pekerjaan,
						'content'		=> 'admin/pekerjaan/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_pekerjaan)
	{
		
		$m_pekerjaan = new Pekerjaan_model();
		$pekerjaan 	= $m_pekerjaan->detail($id_pekerjaan);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_pekerjaan' 	=> 'required|min_length[3]',
        	])) {
			
			$data = [	'id_pekerjaan'		=> $id_pekerjaan,
						'id_user'			=> $this->session->get('id_user'),
						'nama_pekerjaan'	=> $this->request->getPost('nama_pekerjaan'),
						'urutan'			=> $this->request->getPost('urutan'),
				];
			$m_pekerjaan->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/pekerjaan'));
	    }else{
			$data = [	'title'			=> 'Edit Pekerjaan: '.$pekerjaan->nama_pekerjaan,
						'pekerjaan'		=> $pekerjaan,
						'content'		=> 'admin/pekerjaan/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_pekerjaan)
	{
		
		$m_pekerjaan = new Pekerjaan_model();
		$data = ['id_pekerjaan'	=> $id_pekerjaan];
		$m_pekerjaan->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/pekerjaan'));
	}
}