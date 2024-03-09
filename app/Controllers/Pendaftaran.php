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
use App\Models\Jenis_dokumen_model;
use App\Models\Dokumen_model;


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
		$m_siswa 		= new Siswa_model();
		$siswa 			= $m_siswa->last_id();
		if($siswa) {
			$urutan = $siswa->id_siswa+1;
		}else{
			$urutan = 1;
		}

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_siswa' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {

			if($this->request->getPost('identitas_wali')=='Ayah') {
				$id_agama_wali 		= $this->request->getPost('id_agama_ayah');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_ayah');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_ayah');
				$nama_wali			= $this->request->getPost('nama_ayah');
				$alamat_wali 		= $this->request->getPost('alamat_ayah');
				$telepon_wali		= $this->request->getPost('telepon_ayah');
			}elseif($this->request->getPost('identitas_wali')=='Ibu') {
				$id_agama_wali 		= $this->request->getPost('id_agama_ibu');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_ibu');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_ibu');
				$nama_wali			= $this->request->getPost('nama_ibu');
				$alamat_wali 		= $this->request->getPost('alamat_ibu');
				$telepon_wali		= $this->request->getPost('telepon_ibu');
			}else{
				$id_agama_wali 		= $this->request->getPost('id_agama_wali');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_wali');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_wali');
				$nama_wali			= $this->request->getPost('nama_wali');
				$alamat_wali 		= $this->request->getPost('alamat_wali');
				$telepon_wali		= $this->request->getPost('telepon_wali');
			}
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_siswabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_siswabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_siswabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_siswabaru);
	        	// masuk database
	        	$slug_siswa 	= strtolower(url_title($this->request->getVar('nama_siswa'))).'-'.strtoupper(random_string('alnum', 8));
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'id_agama'				=> $this->request->getPost('id_agama'),
							'id_agama_ayah'			=> $this->request->getPost('id_agama_ayah'),
							'id_agama_ibu'			=> $this->request->getPost('id_agama_ibu'),
							'id_agama_wali'			=> $id_agama_wali,
							'id_pekerjaan_ayah'		=> $this->request->getPost('id_pekerjaan_ayah'),
							'id_pekerjaan_ibu'		=> $this->request->getPost('id_pekerjaan_ibu'),
							'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
							'id_jenjang_ayah'		=> $this->request->getPost('id_jenjang_ayah'),
							'id_jenjang_ibu'		=> $this->request->getPost('id_jenjang_ibu'),
							'id_jenjang_wali'		=> $id_jenjang_wali,
							'id_tahun'				=> $this->request->getPost('id_tahun'),
							'id_kelas'				=> $this->request->getPost('id_kelas'),
							'id_jenjang'			=> $this->request->getPost('id_jenjang'),
							'id_hubungan'			=> $this->request->getPost('id_hubungan'),
							'id_akun'				=> $akun->id_akun,
							'kode_siswa'			=> strtoupper(random_string('alnum', 8)),
							'slug_siswa'			=> $slug_siswa,
							// 'nis'					=> $this->request->getPost('nis'),
							// 'nisn'					=> $this->request->getPost('nisn'),
							'status_wn'				=> $this->request->getPost('status_wn'),
							'negara_asal'			=> $this->request->getPost('negara_asal'),
							'nama_siswa'			=> $this->request->getPost('nama_siswa'),
							'nama_panggilan'		=> $this->request->getPost('nama_panggilan'),
							'tempat_lahir'			=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'			=> $this->website->tanggal_input($this->request->getPost('tanggal_lahir')),
							'alamat'				=> $this->request->getPost('alamat'),
							'telepon'				=> $this->request->getPost('telepon'),
							'kode_pos'				=> $this->request->getPost('kode_pos'),
							'website'				=> $this->request->getPost('website'),
							'email'					=> $this->request->getPost('email'),
							'jenis_kelamin'			=> $this->request->getPost('jenis_kelamin'),
							'berkebutuhan_khusus'	=> $this->request->getPost('berkebutuhan_khusus'),
							'isi'					=> $this->request->getPost('isi'),
							'nama_ayah'				=> $this->request->getPost('nama_ayah'),
							'nama_ibu'				=> $this->request->getPost('nama_ibu'),
							'nama_wali'				=> $nama_wali,
							'alamat_ayah'			=> $this->request->getPost('alamat_ayah'),
							'alamat_ibu'			=> $this->request->getPost('alamat_ibu'),
							'alamat_wali'			=> $alamat_wali,
							'telepon_ayah'			=> $this->request->getPost('telepon_ayah'),
							'telepon_ibu'			=> $this->request->getPost('telepon_ibu'),
							'telepon_wali'			=> $telepon_wali,
							'goldar_siswa'			=> $this->request->getPost('goldar_siswa'),
							'hobi_siswa'			=> $this->request->getPost('hobi_siswa'),
							'penyakit_siswa'		=> $this->request->getPost('penyakit_siswa'),
							'tinggi'				=> $this->request->getPost('tinggi'),
							'berat'					=> $this->request->getPost('berat'),
							'kelompok'				=> $this->request->getPost('kelompok'),
							'tanggal_masuk'			=> $this->website->tanggal_input($this->request->getPost('tanggal_masuk')),
							'jenis_siswa'			=> $this->request->getPost('jenis_siswa'),
							'asal_sekolah'			=> $this->request->getPost('asal_sekolah'),
							'alamat_sekolah_asal'	=> $this->request->getPost('alamat_sekolah_asal'),
							'dari_kelompok'			=> $this->request->getPost('dari_kelompok'),
							'tanggal_pindah'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pindah')),
							'anak_ke'				=> $this->request->getPost('anak_ke'),
							'jumlah_saudara'		=> $this->request->getPost('jumlah_saudara'),
							'gambar'				=> $nama_siswabaru,
							'status_siswa'			=> 'Menunggu',
							'tanggal_baca'			=> date('Y-m-d H:i:s'),
							'tanggal_post'			=> date('Y-m-d H:i:s')
						];
				$m_siswa->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/siswa'));
			}else{
				// masuk database
				$slug_siswa 	= strtolower(url_title($this->request->getVar('nama_siswa'))).'-'.strtoupper(random_string('alnum', 8));
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'id_agama'				=> $this->request->getPost('id_agama'),
							'id_agama_ayah'			=> $this->request->getPost('id_agama_ayah'),
							'id_agama_ibu'			=> $this->request->getPost('id_agama_ibu'),
							'id_agama_wali'			=> $id_agama_wali,
							'id_pekerjaan_ayah'		=> $this->request->getPost('id_pekerjaan_ayah'),
							'id_pekerjaan_ibu'		=> $this->request->getPost('id_pekerjaan_ibu'),
							'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
							'id_jenjang_ayah'		=> $this->request->getPost('id_jenjang_ayah'),
							'id_jenjang_ibu'		=> $this->request->getPost('id_jenjang_ibu'),
							'id_jenjang_wali'		=> $id_jenjang_wali,
							'id_tahun'				=> $this->request->getPost('id_tahun'),
							'id_kelas'				=> $this->request->getPost('id_kelas'),
							'id_jenjang'			=> $this->request->getPost('id_jenjang'),
							'id_hubungan'			=> $this->request->getPost('id_hubungan'),
							'id_akun'				=> $akun->id_akun,
							'kode_siswa'			=> strtoupper(random_string('alnum', 8)),
							'slug_siswa'			=> $slug_siswa,
							// 'nis'					=> $this->request->getPost('nis'),
							// 'nisn'					=> $this->request->getPost('nisn'),
							'status_wn'				=> $this->request->getPost('status_wn'),
							'negara_asal'			=> $this->request->getPost('negara_asal'),
							'nama_siswa'			=> $this->request->getPost('nama_siswa'),
							'nama_panggilan'		=> $this->request->getPost('nama_panggilan'),
							'tempat_lahir'			=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'			=> $this->website->tanggal_input($this->request->getPost('tanggal_lahir')),
							'alamat'				=> $this->request->getPost('alamat'),
							'telepon'				=> $this->request->getPost('telepon'),
							'kode_pos'				=> $this->request->getPost('kode_pos'),
							'website'				=> $this->request->getPost('website'),
							'email'					=> $this->request->getPost('email'),
							'jenis_kelamin'			=> $this->request->getPost('jenis_kelamin'),
							'berkebutuhan_khusus'	=> $this->request->getPost('berkebutuhan_khusus'),
							'isi'					=> $this->request->getPost('isi'),
							'nama_ayah'				=> $this->request->getPost('nama_ayah'),
							'nama_ibu'				=> $this->request->getPost('nama_ibu'),
							'nama_wali'				=> $nama_wali,
							'alamat_ayah'			=> $this->request->getPost('alamat_ayah'),
							'alamat_ibu'			=> $this->request->getPost('alamat_ibu'),
							'alamat_wali'			=> $alamat_wali,
							'telepon_ayah'			=> $this->request->getPost('telepon_ayah'),
							'telepon_ibu'			=> $this->request->getPost('telepon_ibu'),
							'telepon_wali'			=> $telepon_wali,
							'goldar_siswa'			=> $this->request->getPost('goldar_siswa'),
							'hobi_siswa'			=> $this->request->getPost('hobi_siswa'),
							'penyakit_siswa'		=> $this->request->getPost('penyakit_siswa'),
							'tinggi'				=> $this->request->getPost('tinggi'),
							'berat'					=> $this->request->getPost('berat'),
							'kelompok'				=> $this->request->getPost('kelompok'),
							'tanggal_masuk'			=> $this->website->tanggal_input($this->request->getPost('tanggal_masuk')),
							'jenis_siswa'			=> $this->request->getPost('jenis_siswa'),
							'asal_sekolah'			=> $this->request->getPost('asal_sekolah'),
							'alamat_sekolah_asal'	=> $this->request->getPost('alamat_sekolah_asal'),
							'dari_kelompok'			=> $this->request->getPost('dari_kelompok'),
							'tanggal_pindah'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pindah')),
							'anak_ke'				=> $this->request->getPost('anak_ke'),
							'jumlah_saudara'		=> $this->request->getPost('jumlah_saudara'),
							// 'gambar'				=> $nama_siswabaru,
							'status_siswa'			=> 'Menunggu',
							'tanggal_baca'			=> date('Y-m-d H:i:s'),
							'tanggal_post'			=> date('Y-m-d H:i:s')
						];
				// masuk database
				$m_siswa->tambah($data);
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('pendaftaran/dokumen/'.$slug_siswa));
			}
	    }else{

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

	// dokumen
	public function dokumen($slug_siswa)
	{
		$m_konfigurasi 		= new Konfigurasi_model();
		$m_akun 			= new Akun_model();
		$m_jenis_dokumen 	= new Jenis_dokumen_model();
		$m_siswa 			= new Siswa_model();
		$m_dokumen 			= new Dokumen_model();

		$konfigurasi 		= $m_konfigurasi->listing();
		$siswa 				= $m_siswa->read($slug_siswa);
		$jenis_dokumen 		= $m_jenis_dokumen->listing();
		$akun 				= $m_akun->detail($siswa->id_akun);

		// Start tambah
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'id_jenis_dokumen' => 'required',
				'gambar'	 	=> [
									'uploaded[gambar]',
					                'ext_in[gambar,jpg,jpeg,png,gif,zip,rar,doc,docx,xls,xlsx,ppt,pptx,pdf]',
					                'max_size[gambar,24096]',
            					],
        	])) {
			// Image upload
			$avatar  	= $this->request->getFile('gambar');
			$namabaru 	= $avatar->getRandomName();
			$file_ext 	= $avatar->guessExtension();
			$file_size 	= $avatar->getSizeByUnit('mb');
            $avatar->move(WRITEPATH . '../assets/upload/pendaftaran/',$namabaru);
        	// masuk database
		    $data = array(
        		'id_akun'				=> $akun->id_akun,
				'id_siswa'				=> $siswa->id_siswa,
				'id_jenis_dokumen'		=> $this->request->getVar('id_jenis_dokumen'),
				'kode_dokumen'			=> strtoupper(random_string('alnum', 32)),
				'gambar' 				=> $namabaru,
				'file_ext' 				=> $file_ext,
				'file_size' 			=> $file_size,
				'status_dokumen'		=> 'Menunggu',
				'tanggal_post'			=> date('Y-m-d H:i:s')
        	);
        	$m_dokumen->tambah($data);
    		return redirect()->to(base_url('pendaftaran/dokumen/'.$slug_siswa))->with('sukses', 'Data Berhasil di Simpan');
		}else{

			$data = [	'title'				=> 'Pendaftaran Peserta Didik Baru - Unggah Dokumen',
						'description'		=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
						'keywords'			=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
						'konfigurasi'		=> $konfigurasi,
						'akun'				=> $akun,
						'jenis_dokumen'		=> $jenis_dokumen,
						'siswa'				=> $siswa,
						'm_dokumen'			=> $m_dokumen,
						'content'			=> 'pendaftaran/dokumen'
					];
			echo view('layout/wrapper',$data);
		}
	}

	// selesai
	public function selesai($slug_siswa)
	{
		$m_konfigurasi 		= new Konfigurasi_model();
		$m_akun 			= new Akun_model();
		$m_jenis_dokumen 	= new Jenis_dokumen_model();
		$m_siswa 			= new Siswa_model();
		$m_dokumen 			= new Dokumen_model();

		$konfigurasi 		= $m_konfigurasi->listing();
		$siswa 				= $m_siswa->read($slug_siswa);
		$jenis_dokumen 		= $m_jenis_dokumen->listing();
		$akun 				= $m_akun->detail($siswa->id_akun);

		$data = [	'title'				=> 'Pendaftaran Peserta Didik Baru - Pendaftaran Berhasil',
					'description'		=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'			=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'konfigurasi'		=> $konfigurasi,
					'akun'				=> $akun,
					'jenis_dokumen'		=> $jenis_dokumen,
					'siswa'				=> $siswa,
					'm_dokumen'			=> $m_dokumen,
					'content'			=> 'pendaftaran/selesai'
				];
		echo view('layout/wrapper',$data);
	}

	// cetak
	public function cetak($slug_siswa)
	{
		$m_konfigurasi 		= new Konfigurasi_model();
		$m_akun 			= new Akun_model();
		$m_jenis_dokumen 	= new Jenis_dokumen_model();
		$m_siswa 			= new Siswa_model();
		$m_dokumen 			= new Dokumen_model();

		$konfigurasi 		= $m_konfigurasi->listing();
		$siswa 				= $m_siswa->read($slug_siswa);
		$jenis_dokumen 		= $m_jenis_dokumen->listing();
		$akun 				= $m_akun->detail($siswa->id_akun);

		$data = [	'title'				=> 'Pendaftaran Peserta Didik Baru - Pendaftaran Berhasil',
					'description'		=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->tentang,
					'keywords'			=> 'Pendaftaran Peserta Didik Baru '.$konfigurasi->namaweb.', '.$konfigurasi->keywords,
					'konfigurasi'		=> $konfigurasi,
					'akun'				=> $akun,
					'jenis_dokumen'		=> $jenis_dokumen,
					'siswa'				=> $siswa,
					'm_dokumen'			=> $m_dokumen,
					'content'			=> 'pendaftaran/selesai'
				];
		// echo view('layout/wrapper',$data);
		$mpdf = new \Mpdf\Mpdf([
						'default_font_size' => 11,
						'default_font' => 'nunito-regular'
					]);
		$html = view('pendaftaran/cetak',$data);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		// buka di browser
		$mpdf->Output('Informasi-Pendaftaran-'.$siswa->nama_siswa.'.pdf','I'); 
	}

	// Unduh
	public function unduh($kode_dokumen,$kode_siswa)
	{
		$m_dokumen 			= new Dokumen_model();
		$dokumen 			= $m_dokumen->kode_dokumen($kode_dokumen);
		if(!file_exists('../assets/upload/pendaftaran/'.$dokumen->gambar)) {
			$this->session->setFlashdata('warning','Mohon maaf, file tidak ditemukan.');
			return redirect()->to(base_url('pendaftaran/dokumen/'.$kode_siswa));
		}else{
			return $this->response->download('../assets/upload/pendaftaran/'.$dokumen->gambar, null);
		}
	}

	// hapus
	public function hapus($kode_dokumen,$kode_siswa)
	{
		$m_dokumen = new Dokumen_model();
		$data = ['kode_dokumen'	=> $kode_dokumen];
		$m_dokumen->hapus($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('pendaftaran/dokumen/'.$kode_siswa));
	}

}