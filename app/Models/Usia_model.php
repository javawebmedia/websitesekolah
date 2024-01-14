<?php 
namespace App\Models;

use CodeIgniter\Model;

class Usia_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'usia';
    protected $primaryKey = 'id_usia';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('usia');
        $builder->select('*');
        $builder->orderBy('usia.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_aktif
    public function status_aktif($status_aktif)
    {
        $builder = $this->db->table('usia');
        $builder->select('*');
        $builder->where('status_aktif',$status_aktif);
        $builder->orderBy('usia.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('usia');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('usia.id_usia','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_usia)
    {
        $builder = $this->db->table('usia');
        $builder->where('id_usia',$id_usia);
        $builder->orderBy('usia.id_usia','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('usia');
        $builder->where('id_usia',$data['id_usia']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('usia');
        $builder->insert($data);
    }

    // tambah  log
    public function usia_log($data)
    {
        $builder = $this->db->table('usia_logs');
        $builder->insert($data);
    }
}