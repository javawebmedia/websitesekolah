<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori');
        $builder->select('*');
        $builder->orderBy('kategori.id_kategori','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori.id_kategori','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori)
    {
        $builder = $this->db->table('kategori');
        $builder->where('id_kategori',$id_kategori);
        $builder->orderBy('kategori.id_kategori','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_kategori)
    {
        $builder = $this->db->table('kategori');
        $builder->where('slug_kategori',$slug_kategori);
        $builder->orderBy('kategori.id_kategori','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori');
        $builder->where('id_kategori',$data['id_kategori']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_log($data)
    {
        $builder = $this->db->table('kategori_logs');
        $builder->insert($data);
    }
}