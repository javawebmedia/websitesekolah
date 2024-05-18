<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\User_model;
use App\Models\Staff_model;
use App\Models\Kategori_staff_model;

class Akun extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_user 			= new User_model();
		$m_staff 			= new Staff_model();
		$m_kategori_staff 	= new Kategori_staff_model();
		$id_user 			= $this->session->get('id_user');
		$user 				= $m_user->detail($id_user);
		$kategori_staff 	= $m_kategori_staff->listing();

		if($user->id_staff >0) {
			$staff 		= $m_staff->detail($user->id_staff);
			$id_staff 	= $user->id_staff;
		}else{
			$staff 		= '';
			$id_staff 	= '';
		}
		

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 		=> 'required',
        	])) {
			// update user
			if(isset($_POST['user'])) {
				if(!empty($_FILES['gambar']['name'])) {
					// Image upload
					$avatar  	= $this->request->getFile('gambar');
					$nama_baru 	= $avatar->getRandomName();
		            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_baru);
		            // Create thumb
		            $image = \Config\Services::image()
				    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_baru)
				    ->fit(100, 100, 'center')
				    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_baru);
		        	// masuk database
				    $data = [	'id_user'		=> $id_user,
								'nama'			=> $this->request->getPost('nama'),
								'email'			=> $this->request->getPost('email'),
								'gambar'		=> $nama_baru,
						];
					$m_user->edit($data);
				}else{
					$data = [	'id_user'		=> $id_user,
								'nama'			=> $this->request->getPost('nama'),
								'email'			=> $this->request->getPost('email'),
						];
					$m_user->edit($data);
				}
				$this->session->setFlashdata('sukses','Data telah diupdate');
				return redirect()->to(base_url('admin/akun#user'));
			}
			// end update user
			// update password
			if(isset($_POST['pwd'])) {
				
				if(strlen($this->request->getPost('password')) < 6 && strlen($this->request->getPost('password')) > 32) {
					$this->session->setFlashdata('warning','Password minimal 6 dan maksimal 32 karakter');
					return redirect()->to(base_url('admin/akun#pwd'));
				}elseif($this->request->getPost('password')!= $this->request->getPost('konfirmasi_password')) {
					$this->session->setFlashdata('warning','Password tidak sama');
					return redirect()->to(base_url('admin/akun#pwd'));
				}else{
					$data = [	'id_user'		=> $id_user,
								'password'		=> sha1($this->request->getPost('password')),
						];
					$m_user->edit($data);
					$this->session->setFlashdata('sukses','Password telah diupdate');
					return redirect()->to(base_url('admin/akun#pwd'));
				}  
			}
			// end update password
			// update user
			if(isset($_POST['staff'])) {
				if(!empty($_FILES['gambar']['name'])) {
					// Image upload
					$avatar  	= $this->request->getFile('gambar');
					$nama_baru 	= $avatar->getRandomName();
		            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_baru);
		            // Create thumb
		            $image = \Config\Services::image()
				    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_baru)
				    ->fit(100, 100, 'center')
				    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_baru);
		        	// masuk database
				    $data = [	'id_staff'		=> $id_staff,
								'id_user'		=> $this->session->get('id_user'),
								'id_kategori_staff'	=> $this->request->getPost('id_kategori_staff'),
								'urutan'		=> $this->request->getPost('urutan'),
								'nama'			=> $this->request->getPost('nama'),
								'jenis_kelamin'	=> $this->request->getPost('jenis_kelamin'),
								'jabatan'		=> $this->request->getPost('jabatan'),
								'alamat'		=> $this->request->getPost('alamat'),
								'telepon'		=> $this->request->getPost('telepon'),
								'website'		=> $this->request->getPost('website'),
								'email'			=> $this->request->getPost('email'),
								'keahlian'		=> $this->request->getPost('keahlian'),
								'gambar'		=> $nama_baru,
								'status_staff'	=> $this->request->getPost('status_staff'),
								'tempat_lahir'	=> $this->request->getPost('tempat_lahir'),
								'tanggal_lahir'	=> date('Y-m-d',strtotime($this->request->getPost('tanggal_lahir'))),
							];
					$m_staff->edit($data);
				}else{
					$data = [	'id_staff'		=> $id_staff,
								'id_user'		=> $this->session->get('id_user'),
								'id_kategori_staff'	=> $this->request->getPost('id_kategori_staff'),
								'urutan'		=> $this->request->getPost('urutan'),
								'nama'			=> $this->request->getPost('nama'),
								'jenis_kelamin'	=> $this->request->getPost('jenis_kelamin'),
								'jabatan'		=> $this->request->getPost('jabatan'),
								'alamat'		=> $this->request->getPost('alamat'),
								'telepon'		=> $this->request->getPost('telepon'),
								'website'		=> $this->request->getPost('website'),
								'email'			=> $this->request->getPost('email'),
								'keahlian'		=> $this->request->getPost('keahlian'),
								// 'gambar'		=> $namabaru,
								'status_staff'	=> $this->request->getPost('status_staff'),
								'tempat_lahir'	=> $this->request->getPost('tempat_lahir'),
								'tanggal_lahir'	=> date('Y-m-d',strtotime($this->request->getPost('tanggal_lahir'))),
							];
					$m_staff->edit($data);
				}
				$this->session->setFlashdata('sukses','Data telah diupdate');
				return redirect()->to(base_url('admin/akun#staff'));
			}
			// end update user
	    }
		$data = [	'title'			=> 'Profil Saya',
					'user'			=> $user,
					'staff'			=> $staff,
					'kategori_staff'=> $kategori_staff,
					'content'		=> 'admin/akun/index'
				];
		echo view('admin/layout/wrapper',$data);
		
	}
}