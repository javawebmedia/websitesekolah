<?php 
namespace App\Models;

use CodeIgniter\Model;

class Staff_rombel_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'staff_rombel';
    protected $primaryKey       = 'id_staff_rombel';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('staff_rombel.*,
                        staff.nama,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('staff','staff.id_staff = staff_rombel.id_staff','LEFT');
        $builder->join('kelas','kelas.id_kelas = staff_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = staff_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = staff_rombel.id_rombel','LEFT');
        $builder->orderBy('staff.nama','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // rombel
    public function rombel($id_rombel)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('staff_rombel.*,
                        staff.nama,
                        staff.tempat_lahir,
                        staff.tanggal_lahir,
                        staff.jenis_kelamin,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('staff','staff.id_staff = staff_rombel.id_staff','LEFT');
        $builder->join('kelas','kelas.id_kelas = staff_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = staff_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = staff_rombel.id_rombel','LEFT');
        $builder->where('staff_rombel.id_rombel',$id_rombel);
        $builder->orderBy('staff_rombel.status_guru_rombel','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_staff_rombel
    public function status_staff_rombel($status_staff_rombel)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('staff_rombel.*,
                        staff.nama,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('staff','staff.id_staff = staff_rombel.id_staff','LEFT');
        $builder->join('kelas','kelas.id_kelas = staff_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = staff_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = staff_rombel.id_rombel','LEFT');
        $builder->where('status_staff_rombel',$status_staff_rombel);
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total_rombelnya($id_rombel)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_rombel',$id_rombel);
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total_rombel($id_tahun,$id_kelas,$status_guru_rombel)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('staff_rombel.*,
                        staff.nama,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('staff','staff.id_staff = staff_rombel.id_staff','LEFT');
        $builder->join('kelas','kelas.id_kelas = staff_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = staff_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = staff_rombel.id_rombel','LEFT');
        $builder->where('staff_rombel.id_tahun',$id_tahun);
        $builder->where('staff_rombel.id_kelas',$id_kelas);
        $builder->where('status_guru_rombel',$status_guru_rombel);
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function staff_rombel($id_tahun,$id_kelas,$status_guru_rombel)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('staff_rombel.*,
                        staff.nama,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('staff','staff.id_staff = staff_rombel.id_staff','LEFT');
        $builder->join('kelas','kelas.id_kelas = staff_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = staff_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = staff_rombel.id_rombel','LEFT');
        $builder->where('staff_rombel.id_tahun',$id_tahun);
        $builder->where('staff_rombel.id_kelas',$id_kelas);
        $builder->where('status_guru_rombel',$status_guru_rombel);
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // last_id
    public function last_id()
    {
        $builder = $this->db->table('staff_rombel');
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_staff_rombel)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->select('staff_rombel.*,
                        staff.nama,
                        kelas.nama_kelas,
                        tahun.nama_tahun,
                        rombel.status_rombel,');
        $builder->join('staff','staff.id_staff = staff_rombel.id_staff','LEFT');
        $builder->join('kelas','kelas.id_kelas = staff_rombel.id_kelas','LEFT');
        $builder->join('tahun','tahun.id_tahun = staff_rombel.id_tahun','LEFT');
        $builder->join('rombel','rombel.id_rombel = staff_rombel.id_rombel','LEFT');
        $builder->where('id_staff_rombel',$id_staff_rombel);
        $builder->orderBy('staff_rombel.id_staff_rombel','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // check
    public function check($data)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->where('id_staff',$data['id_staff']);
        $builder->where('id_tahun',$data['id_tahun']);
        $builder->where('id_kelas',$data['id_kelas']);
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->where('id_staff_rombel',$data['id_staff_rombel']);
        $builder->update($data);
    }

    // edit
    public function hapus($data)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->where('id_staff_rombel',$data['id_staff_rombel']);
        $builder->delete($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('staff_rombel');
        $builder->insert($data);
    }

    // tambah  log
    public function staff_rombel_log($data)
    {
        $builder = $this->db->table('staff_rombel_logs');
        $builder->insert($data);
    }
}