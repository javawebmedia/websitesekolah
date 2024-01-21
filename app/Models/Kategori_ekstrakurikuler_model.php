<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_ekstrakurikuler_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_ekstrakurikuler';
    protected $primaryKey       = 'id_kategori_ekstrakurikuler';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_ekstrakurikuler');
        $builder->select('*');
        $builder->orderBy('kategori_ekstrakurikuler.id_kategori_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function ekstrakurikuler($id_kategori_ekstrakurikuler)
    {
        $builder = $this->db->table('ekstrakurikuler');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_ekstrakurikuler',$id_kategori_ekstrakurikuler);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_ekstrakurikuler');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_ekstrakurikuler.id_kategori_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_ekstrakurikuler)
    {
        $builder = $this->db->table('kategori_ekstrakurikuler');
        $builder->where('id_kategori_ekstrakurikuler',$id_kategori_ekstrakurikuler);
        $builder->orderBy('kategori_ekstrakurikuler.id_kategori_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_kategori_ekstrakurikuler)
    {
        $builder = $this->db->table('kategori_ekstrakurikuler');
        $builder->where('slug_kategori_ekstrakurikuler',$slug_kategori_ekstrakurikuler);
        $builder->orderBy('kategori_ekstrakurikuler.id_kategori_ekstrakurikuler','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_ekstrakurikuler');
        $builder->where('id_kategori_ekstrakurikuler',$data['id_kategori_ekstrakurikuler']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_ekstrakurikuler');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_ekstrakurikuler_log($data)
    {
        $builder = $this->db->table('kategori_ekstrakurikuler_logs');
        $builder->insert($data);
    }
}