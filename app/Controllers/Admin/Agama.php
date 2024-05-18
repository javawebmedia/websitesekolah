<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Agama_model;

class Agama extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_agama = new Agama_model();
		$agama 	= $m_agama->listing();
		$total 	= $m_agama->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_agama' 	=> 'required|min_length[3]|is_unique[agama.nama_agama]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'nama_agama'	=> $this->request->getPost('nama_agama'),
						'urutan'		=> $this->request->getPost('urutan'),
					];
			$m_agama->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/agama'));
	    }else{
			$data = [	'title'			=> 'Master Agama: '.$total->total,
						'agama'			=> $agama,
						'content'		=> 'admin/agama/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_agama)
	{
		
		$m_agama = new Agama_model();
		$agama 	= $m_agama->detail($id_agama);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_agama' 	=> 'required|min_length[3]',
        	])) {
			
			$data = [	'id_agama'		=> $id_agama,
						'id_user'		=> $this->session->get('id_user'),
						'nama_agama'	=> $this->request->getPost('nama_agama'),
						'urutan'		=> $this->request->getPost('urutan'),
				];
			$m_agama->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/agama'));
	    }else{
			$data = [	'title'			=> 'Edit Agama: '.$agama->nama_agama,
						'agama'			=> $agama,
						'content'		=> 'admin/agama/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_agama)
	{
		
		$m_agama = new Agama_model();
		$data = ['id_agama'	=> $id_agama];
		$m_agama->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/agama'));
	}
}