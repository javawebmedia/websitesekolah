<?php namespace App\Models;

use CodeIgniter\Model;

class Anggota_model extends Model
{

	protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('anggota');
        $builder->select('anggota.*, pekerjaan.nama_pekerjaan, users.nama');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = anggota.id_pekerjaan','LEFT');
        $builder->join('users','users.id_user = anggota.id_user','LEFT');
        $builder->orderBy('anggota.id_anggota','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function jenis_anggota_depan($jenis_anggota)
    {
        $builder = $this->db->table('anggota');
        $builder->select('anggota.*, pekerjaan.nama_pekerjaan, users.nama');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = anggota.id_pekerjaan','LEFT');
        $builder->join('users','users.id_user = anggota.id_user','LEFT');
        $builder->where('anggota.jenis_anggota',$jenis_anggota);
        $builder->orderBy('anggota.id_anggota','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('anggota');
        $this->select('anggota.*, pekerjaan.nama_pekerjaan, users.nama');
        $this->join('pekerjaan','pekerjaan.id_pekerjaan = anggota.id_pekerjaan','LEFT');
        $this->join('users','users.id_user = anggota.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('anggota.id_anggota','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('anggota');
        $this->select('anggota.*, pekerjaan.nama_pekerjaan, users.nama');
        $this->join('pekerjaan','pekerjaan.id_pekerjaan = anggota.id_pekerjaan','LEFT');
        $this->join('users','users.id_user = anggota.id_user','LEFT');
        $this->like('anggota.judul_anggota',$keywords,'BOTH');
        $this->orLike('anggota.website',$keywords,'BOTH');
        $this->orLike('anggota.isi',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('anggota.id_anggota','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('anggota');
        $this->select('anggota.*, pekerjaan.nama_pekerjaan, users.nama AS nama_user');
        $this->join('pekerjaan','pekerjaan.id_pekerjaan = anggota.id_pekerjaan','LEFT');
        $this->join('users','users.id_user = anggota.id_user','LEFT');
        $this->like('anggota.judul_anggota',$keywords,'BOTH');
        $this->orLike('anggota.website',$keywords,'BOTH');
        $this->orLike('anggota.isi',$keywords,'BOTH');
        $this->orderBy('anggota.id_anggota','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('anggota');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_anggota)
    {
        $builder = $this->db->table('anggota');
        $builder->select('anggota.*, pekerjaan.nama_pekerjaan, users.nama');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = anggota.id_pekerjaan','LEFT');
        $builder->join('users','users.id_user = anggota.id_user','LEFT');
        $builder->where('anggota.id_anggota',$id_anggota);
        $builder->orderBy('anggota.id_anggota','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('anggota');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('anggota');
        $builder->where('id_anggota',$data['id_anggota']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('anggota');
        $builder->where('jenis_anggota','Homepage');
        $builder->orderBy('anggota.id_anggota','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // anggota
    public function jenis_anggota($jenis_anggota)
    {
        $builder = $this->db->table('anggota');
        $builder->where('jenis_anggota',$jenis_anggota);
        $builder->limit(5);
        $builder->orderBy('anggota.id_anggota','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // anggota
    public function jenis_anggota_1($jenis_anggota)
    {
        $builder = $this->db->table('anggota');
        $builder->where('jenis_anggota',$jenis_anggota);
        $builder->orderBy('anggota.id_anggota','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // anggota
    public function anggota()
    {
        $builder = $this->db->table('anggota');
        $builder->where('jenis_anggota','Anggota');
        $builder->orderBy('anggota.id_anggota','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}