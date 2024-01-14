<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_client_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_client';
    protected $primaryKey       = 'id_kategori_client';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_client');
        $builder->select('*');
        $builder->orderBy('kategori_client.id_kategori_client','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function client($id_kategori_client)
    {
        $builder = $this->db->table('client');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_client',$id_kategori_client);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_client');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_client.id_kategori_client','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_client)
    {
        $builder = $this->db->table('kategori_client');
        $builder->where('id_kategori_client',$id_kategori_client);
        $builder->orderBy('kategori_client.id_kategori_client','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_client');
        $builder->where('id_kategori_client',$data['id_kategori_client']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_client');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_client_log($data)
    {
        $builder = $this->db->table('kategori_client_logs');
        $builder->insert($data);
    }
}