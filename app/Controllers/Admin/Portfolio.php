<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Portfolio_model;
use App\Models\Kategori_portfolio_model;

class Portfolio extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_portfolio 			= new Portfolio_model();
		$m_kategori_portfolio 	= new Kategori_portfolio_model();
		$kategori_portfolio 	= $m_kategori_portfolio->listing();
		$pager 				= service('pager'); 
		// portfolio
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_portfolio->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $portfolio 		= $m_portfolio->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_portfolio->total();
			$title 			= 'Portfolio Gambar ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $portfolio 		= $m_portfolio->paginasi_admin($perPage, $page);
		}
		// end portfolio

		$data = [	'title'				=> $title,
					'portfolio'			=> $portfolio,
					'kategori_portfolio'	=> $kategori_portfolio,
					'pagination'		=> $pager_links,
					'content'			=> 'admin/portfolio/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		
		$m_portfolio 			= new Portfolio_model();
		$m_kategori_portfolio 	= new Kategori_portfolio_model();
		$kategori_portfolio 	= $m_kategori_portfolio->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_portfolio' 	=> 'required',
				'gambar'	 	=> [
					                'uploaded[gambar]',
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
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
					'id_kategori_portfolio'	=> $this->request->getVar('id_kategori_portfolio'),
					'judul_portfolio'		=> $this->request->getVar('judul_portfolio'),
					'jenis_portfolio'		=> $this->request->getVar('jenis_portfolio'),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_portfolio'		=> $this->request->getVar('status_portfolio'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_portfolio->tambah($data);
        		return redirect()->to(base_url('admin/portfolio'))->with('sukses', 'Data Berhasil di Simpan');
        	}else{
        		$data = array(
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_portfolio'	=> $this->request->getVar('id_kategori_portfolio'),
					'judul_portfolio'		=> $this->request->getVar('judul_portfolio'),
					'jenis_portfolio'		=> $this->request->getVar('jenis_portfolio'),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_portfolio'		=> $this->request->getVar('status_portfolio'),
					'tanggal_post'			=> date('Y-m-d H:i:s')
	        	);
	        	$m_portfolio->tambah($data);
        		return redirect()->to(base_url('admin/portfolio'))->with('sukses', 'Data Berhasil di Simpan');
        	}
        }

		$data = [	'title'				=> 'Tambah Portfolio',
					'kategori_portfolio'	=> $kategori_portfolio,
					'content'			=> 'admin/portfolio/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_kategori 	= new Kategori_portfolio_model();
		$m_portfolio 		= new Portfolio_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_portfolio 	= $this->request->getVar('id_portfolio');
		// check portfolio
		if(empty($this->request->getVar('id_portfolio')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih portfolio. Pilih salah satu portfolio');
		}
		// end check portfolio
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_portfolio);$i++) {
				$data = array(	'id_portfolio'				=> $id_portfolio[$i],
								'id_user'				=> $this->session->get('id_user'),
								'id_kategori_portfolio'	=> $this->request->getVar('id_kategori_portfolio')
							);
   				$m_portfolio->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Portfolio berhasil diupdate jenis portfolionya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_portfolio);$i++) {
				$data = array(	'id_portfolio'		=> $id_portfolio[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_portfolio'	=> 'Publish'
							);
   				$m_portfolio->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Portfolio berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_portfolio);$i++) {
				$data = array(	'id_portfolio'		=> $id_portfolio[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_portfolio'	=> 'Draft'
							);
   				$m_portfolio->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Portfolio berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_portfolio);$i++) {
				$data = array(	'id_portfolio'	=> $id_portfolio[$i]);
   				$m_portfolio->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}

	// edit
	public function edit($id_portfolio)
	{
		
		$m_kategori_portfolio 	= new Kategori_portfolio_model();
		$m_portfolio 			= new Portfolio_model();
		$kategori_portfolio 	= $m_kategori_portfolio->listing();
		$portfolio 			= $m_portfolio->detail($id_portfolio);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_portfolio' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
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
	        		'id_portfolio'			=> $id_portfolio,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_portfolio'	=> $this->request->getVar('id_kategori_portfolio'),
					'judul_portfolio'		=> $this->request->getVar('judul_portfolio'),
					'jenis_portfolio'		=> $this->request->getVar('jenis_portfolio'),
					'isi'					=> $this->request->getVar('isi'),
					'gambar' 				=> $namabaru,
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_portfolio'		=> $this->request->getVar('status_portfolio'),
	        	);
	        	$m_portfolio->edit($data);
        		return redirect()->to(base_url('admin/portfolio'))->with('sukses', 'Data Berhasil di Simpan');
			}else{
				$data = array(
	        		'id_portfolio'			=> $id_portfolio,
	        		'id_user'				=> $this->session->get('id_user'),
					'id_kategori_portfolio'	=> $this->request->getVar('id_kategori_portfolio'),
					'judul_portfolio'		=> $this->request->getVar('judul_portfolio'),
					'jenis_portfolio'		=> $this->request->getVar('jenis_portfolio'),
					'isi'					=> $this->request->getVar('isi'),
					'website'				=> $this->request->getVar('website'),
					'text_website'			=> $this->request->getVar('text_website'),
					'status_text'			=> $this->request->getVar('status_text'),
					'status_portfolio'		=> $this->request->getVar('status_portfolio'),
	        	);
	        	$m_portfolio->edit($data);
        		return redirect()->to(base_url('admin/portfolio'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}

		$data = [	'title'				=> 'Edit Portfolio: '.$portfolio->judul_portfolio,
					'kategori_portfolio'	=> $kategori_portfolio,
					'portfolio'			=> $portfolio,
					'content'			=> 'admin/portfolio/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Delete
	public function delete($id_portfolio)
	{
		
		$m_portfolio = new Portfolio_model();
		$data = ['id_portfolio'	=> $id_portfolio];
		$m_portfolio->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/portfolio'));
	}
}