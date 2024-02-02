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

class Pendaftaran extends BaseController
{
	// Kontak
	public function index()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_galeri		= new Galeri_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$slider 		= $m_galeri->slider();

		$data = [	'title'			=> 'Pendaftaran Peserta Didik Baru',
					'description'	=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'		=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'slider'		=> $slider,
					'konfigurasi'	=> $konfigurasi,
					'content'		=> 'pendaftaran/index'
				];
		echo view('layout/wrapper',$data);
	}

}