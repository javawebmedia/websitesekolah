<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_staff_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_staff';
    protected $primaryKey       = 'id_kategori_staff';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_staff');
        $builder->select('*');
        $builder->orderBy('kategori_staff.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function staff($id_kategori_staff)
    {
        $builder = $this->db->table('staff');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_staff',$id_kategori_staff);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_staff');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_staff.id_kategori_staff','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_staff)
    {
        $builder = $this->db->table('kategori_staff');
        $builder->where('id_kategori_staff',$id_kategori_staff);
        $builder->orderBy('kategori_staff.id_kategori_staff','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_staff');
        $builder->where('id_kategori_staff',$data['id_kategori_staff']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_staff');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_staff_log($data)
    {
        $builder = $this->db->table('kategori_staff_logs');
        $builder->insert($data);
    }
}