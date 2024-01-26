<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kelas_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*,jenjang.nama_jenjang, jenjang.keterangan AS keterangan_jenjang');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->orderBy('kelas.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_jenjang
    public function all_jenjang()
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*,jenjang.nama_jenjang, jenjang.keterangan AS keterangan_jenjang');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->groupBy('jenjang.id_jenjang');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenjang
    public function jenjang($id_jenjang)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*,jenjang.nama_jenjang');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('kelas.id_jenjang',$id_jenjang);
        $builder->orderBy('kelas.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kelas');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kelas.id_kelas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*,jenjang.nama_jenjang, jenjang.keterangan AS keterangan_jenjang');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->orderBy('kelas.id_kelas','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kelas');
        $builder->where('id_kelas',$data['id_kelas']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kelas');
        $builder->insert($data);
    }

    // tambah  log
    public function kelas_log($data)
    {
        $builder = $this->db->table('kelas_logs');
        $builder->insert($data);
    }
}