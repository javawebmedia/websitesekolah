<?php 
namespace App\Models;

use CodeIgniter\Model;

class Tingkatan_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'tingkatan';
    protected $primaryKey       = 'id_tingkatan';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('tingkatan');
        $builder->select('*');
        $builder->orderBy('tingkatan.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function anggota($id_tingkatan)
    {
        $builder = $this->db->table('anggota');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_tingkatan',$id_tingkatan);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('tingkatan');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('tingkatan.urutan','ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_tingkatan)
    {
        $builder = $this->db->table('tingkatan');
        $builder->where('id_tingkatan',$id_tingkatan);
        $builder->orderBy('tingkatan.urutan','ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('tingkatan');
        $builder->where('id_tingkatan',$data['id_tingkatan']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('tingkatan');
        $builder->insert($data);
    }

    // tambah  log
    public function tingkatan_log($data)
    {
        $builder = $this->db->table('tingkatan_logs');
        $builder->insert($data);
    }
}