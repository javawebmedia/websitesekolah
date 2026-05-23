<?php 
namespace App\Models;

use CodeIgniter\Model;
class Kategori_jurusan_model extends Model
{
    protected $table = 'kategori_jurusan';
    protected $primaryKey = 'id_kategori_jurusan';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [''];

    protected $useTimestamps = false;
    protected $createdField  = 'tanggal_post';
    protected $updatedField  = 'tanggal';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->orderBy('kategori_jurusan.id_kategori_jurusan','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function home()
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->where('status_kategori_jurusan','Publish');
        $builder->orderBy('kategori_jurusan.id_kategori_jurusan','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // testimoni
    public function testimoni()
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->where('status_kategori_jurusan','Publish');
        $builder->orderBy('kategori_jurusan.id_kategori_jurusan','DESC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_jurusan.id_kategori_jurusan','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // detail
    public function detail($id_kategori_jurusan)
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->where('id_kategori_jurusan',$id_kategori_jurusan);
        $builder->orderBy('kategori_jurusan.id_kategori_jurusan','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // read
    public function read($slug_kategori_jurusan)
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->where('slug_kategori_jurusan',$slug_kategori_jurusan);
        $builder->orderBy('kategori_jurusan.id_kategori_jurusan','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('kategori_jurusan');
        $builder->where('id_kategori_jurusan',$data['id_kategori_jurusan']);
        $builder->update($data);
    }

}