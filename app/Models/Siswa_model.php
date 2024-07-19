<?php 
namespace App\Models;

use CodeIgniter\Model;

class Siswa_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_siswa
    public function status_siswa($status_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->where('status_siswa',$status_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // gelombang_status_siswa
    public function gelombang_status_siswa($id_gelombang,$status_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->where('id_gelombang',$id_gelombang);

        if($status_siswa != 'Semua') {
            $builder->where('status_siswa',$status_siswa);
        }

        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_siswa_gelombang
    public function status_siswa_gelombang($status_siswa,$id_gelombang)
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');

        if($status_siswa != 'Semua') {
            $builder->where('status_siswa',$status_siswa);
        }
        
        $builder->where('id_gelombang',$id_gelombang);
        $query = $builder->get();
        return $query->getRow();
    }

    // paginasi
    public function paginasi($limit,$start)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->limit($limit,$start);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // paginasi
    public function paginasi_cari($keywords,$limit,$start)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->like('nama_siswa',$keywords,'BOTH');
        $builder->orLike('email',$keywords,'BOTH');
        $builder->orLike('nama_ayah',$keywords,'BOTH');
        $builder->orLike('nama_ibu',$keywords,'BOTH');
        $builder->orLike('nama_wali',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->orLike('telepon',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->limit($limit,$start);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total_cari($keywords)
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');
        $builder->like('nama_siswa',$keywords,'BOTH');
        $builder->orLike('email',$keywords,'BOTH');
        $builder->orLike('nama_ayah',$keywords,'BOTH');
        $builder->orLike('nama_ibu',$keywords,'BOTH');
        $builder->orLike('nama_wali',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->orLike('telepon',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // last_id
    public function last_id()
    {
        $builder = $this->db->table('siswa');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,
                        pekerjaan.nama_pekerjaan,
                        a.nama_pekerjaan AS pekerjaan_ibu');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan a','a.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->where('id_siswa',$id_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // listing
    public function login($username,$password)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->where([   'email'     => $username,
                            'password'  => $password
                        ]);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // listing
    public function login_nis($username,$password)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        hubungan.nama_hubungan,');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->where([   'nis'       => $username,
                            'password'  => $password
                        ]);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->where('slug_siswa',$slug_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('siswa');
        $builder->where('id_siswa',$data['id_siswa']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('siswa');
        $builder->insert($data);
    }

    // tambah  log
    public function siswa_log($data)
    {
        $builder = $this->db->table('siswa_logs');
        $builder->insert($data);
    }
}