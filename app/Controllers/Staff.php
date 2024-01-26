<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Staff_model;
use App\Models\Kategori_staff_model;

class Staff extends BaseController
{
	// Staff
	public function index()
	{
		$m_konfigurasi 		= new Konfigurasi_model();
		$m_staff			= new Staff_model();
		$m_kategori_staff	= new Kategori_staff_model();
		$konfigurasi 		= $m_konfigurasi->listing();
		$kategori_staff 	= $m_kategori_staff->listing();

		$data = [	'title'				=> 'Guru, Staff, dan Pimpinan',
					'description'		=> 'Guru, Staff, dan Pimpinan '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'			=> 'Guru, Staff, dan Pimpinan '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'kategori_staff'	=> $kategori_staff,
					'm_staff'			=> $m_staff,
					'konfigurasi'		=> $konfigurasi,
					'content'			=> 'staff/index'
				];
		echo view('layout/wrapper',$data);
	}

	// detail
	public function detail($id_staff,$slug_staff)
	{
		$m_konfigurasi 		= new Konfigurasi_model();
		$m_staff			= new Staff_model();
		$m_kategori_staff	= new Kategori_staff_model();
		$konfigurasi 		= $m_konfigurasi->listing();
		$kategori_staff 	= $m_kategori_staff->listing();
		$staff 				= $m_staff->detail($id_staff);

		$data = [	'title'				=> $staff->nama,
					'description'		=> $staff->nama,
					'keywords'			=> $staff->nama,
					'kategori_staff'	=> $kategori_staff,
					'm_staff'			=> $m_staff,
					'staff'				=> $staff,
					'konfigurasi'		=> $konfigurasi,
					'content'			=> 'staff/detail'
				];
		echo view('layout/wrapper',$data);
	}
}