<?php 
namespace App\Models;

use CodeIgniter\Model;

class Pekerjaan_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'pekerjaan';
    protected $primaryKey = 'id_pekerjaan';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('pekerjaan');
        $builder->select('*');
        $builder->orderBy('pekerjaan.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // cari
    public function cari($keywords='')
    {
        $builder = $this->db->table('pekerjaan');
        $builder->select('*');
        if($keywords=='') {}else{
            $builder->like('nama_pekerjaan',$keywords,'BOTH');
        }
        $builder->orderBy('pekerjaan.urutan','ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('pekerjaan');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('pekerjaan.id_pekerjaan','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_pekerjaan)
    {
        $builder = $this->db->table('pekerjaan');
        $builder->where('id_pekerjaan',$id_pekerjaan);
        $builder->orderBy('pekerjaan.id_pekerjaan','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('pekerjaan');
        $builder->where('id_pekerjaan',$data['id_pekerjaan']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('pekerjaan');
        $builder->insert($data);
    }

    // tambah  log
    public function pekerjaan_log($data)
    {
        $builder = $this->db->table('pekerjaan_logs');
        $builder->insert($data);
    }
}