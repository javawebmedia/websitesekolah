<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Konfigurasi_model;
use App\Models\Client_model;
use App\Models\User_model;

class Register extends BaseController
{

	public function __construct()
	{
		helper('form');
	}

	// Homepage
	public function index()
	{
		$session 		= \Config\Services::session();
		if(isset($_GET['redirect'])) {
			$this->session->set('pengalihan',$_GET['redirect']);
		}
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_client 		= new Client_model();
		$konfigurasi 	= $m_konfigurasi->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_client' 				=> [	'rules'  	=> 'required',
								            'errors' 	=> [
								                'required' 	=> 'Nama harus diisi.'
								            ]
								        ],
				'telepon' 			=> [	'rules'  	=> 'required',
								            'errors' 	=> [
								                'required' 	=> 'Telepon/HP harus diisi.'
								            ]
								        ],
            	'email' 			=> [	'rules'		=> 'required|is_unique[client.email]',
            								'errors'	=> [
            									'required' 	=> 'Email harus diisi.',
            									'is_unique'	=> 'Email sudah terdaftar. Gunakan email yang berbeda!'
            								]
            							],
            	'password' 			=> [	'rules'		=> 'required|min_length[6]|max_length[32]',
            								'errors'	=> [
            									'required' 	=> 'Email harus diisi.',
            									'min_length'=> 'Password minimal 6 karakter.',
            									'max_length'=> 'Password minimal 32 karakter.'
            								]
            							],
            	'nama_perusahaan' 	=> [	'rules'  	=> 'required',
								            'errors' 	=> [
								                'required' 	=> 'Nama perguruan/organisasi harus diisi.'
								            ]
								        ]
        	])) {
			// masuk database
			$data = [	'jenis_client'		=> 'Client',
						'nama_client'				=> $this->request->getPost('nama_client'),
						'nama_perusahaan'	=> $this->request->getPost('nama_perusahaan'),
						'telepon'			=> $this->request->getPost('telepon'),
						'email'				=> $this->request->getPost('email'),
						'password'			=> sha1($this->request->getPost('password')),
						'password_hint'		=> $this->request->getPost('password'),
						'tanggal_post'		=> date('Y-m-d H:i:s')
					];
			$m_client->tambah($data);
			// proses login
			$username       = $this->request->getPost('email');
            $password       = $this->request->getPost('password');
            $pengalihan     = $this->request->getPost('pengalihan');
            $this->session->setFlashdata('sukses','Pendaftaran akun berhasil');
            $this->simple_login->login_client($username,$password);
			// masuk database
	    }else{
			$data = [	'title'			=> 'Pembuatan Akun',
						'description'	=> 'Pembuatan Akun '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
						'keywords'		=> 'Pembuatan Akun '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
						'session'		=> $session,
						'content'		=> 'register/index'
					];
			echo view('layout/wrapper-2',$data);
		}
		// End proses
	}
}