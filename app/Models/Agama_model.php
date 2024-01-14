<?php 
namespace App\Models;

use CodeIgniter\Model;

class Agama_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'agama';
    protected $primaryKey = 'id_agama';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('agama');
        $builder->select('*');
        $builder->orderBy('agama.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // cari
    public function cari($keywords)
    {
        $builder = $this->db->table('agama');
        $builder->select('*');
        $builder->like('nama_agama',$keywords,'BOTH');
        $builder->orderBy('agama.urutan','ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('agama');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('agama.id_agama','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_agama)
    {
        $builder = $this->db->table('agama');
        $builder->where('id_agama',$id_agama);
        $builder->orderBy('agama.id_agama','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('agama');
        $builder->where('id_agama',$data['id_agama']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('agama');
        $builder->insert($data);
    }

    // tambah  log
    public function agama_log($data)
    {
        $builder = $this->db->table('agama_logs');
        $builder->insert($data);
    }
}