<?php namespace App\Models;

use CodeIgniter\Model;

class Fasilitas_model extends Model
{

	protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // read
    public function read($slug_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');
        $builder->where('fasilitas.slug_fasilitas',$slug_fasilitas);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // home
    public function home($limit,$status_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');
        $builder->where('fasilitas.status_fasilitas',$status_fasilitas);
        $this->limit((int)$limit);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function status_fasilitas($limit,$start,$status_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');
        $builder->where('fasilitas.status_fasilitas',$status_fasilitas);
        $builder->limit($limit,$start);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_kategori_fasilitas
    public function total_status_fasilitas($status_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('status_fasilitas',$status_fasilitas);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // kategori_fasilitas
    public function kategori_fasilitas($limit, $start, $slug_kategori_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');

        $builder->where('kategori_fasilitas.slug_kategori_fasilitas',$slug_kategori_fasilitas);
        $builder->limit($limit,$start);

        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // kategori_fasilitas_home
    public function kategori_fasilitas_status($limit, $start, $id_kategori_fasilitas,$status_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');
        $builder->where(array(  'fasilitas.id_kategori_fasilitas' => $id_kategori_fasilitas,
                                'fasilitas.status_fasilitas'      => $status_fasilitas
                        ));
        $builder->limit($limit,$start);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_kategori_fasilitas
    public function total_kategori_fasilitas_status($id_kategori_fasilitas,$status_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('id_kategori_fasilitas',$id_kategori_fasilitas);
        $builder->where('status_fasilitas',$status_fasilitas);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('fasilitas');
        $this->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $this->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $this->join('users','users.id_user = fasilitas.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('fasilitas');
        $this->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $this->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $this->join('users','users.id_user = fasilitas.id_user','LEFT');
        $this->like('fasilitas.judul_fasilitas',$keywords,'BOTH');
        $this->orLike('fasilitas.website',$keywords,'BOTH');
        $this->orLike('fasilitas.isi',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('fasilitas');
        $this->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama AS nama_user');
        $this->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $this->join('users','users.id_user = fasilitas.id_user','LEFT');
        $this->like('fasilitas.judul_fasilitas',$keywords,'BOTH');
        $this->orLike('fasilitas.website',$keywords,'BOTH');
        $this->orLike('fasilitas.isi',$keywords,'BOTH');
        $this->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('fasilitas');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // total_kategori_fasilitas
    public function total_kategori_fasilitas($id_kategori_fasilitas)
    {
        $builder = $this->db->table('fasilitas');

        $builder->where('id_kategori_fasilitas',$id_kategori_fasilitas);

        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('fasilitas.*, kategori_fasilitas.nama_kategori_fasilitas, kategori_fasilitas.slug_kategori_fasilitas, users.nama');
        $builder->join('kategori_fasilitas','kategori_fasilitas.id_kategori_fasilitas = fasilitas.id_kategori_fasilitas','LEFT');
        $builder->join('users','users.id_user = fasilitas.id_user','LEFT');
        $builder->where('fasilitas.id_fasilitas',$id_fasilitas);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('fasilitas');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('id_fasilitas',$data['id_fasilitas']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('jenis_fasilitas','Homepage');
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // fasilitas
    public function jenis_fasilitas($jenis_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('jenis_fasilitas',$jenis_fasilitas);
        $builder->limit(5);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // fasilitas
    public function jenis_fasilitas_1($jenis_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('jenis_fasilitas',$jenis_fasilitas);
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // fasilitas
    public function fasilitas()
    {
        $builder = $this->db->table('fasilitas');
        $builder->where('jenis_fasilitas','Fasilitas');
        $builder->orderBy('fasilitas.id_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}