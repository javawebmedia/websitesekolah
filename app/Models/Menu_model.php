<?php 
namespace App\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{


    // Menu berita
    public function berita()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.id_kategori,berita.icon, berita.ringkasan, berita.gambar, kategori.nama_kategori, kategori.slug_kategori');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => 'Berita'));
        $builder->groupBy('berita.id_kategori');
        $query = $builder->get();
        return $query->getResult();
    }

    // Menu profil
    public function profil($jenis_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.hits,berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => $jenis_berita));
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

    // Menu profil
    public function jenis_berita($jenis_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => $jenis_berita));
        $query = $builder->get();
        return $query->getResult();
    }

    // Menu profil
    public function faq()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => 'FAQ'));
        $builder->orderBy('urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Menu konservasi
    public function cabang($status_cabang)
    {
        $builder = $this->db->table('cabang');
        $builder->select('*');
        $builder->where('status_cabang',$status_cabang);
        $builder->orderBy('nama_cabang','ASC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    // Menu layanan
    public function layanan()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.judul_berita, berita.icon, berita.ringkasan, berita.gambar, berita.slug_berita, berita.id_berita');
        $builder->where(array('status_berita'    => 'Publish','jenis_berita' => 'Layanan'));
        $query = $builder->get();
        return $query->getResult();
    }

    // Menu portfolio
    public function portfolio()
    {
        $builder = $this->db->table('portfolio');
        $builder->select('portfolio.id_portfolio, 
                        kategori_portfolio.nama_kategori_portfolio, 
                        kategori_portfolio.slug_kategori_portfolio');
        
        $builder->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio');
        $builder->groupBy('portfolio.id_kategori_portfolio');
        $builder->orderBy('kategori_portfolio.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}



