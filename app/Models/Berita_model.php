<?php 
namespace App\Models;

use CodeIgniter\Model;

class Berita_model extends Model
{

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->like('berita.judul_berita',$keywords,'BOTH');
        $this->orLike('berita.isi',$keywords,'BOTH');
        $this->orLike('berita.keywords',$keywords,'BOTH');
        $this->orLike('berita.ringkasan',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->like('berita.judul_berita',$keywords,'BOTH');
        $this->orLike('berita.isi',$keywords,'BOTH');
        $this->orLike('berita.keywords',$keywords,'BOTH');
        $this->orLike('berita.ringkasan',$keywords,'BOTH');
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // home
    public function main()
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'status_berita' => 'Publish',
                            'jenis_berita'  => 'Berita']);
        $this->orderBy('berita.tanggal_publish','DESC');
    }

    // home
    public function beranda($jenis_berita,$jumlah)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [     'status_berita' => 'Publish',
                            'jenis_berita'  => $jenis_berita]);
        $this->orderBy('berita.tanggal_publish','DESC');
        $this->limit($jumlah);
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function sidebar()
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'status_berita' => 'Publish',
                            'jenis_berita'  => 'Berita']);
        $this->orderBy('berita.tanggal_publish','DESC');
        $this->limit(10);
        $query = $this->get();
        return $query->getResult();
    }


    // home
    public function home()
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [     'status_berita' => 'Publish',
                            'jenis_berita'  => 'Berita']);
        $this->orderBy('berita.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function jenis_publish($jenis_berita)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [     'status_berita'    => 'Publish',
                            'jenis_berita'  => $jenis_berita
                        ]);
        $this->orderBy('berita.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori
    public function kategori($id_kategori)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'status_berita'         => 'Publish',
                            'jenis_berita'          => 'Berita',
                            'berita.id_kategori'    => $id_kategori]);
        $this->orderBy('berita.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori
    public function kategori_status_jenis_all($id_kategori,$jenis_berita,$status_berita,$limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [ 'berita.id_kategori'    => $id_kategori,
                        'berita.jenis_berita'   => $jenis_berita,
                        'berita.status_berita'  => $status_berita,
                    ]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_kategori_status_jenis($id_kategori,$jenis_berita,$status_berita)
    {
        $this->table('berita');
        $this->where( [ 'berita.id_kategori'    => $id_kategori,
                        'berita.jenis_berita'   => $jenis_berita,
                        'berita.status_berita'  => $status_berita,
                    ]);
        $query = $this->get();
        return $query->getNumRows();
    }

    // kategori
    public function kategori_all($id_kategori,$limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'berita.id_kategori'    => $id_kategori]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_kategori($id_kategori)
    {
        $this->table('berita')->where('id_kategori',$id_kategori);
        $query = $this->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'berita.id_user'    => $id_user]);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_author($id_user)
    {
        $this->table('berita')->where('id_user',$id_user);
        $query = $this->get();
        return $query->getNumRows();
    }

    // kategori
    public function jenis_berita_all($jenis_berita,$limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'berita.jenis_berita'    => $jenis_berita]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_berita($jenis_berita)
    {
        $this->table('berita')->where('jenis_berita',$jenis_berita);
        $query = $this->get();
        return $query->getNumRows();
    }

    // status_berita
    public function status_berita_all($status_berita,$limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [  'berita.status_berita'    => $status_berita]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori
    public function jenis_status_berita_all($jenis_berita,$status_berita,$limit,$start)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where( [     'berita.jenis_berita'   => $jenis_berita,
                            'berita.status_berita'  => $status_berita,  
                        ]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_status_berita($jenis_berita,$status_berita)
    {
        $this->table('berita')->where('jenis_berita',$jenis_berita)->where('status_berita',$status_berita);
        $query = $this->get();
        return $query->getNumRows();
    }

    // status_berita
    public function total_status_berita($status_berita)
    {
        $this->table('berita')->where('status_berita',$status_berita);
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $this->table('berita');
        $query = $this->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_berita)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where('berita.id_berita',$id_berita);
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // detail
    public function detail2($id_berita)
    {
        $this->table('berita');
        $this->select('*');
        $this->where('berita.id_berita',$id_berita);
        $query = $this->get();
        return $query->getRow();
    }

    // read
    public function read($slug_berita)
    {
        $this->table('berita');
        $this->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $this->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
        $this->join('users','users.id_user = berita.id_user','LEFT');
        $this->where('berita.slug_berita',$slug_berita);
        $this->where('berita.status_berita','Publish');
        $this->orderBy('berita.id_berita','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('berita');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('berita');
        $builder->where('id_berita',$data['id_berita']);
        $builder->update($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('berita');
        $builder->insert($data);
    }

}