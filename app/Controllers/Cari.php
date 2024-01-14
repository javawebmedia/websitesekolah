<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Produk_model;
use App\Models\Kategori_produk_model;
use App\Models\Gambar_produk_model;
use App\Models\Harga_produk_model;

class Cari extends BaseController
{
	public function index()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$keywords 		= strip_tags($_GET['keywords']);

		$m_konfigurasi 	= new Konfigurasi_model();
		$m_produk 		= new Produk_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		// pagination setting
		$pager 			= service('pager'); 
		$produk 		= $m_produk->select('produk.*, kategori_produk.nama_kategori_produk, kategori_produk.slug_kategori_produk, users.nama, merek.nama_merek, merek.slug_merek')
						->join('kategori_produk','kategori_produk.id_kategori_produk = produk.id_kategori_produk','LEFT')
						->join('merek','merek.id_merek = produk.id_merek','LEFT')
						->join('users','users.id_user = produk.id_user','LEFT')
						->like('produk.nama_produk',$keywords)
						->orLike('produk.isi',$keywords)
						->orLike('produk.keywords',$keywords)
						->orLike('kategori_produk.nama_kategori_produk',$keywords)
						->where('produk.status_produk','Publish');

		$data = [	'title'			=> 'Hasil pencarian: '.$keywords,
					'description'	=> 'Hasil pencarian: '.$keywords,
					'keywords'		=> 'Hasil pencarian: '.$keywords,
					'konfigurasi'	=> $konfigurasi,
					'produk'		=> $produk->paginate(paginasi(),'bootstrap'),
					'pager'			=> $produk->pager,
					'content'		=> 'produk/index'
				];
		echo view('layout/wrapper',$data);
	}
}