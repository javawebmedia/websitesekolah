<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Tahun_model;

class Tahun extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_tahun = new Tahun_model();
		$tahun 	= $m_tahun->listing();
		$total 	= $m_tahun->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_tahun' 	=> 'required|min_length[1]|is_unique[tahun.nama_tahun]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'nama_tahun'	=> $this->request->getPost('nama_tahun'),
						'tahun_mulai'	=> $this->request->getPost('tahun_mulai'),
						'tahun_selesai'	=> $this->request->getPost('tahun_selesai'),
						'keterangan'	=> $this->request->getPost('keterangan')
					];
			$m_tahun->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/tahun'));
	    }else{
			$data = [	'title'		=> 'Master Tahun Ajaran: '.$total->total,
						'tahun'		=> $tahun,
						'content'	=> 'admin/tahun/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_tahun)
	{
		
		$m_tahun = new Tahun_model();
		$tahun 	= $m_tahun->detail($id_tahun);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_tahun' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_tahun'		=> $id_tahun,
						'id_user'		=> $this->session->get('id_user'),
						'nama_tahun'	=> $this->request->getPost('nama_tahun'),
						'tahun_mulai'	=> $this->request->getPost('tahun_mulai'),
						'tahun_selesai'	=> $this->request->getPost('tahun_selesai'),
						'keterangan'	=> $this->request->getPost('keterangan')
				];
			$m_tahun->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/tahun'));
	    }else{
			$data = [	'title'		=> 'Edit Tahun Ajaran: '.$tahun->nama_tahun,
						'tahun'		=> $tahun,
						'content'	=> 'admin/tahun/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_tahun)
	{
		
		$m_tahun = new Tahun_model();
		$data = ['id_tahun'	=> $id_tahun];
		$m_tahun->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/tahun'));
	}
}