<?php 
namespace App\Models;

use CodeIgniter\Model;

class Jenjang_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'jenjang';
    protected $primaryKey = 'id_jenjang';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('jenjang');
        $builder->select('*');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_aktif
    public function status_aktif($status_aktif)
    {
        $builder = $this->db->table('jenjang');
        $builder->select('*');
        $builder->where('status_aktif',$status_aktif);
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('jenjang');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('jenjang.id_jenjang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_jenjang)
    {
        $builder = $this->db->table('jenjang');
        $builder->where('id_jenjang',$id_jenjang);
        $builder->orderBy('jenjang.id_jenjang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('jenjang');
        $builder->where('id_jenjang',$data['id_jenjang']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('jenjang');
        $builder->insert($data);
    }

    // tambah  log
    public function jenjang_log($data)
    {
        $builder = $this->db->table('jenjang_logs');
        $builder->insert($data);
    }
}