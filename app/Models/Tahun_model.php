<?php 
namespace App\Models;

use CodeIgniter\Model;

class Tahun_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'tahun';
    protected $primaryKey = 'id_tahun';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('tahun');
        $builder->select('*');
        $builder->orderBy('tahun.tahun_mulai','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('tahun');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('tahun.id_tahun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_tahun)
    {
        $builder = $this->db->table('tahun');
        $builder->where('id_tahun',$id_tahun);
        $builder->orderBy('tahun.id_tahun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('tahun');
        $builder->where('id_tahun',$data['id_tahun']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('tahun');
        $builder->insert($data);
    }

    // tambah  log
    public function tahun_log($data)
    {
        $builder = $this->db->table('tahun_logs');
        $builder->insert($data);
    }
}