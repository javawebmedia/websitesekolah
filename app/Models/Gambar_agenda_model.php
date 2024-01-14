<?php 
namespace App\Models;

use CodeIgniter\Model;
class Gambar_agenda_model extends Model
{
    protected $table = 'gambar_agenda';
    protected $primaryKey = 'id_gambar_agenda';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_gambar_agenda','judul','gambar_agenda','keterangan'];

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
        $builder = $this->db->table('gambar_agenda');
        $builder->orderBy('gambar_agenda.id_gambar_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // agenda
    public function agenda($id_agenda)
    {
        $builder = $this->db->table('gambar_agenda');
        $builder->where('id_agenda',$id_agenda);
        $builder->orderBy('gambar_agenda.id_gambar_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('gambar_agenda');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('gambar_agenda.id_gambar_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // detail
    public function detail($id_gambar_agenda)
    {
        $builder = $this->db->table('gambar_agenda');
        $builder->where('id_gambar_agenda',$id_gambar_agenda);
        $builder->orderBy('gambar_agenda.id_gambar_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // read
    public function read($slug_gambar_agenda)
    {
        $builder = $this->db->table('gambar_agenda');
        $builder->where('slug_gambar_agenda',$slug_gambar_agenda);
        $builder->orderBy('gambar_agenda.id_gambar_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('gambar_agenda');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('gambar_agenda');
        $builder->where('id_gambar_agenda',$data['id_gambar_agenda']);
        $builder->update($data);
    }

}