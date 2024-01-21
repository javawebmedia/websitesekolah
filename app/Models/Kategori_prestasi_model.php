<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_prestasi_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_prestasi';
    protected $primaryKey       = 'id_kategori_prestasi';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_prestasi');
        $builder->select('*');
        $builder->orderBy('kategori_prestasi.id_kategori_prestasi','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function prestasi($id_kategori_prestasi)
    {
        $builder = $this->db->table('prestasi');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_prestasi',$id_kategori_prestasi);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_prestasi');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_prestasi.id_kategori_prestasi','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_prestasi)
    {
        $builder = $this->db->table('kategori_prestasi');
        $builder->where('id_kategori_prestasi',$id_kategori_prestasi);
        $builder->orderBy('kategori_prestasi.id_kategori_prestasi','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_kategori_prestasi)
    {
        $builder = $this->db->table('kategori_prestasi');
        $builder->where('slug_kategori_prestasi',$slug_kategori_prestasi);
        $builder->orderBy('kategori_prestasi.id_kategori_prestasi','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_prestasi');
        $builder->where('id_kategori_prestasi',$data['id_kategori_prestasi']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_prestasi');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_prestasi_log($data)
    {
        $builder = $this->db->table('kategori_prestasi_logs');
        $builder->insert($data);
    }
}