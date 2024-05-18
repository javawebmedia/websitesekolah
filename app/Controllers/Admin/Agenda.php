<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Agenda_model;
use App\Models\Kategori_agenda_model;
use App\Models\User_model;
use App\Models\Gambar_agenda_model;
use App\Models\Jadwal_model;

class Agenda extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_agenda 			= new Agenda_model();
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$agenda 			= $m_agenda->listing();
		$total 				= $m_agenda->total();
		$kategori_agenda 	= $m_kategori_agenda->listing();

		$data = [	'title'				=> 'Agenda/Even ('.$total.')',
					'agenda'			=> $agenda,
					'kategori_agenda'	=> $kategori_agenda,
					'content'			=> 'admin/agenda/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// index
	public function cari()
	{
		
		$keywords 			= $_GET['keywords'];
		$m_agenda 			= new Agenda_model();
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$agenda 			= $m_agenda->listing_cari($keywords);
		$total 				= $m_agenda->total_cari($keywords);
		$kategori_agenda 	= $m_kategori_agenda->listing();

		$data = [	'title'				=> 'Hasil pencarian: '.$keywords.' ('.$total.')',
					'agenda'			=> $agenda,
					'kategori_agenda'	=> $kategori_agenda,
					'content'			=> 'admin/agenda/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// kategori_agenda
	public function kategori($id_kategori_agenda)
	{
		
		$m_agenda 			= new Agenda_model();
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$kategori_agenda 		= $m_kategori_agenda->listing();
		$kategori_agenda_detail= $m_kategori_agenda->detail($id_kategori_agenda);
		$agenda 				= $m_agenda->kategori_agenda_all($id_kategori_agenda);
		$total 					= $m_agenda->total_kategori_agenda($id_kategori_agenda);

		$data = [	'title'				=> $kategori_agenda_detail['nama_kategori_agenda'].' ('.$total.')',
					'agenda'			=> $agenda,
					'kategori_agenda'	=> $kategori_agenda,
					'content'			=> 'admin/agenda/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jenis_agenda
	public function jenis_agenda($jenis_agenda)
	{
		
		$m_agenda 			= new Agenda_model();
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$agenda 				= $m_agenda->jenis_agenda_all($jenis_agenda);
		$total 					= $m_agenda->total_jenis_agenda($jenis_agenda);

		$data = [	'title'				=> $jenis_agenda.' ('.$total.')',
					'agenda'			=> $agenda,
					'kategori_agenda'	=> $kategori_agenda,
					'content'			=> 'admin/agenda/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// status_agenda
	public function status_agenda($status_agenda)
	{
		
		$m_agenda 			= new Agenda_model();
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$kategori_agenda 		= $m_kategori_agenda->listing();
		$agenda 				= $m_agenda->status_agenda_all($status_agenda);
		$total 					= $m_agenda->total_status_agenda($status_agenda);

		$data = [	'title'				=> $status_agenda.' ('.$total.')',
					'agenda'			=> $agenda,
					'kategori_agenda'	=> $kategori_agenda,
					'content'			=> 'admin/agenda/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// author
	public function author($id_user)
	{
		
		$m_agenda 			= new Agenda_model();
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$m_user 				= new User_model();
		$user 					= $m_user->detail($id_user);
		$agenda 				= $m_agenda->author_all($id_user);
		$total 					= $m_agenda->total_author($id_user);

		$data = [	'title'			=> $user['nama'].' ('.$total.')',
					'agenda'		=> $agenda,
					'content'		=> 'admin/agenda/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$m_agenda 			= new Agenda_model();
		$kategori_agenda 	= $m_kategori_agenda->listing();


		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_agenda' 	=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_agenda'	=> $this->request->getVar('id_kategori_agenda'),
					'slug_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))).'-'.strtolower(url_title($this->request->getVar('nama_agenda'))),
					'kode_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))),
    				'nama_agenda'			=> $this->request->getVar('nama_agenda'),
    				'isi'					=> $this->request->getVar('isi'),
    				'status_agenda'			=> $this->request->getVar('status_agenda'),
    				'status_pendaftaran'	=> $this->request->getVar('status_pendaftaran'),
    				'urutan'				=> $this->request->getVar('urutan'),
    				'deskripsi'				=> $this->request->getVar('deskripsi'),
    				'gambar' 				=> $namabaru,
    				'keywords'				=> $this->request->getVar('keywords'),
    				'harga'					=> $this->request->getVar('harga'),
    				'harga_diskon'			=> $this->request->getVar('harga_diskon'),
    				'tanggal_mulai'			=> $this->website->tanggal_input($this->request->getVar('tanggal_mulai')),
    				'tanggal_selesai'		=> $this->website->tanggal_input($this->request->getVar('tanggal_selesai')),
    				'jam_mulai'				=> $this->request->getVar('jam_mulai'),
    				'jam_selesai'			=> $this->request->getVar('jam_selesai'),
    				'tanggal_buka'			=> $this->website->tanggal_input($this->request->getVar('tanggal_buka')),
    				'tanggal_tutup'			=> $this->website->tanggal_input($this->request->getVar('tanggal_tutup')),
    				'nama_tempat'			=> $this->request->getVar('nama_tempat'),
    				'google_map'			=> $this->request->getVar('google_map'),
    				'link_google_map'		=> $this->request->getVar('link_google_map'),
    				'alamat'				=> $this->request->getVar('alamat'),
    				'hotel'					=> $this->request->getVar('hotel'),
    				'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_agenda->tambah($data);
	        	return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_agenda'	=> $this->request->getVar('id_kategori_agenda'),
					'slug_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))).'-'.strtolower(url_title($this->request->getVar('nama_agenda'))),
					'kode_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))),
    				'nama_agenda'			=> $this->request->getVar('nama_agenda'),
    				'isi'					=> $this->request->getVar('isi'),
    				'status_agenda'			=> $this->request->getVar('status_agenda'),
    				'status_pendaftaran'	=> $this->request->getVar('status_pendaftaran'),
    				'urutan'				=> $this->request->getVar('urutan'),
    				'deskripsi'				=> $this->request->getVar('deskripsi'),
    				// 'gambar' 				=> $namabaru,
    				'keywords'				=> $this->request->getVar('keywords'),
    				'harga'					=> $this->request->getVar('harga'),
    				'harga_diskon'			=> $this->request->getVar('harga_diskon'),
    				'tanggal_mulai'			=> $this->website->tanggal_input($this->request->getVar('tanggal_mulai')),
    				'tanggal_selesai'		=> $this->website->tanggal_input($this->request->getVar('tanggal_selesai')),
    				'jam_mulai'				=> $this->request->getVar('jam_mulai'),
    				'jam_selesai'			=> $this->request->getVar('jam_selesai'),
    				'tanggal_buka'			=> $this->website->tanggal_input($this->request->getVar('tanggal_buka')),
    				'tanggal_tutup'			=> $this->website->tanggal_input($this->request->getVar('tanggal_tutup')),
    				'nama_tempat'			=> $this->request->getVar('nama_tempat'),
    				'google_map'			=> $this->request->getVar('google_map'),
    				'link_google_map'		=> $this->request->getVar('link_google_map'),
    				'alamat'				=> $this->request->getVar('alamat'),
    				'hotel'					=> $this->request->getVar('hotel'),
    				'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_agenda->tambah($data);
	        	return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }


		$data = [	'title'				=> 'Tambah Agenda/Even',
					'kategori_agenda'	=> $kategori_agenda,
					'content'			=> 'admin/agenda/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_agenda)
	{
		
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$m_agenda 			= new Agenda_model();
		$kategori_agenda 	= $m_kategori_agenda->listing();
		$agenda 			= $m_agenda->detail($id_agenda);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_agenda' 	=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_agenda'			=> $id_agenda,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_agenda'	=> $this->request->getVar('id_kategori_agenda'),
					'slug_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))).'-'.strtolower(url_title($this->request->getVar('nama_agenda'))),
					'kode_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))),
    				'nama_agenda'			=> $this->request->getVar('nama_agenda'),
    				'isi'					=> $this->request->getVar('isi'),
    				'status_agenda'			=> $this->request->getVar('status_agenda'),
    				'status_pendaftaran'	=> $this->request->getVar('status_pendaftaran'),
    				'urutan'				=> $this->request->getVar('urutan'),
    				'deskripsi'				=> $this->request->getVar('deskripsi'),
    				'gambar' 				=> $namabaru,
    				'keywords'				=> $this->request->getVar('keywords'),
    				'harga'					=> $this->request->getVar('harga'),
    				'harga_diskon'			=> $this->request->getVar('harga_diskon'),
    				'tanggal_mulai'			=> $this->website->tanggal_input($this->request->getVar('tanggal_mulai')),
    				'tanggal_selesai'		=> $this->website->tanggal_input($this->request->getVar('tanggal_selesai')),
    				'jam_mulai'				=> $this->request->getVar('jam_mulai'),
    				'jam_selesai'			=> $this->request->getVar('jam_selesai'),
    				'tanggal_buka'			=> $this->website->tanggal_input($this->request->getVar('tanggal_buka')),
    				'tanggal_tutup'			=> $this->website->tanggal_input($this->request->getVar('tanggal_tutup')),
    				'nama_tempat'			=> $this->request->getVar('nama_tempat'),
    				'google_map'			=> $this->request->getVar('google_map'),
    				'link_google_map'		=> $this->request->getVar('link_google_map'),
    				'alamat'				=> $this->request->getVar('alamat'),
    				'hotel'					=> $this->request->getVar('hotel'),
	        	);
	        	$m_agenda->edit($data);
       		 	return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_agenda'			=> $id_agenda,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_agenda'	=> $this->request->getVar('id_kategori_agenda'),
					'slug_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))).'-'.strtolower(url_title($this->request->getVar('nama_agenda'))),
					'kode_agenda'			=> strtoupper(str_replace(' ','',$this->request->getVar('kode_agenda'))),
    				'nama_agenda'			=> $this->request->getVar('nama_agenda'),
    				'isi'					=> $this->request->getVar('isi'),
    				'status_agenda'			=> $this->request->getVar('status_agenda'),
    				'status_pendaftaran'	=> $this->request->getVar('status_pendaftaran'),
    				'urutan'				=> $this->request->getVar('urutan'),
    				'deskripsi'				=> $this->request->getVar('deskripsi'),
    				// 'gambar' 				=> $namabaru,
    				'keywords'				=> $this->request->getVar('keywords'),
    				'harga'					=> $this->request->getVar('harga'),
    				'harga_diskon'			=> $this->request->getVar('harga_diskon'),
    				'tanggal_mulai'			=> $this->website->tanggal_input($this->request->getVar('tanggal_mulai')),
    				'tanggal_selesai'		=> $this->website->tanggal_input($this->request->getVar('tanggal_selesai')),
    				'jam_mulai'				=> $this->request->getVar('jam_mulai'),
    				'jam_selesai'			=> $this->request->getVar('jam_selesai'),
    				'tanggal_buka'			=> $this->website->tanggal_input($this->request->getVar('tanggal_buka')),
    				'tanggal_tutup'			=> $this->website->tanggal_input($this->request->getVar('tanggal_tutup')),
    				'nama_tempat'			=> $this->request->getVar('nama_tempat'),
    				'google_map'			=> $this->request->getVar('google_map'),
    				'link_google_map'		=> $this->request->getVar('link_google_map'),
    				'alamat'				=> $this->request->getVar('alamat'),
    				'hotel'					=> $this->request->getVar('hotel'),
	        	);
	        	$m_agenda->edit($data);
       		 	return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'				=> 'Edit Agenda: '.$agenda['nama_agenda'],
					'kategori_agenda'	=> $kategori_agenda,
					'agenda'			=> $agenda,
					'content'			=> 'admin/agenda/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// gambar
	public function gambar($id_agenda)
	{
		
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$m_agenda 			= new Agenda_model();
		$m_gambar_agenda	= new Gambar_agenda_model();
		$kategori_agenda 	= $m_kategori_agenda->listing();
		$agenda 			= $m_agenda->detail($id_agenda);
		$gambar_agenda  	= $m_gambar_agenda->agenda($id_agenda);
		// Start validasi
		if(isset($_POST['simpan'])) {
			if($this->request->getMethod() === 'post' && $this->validate(
				[
					'gambar'	 	=> [
										 'uploaded[gambar]',
						                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
						                'max_size[gambar,4096]',
	            					],
	        	])) {
					// Image upload
					$avatar  	= $this->request->getFile('gambar');
					$namabaru 	= $avatar->getRandomName();
		            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
		            // Create thumb
		            $image = \Config\Services::image()
				    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
				    ->fit(100, 100, 'center')
				    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
		        	// masuk database
		        	$data = array(
		        		'id_agenda'				=> $id_agenda,
		        		'id_user'				=> $this->session->get('id_user'),
	    				'nama_gambar_agenda'	=> $this->request->getVar('nama_gambar_agenda'),
	    				'keterangan'			=> $this->request->getVar('keterangan'),
	    				'gambar' 				=> $namabaru,
	    				'urutan'				=> $this->request->getVar('urutan')
		        	);
		        	$m_gambar_agenda->tambah($data);
	       		 	return redirect()->to(base_url('admin/agenda/gambar/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
		    }
		}elseif(isset($_POST['update'])) {
			if($this->request->getMethod() === 'post' && $this->validate(
				[
					'gambar'	 	=> [
						                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
						                'max_size[gambar,4096]',
	            					],
	        	])) {
				if(!empty($_FILES['gambar']['name'])) {
					// Image upload
					$avatar  	= $this->request->getFile('gambar');
					$namabaru 	= $avatar->getRandomName();
		            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
		            // Create thumb
		            $image = \Config\Services::image()
				    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
				    ->fit(100, 100, 'center')
				    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
		        	// masuk database
		        	$data = array(
		        		'id_gambar_agenda'		=> $this->request->getVar('id_gambar_agenda'),
		        		'id_agenda'				=> $id_agenda,
		        		'id_user'				=> $this->session->get('id_user'),
	    				'nama_gambar_agenda'	=> $this->request->getVar('nama_gambar_agenda'),
	    				'keterangan'			=> $this->request->getVar('keterangan'),
	    				'gambar' 				=> $namabaru,
	    				'urutan'				=> $this->request->getVar('urutan')
		        	);
		        	$m_gambar_agenda->edit($data);
	       		 	return redirect()->to(base_url('admin/agenda/gambar/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
	       		 }else{
	       		 	$data = array(
		        		'id_gambar_agenda'		=> $this->request->getVar('id_gambar_agenda'),
		        		'id_agenda'				=> $id_agenda,
		        		'id_user'				=> $this->session->get('id_user'),
	    				'nama_gambar_agenda'	=> $this->request->getVar('nama_gambar_agenda'),
	    				'keterangan'			=> $this->request->getVar('keterangan'),
	    				'urutan'				=> $this->request->getVar('urutan')
		        	);
		        	$m_gambar_agenda->edit($data);
	       		 	return redirect()->to(base_url('admin/agenda/gambar/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
	       		 }
		    }
		}

		$data = [	'title'				=> 'Gambar Agenda: '.$agenda['nama_agenda'],
					'kategori_agenda'	=> $kategori_agenda,
					'agenda'			=> $agenda,
					'gambar_agenda'		=> $gambar_agenda,
					'content'			=> 'admin/agenda/gambar'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jadwal
	public function jadwal($id_agenda)
	{
		
		$m_kategori_agenda 	= new Kategori_agenda_model();
		$m_agenda 			= new Agenda_model();
		$m_jadwal			= new Jadwal_model();
		$agenda 			= $m_agenda->detail($id_agenda);
		$jadwal  			= $m_jadwal->agenda($id_agenda);
		// Start validasi
		if(isset($_POST['simpan'])) {
			if($this->request->getMethod() === 'post' && $this->validate(
				[
					'nama_jadwal' 	=> 'required',
	        	])) {
		        	$data = array(
		        		'id_agenda'			=> $id_agenda,
		        		'id_user'			=> $this->session->get('id_user'),
	    				'nama_jadwal'		=> $this->request->getVar('nama_jadwal'),
	    				'pembicara'			=> $this->request->getVar('pembicara'),
	    				'peserta'			=> $this->request->getVar('peserta'),
	    				'tanggal_mulai'		=> $this->website->tanggal_input($this->request->getVar('tanggal_mulai')),
	    				'tanggal_selesai'	=> $this->website->tanggal_input($this->request->getVar('tanggal_selesai')),
	    				'jam_mulai'			=> $this->request->getVar('jam_mulai'),
	    				'jam_selesai'		=> $this->request->getVar('jam_selesai'),
	    				'keterangan'		=> $this->request->getVar('keterangan'),
	    				'nama_tempat'		=> $this->request->getVar('nama_tempat'),
	    				'tanggal_post'		=> date('Y-m-d H:i:s')
		        	);
		        	$m_jadwal->tambah($data);
	       		 	return redirect()->to(base_url('admin/agenda/jadwal/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
		    }
		}elseif(isset($_POST['update'])) {
			if($this->request->getMethod() === 'post' && $this->validate(
				[
					'nama_agenda' 	=> 'required',
	        	])) {
				
       		 	$data = array(
	        		'id_jadwal'			=> $this->request->getVar('id_jadwal'),
	        		'id_agenda'			=> $id_agenda,
	        		'id_user'			=> $this->session->get('id_user'),
    				'nama_jadwal'		=> $this->request->getVar('nama_jadwal'),
    				'pembicara'			=> $this->request->getVar('pembicara'),
    				'peserta'			=> $this->request->getVar('peserta'),
    				'tanggal_mulai'		=> $this->website->tanggal_input($this->request->getVar('tanggal_mulai')),
    				'tanggal_selesai'	=> $this->website->tanggal_input($this->request->getVar('tanggal_selesai')),
    				'jam_mulai'			=> $this->request->getVar('jam_mulai'),
    				'jam_selesai'		=> $this->request->getVar('jam_selesai'),
    				'keterangan'		=> $this->request->getVar('keterangan'),
    				'nama_tempat'		=> $this->request->getVar('nama_tempat'),
	        	);
	        	$m_jadwal->edit($data);
       		 	return redirect()->to(base_url('admin/agenda/jadwal/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
		    }
		}

		$data = [	'title'				=> 'Jadwal Agenda: '.$agenda['nama_agenda'],
					'agenda'			=> $agenda,
					'jadwal'			=> $jadwal,
					'content'			=> 'admin/agenda/jadwal'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Lokasi
	public function lokasi($id_agenda)
	{
		
		$m_desa 			= new Desa_model();
		$m_agenda 			= new Agenda_model();
		$m_lokasi_agenda	= new Lokasi_agenda_model();
		$desa 				= $m_desa->listing();
		$agenda 			= $m_agenda->detail($id_agenda);
		$lokasi_agenda  	= $m_lokasi_agenda->agenda($id_agenda);
		// Start validasi
		if(isset($_POST['simpan'])) {
			if($this->request->getMethod() === 'post' && $this->validate(
				[
					'id_desa' 	=> 'required'
	        	])) {
		        	// masuk database
		        	$data = array(
		        		'id_agenda'	=> $id_agenda,
		        		'id_user'	=> $this->session->get('id_user'),
	    				'id_desa'	=> $this->request->getVar('id_desa')
		        	);
		        	$m_lokasi_agenda->tambah($data);
	       		 	return redirect()->to(base_url('admin/agenda/lokasi/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
		    }
		}elseif(isset($_POST['update'])) {
			if($this->request->getMethod() === 'post' && $this->validate(
				[
					'id_desa' 	=> 'required'
	        	])) {
				
       		 	$data = array(
	        		'id_lokasi_agenda'	=> $this->request->getVar('id_lokasi_agenda'),
	        		'id_agenda'			=> $id_agenda,
	        		'id_user'			=> $this->session->get('id_user'),
	        		'id_desa'			=> $this->request->getVar('id_desa')
	        	);
	        	$m_lokasi_agenda->edit($data);
       		 	return redirect()->to(base_url('admin/agenda/lokasi/'.$id_agenda))->with('sukses', 'Data Berhasil di Simpan');
		    }
		}

		$data = [	'title'			=> 'Lokasi Agenda: '.$agenda['nama_agenda'],
					'lokasi_agenda'	=> $lokasi_agenda,
					'agenda'		=> $agenda,
					'desa'			=> $desa,
					'content'		=> 'admin/agenda/lokasi'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Proses
	public function proses()
	{
		$m_agenda 			= new Agenda_model();
		// PROSES HAPUS MULTIPLE
		if(isset($_POST['hapus'])) {
			$id_agendanya		= $this->request->getVar('id_agenda');

   			for($i=0; $i < sizeof($id_agendanya);$i++) {
   				$agenda 	= $m_agenda->detail($id_agendanya[$i]);
				$data = array(	'id_agenda'	=> $id_agendanya[$i]);
   				$this->agenda_model->delete($data);
   			}

   			return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil dihapus');
   		// PROSES SETTING DRAFT
   		}elseif(isset($_POST['draft'])) {
   			$id_agendanya		= $this->request->getVar('id_agenda');

   			for($i=0; $i < sizeof($id_agendanya);$i++) {
   				$agenda 	= $m_agenda->detail($id_agendanya[$i]);
				$data = array(	'id_agenda'		=> $id_agendanya[$i],
								'status_agenda'	=> 'Draft');
   				$m_agenda->edit($data);
   			}

   			return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
   		// PROSES SETTING PUBLISH
   		}elseif(isset($_POST['publish'])) {
   			$id_agendanya		= $this->request->getVar('id_agenda');

   			for($i=0; $i < sizeof($id_agendanya);$i++) {
   				$agenda 	= $m_agenda->detail($id_agendanya[$i]);
				$data = array(	'id_agenda'		=> $id_agendanya[$i],
								'status_agenda'	=> 'Publish');
   				$m_agenda->edit($data);
   			}

   			return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
   		}elseif(isset($_POST['update'])) {
   			$id_agendanya			= $this->request->getVar('id_agenda');
   			$id_kategori_agenda	= $this->request->getVar('id_kategori_agenda');

   			for($i=0; $i < sizeof($id_agendanya);$i++) {
   				$agenda 	= $m_agenda->detail($id_agendanya[$i]);
				$data = array(	'id_agenda'			=> $id_agendanya[$i],
								'id_kategori_agenda'	=> $id_kategori_agenda,
								'status_agenda'		=> 'Publish');
   				$m_agenda->edit($data);
   			}

   			return redirect()->to(base_url('admin/agenda'))->with('sukses', 'Data Berhasil di Simpan');
   		}
	}
	
	// Delete
	public function delete($id_agenda)
	{
		
		$m_agenda = new Agenda_model();
		$data = ['id_agenda'	=> $id_agenda];
		$m_agenda->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/agenda'));
	}

	// Delete
	public function delete_gambar($id_gambar_agenda,$id_agenda)
	{
		
		$m_gambar_agenda = new Gambar_agenda_model();
		$data = ['id_gambar_agenda'	=> $id_gambar_agenda];
		$m_gambar_agenda->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/agenda/gambar/'.$id_agenda));
	}

	// Delete Lokasi
	public function delete_lokasi($id_lokasi_agenda,$id_agenda)
	{
		
		$m_lokasi_agenda = new Lokasi_agenda_model();
		$data = ['id_lokasi_agenda'	=> $id_lokasi_agenda];
		$m_lokasi_agenda->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/agenda/lokasi/'.$id_agenda));
	}
}