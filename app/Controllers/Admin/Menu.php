<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Menu_model;
use App\Models\Sub_menu_model;
use App\Models\Konfigurasi_model;

class Menu extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_menu 		= new Menu_model();
		$m_sub_menu 	= new Sub_menu_model();
		$m_konfigurasi 	= new Konfigurasi_model();
		$menu 			= $m_menu->listing();
		$total 			= $m_menu->total();
		$konfigurasi 	= $m_konfigurasi->listing();
		$id_konfigurasi = $konfigurasi->id_konfigurasi;
		$menu 			= $m_menu->listing();
		$total 			= $m_menu->total();
		$menu_akhir 	= $m_menu->akhir();
		if($menu_akhir) {
			$urutan = $menu_akhir->urutan+1;
		}else{
			$urutan = 1;
		}

		// update menu
		if(isset($_POST['updateMenu'])) {
			$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
						'id_user'			=> $this->session->get('id_user'),
						'menu_home'			=> $this->request->getPost('menu_home'),
						'menu_berita'		=> $this->request->getPost('menu_berita'),
						'menu_profil'		=> $this->request->getPost('menu_profil'),
						'menu_prestasi'		=> $this->request->getPost('menu_prestasi'),
						'menu_galeri'		=> $this->request->getPost('menu_galeri'),
						'menu_unduhan'		=> $this->request->getPost('menu_unduhan'),
						'menu_tautan'		=> $this->request->getPost('menu_tautan'),
						'menu_kontak'	=> $this->request->getPost('menu_kontak')
					];
			$m_konfigurasi->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data menu telah diupdate');
			return redirect()->to(base_url('admin/menu'));
		}

		// update menu
		if(isset($_POST['posisiMenu'])) {
			$data = [	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
						'id_user'			=> $this->session->get('id_user'),
						'letak_menu'		=> $this->request->getPost('letak_menu')
					];
			$m_konfigurasi->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Letak menu tambahan telah diupdate');
			return redirect()->to(base_url('admin/menu'));
		}
		// end update menu
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_menu' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			if($this->request->getPost('jenis')=='menu') {
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'nama_menu'				=> $this->request->getPost('nama_menu'),
							'icon'					=> $this->request->getPost('icon'),
							'link'					=> $this->request->getPost('link'),
							'urutan'				=> $this->request->getPost('urutan'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_menu'			=> $this->request->getPost('status_menu')
						];
				$m_menu->tambah($data);
			}else{
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'id_menu'				=> $this->request->getPost('id_menu'),
							'nama_sub_menu'			=> $this->request->getPost('nama_menu'),
							'urutan'				=> $this->request->getPost('urutan'),
							'link'					=> $this->request->getPost('link'),
							'icon'					=> $this->request->getPost('icon'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_sub_menu'		=> $this->request->getPost('status_sub_menu')
						];
				$m_sub_menu->tambah($data);
			}
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/menu'));
	    }else{
			$data = [	'title'			=> 'Master Menu: '.$total->total,
						'menu'			=> $menu,
						'menu2'			=> $menu,
						'm_sub_menu'	=> $m_sub_menu,
						'urutan'		=> $urutan,
						'konfigurasi'	=> $konfigurasi,
						'content'		=> 'admin/menu/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// urutkan
	public function urutkan()
	{
		$m_menu 		= new Menu_model();
		$m_sub_menu 	= new Sub_menu_model();
		$menu 			= $m_menu->listing();
		$total 					= $m_menu->total();

		if(isset($_POST['page_id_array'])) 
		{
			for($i=0; $i<count($_POST["page_id_array"]); $i++)
			{
				$data = [	'id_menu'	=> $_POST["page_id_array"][$i],
							'id_user'		=> $this->session->get('id_user'),
							'urutan'			=> $i
						];
			 	$m_menu->edit($data);
			}
			$this->session->setFlashdata('sukses','Data telah diurutkan');
			return redirect()->to(base_url('admin/menu/urutkan'));
		}else{
			$data = [   'title'     			=> 'Urutkan Menu Aplikasi',
						'menu'			=> $menu,
						'menu2'		=> $menu,
						'm_sub_menu'	=> $m_sub_menu,
						'content'				=> 'admin/menu/urutkan'
	                ];
	        return view('admin/layout/wrapper',$data);	
		}

		
    }

    // urutkan
	public function urutkan_sub($id_menu)
	{
		$m_menu 		= new Menu_model();
		$m_sub_menu 	= new Sub_menu_model();
		$menu 			= $m_menu->detail($id_menu);
		$sub_menu 		= $m_sub_menu->menu($id_menu);

		if(isset($_POST['page_id_array'])) 
		{
			for($i=0; $i<count($_POST["page_id_array"]); $i++)
			{
				$data = [	'id_sub_menu'	=> $_POST["page_id_array"][$i],
							'id_user'			=> $this->session->get('id_user'),
							'urutan'				=> $i
						];
			 	$m_sub_menu->edit($data);
			}
			$this->session->setFlashdata('sukses','Data telah diurutkan');
			return redirect()->to(base_url('admin/menu/urutkan_sub/'.$id_menu));
		}else{
			$data = [   'title'     			=> 'Urutkan Sub Menu Aplikasi: '.$menu->nama_menu,
						'menu'			=> $menu,
						'sub_menu'		=> $sub_menu,
						'm_sub_menu'	=> $m_sub_menu,
						'content'				=> 'admin/menu/urutkan_sub'
	                ];
	        return view('admin/layout/wrapper',$data);
		}

		
    }

	// edit
	public function edit($id_menu)
	{
		$m_menu 	= new Menu_model();
		$menu 		= $m_menu->detail($id_menu);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_menu' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			$data = [	'id_menu'				=> $id_menu,
						'id_user'				=> $this->session->get('id_user'),
						'nama_menu'				=> $this->request->getPost('nama_menu'),
						'icon'					=> $this->request->getPost('icon'),
						'link'					=> $this->request->getPost('link'),
						'urutan'				=> $this->request->getPost('urutan'),
						'keterangan'			=> $this->request->getPost('keterangan'),
						'status_menu'			=> $this->request->getPost('status_menu')
					];
			$m_menu->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/menu'));
	    }else{
			$data = [	'title'			=> 'Edit menu: '.$menu->nama_menu,
						'menu'	=> $menu,
						'content'		=> 'admin/menu/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function sub()
	{
		$id_menu 	= $_GET['q'];
		$m_menu 	= new Menu_model();
		$m_sub_menu 	= new Sub_menu_model();
		$menu 		= $m_menu->detail($id_menu);
		$sub_menu 	= $m_sub_menu->akhir_menu($id_menu);
		if($sub_menu) {
			$urutan 	= $sub_menu->urutan+1;
		}else{
			$urutan 	= 1;
		}
		echo '<input type="number" name="urutan" class="form-control" placeholder="Nomor urut" value="'.$urutan.'">';
	}

	// edit
	public function edit_sub($id_sub_menu)
	{
		$m_menu 		= new Menu_model();
		$m_sub_menu 	= new Sub_menu_model();
		$menu 			= $m_menu->listing();
		$sub_menu 		= $m_sub_menu->detail($id_sub_menu);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_menu' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			$data = [	'id_sub_menu'			=> $id_sub_menu,
						'id_user'				=> $this->session->get('id_user'),
						'id_menu'				=> $this->request->getPost('id_menu'),
						'nama_sub_menu'			=> $this->request->getPost('nama_menu'),
						'urutan'				=> $this->request->getPost('urutan'),
						'link'					=> $this->request->getPost('link'),
						'icon'					=> $this->request->getPost('icon'),
						'keterangan'			=> $this->request->getPost('keterangan'),
						'status_sub_menu'		=> $this->request->getPost('status_sub_menu')
					];
			$m_sub_menu->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/menu'));
	    }else{
			$data = [	'title'				=> 'Edit sub menu: '.$sub_menu->nama_sub_menu,
						'menu2'	=> $menu,
						'sub_menu'	=> $sub_menu,
						'content'			=> 'admin/menu/edit-sub'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_menu)
	{
		// $this->simple_login->checklogin();
		// $this->simple_login->checkadmin();
		$m_menu 		= new Menu_model();
		$m_sub_menu 	= new Sub_menu_model();
		$data = ['id_menu'	=> $id_menu];
		$m_menu->delete($data);
		$m_sub_menu->hapus($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/menu'));
	}

	// delete
	public function delete_sub($id_sub_menu)
	{
		// $this->simple_login->checklogin();
		// $this->simple_login->checkadmin();
		$m_sub_menu = new Sub_menu_model();
		$data = ['id_sub_menu'	=> $id_sub_menu];
		$m_sub_menu->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/menu'));
	}
}