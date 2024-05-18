<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\User_model;
use App\Models\Staff_model;

class User extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_user 	= new User_model();
		$m_staff 	= new Staff_model();
		$user 		= $m_user->listing();
		$staff 		= $m_staff->listing();
		$total 		= $m_user->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 		=> 'required',
            	'username' 	=> 'required|min_length[3]|is_unique[users.username]',
        	])) {
			// masuk database
			$data = [	'id_staff'		=> $this->request->getPost('id_staff'),
						'nama'			=> $this->request->getPost('nama'),
						'email'			=> $this->request->getPost('email'),
						'username'		=> $this->request->getPost('username'),
						'password'		=> sha1($this->request->getPost('password')),
						'akses_level'	=> $this->request->getPost('akses_level'),
						'tanggal_post'	=> date('Y-m-d H:i:s')
					];
			$m_user->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/user'));
	    }else{
			$data = [	'title'			=> 'Pengguna Website: '.$total->total,
						'user'			=> $user,
						'staff'			=> $staff,
						'content'		=> 'admin/user/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_user)
	{
		
		$m_user = new User_model();
		$user 	= $m_user->detail($id_user);
		$m_staff 	= new Staff_model();
		$staff 		= $m_staff->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			if(strlen($this->request->getPost('password')) >= 6 && strlen($this->request->getPost('password')) <= 32 ) {
				$data = [	'id_user'		=> $id_user,
							'id_staff'		=> $this->request->getPost('id_staff'),
							'nama'			=> $this->request->getPost('nama'),
							'email'			=> $this->request->getPost('email'),
							'username'		=> $this->request->getPost('username'),
							'password'		=> sha1($this->request->getPost('password')),
							'akses_level'	=> $this->request->getPost('akses_level')
					];
			}else{
				$data = [	'id_user'		=> $id_user,
							'id_staff'		=> $this->request->getPost('id_staff'),
							'nama'			=> $this->request->getPost('nama'),
							'email'			=> $this->request->getPost('email'),
							'username'		=> $this->request->getPost('username'),
							'akses_level'	=> $this->request->getPost('akses_level')
					];
			}
			$m_user->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/user'));
	    }else{
			$data = [	'title'			=> 'Edit Pengguna: '.$user->nama,
						'user'			=> $user,
						'staff'			=> $staff,
						'content'		=> 'admin/user/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_user)
	{
		
		$m_user = new User_model();
		$data = ['id_user'	=> $id_user];
		$m_user->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/user'));
	}
}