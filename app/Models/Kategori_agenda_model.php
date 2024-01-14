<?php 
namespace App\Models;

use CodeIgniter\Model;
class Kategori_agenda_model extends Model
{
    protected $table = 'kategori_agenda';
    protected $primaryKey = 'id_kategori_agenda';

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
        $builder = $this->db->table('kategori_agenda');
        $builder->orderBy('kategori_agenda.id_kategori_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function home()
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->where('status_kategori_agenda','Publish');
        $builder->orderBy('kategori_agenda.id_kategori_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // testimoni
    public function testimoni()
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->where('status_kategori_agenda','Publish');
        $builder->orderBy('kategori_agenda.id_kategori_agenda','DESC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_agenda.id_kategori_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // detail
    public function detail($id_kategori_agenda)
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->where('id_kategori_agenda',$id_kategori_agenda);
        $builder->orderBy('kategori_agenda.id_kategori_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // read
    public function read($slug_kategori_agenda)
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->where('slug_kategori_agenda',$slug_kategori_agenda);
        $builder->orderBy('kategori_agenda.id_kategori_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('kategori_agenda');
        $builder->where('id_kategori_agenda',$data['id_kategori_agenda']);
        $builder->update($data);
    }

}