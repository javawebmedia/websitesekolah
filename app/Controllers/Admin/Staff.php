<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Staff_model;
use App\Models\Kategori_staff_model;

class Staff extends BaseController
{

	// mainpage
	public function index()
	{
		$this->simple_login->checklogin();
		$m_staff 			= new Staff_model();
		$m_kategori_staff 	= new Kategori_staff_model();
		$kategori_staff 	= $m_kategori_staff->listing();
		$pager 				= service('pager'); 
		// staff
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_staff->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $staff 			= $m_staff->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_staff->total();
			$title 			= 'Staff dan Team ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $staff 			= $m_staff->paginasi_admin($perPage, $page);
		}
		// end staff
		

		$data = [	'title'			=> $title,
					'staff'			=> $staff,
					'kategori_staff'=> $kategori_staff,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/staff/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		$this->simple_login->checklogin();
		$m_kategori 	= new Kategori_staff_model();
		$m_staff 		= new Staff_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_staff 	= $this->request->getVar('id_staff');
		// check staff
		if(empty($this->request->getVar('id_staff')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih staff. Pilih salah satu staff');
		}
		// end check staff
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_staff);$i++) {
				$data = array(	'id_staff'			=> $id_staff[$i],
								'id_user'			=> $this->session->get('id_user'),
								'id_kategori_staff'	=> $this->request->getVar('id_kategori_staff')
							);
   				$m_staff->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Staff berhasil diupdate jenis staffnya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_staff);$i++) {
				$data = array(	'id_staff'		=> $id_staff[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_staff'	=> 'Publish'
							);
   				$m_staff->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Staff berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_staff);$i++) {
				$data = array(	'id_staff'		=> $id_staff[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_staff'	=> 'Draft'
							);
   				$m_staff->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Staff berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_staff);$i++) {
				$data = array(	'id_staff'	=> $id_staff[$i]);
   				$m_staff->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// tambah
	public function tambah()
	{
		$this->simple_login->checklogin();
		$m_staff 			= new Staff_model();
		$m_kategori_staff 	= new Kategori_staff_model();
		$staff 				= $m_staff->listing();
		$kategori_staff 	= $m_kategori_staff->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 		=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/staff/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/staff/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/staff/thumbs/'.$namabaru);
	        	// masuk database
	        	// masuk database
				$data = [	'id_user'		=> $this->session->get('id_user'),
							'id_kategori_staff'	=> $this->request->getPost('id_kategori_staff'),
							'urutan'	=> $this->request->getPost('urutan'),
							'nama'			=> $this->request->getPost('nama'),
							'jenis_kelamin'	=> $this->request->getPost('jenis_kelamin'),
							'jabatan'		=> $this->request->getPost('jabatan'),
							'alamat'		=> $this->request->getPost('alamat'),
							'telepon'		=> $this->request->getPost('telepon'),
							'website'		=> $this->request->getPost('website'),
							'email'			=> $this->request->getPost('email'),
							'keahlian'		=> $this->request->getPost('keahlian'),
							'gambar'		=> $namabaru,
							'status_staff'	=> $this->request->getPost('status_staff'),
							'tempat_lahir'	=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'	=> date('Y-m-d',strtotime($this->request->getPost('tanggal_lahir'))),
							'tanggal_post'	=> date('Y-m-d H:i:s')
						];
				$m_staff->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/staff'));
			}else{
				// masuk database
				$data = [	'id_user'		=> $this->session->get('id_user'),
							'id_kategori_staff'	=> $this->request->getPost('id_kategori_staff'),
							'urutan'	=> $this->request->getPost('urutan'),
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
							'tanggal_post'	=> date('Y-m-d H:i:s')
						];
				$m_staff->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/staff'));
			}
	    }else{
			$data = [	'title'			=> 'Tambah Data Staff',
						'staff'			=> $staff,
						'kategori_staff'=> $kategori_staff,
						'content'		=> 'admin/staff/tambah'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_staff)
	{
		$this->simple_login->checklogin();
		$m_kategori_staff 	= new Kategori_staff_model();
		$m_staff 			= new Staff_model();
		$staff 				= $m_staff->detail($id_staff);
		$kategori_staff 	= $m_kategori_staff->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 		=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/staff/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/staff/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/staff/thumbs/'.$namabaru);
	        	// masuk database
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
							'gambar'		=> $namabaru,
							'status_staff'	=> $this->request->getPost('status_staff'),
							'tempat_lahir'	=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'	=> date('Y-m-d',strtotime($this->request->getPost('tanggal_lahir'))),
						];
				$m_staff->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/staff'));
			}else{
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
							// 'gambar'		=> $namabaru,
							'status_staff'	=> $this->request->getPost('status_staff'),
							'tempat_lahir'	=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'	=> date('Y-m-d',strtotime($this->request->getPost('tanggal_lahir'))),
						];
				$m_staff->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/staff'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Data Staff: '.$staff->nama,
						'staff'			=> $staff,
						'kategori_staff'=> $kategori_staff,
						'content'		=> 'admin/staff/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_staff)
	{
		$this->simple_login->checklogin();
		$m_staff = new Staff_model();
		$data = ['id_staff'	=> $id_staff];
		$m_staff->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/staff'));
	}
}