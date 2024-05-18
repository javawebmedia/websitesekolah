<?php namespace App\Models;

use CodeIgniter\Model;

class Ekstrakurikuler_model extends Model
{

	protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'id_ekstrakurikuler';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // read
    public function read($slug_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $builder->where('ekstrakurikuler.slug_ekstrakurikuler',$slug_ekstrakurikuler);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // home
    public function home($limit,$status_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $builder->where('ekstrakurikuler.status_ekstrakurikuler',$status_ekstrakurikuler);
        $this->limit((int)$limit);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function status_ekstrakurikuler($limit,$start,$status_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $builder->where('ekstrakurikuler.status_ekstrakurikuler',$status_ekstrakurikuler);
        $builder->limit($limit,$start);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_kategori_ekstrakurikuler
    public function total_status_ekstrakurikuler($status_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('status_ekstrakurikuler',$status_ekstrakurikuler);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // kategori_ekstrakurikuler
    public function kategori_ekstrakurikuler($limit, $start, $slug_kategori_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');

        $builder->where('kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler',$slug_kategori_ekstrakurikuler);
        $builder->limit($limit,$start);

        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // kategori_ekstrakurikuler_home
    public function kategori_ekstrakurikuler_status($limit, $start, $id_kategori_ekstrakurikuler,$status_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $builder->where(array(  'ekstrakurikuler.id_kategori_ekstrakurikuler' => $id_kategori_ekstrakurikuler,
                                'ekstrakurikuler.status_ekstrakurikuler'      => $status_ekstrakurikuler
                        ));
        $builder->limit($limit,$start);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_kategori_ekstrakurikuler
    public function total_kategori_ekstrakurikuler_status($id_kategori_ekstrakurikuler,$status_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('id_kategori_ekstrakurikuler',$id_kategori_ekstrakurikuler);
        $builder->where('status_ekstrakurikuler',$status_ekstrakurikuler);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('ekstrakurikuler');
        $this->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $this->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $this->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('ekstrakurikuler');
        $this->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $this->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $this->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $this->like('ekstrakurikuler.judul_ekstrakurikuler',$keywords,'BOTH');
        $this->orLike('ekstrakurikuler.website',$keywords,'BOTH');
        $this->orLike('ekstrakurikuler.isi',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('ekstrakurikuler');
        $this->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama AS nama_user');
        $this->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $this->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $this->like('ekstrakurikuler.judul_ekstrakurikuler',$keywords,'BOTH');
        $this->orLike('ekstrakurikuler.website',$keywords,'BOTH');
        $this->orLike('ekstrakurikuler.isi',$keywords,'BOTH');
        $this->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('ekstrakurikuler');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // total_kategori_ekstrakurikuler
    public function total_kategori_ekstrakurikuler($id_kategori_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');

        $builder->where('id_kategori_ekstrakurikuler',$id_kategori_ekstrakurikuler);

        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('ekstrakurikuler.*, kategori_ekstrakurikuler.nama_kategori_ekstrakurikuler, kategori_ekstrakurikuler.slug_kategori_ekstrakurikuler, users.nama');
        $builder->join('kategori_ekstrakurikuler','kategori_ekstrakurikuler.id_kategori_ekstrakurikuler = ekstrakurikuler.id_kategori_ekstrakurikuler','LEFT');
        $builder->join('users','users.id_user = ekstrakurikuler.id_user','LEFT');
        $builder->where('ekstrakurikuler.id_ekstrakurikuler',$id_ekstrakurikuler);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('id_ekstrakurikuler',$data['id_ekstrakurikuler']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('jenis_ekstrakurikuler','Homepage');
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // ekstrakurikuler
    public function jenis_ekstrakurikuler($jenis_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('jenis_ekstrakurikuler',$jenis_ekstrakurikuler);
        $builder->limit(5);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // ekstrakurikuler
    public function jenis_ekstrakurikuler_1($jenis_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('jenis_ekstrakurikuler',$jenis_ekstrakurikuler);
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // ekstrakurikuler
    public function ekstrakurikuler()
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->where('jenis_ekstrakurikuler','Ekstrakurikuler');
        $builder->orderBy('ekstrakurikuler.id_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}