<?php 
namespace App\Models;

use CodeIgniter\Model;
class Jadwal_model extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_jadwal','judul','jadwal','keterangan'];

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
        $builder = $this->db->table('jadwal');
        $builder->orderBy('jadwal.id_jadwal','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // agenda
    public function agenda($id_agenda)
    {
        $builder = $this->db->table('jadwal');
        $builder->where('id_agenda',$id_agenda);
        $builder->orderBy('jadwal.id_jadwal','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('jadwal');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('jadwal.id_jadwal','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // detail
    public function detail($id_jadwal)
    {
        $builder = $this->db->table('jadwal');
        $builder->where('id_jadwal',$id_jadwal);
        $builder->orderBy('jadwal.id_jadwal','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // read
    public function read($slug_jadwal)
    {
        $builder = $this->db->table('jadwal');
        $builder->where('slug_jadwal',$slug_jadwal);
        $builder->orderBy('jadwal.id_jadwal','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('jadwal');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('jadwal');
        $builder->where('id_jadwal',$data['id_jadwal']);
        $builder->update($data);
    }

}