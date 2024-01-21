<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_fasilitas_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_fasilitas';
    protected $primaryKey       = 'id_kategori_fasilitas';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_fasilitas');
        $builder->select('*');
        $builder->orderBy('kategori_fasilitas.id_kategori_fasilitas','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function fasilitas($id_kategori_fasilitas)
    {
        $builder = $this->db->table('fasilitas');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_fasilitas',$id_kategori_fasilitas);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_fasilitas');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_fasilitas.id_kategori_fasilitas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_fasilitas)
    {
        $builder = $this->db->table('kategori_fasilitas');
        $builder->where('id_kategori_fasilitas',$id_kategori_fasilitas);
        $builder->orderBy('kategori_fasilitas.id_kategori_fasilitas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_kategori_fasilitas)
    {
        $builder = $this->db->table('kategori_fasilitas');
        $builder->where('slug_kategori_fasilitas',$slug_kategori_fasilitas);
        $builder->orderBy('kategori_fasilitas.id_kategori_fasilitas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_fasilitas');
        $builder->where('id_kategori_fasilitas',$data['id_kategori_fasilitas']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_fasilitas');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_fasilitas_log($data)
    {
        $builder = $this->db->table('kategori_fasilitas_logs');
        $builder->insert($data);
    }
}