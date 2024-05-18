<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Hubungan_model;

class Hubungan extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_hubungan = new Hubungan_model();
		$hubungan 	= $m_hubungan->listing();
		$total 	= $m_hubungan->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_hubungan' 	=> 'required|min_length[1]|is_unique[hubungan.nama_hubungan]',
        	])) {
			// masuk database
			$data = [	'id_user'		=> $this->session->get('id_user'),
						'nama_hubungan'	=> $this->request->getPost('nama_hubungan'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
					];
			$m_hubungan->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/hubungan'));
	    }else{
			$data = [	'title'			=> 'Master Hubungan Keluarga: '.$total->total,
						'hubungan'		=> $hubungan,
						'content'		=> 'admin/hubungan/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_hubungan)
	{
		
		$m_hubungan = new Hubungan_model();
		$hubungan 	= $m_hubungan->detail($id_hubungan);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_hubungan' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_hubungan'	=> $id_hubungan,
						'id_user'		=> $this->session->get('id_user'),
						'nama_hubungan'	=> $this->request->getPost('nama_hubungan'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan'),
				];
			$m_hubungan->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/hubungan'));
	    }else{
			$data = [	'title'			=> 'Edit Hubungan Keluarga: '.$hubungan->nama_hubungan,
						'hubungan'		=> $hubungan,
						'content'		=> 'admin/hubungan/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_hubungan)
	{
		
		$m_hubungan = new Hubungan_model();
		$data = ['id_hubungan'	=> $id_hubungan];
		$m_hubungan->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/hubungan'));
	}
}