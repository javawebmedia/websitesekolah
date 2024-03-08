<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Galeri_model;
use App\Models\Berita_model;
use App\Models\Siswa_model;
use App\Models\Rombel_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
use App\Models\Jenjang_model;
use App\Models\Pekerjaan_model;
use App\Models\Hubungan_model;
use App\Models\Siswa_rombel_model;
use App\Models\Agama_model;
use App\Models\Akun_model;

class Pendaftaran extends BaseController
{
	// Kontak
	public function index()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$m_akun 		= new Akun_model();
		$kode_akun 		= strtoupper(random_string('alnum', 64));

		// proses
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 						=> 'required',
				'email' 					=> 'required|valid_email|is_unique[akun.email]',
				'alamat' 					=> 'min_length[32]',
				'password' 					=> 'min_length[6]|max_length[32]',
				'telepon'					=> 'required',
				'konfirmasi_password' 		=> 'required|matches[password]',
        	])) {
        		$data = array(
					'jenis_akun'		=> 'Pendaftar',
					'status_akun'		=> 'Menunggu',
					'nama'				=> $this->request->getVar('nama'),
					'email'				=> $this->request->getVar('email'),
					'username'			=> $this->request->getVar('email'),
					'password'			=> sha1($this->request->getVar('password')),
					'password_hint'		=> $this->request->getVar('password'),
					'telepon'			=> $this->request->getVar('telepon'),
					'alamat'			=> $this->request->getVar('alamat'),
					'kode_akun'			=> $kode_akun,
					'tanggal_post'		=> date('Y-m-d H:i:s')
	        	);
	        	$m_akun->tambah($data);
        		return redirect()->to(base_url('pendaftaran/biodata/'.$kode_akun))->with('sukses', 'Data Akun Berhasil Dibuat. Silakan lanjutkan mengisi biodata.');
        }else{
			$data = [	'title'			=> 'Pendaftaran Peserta Didik Baru - Buat Akun',
						'description'	=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
						'keywords'		=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'pendaftaran/index'
					];
			echo view('layout/wrapper',$data);
		}
	}

	// biodata
	public function biodata($kode_akun)
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$m_akun 		= new Akun_model();
		$akun 			= $m_akun->kode_akun($kode_akun);

		$data = [	'title'				=> 'Pendaftaran Peserta Didik Baru - Isi Biodata',
						'description'	=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
						'keywords'		=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
						'konfigurasi'	=> $konfigurasi,
						'akun'			=> $akun,
						'content'		=> 'pendaftaran/biodata'
					];
			echo view('layout/wrapper',$data);
	}

}