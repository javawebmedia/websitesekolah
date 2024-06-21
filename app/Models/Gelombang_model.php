<?php 
namespace App\Models;

use CodeIgniter\Model;

class Gelombang_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'gelombang';
    protected $primaryKey = 'id_gelombang';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('gelombang');
        $builder->select('*');
        $builder->orderBy('gelombang.id_gelombang','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // cari
    public function cari($keywords)
    {
        $builder = $this->db->table('gelombang');
        $builder->select('*');
        $builder->like('nama_gelombang',$keywords,'BOTH');
        $builder->orderBy('gelombang.id_gelombang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('gelombang');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('gelombang.id_gelombang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // siswa
    public function siswa($id_gelombang)
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_gelombang)
    {
        $builder = $this->db->table('gelombang');
        $builder->where('id_gelombang',$id_gelombang);
        $builder->orderBy('gelombang.id_gelombang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('gelombang');
        $builder->where('id_gelombang',$data['id_gelombang']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('gelombang');
        $builder->insert($data);
    }

    // tambah  log
    public function gelombang_log($data)
    {
        $builder = $this->db->table('gelombang_logs');
        $builder->insert($data);
    }
}