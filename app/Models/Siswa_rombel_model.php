<?php 
namespace App\Models;

use CodeIgniter\Model;

class Siswa_rombel_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'siswa_rombel';
    protected $primaryKey       = 'id_siswa_rombel';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->select('siswa_rombel.*,
                        siswa.nama_siswa,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('siswa','siswa.id_siswa = siswa_rombel.id_siswa','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = siswa_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = siswa_rombel.id_rombel','LEFT');
        $builder->orderBy('siswa.nama_siswa','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // rombel
    public function rombel($id_rombel)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->select('siswa_rombel.*,
                        siswa.nama_siswa,
                        siswa.nis,
                        siswa.nisn,
                        siswa.tempat_lahir,
                        siswa.tanggal_lahir,
                        siswa.jenis_kelamin,
                        kelas.nama_kelas,
                        kelas.id_jenjang,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('siswa','siswa.id_siswa = siswa_rombel.id_siswa','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = siswa_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = siswa_rombel.id_rombel','LEFT');
        $builder->where('siswa_rombel.id_rombel',$id_rombel);
        $builder->orderBy('siswa_rombel.id_siswa_rombel','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_siswa_rombel
    public function status_siswa_rombel($status_siswa_rombel)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->select('siswa_rombel.*,
                        siswa.nama_siswa,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('siswa','siswa.id_siswa = siswa_rombel.id_siswa','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = siswa_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = siswa_rombel.id_rombel','LEFT');
        $builder->where('status_siswa_rombel',$status_siswa_rombel);
        $builder->orderBy('siswa_rombel.id_siswa_rombel','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('siswa_rombel.id_siswa_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total_rombel($id_tahun,$id_kelas)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_tahun',$id_tahun);
        $builder->where('id_kelas',$id_kelas);
        $builder->orderBy('siswa_rombel.id_siswa_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // last_id
    public function last_id()
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->orderBy('siswa_rombel.id_siswa_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_siswa_rombel)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->select('siswa_rombel.*,
                        siswa.nama_siswa,
                        siswa.nis,
                        siswa.nisn,
                        siswa.tempat_lahir,
                        siswa.tanggal_lahir,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,
                        jenjang.id_jenjang,
                        jenjang.nama_jenjang,
                        rombel.id_rombel');
        $builder->join('rombel','rombel.id_rombel = siswa_rombel.id_rombel','LEFT');
        $builder->join('siswa','siswa.id_siswa = siswa_rombel.id_siswa','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang','LEFT');
        $builder->join('tahun','tahun.id_tahun = siswa_rombel.id_tahun','LEFT');
        $builder->where('siswa_rombel.id_siswa_rombel',$id_siswa_rombel);
        $builder->orderBy('siswa_rombel.id_siswa_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // check
    public function check($data)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->where('id_siswa',$data['id_siswa']);
        $builder->where('id_tahun',$data['id_tahun']);
        $builder->where('id_kelas',$data['id_kelas']);
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->where('id_siswa_rombel',$data['id_siswa_rombel']);
        $builder->update($data);
    }

    // edit
    public function hapus($data)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->where('id_siswa_rombel',$data['id_siswa_rombel']);
        $builder->delete($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('siswa_rombel');
        $builder->insert($data);
    }

    // tambah  log
    public function siswa_rombel_log($data)
    {
        $builder = $this->db->table('siswa_rombel_logs');
        $builder->insert($data);
    }
}