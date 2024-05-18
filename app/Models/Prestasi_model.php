<?php namespace App\Models;

use CodeIgniter\Model;

class Prestasi_model extends Model
{

	protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // read
    public function read($slug_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');
        $builder->where('prestasi.slug_prestasi',$slug_prestasi);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // home
    public function home($limit,$status_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');
        $builder->where('prestasi.status_prestasi',$status_prestasi);
        $this->limit((int)$limit);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function status_prestasi($limit,$start,$status_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');
        $builder->where('prestasi.status_prestasi',$status_prestasi);
        $builder->limit($limit,$start);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_kategori_prestasi
    public function total_status_prestasi($status_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->where('status_prestasi',$status_prestasi);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // kategori_prestasi
    public function kategori_prestasi($limit, $start, $slug_kategori_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');

        $builder->where('kategori_prestasi.slug_kategori_prestasi',$slug_kategori_prestasi);
        $builder->limit($limit,$start);

        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // kategori_prestasi_home
    public function kategori_prestasi_status($limit, $start, $id_kategori_prestasi,$status_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');
        $builder->where(array(  'prestasi.id_kategori_prestasi' => $id_kategori_prestasi,
                                'prestasi.status_prestasi'      => $status_prestasi
                        ));
        $builder->limit($limit,$start);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_kategori_prestasi
    public function total_kategori_prestasi_status($id_kategori_prestasi,$status_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->where('id_kategori_prestasi',$id_kategori_prestasi);
        $builder->where('status_prestasi',$status_prestasi);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('prestasi');
        $this->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $this->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $this->join('users','users.id_user = prestasi.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('prestasi.id_prestasi','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('prestasi');
        $this->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $this->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $this->join('users','users.id_user = prestasi.id_user','LEFT');
        $this->like('prestasi.judul_prestasi',$keywords,'BOTH');
        $this->orLike('prestasi.website',$keywords,'BOTH');
        $this->orLike('prestasi.isi',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('prestasi.id_prestasi','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('prestasi');
        $this->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama AS nama_user');
        $this->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $this->join('users','users.id_user = prestasi.id_user','LEFT');
        $this->like('prestasi.judul_prestasi',$keywords,'BOTH');
        $this->orLike('prestasi.website',$keywords,'BOTH');
        $this->orLike('prestasi.isi',$keywords,'BOTH');
        $this->orderBy('prestasi.id_prestasi','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('prestasi');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // total_kategori_prestasi
    public function total_kategori_prestasi($id_kategori_prestasi)
    {
        $builder = $this->db->table('prestasi');

        $builder->where('id_kategori_prestasi',$id_kategori_prestasi);

        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('prestasi.*, kategori_prestasi.nama_kategori_prestasi, kategori_prestasi.slug_kategori_prestasi, users.nama');
        $builder->join('kategori_prestasi','kategori_prestasi.id_kategori_prestasi = prestasi.id_kategori_prestasi','LEFT');
        $builder->join('users','users.id_user = prestasi.id_user','LEFT');
        $builder->where('prestasi.id_prestasi',$id_prestasi);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('prestasi');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('prestasi');
        $builder->where('id_prestasi',$data['id_prestasi']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('prestasi');
        $builder->where('jenis_prestasi','Homepage');
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // prestasi
    public function jenis_prestasi($jenis_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->where('jenis_prestasi',$jenis_prestasi);
        $builder->limit(5);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // prestasi
    public function jenis_prestasi_1($jenis_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->where('jenis_prestasi',$jenis_prestasi);
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // prestasi
    public function prestasi()
    {
        $builder = $this->db->table('prestasi');
        $builder->where('jenis_prestasi','Prestasi');
        $builder->orderBy('prestasi.id_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}