<?php namespace App\Models;

use CodeIgniter\Model;

class Client_model extends Model
{

	protected $table = 'client';
    protected $primaryKey = 'id_client';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('client');
        $builder->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $builder->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $builder->join('users','users.id_user = client.id_user','LEFT');
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // home
    public function home()
    {
        $builder = $this->db->table('client');
        $builder->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $builder->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $builder->join('users','users.id_user = client.id_user','LEFT');
        $builder->limit(6);
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function jenis_client_depan($jenis_client)
    {
        $builder = $this->db->table('client');
        $builder->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $builder->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $builder->join('users','users.id_user = client.id_user','LEFT');
        $builder->where('client.jenis_client',$jenis_client);
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('client');
        $this->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $this->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $this->join('users','users.id_user = client.id_user','LEFT');
        $this->limit($limit,$start);
        $this->orderBy('client.id_client','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('client');
        $this->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $this->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $this->join('users','users.id_user = client.id_user','LEFT');
        $this->like('client.judul_client',$keywords,'BOTH');
        $this->orLike('client.website',$keywords,'BOTH');
        $this->orLike('client.isi',$keywords,'BOTH');
        $this->limit($limit,$start);
        $this->orderBy('client.id_client','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('client');
        $this->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama AS nama_user');
        $this->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $this->join('users','users.id_user = client.id_user','LEFT');
        $this->like('client.judul_client',$keywords,'BOTH');
        $this->orLike('client.website',$keywords,'BOTH');
        $this->orLike('client.isi',$keywords,'BOTH');
        $this->orderBy('client.id_client','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('client');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // Listing
    public function semua($status_client,$limit,$start)
    {
        $this->table('client');
        $this->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $this->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $this->join('users','users.id_user = client.id_user','LEFT');
        $this->where('client.status_client',$status_client);
        $this->limit($limit,$start);
        $this->orderBy('client.id_client','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_status($status_client)
    {
        $builder = $this->db->table('client');
        $builder->select('COUNT(*) AS total');
        $builder->where('client.status_client',$status_client);
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function login($username,$password)
    {
        $builder = $this->db->table('client');
        $builder->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $builder->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $builder->join('users','users.id_user = client.id_user','LEFT');
        $builder->where('client.email',$username);
        $builder->where('client.password',$password);
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_client)
    {
        $builder = $this->db->table('client');
        $builder->select('client.*, kategori_client.nama_kategori_client, kategori_client.slug_kategori_client, users.nama');
        $builder->join('kategori_client','kategori_client.id_kategori_client = client.id_kategori_client','LEFT');
        $builder->join('users','users.id_user = client.id_user','LEFT');
        $builder->where('client.id_client',$id_client);
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('client');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('client');
        $builder->where('id_client',$data['id_client']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('client');
        $builder->where('jenis_client','Homepage');
        $builder->orderBy('client.id_client','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // client
    public function jenis_client($jenis_client)
    {
        $builder = $this->db->table('client');
        $builder->where('jenis_client',$jenis_client);
        $builder->limit(5);
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // client
    public function jenis_client_1($jenis_client)
    {
        $builder = $this->db->table('client');
        $builder->where('jenis_client',$jenis_client);
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // client
    public function client()
    {
        $builder = $this->db->table('client');
        $builder->where('jenis_client','Client');
        $builder->orderBy('client.id_client','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}