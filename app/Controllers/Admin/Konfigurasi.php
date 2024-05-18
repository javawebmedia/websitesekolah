<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Sekolah_model;

class Konfigurasi extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$id_konfigurasi = $konfigurasi->id_konfigurasi;
		
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'namaweb' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
						'id_user'			=> $this->session->get('id_user'),
						'namaweb'			=> $this->request->getPost('namaweb'),
						'singkatan'			=> $this->request->getPost('singkatan'),
						'tagline'			=> $this->request->getPost('tagline'),
						'tentang'			=> $this->request->getPost('tentang'),
						'deskripsi'			=> $this->request->getPost('deskripsi'),
						'website'			=> $this->request->getPost('website'),
						'email'				=> $this->request->getPost('email'),
						'email_cadangan'	=> $this->request->getPost('email_cadangan'),
						'alamat'			=> $this->request->getPost('alamat'),
						'telepon'			=> $this->request->getPost('telepon'),
						'whatsapp'			=> $this->request->getPost('whatsapp'),
						'pesan_whatsapp'	=> $this->request->getPost('pesan_whatsapp'),
						'hp'				=> $this->request->getPost('hp'),
						'facebook'			=> $this->request->getPost('facebook'),
						'twitter'			=> $this->request->getPost('twitter'),
						'instagram'			=> $this->request->getPost('instagram'),
						'youtube'			=> $this->request->getPost('youtube'),
						'nama_facebook'		=> $this->request->getPost('nama_facebook'),
						'nama_twitter'		=> $this->request->getPost('nama_twitter'),
						'nama_instagram'	=> $this->request->getPost('nama_instagram'),
						'nama_youtube'		=> $this->request->getPost('nama_youtube'),
						'google_map'		=> $this->request->getPost('google_map'),
						'paginasi'			=> $this->request->getPost('paginasi'),
						'paginasi_depan'	=> $this->request->getPost('paginasi_depan'),
						'fitur_pendaftaran'	=> $this->request->getPost('fitur_pendaftaran'),
						'mulai_pendaftaran'			=> $this->website->tanggal_input($this->request->getPost('mulai_pendaftaran')),
						'selesai_pendaftaran'		=> $this->website->tanggal_input($this->request->getPost('selesai_pendaftaran')),
						'pengumuman_pendaftaran'	=> $this->website->tanggal_input($this->request->getPost('pengumuman_pendaftaran')),
						'keterangan_pendaftaran'	=> $this->request->getPost('keterangan_pendaftaran'),
					];
			$m_konfigurasi->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi'));
	    }else{
			$data = [	'title'			=> 'Konfigurasi Website',
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'admin/konfigurasi/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// email
	public function email()
	{
		
		// $this->simple_login->checkadmin();
		$m_site     = new Konfigurasi_model();
        $site       = $m_site->listing();

        // Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'smtp_user' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			$data = [	'id_konfigurasi'	=> $this->request->getPost('id_konfigurasi'),
						'id_user'			=> $this->session->get('id_user'),
						'protocol'			=> $this->request->getPost('protocol'),
						'smtp_host'			=> $this->request->getPost('smtp_host'),
						'smtp_port'			=> $this->request->getPost('smtp_port'),
						'smtp_timeout'		=> $this->request->getPost('smtp_timeout'),
						'smtp_user'			=> $this->request->getPost('smtp_user'),
						'smtp_pass'			=> $this->request->getPost('smtp_pass'),
					];
			$m_site->edit($data);
			// UPDATE VERSI
			$this->session->setFlashdata('sukses','Konfigurasi email telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi/email'));
	    }else{

			$data = [   'title'     => 'Setting Email',
						'site'      => $site,
						'content'	=> 'admin/konfigurasi/email'
	                ];
	        return view('admin/layout/wrapper',$data);
	    }
	}

	// sekolah
	public function sekolah()
	{
		
		$m_sekolah 		= new Sekolah_model();
		$sekolah 		= $m_sekolah->listing();
		$id_sekolah 	= $sekolah->id_sekolah;
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_sekolah' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			$data = [	'id_sekolah'		=> $sekolah->id_sekolah,
						'id_user'			=> $this->session->get('id_user'),
						'nama_sekolah'		=> $this->request->getPost('nama_sekolah'),
						'nama_sekolah_cover'=> $this->request->getPost('nama_sekolah_cover'),
						'nama_singkat'		=> $this->request->getPost('nama_singkat'),
						'nis'				=> $this->request->getPost('nis'),
						'status_sekolah'	=> $this->request->getPost('status_sekolah'),
						'alamat'			=> $this->request->getPost('alamat'),
						'kelurahan'			=> $this->request->getPost('kelurahan'),
						'kecamatan'			=> $this->request->getPost('kecamatan'),
						'kabupaten'			=> $this->request->getPost('kabupaten'),
						'provinsi'			=> $this->request->getPost('provinsi'),
						'kode_pos'			=> $this->request->getPost('kode_pos'),
						'telepon'			=> $this->request->getPost('telepon'),
						'email'				=> $this->request->getPost('email'),
						'website'			=> $this->request->getPost('website'),
						'luas_tanah'		=> $this->request->getPost('luas_tanah'),
						'luas_bangunan'		=> $this->request->getPost('luas_bangunan'),
						'status_tanah'		=> $this->request->getPost('status_tanah'),
						'imb'				=> $this->request->getPost('imb'),
						'nomor_sertifikat'	=> $this->request->getPost('nomor_sertifikat'),
						'nama_yayasan'		=> $this->request->getPost('nama_yayasan'),
						'tanggal_berdiri'	=> $this->website->tanggal_input($this->request->getPost('tanggal_berdiri')),
						'tahun_berdiri'		=> $this->request->getPost('tahun_berdiri'),
						'nama_kepsek'		=> $this->request->getPost('nama_kepsek'),
						'jumlah_rombel'		=> $this->request->getPost('jumlah_rombel'),
						'jumlah_murid'		=> $this->request->getPost('jumlah_murid'),
						'jumlah_pegawai'	=> $this->request->getPost('jumlah_pegawai'),
						'nilai_akreditasi'	=> $this->request->getPost('nilai_akreditasi'),
						'tahun_akreditasi'	=> $this->request->getPost('tahun_akreditasi'),
						'tanggal_berlaku'	=> $this->website->tanggal_input($this->request->getPost('tanggal_berlaku')),
						'tanggal_kadaluarsa'=> $this->website->tanggal_input($this->request->getPost('tanggal_kadaluarsa')),
						'nomor_izin'		=> $this->request->getPost('nomor_izin'),
						'keterangan'		=> $this->request->getPost('keterangan'),
						'nama_footer'		=> $this->request->getPost('nama_footer'),
						'nama_cover'		=> $this->request->getPost('nama_cover'),
						'kota_cover'		=> $this->request->getPost('kota_cover'),
					];
			$m_sekolah->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi/sekolah'));
	    }else{
			$data = [	'title'		=> 'Informasi Sekolah',
						'sekolah'	=> $sekolah,
						'content'	=> 'admin/konfigurasi/sekolah'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// banner
	public function banner()
	{
		
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$id_konfigurasi = $konfigurasi->id_konfigurasi;
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'id_konfigurasi' 	=> 'required',
				'banner'	 	=> [
					                'ext_in[banner,jpg,jpeg,gif,png,svg]',
					                'max_size[banner,4096]',
            					],
        	])) {
			if(!empty($_FILES['banner']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('banner');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
				// masuk database
				$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'id_user'			=> $this->session->get('id_user'),
							'tentang'			=> $this->request->getPost('tentang'),
							'banner'			=> $namabaru,
							'link_text'			=> $this->request->getPost('link_text'),
							'link_website'		=> $this->request->getPost('link_website'),
							'link_video'		=> $this->request->getPost('link_video'),
							'ringkasan'			=> $this->request->getPost('ringkasan')
						];
				$m_konfigurasi->edit($data);
			}else{
				$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'id_user'			=> $this->session->get('id_user'),
							'tentang'			=> $this->request->getPost('tentang'),
							'link_text'			=> $this->request->getPost('link_text'),
							'link_website'		=> $this->request->getPost('link_website'),
							'link_video'		=> $this->request->getPost('link_video'),
							'ringkasan'			=> $this->request->getPost('ringkasan')
						];
				$m_konfigurasi->edit($data);
			}
			// masuk database
			$this->session->setFlashdata('sukses','About Us dan Banner telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi/banner'));
	    }else{
			$data = [	'title'			=> 'About Us dan Banner',
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'admin/konfigurasi/banner'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// unduh
	public function unduh()
	{
		
		$m_sekolah 		= new Sekolah_model();
		$sekolah 		= $m_sekolah->listing();
		$id_sekolah 	= $sekolah->id_sekolah;

		$data = [	'title'		=> 'Informasi Sekolah',
					'sekolah'	=> $sekolah,
					];
		$mpdf = new \Mpdf\Mpdf([
						'default_font_size' => 11,
						'default_font' => 'nunito-regular'
					]);
		$html = view('admin/konfigurasi/cetak',$data);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		// buka di browser
		$mpdf->Output('Informasi-Sekolah.pdf','I'); 
	}

	// seo
	public function seo()
	{
		
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$id_konfigurasi = $konfigurasi->id_konfigurasi;
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'id_konfigurasi' 	=> 'required',
        	])) {
			// masuk database
			$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
						'id_user'			=> $this->session->get('id_user'),
						'keywords'			=> $this->request->getPost('keywords'),
						'metatext'			=> $this->request->getPost('metatext')
					];
			$m_konfigurasi->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi/seo'));
	    }else{
			$data = [	'title'			=> 'Konfigurasi SEO Website',
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'admin/konfigurasi/seo'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// logo
	public function logo()
	{
		
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$id_konfigurasi = $konfigurasi->id_konfigurasi;
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate([
			'id_konfigurasi' => 'required',
			'logo'	 		=> [
                'uploaded[logo]',
                'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[logo,4096]',
            ],
		])) {
			// Image upload
			$avatar  	= $this->request->getFile('logo');
			$namabaru 	= $avatar->getName();
            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
            // Create thumb
            $image = \Config\Services::image()
		    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
		    ->fit(100, 100, 'center')
		    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
        	// masuk database
			$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
						'id_user'			=> $this->session->get('id_user'),
						'logo'				=> $namabaru
					];
			$m_konfigurasi->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi/logo'));
        }else{
        	// End validasi
			$data = [	'title'			=> 'Update Logo Website',
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'admin/konfigurasi/logo'
					];
			echo view('admin/layout/wrapper',$data);
        }		
	}

	// icon
	public function icon()
	{
		
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$id_konfigurasi = $konfigurasi->id_konfigurasi;
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate([
			'id_konfigurasi' => 'required',
			'icon'	 		=> [
                'uploaded[icon]',
                'mime_in[icon,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[icon,4096]',
            ],
		])) {
			// Image upload
			$avatar  	= $this->request->getFile('icon');
			$namabaru 	= $avatar->getName();
            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
            // Create thumb
            $image = \Config\Services::image()
		    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
		    ->fit(100, 100, 'center')
		    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
        	// masuk database
			$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
						'id_user'			=> $this->session->get('id_user'),
						'icon'				=> $namabaru
					];
			$m_konfigurasi->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diupdate');
			return redirect()->to(base_url('admin/konfigurasi/icon'));
        }else{
        	// End validasi
			$data = [	'title'			=> 'Update Icon Website',
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'admin/konfigurasi/icon'
					];
			echo view('admin/layout/wrapper',$data);
        }		
	}
}