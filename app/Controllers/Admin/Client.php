<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Client_model;
use App\Models\Kategori_client_model;

class Client extends BaseController
{
	
	// index
	public function index()
	{
		$this->simple_login->checklogin();
		$m_client 			= new Client_model();
		$m_kategori_client 	= new Kategori_client_model();
		$kategori_client 	= $m_kategori_client->listing();
		$pager 				= service('pager'); 
		// client
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_client->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $client 		= $m_client->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_client->total();
			$title 			= 'Data Client ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $client 		= $m_client->paginasi_admin($perPage, $page);
		}
		// end client

		$data = [	'title'				=> $title,
					'client'			=> $client,
					'kategori_client'	=> $kategori_client,
					'pagination'	=> $pager_links,
					'content'			=> 'admin/client/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		$this->simple_login->checklogin();
		$m_client 			= new Client_model();
		$m_kategori_client 	= new Kategori_client_model();
		$kategori_client 	= $m_kategori_client->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_client' 	=> 'required',
				'gambar'	 	=> [
					                'uploaded[gambar]',
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_clientbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_clientbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_clientbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_clientbaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_client'=> $this->request->getVar('id_kategori_client'),
					'jenis_client'		=> $this->request->getVar('jenis_client'),
					'jenis_kelamin'		=> $this->request->getVar('jenis_kelamin'),
					'nama_client'		=> $this->request->getVar('nama_client'),
					'nama_perusahaan'	=> $this->request->getVar('nama_perusahaan'),
					'pimpinan'			=> $this->request->getVar('pimpinan'),
					'alamat'			=> $this->request->getVar('alamat'),
					'telepon'			=> $this->request->getVar('telepon'),
					'website'			=> $this->request->getVar('website'),
					'email'				=> $this->request->getVar('email'),
					'password'			=> sha1($this->request->getVar('password')),
					'password_hint'		=> $this->request->getVar('password'),
					'isi_testimoni'		=> $this->request->getVar('isi_testimoni'),
					'gambar' 			=> $nama_clientbaru,
					'status_client'		=> $this->request->getVar('status_client'),
					'tempat_lahir'		=> $this->request->getVar('tempat_lahir'),
					'tanggal_lahir'		=> $this->website->tanggal_input($this->request->getVar('tanggal_lahir')),
					'tanggal_post'		=> date('Y-m-d H:i:s')
	        	);
	        	$m_client->tambah($data);
        		return redirect()->to(base_url('admin/client'))->with('sukses', 'Data Berhasil di Simpan');
        	}else{
        		$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_client'=> $this->request->getVar('id_kategori_client'),
					'jenis_client'		=> $this->request->getVar('jenis_client'),
					'jenis_kelamin'		=> $this->request->getVar('jenis_kelamin'),
					'nama_client'		=> $this->request->getVar('nama_client'),
					'nama_perusahaan'	=> $this->request->getVar('nama_perusahaan'),
					'pimpinan'			=> $this->request->getVar('pimpinan'),
					'alamat'			=> $this->request->getVar('alamat'),
					'telepon'			=> $this->request->getVar('telepon'),
					'website'			=> $this->request->getVar('website'),
					'email'				=> $this->request->getVar('email'),
					'password'			=> sha1($this->request->getVar('password')),
					'password_hint'		=> $this->request->getVar('password'),
					'isi_testimoni'		=> $this->request->getVar('isi_testimoni'),
					'status_client'		=> $this->request->getVar('status_client'),
					'tempat_lahir'		=> $this->request->getVar('tempat_lahir'),
					'tanggal_lahir'		=> $this->website->tanggal_input($this->request->getVar('tanggal_lahir')),
					'tanggal_post'		=> date('Y-m-d H:i:s')
	        	);
	        	$m_client->tambah($data);
        		return redirect()->to(base_url('admin/client'))->with('sukses', 'Data Berhasil di Simpan');
        	}
        }

		$data = [	'title'				=> 'Tambah Client',
					'kategori_client'	=> $kategori_client,
					'content'			=> 'admin/client/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		$this->simple_login->checklogin();
		$m_kategori 	= new Kategori_client_model();
		$m_client 		= new Client_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_client 	= $this->request->getVar('id_client');
		// check client
		if(empty($this->request->getVar('id_client')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih client. Pilih salah satu client');
		}
		// end check client
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_client);$i++) {
				$data = array(	'id_client'				=> $id_client[$i],
								'id_user'				=> $this->session->get('id_user'),
								'id_kategori_client'	=> $this->request->getVar('id_kategori_client')
							);
   				$m_client->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Client berhasil diupdate jenis clientnya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_client);$i++) {
				$data = array(	'id_client'		=> $id_client[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_client'	=> 'Publish'
							);
   				$m_client->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Client berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_client);$i++) {
				$data = array(	'id_client'		=> $id_client[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_client'	=> 'Draft'
							);
   				$m_client->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Client berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_client);$i++) {
				$data = array(	'id_client'	=> $id_client[$i]);
   				$m_client->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// edit
	public function edit($id_client)
	{
		$this->simple_login->checklogin();
		$m_kategori_client 	= new Kategori_client_model();
		$m_client 			= new Client_model();
		$kategori_client 	= $m_kategori_client->listing();
		$client 			= $m_client->detail($id_client);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_client' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_clientbaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_clientbaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_clientbaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_clientbaru);
	        	// masuk database
			    $data = array(
	        		'id_client'			=> $id_client,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_client'=> $this->request->getVar('id_kategori_client'),
					'jenis_client'		=> $this->request->getVar('jenis_client'),
					'jenis_kelamin'		=> $this->request->getVar('jenis_kelamin'),
					'nama_client'		=> $this->request->getVar('nama_client'),
					'nama_perusahaan'	=> $this->request->getVar('nama_perusahaan'),
					'pimpinan'			=> $this->request->getVar('pimpinan'),
					'alamat'			=> $this->request->getVar('alamat'),
					'telepon'			=> $this->request->getVar('telepon'),
					'website'			=> $this->request->getVar('website'),
					'email'				=> $this->request->getVar('email'),
					'password'			=> sha1($this->request->getVar('password')),
					'password_hint'		=> $this->request->getVar('password'),
					'isi_testimoni'		=> $this->request->getVar('isi_testimoni'),
					'gambar' 			=> $nama_clientbaru,
					'status_client'		=> $this->request->getVar('status_client'),
					'tempat_lahir'		=> $this->request->getVar('tempat_lahir'),
					'tanggal_lahir'		=> $this->website->tanggal_input($this->request->getVar('tanggal_lahir')),
	        	);
	        	$m_client->edit($data);
        		return redirect()->to(base_url('admin/client'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_client'			=> $id_client,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_kategori_client'=> $this->request->getVar('id_kategori_client'),
					'jenis_client'		=> $this->request->getVar('jenis_client'),
					'jenis_kelamin'		=> $this->request->getVar('jenis_kelamin'),
					'nama_client'		=> $this->request->getVar('nama_client'),
					'nama_perusahaan'	=> $this->request->getVar('nama_perusahaan'),
					'pimpinan'			=> $this->request->getVar('pimpinan'),
					'alamat'			=> $this->request->getVar('alamat'),
					'telepon'			=> $this->request->getVar('telepon'),
					'website'			=> $this->request->getVar('website'),
					'email'				=> $this->request->getVar('email'),
					'password'			=> sha1($this->request->getVar('password')),
					'password_hint'		=> $this->request->getVar('password'),
					'isi_testimoni'		=> $this->request->getVar('isi_testimoni'),
					'status_client'		=> $this->request->getVar('status_client'),
					'tempat_lahir'		=> $this->request->getVar('tempat_lahir'),
					'tanggal_lahir'		=> $this->website->tanggal_input($this->request->getVar('tanggal_lahir')),
	        	);
	        	$m_client->edit($data);
        		return redirect()->to(base_url('admin/client'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}

		$data = [	'title'				=> 'Edit Client: '.$client->nama_client,
					'kategori_client'	=> $kategori_client,
					'client'			=> $client,
					'content'			=> 'admin/client/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Delete
	public function delete($id_client)
	{
		$this->simple_login->checklogin();
		$m_client = new Client_model();
		$data = ['id_client'	=> $id_client];
		$m_client->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/client'));
	}
}