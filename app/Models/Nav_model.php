<?php 
namespace App\Models;

use CodeIgniter\Model;

class Nav_model extends Model
{


    // Nav berita
    public function berita()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.id_kategori, MAX(berita.icon) AS icon, MAX(berita.ringkasan) AS ringkasan, MAX(berita.gambar) AS gambar, kategori.nama_kategori, kategori.slug_kategori');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori');
        $builder->where(array('status_berita' => 'Publish', 'jenis_berita' => 'Berita'));
        $builder->groupBy('berita.id_kategori');
        $query = $builder->get();
        return $query->getResult();
    }


    // Nav profil
    public function profil($jenis_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.hits,berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => $jenis_berita));
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav download
    public function download()
    {
        $builder = $this->db->table('download');
        $builder->select('download.id_kategori_download, MAX(download.gambar) AS gambar, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download');
        $builder->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download');
        $builder->where('download.jenis_download','Download');
        $builder->groupBy('download.id_kategori_download');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav prestasi
    public function prestasi()
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.id_kategori_prestasi, MAX(prestasi.gambar) AS gambar, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi');
        $builder->join('kategori_prestasi', 'kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi');
        $builder->where(array('status_prestasi' => 'Publish'));
        $builder->groupBy('prestasi.id_kategori_prestasi');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav fasilitas
    public function fasilitas()
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.judul_fasilitas, fasilitas.slug_fasilitas, fasilitas.hits, fasilitas.gambar, fasilitas.id_fasilitas, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas');
        $builder->join('kategori_fasilitas', 'kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas');
        $builder->where(array('fasilitas.status_fasilitas'    => 'Publish'));
        $builder->limit(15);
        $builder->orderBy('kategori_fasilitas.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav ekstrakurikuler
    public function ekstrakurikuler()
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.id_kategori_ekstrakurikuler, MAX(ekstrakurikuler.gambar) AS gambar, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler');
        $builder->join('kategori_ekstrakurikuler', 'kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler');
        $builder->where(array('status_ekstrakurikuler' => 'Publish'));
        $builder->groupBy('ekstrakurikuler.id_kategori_ekstrakurikuler');
        $query = $builder->get();
        return $query->getResult();
    }

    // Listing
    public function kreatif()
    {
        $builder = $this->db->table('kreatif');
        $builder->select('kreatif.*, kategori_kreatif.nama_kategori_kreatif, kategori_kreatif.slug_kategori_kreatif, users.nama');
        $builder->join('kategori_kreatif','kategori_kreatif.id_kategori_kreatif = kreatif.id_kategori_kreatif','LEFT');
        $builder->join('users','users.id_user = kreatif.id_user','LEFT');
        $builder->orderBy('kreatif.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav profil
    public function jenis_berita($jenis_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => $jenis_berita));
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav menu
    public function menu()
    {
        $builder = $this->db->table('menu');
        $builder->select('*');
        $builder->where(array('status_menu'    => 'Publish'));
        $builder->orderBy('urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav menu
    public function sub_menu($id_menu)
    {
        $builder = $this->db->table('sub_menu');
        $builder->select('*');
        $builder->where(array(  'status_sub_menu'   => 'Publish',
                                'id_menu'           => $id_menu));
        $builder->orderBy('urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav profil
    public function faq()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => 'FAQ'));
        $builder->orderBy('urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav konservasi
    public function link_website($status_link_website)
    {
        $builder = $this->db->table('link_website');
        $builder->select('*');
        $builder->where('status_link_website',$status_link_website);
        $builder->orderBy('urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav layanan
    public function layanan()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => 'Layanan'));
        $query = $builder->get();
        return $query->getResult();
    }

    // Nav portfolio
    public function portfolio()
    {
        $builder = $this->db->table('portfolio');
        $builder->select('portfolio.id_kategori_portfolio, MAX(portfolio.gambar) AS gambar, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio');
        $builder->join('kategori_portfolio', 'kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio');
        $builder->where(array('status_portfolio' => 'Publish'));
        $builder->groupBy('portfolio.id_kategori_portfolio');
        $query = $builder->get();
        return $query->getResult();
    }

}



