<?php 
namespace App\Models;

use CodeIgniter\Model;

class Rombel_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'rombel';
    protected $primaryKey = 'id_rombel';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->orderBy('tahun.tahun_mulai','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_kelas
    public function tahun($id_tahun)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->groupBy('rombel.id_tahun');
        $builder->orderBy('kelas.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_kelas
    public function kelas_tahun($id_tahun)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->groupBy('rombel.id_kelas');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_kelas
    public function kelas_tahun_staff($id_tahun,$id_staff)
    {
        $builder = $this->db->table('rombel');
         $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.keterangan AS keterangan_jenjang,
                        jenjang.id_jenjang,
                        staff_rombel.status_guru_rombel,');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->join('staff_rombel','staff_rombel.id_rombel = rombel.id_rombel');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->where('staff_rombel.id_staff',$id_staff);
        $builder->groupBy('rombel.id_kelas');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_kelas
    public function tahun_detail($id_tahun)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->groupBy('rombel.id_tahun');
        $builder->orderBy('kelas.urutan','ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // all_jenjang
    public function all_jenjang($id_tahun)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.keterangan AS keterangan_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->groupBy('kelas.id_jenjang');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_jenjang
    public function all_jenjang_staff($id_tahun,$id_staff)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.keterangan AS keterangan_jenjang,
                        jenjang.id_jenjang,
                        staff_rombel.status_guru_rombel,');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->join('staff_rombel','staff_rombel.id_rombel = rombel.id_rombel');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->where('staff_rombel.id_staff',$id_staff);
        $builder->groupBy('kelas.id_jenjang');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_jenjang
    public function all_jenjang_kelas($id_tahun,$id_jenjang)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.keterangan AS keterangan_jenjang,
                        jenjang.id_jenjang,
                        staff_rombel.status_guru_rombel,');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->join('staff_rombel','staff_rombel.id_rombel = rombel.id_rombel');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->where('jenjang.id_jenjang',$id_jenjang);
        $builder->groupBy('rombel.id_kelas');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all_jenjang
    public function all_jenjang_kelas_staff($id_tahun,$id_jenjang,$id_staff)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.keterangan AS keterangan_jenjang,
                        jenjang.id_jenjang,
                        staff_rombel.status_guru_rombel,');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->join('staff_rombel','staff_rombel.id_rombel = rombel.id_rombel');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->where('jenjang.id_jenjang',$id_jenjang);
        $builder->where('staff_rombel.id_staff',$id_staff);
        $builder->groupBy('rombel.id_kelas');
        $builder->orderBy('jenjang.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // kelas
    public function kelas($id_kelas)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_kelas',$id_kelas);
        $builder->orderBy('rombel.urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('rombel');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('rombel.id_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function akhir()
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->orderBy('tahun.tahun_mulai','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

     // detail
    public function akhir_tahun($id_tahun)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->orderBy('tahun.tahun_mulai','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // check
    public function check($id_tahun,$id_kelas)
    {
        $builder = $this->db->table('rombel');
        $builder->select('*');
        $builder->where('rombel.id_tahun',$id_tahun);
        $builder->where('rombel.id_kelas',$id_kelas);
        $builder->orderBy('rombel.id_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_rombel)
    {
        $builder = $this->db->table('rombel');
        $builder->select('rombel.*,
                        kelas.nama_kelas, 
                        kelas.keterangan AS keterangan_kelas, 
                        tahun.nama_tahun, 
                        tahun.tahun_mulai, 
                        tahun.tahun_selesai,
                        jenjang.nama_jenjang,
                        jenjang.id_jenjang');
        $builder->join('kelas','kelas.id_kelas = rombel.id_kelas');
        $builder->join('tahun','tahun.id_tahun = rombel.id_tahun');
        $builder->join('jenjang','jenjang.id_jenjang = kelas.id_jenjang');
        $builder->where('rombel.id_rombel',$id_rombel);
        $builder->orderBy('rombel.id_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // hapus
    public function hapus($data)
    {
        $builder = $this->db->table('rombel');
        $builder->where('id_tahun',$data['id_tahun']);
        $builder->delete($data);
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('rombel');
        $builder->where('id_rombel',$data['id_rombel']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('rombel');
        $builder->insert($data);
    }

    // tambah  log
    public function rombel_log($data)
    {
        $builder = $this->db->table('rombel_logs');
        $builder->insert($data);
    }
}