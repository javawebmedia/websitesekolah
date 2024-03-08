<?php 
namespace App\Models;

use CodeIgniter\Model;

class Jenis_dokumen_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'jenis_dokumen';
    protected $primaryKey       = 'id_jenis_dokumen';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('jenis_dokumen');
        $builder->select('*');
        $builder->orderBy('jenis_dokumen.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function cabang($id_jenis_dokumen)
    {
        $builder = $this->db->table('cabang');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_jenis_dokumen',$id_jenis_dokumen);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('jenis_dokumen');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('jenis_dokumen.id_jenis_dokumen','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_jenis_dokumen)
    {
        $builder = $this->db->table('jenis_dokumen');
        $builder->where('id_jenis_dokumen',$id_jenis_dokumen);
        $builder->orderBy('jenis_dokumen.id_jenis_dokumen','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('jenis_dokumen');
        $builder->where('id_jenis_dokumen',$data['id_jenis_dokumen']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('jenis_dokumen');
        $builder->insert($data);
    }

    // tambah  log
    public function jenis_dokumen_log($data)
    {
        $builder = $this->db->table('jenis_dokumen_logs');
        $builder->insert($data);
    }
}