<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_cabang_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_cabang';
    protected $primaryKey       = 'id_kategori_cabang';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_cabang');
        $builder->select('*');
        $builder->orderBy('kategori_cabang.id_kategori_cabang','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function cabang($id_kategori_cabang)
    {
        $builder = $this->db->table('cabang');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_cabang',$id_kategori_cabang);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_cabang');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_cabang.id_kategori_cabang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_cabang)
    {
        $builder = $this->db->table('kategori_cabang');
        $builder->where('id_kategori_cabang',$id_kategori_cabang);
        $builder->orderBy('kategori_cabang.id_kategori_cabang','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_cabang');
        $builder->where('id_kategori_cabang',$data['id_kategori_cabang']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_cabang');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_cabang_log($data)
    {
        $builder = $this->db->table('kategori_cabang_logs');
        $builder->insert($data);
    }
}