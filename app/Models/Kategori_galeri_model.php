<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_galeri_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_galeri';
    protected $primaryKey       = 'id_kategori_galeri';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_galeri');
        $builder->select('*');
        $builder->orderBy('kategori_galeri.id_kategori_galeri','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function galeri($id_kategori_galeri)
    {
        $builder = $this->db->table('galeri');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_galeri',$id_kategori_galeri);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_galeri');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_galeri.id_kategori_galeri','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_galeri)
    {
        $builder = $this->db->table('kategori_galeri');
        $builder->where('id_kategori_galeri',$id_kategori_galeri);
        $builder->orderBy('kategori_galeri.id_kategori_galeri','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_galeri');
        $builder->where('id_kategori_galeri',$data['id_kategori_galeri']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_galeri');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_galeri_log($data)
    {
        $builder = $this->db->table('kategori_galeri_logs');
        $builder->insert($data);
    }
}