<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Kategori_portfolio_model;

class Kategori_portfolio extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_kategori_portfolio 	= new Kategori_portfolio_model();
		$kategori_portfolio 	= $m_kategori_portfolio->listing();
		$total 				= $m_kategori_portfolio->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_portfolio' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_kategori_portfoliobaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_portfoliobaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_portfoliobaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_portfoliobaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_portfolio')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_portfolio'		=> $slug,
							'nama_kategori_portfolio'		=> $this->request->getPost('nama_kategori_portfolio'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_portfolio'		=> $this->request->getPost('status_kategori_portfolio'),
							'urutan'					=> $this->request->getPost('urutan'),
							'gambar'					=> $nama_kategori_portfoliobaru,
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_portfolio->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_portfolio'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_portfolio')));
				$data = [	'id_user'					=> $this->session->get('id_user'),
							'slug_kategori_portfolio'		=> $slug,
							'nama_kategori_portfolio'		=> $this->request->getPost('nama_kategori_portfolio'),
							'keterangan'				=> $this->request->getPost('keterangan'),
							'status_kategori_portfolio'		=> $this->request->getPost('status_kategori_portfolio'),
							'urutan'					=> $this->request->getPost('urutan'),
							'tanggal_post'				=> date('Y-m-d H:i:s')
						];
				$m_kategori_portfolio->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/kategori_portfolio'));
			}
	    }else{
			$data = [	'title'				=> 'Data Kategori Portfolio: '.$total->total,
						'kategori_portfolio'	=> $kategori_portfolio,
						'm_kategori_portfolio'	=> $m_kategori_portfolio,
						'content'			=> 'admin/kategori_portfolio/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_kategori_portfolio)
	{
		
		$m_kategori_portfolio 	= new Kategori_portfolio_model();
		$kategori_portfolio 	= $m_kategori_portfolio->detail($id_kategori_portfolio);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_kategori_portfolio' 	=> 'required',
				'gambar'	 			=> [
								                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_kategori_portfoliobaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_kategori_portfoliobaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_kategori_portfoliobaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_kategori_portfoliobaru);
	        	// masuk database
	        	$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_portfolio')));
				$data = [	'id_kategori_portfolio'		=> $id_kategori_portfolio,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_portfolio'	=> $slug,
							'nama_kategori_portfolio'	=> $this->request->getPost('nama_kategori_portfolio'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_portfolio'	=> $this->request->getPost('status_kategori_portfolio'),
							'urutan'				=> $this->request->getPost('urutan'),
							'gambar'				=> $nama_kategori_portfoliobaru
						];
				$m_kategori_portfolio->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_portfolio'));
			}else{
				// masuk database
				$slug 	= strtolower(url_title($this->request->getVar('nama_kategori_portfolio')));
				$data = [	'id_kategori_portfolio'		=> $id_kategori_portfolio,
							'id_user'				=> $this->session->get('id_user'),
							'slug_kategori_portfolio'	=> $slug,
							'nama_kategori_portfolio'	=> $this->request->getPost('nama_kategori_portfolio'),
							'keterangan'			=> $this->request->getPost('keterangan'),
							'status_kategori_portfolio'	=> $this->request->getPost('status_kategori_portfolio'),
							'urutan'				=> $this->request->getPost('urutan'),
						];
				$m_kategori_portfolio->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/kategori_portfolio'));
			}
	    }else{
			$data = [	'title'			=> 'Edit Kategori Portfolio: '.$kategori_portfolio->nama_kategori_portfolio,
						'kategori_portfolio'=> $kategori_portfolio,
						'content'		=> 'admin/kategori_portfolio/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_kategori_portfolio)
	{
		
		$m_kategori_portfolio = new Kategori_portfolio_model();
		$data = ['id_kategori_portfolio'	=> $id_kategori_portfolio];
		$m_kategori_portfolio->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/kategori_portfolio'));
	}
}