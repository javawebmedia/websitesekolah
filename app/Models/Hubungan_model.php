<?php 
namespace App\Models;

use CodeIgniter\Model;

class Hubungan_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'hubungan';
    protected $primaryKey = 'id_hubungan';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('hubungan');
        $builder->select('*');
        $builder->orderBy('hubungan.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // cari
    public function cari($keywords)
    {
        $builder = $this->db->table('hubungan');
        $builder->select('*');
         $builder->like('nama_hubungan',$keywords,'BOTH');
        $builder->orderBy('hubungan.urutan','ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('hubungan');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('hubungan.id_hubungan','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_hubungan)
    {
        $builder = $this->db->table('hubungan');
        $builder->where('id_hubungan',$id_hubungan);
        $builder->orderBy('hubungan.id_hubungan','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('hubungan');
        $builder->where('id_hubungan',$data['id_hubungan']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('hubungan');
        $builder->insert($data);
    }

    // tambah  log
    public function hubungan_log($data)
    {
        $builder = $this->db->table('hubungan_logs');
        $builder->insert($data);
    }
}