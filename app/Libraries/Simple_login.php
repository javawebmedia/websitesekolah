<?php 
namespace App\Libraries;
use App\Models\User_model;
use App\Models\Client_model;
use App\Models\Siswa_model;

class Simple_login
{
	// check login
	public function login($username,$password,$pengalihan)
	{
		$this->session  = \Config\Services::session();
		$uri            = service('uri');
		$m_user 		= new User_model();
		$user 			= $m_user->login($username,$password);
		if($user) 
		{
			// Jika username password benar
			$this->session->set('username',$username);
			$this->session->set('id_user',$user->id_user);
			$this->session->set('id_staff',$user->id_staff);
			$this->session->set('nama',$user->nama);
			$this->session->set('akses_level',$user->akses_level);
			// $this->session->setFlashdata('warning', 'Hai '.$user->nama.', Anda berhasil login');
			// return redirect()->to(base_url('admin/dasbor'));
			if($pengalihan!=='') {
				header("Location: ".$pengalihan);
			}else{
				header("Location: admin/dasbor");
			}
			
            exit;
		}else{
			// jika username password salah
			$this->session->setFlashdata('warning','Username atau password salah');
			return redirect()->to(base_url('login'));
		}
	}

	// check login
	public function login_siswa($username,$password)
	{
		$this->session  = \Config\Services::session();
		$uri            = service('uri');
		$m_siswa 		= new Siswa_model();
		$user 			= $m_siswa->login($username,sha1($password));
		$user2 			= $m_siswa->login_nis($username,sha1($password));
		if($user) 
		{
			// Jika username password benar
			$this->session->set('username_siswa',$username);
			$this->session->set('id_siswa',$user->id_siswa);
			$this->session->set('nama_siswa',$user->nama);
			$this->session->set('akses_level','Client');
			header("Location: siswa/dasbor");			
            exit;
        }elseif($user2) {
        	// Jika username password benar
			$this->session->set('username_siswa',$username);
			$this->session->set('id_siswa',$user2->id_siswa);
			$this->session->set('nama_siswa',$user2->nama);
			$this->session->set('akses_level','Client');
			header("Location: siswa/dasbor");			
            exit;
		}else{
			// jika username password salah
			$this->session->setFlashdata('warning','Username atau password salah');
			return redirect()->to(base_url('signin'));
		}
	}

	// check login
	public function checklogin_siswa()
	{
		$this->session  = \Config\Services::session();
		if($this->session->get('username_siswa')=='') 
		{
			$pengalihan = str_replace('index.php/','',current_url());
			$this->session->set('pengalihan',$pengalihan);
			$this->session->setFlashdata('warning','Anda belum login');
			header("Location: ".base_url('signin')).'?redirect='.$pengalihan;
	        exit;
		}
	}

	// check login
	public function login_client($username,$password)
	{
		$this->session  = \Config\Services::session();
		$uri            = service('uri');
		$m_client 		= new Client_model();
		$user 			= $m_client->login($username,$password);
		if($user) 
		{
			// Jika username password benar
			$this->session->set('username_client',$username);
			$this->session->set('id_client',$user->id_client);
			$this->session->set('nama_client',$user->nama);
			$this->session->set('akses_level','Client');
			header("Location: client/dasbor");			
            exit;
		}else{
			// jika username password salah
			$this->session->setFlashdata('warning','Username atau password salah');
			return redirect()->to(base_url('signin'));
		}
	}

	// check login
	public function checklogin()
	{
		$this->session  = \Config\Services::session();
		if($this->session->get('username')=='') 
		{
			$pengalihan = str_replace('index.php/','',current_url());
			$this->session->set('pengalihan',$pengalihan);
			$this->session->setFlashdata('warning','Anda belum login');
			header("Location: ".base_url('login')).'?redirect='.$pengalihan;
	        exit;
		}
	}

	// check login
	public function checklogin_client()
	{
		$this->session  = \Config\Services::session();
		if($this->session->get('username_client')=='') 
		{
			$pengalihan = str_replace('index.php/','',current_url());
			$this->session->set('pengalihan',$pengalihan);
			$this->session->setFlashdata('warning','Anda belum login');
			header("Location: ".base_url('signin')).'?redirect='.$pengalihan;
	        exit;
		}
	}

	// check logout
	public function logout()
	{
		$this->session  = \Config\Services::session();
		$this->session->remove('username');
		$this->session->remove('id_user');
		$this->session->remove('akses_level');
		$this->session->remove('nama');
		$this->session->setFlashdata('sukses','Anda berhasil logout');
		header("Location: ".base_url('login?logout=sukses'));
        exit;
	}
}