<?php namespace App\Models;

use CodeIgniter\Model;

class Akun_model extends Model
{

	protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // home
    public function home()
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->limit(6);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function jenis_akun_depan($jenis_akun)
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->where('akun.jenis_akun',$jenis_akun);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('akun');
        $this->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $this->join('siswa','siswa.nis = akun.nis','LEFT');
        $this->join('users','users.id_user = akun.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('akun.id_akun','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('akun');
        $this->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $this->join('siswa','siswa.nis = akun.nis','LEFT');
        $this->join('users','users.id_user = akun.id_user','LEFT');
        $this->like('akun.judul_akun',$keywords,'BOTH');
        $this->orLike('akun.website',$keywords,'BOTH');
        $this->orLike('akun.isi',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('akun.id_akun','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('akun');
        $this->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user AS nama_user');
        $this->join('siswa','siswa.nis = akun.nis','LEFT');
        $this->join('users','users.id_user = akun.id_user','LEFT');
        $this->like('akun.judul_akun',$keywords,'BOTH');
        $this->orLike('akun.website',$keywords,'BOTH');
        $this->orLike('akun.isi',$keywords,'BOTH');
        $this->orderBy('akun.id_akun','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('akun');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // Listing
    public function semua($status_akun,$limit,$start)
    {
        $this->table('akun');
        $this->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $this->join('siswa','siswa.nis = akun.nis','LEFT');
        $this->join('users','users.id_user = akun.id_user','LEFT');
        $this->where('akun.status_akun',$status_akun);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('akun.id_akun','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_status($status_akun)
    {
        $builder = $this->db->table('akun');
        $builder->select('COUNT(*) AS total');
        $builder->where('akun.status_akun',$status_akun);
        $query = $builder->get();
        return $query->getRow();
    }

    // login
    public function login($username,$password)
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->where('akun.email',$username);
        $builder->where('akun.password',$password);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // login_nis
    public function login_nis($username,$password)
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->where('akun.nis',$username);
        $builder->where('akun.password',$password);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function kode_akun($kode_akun)
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->where('akun.kode_akun',$kode_akun);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_akun)
    {
        $builder = $this->db->table('akun');
        $builder->select('akun.*, siswa.nama_siswa, siswa.slug_siswa, users.nama AS nama_user');
        $builder->join('siswa','siswa.nis = akun.nis','LEFT');
        $builder->join('users','users.id_user = akun.id_user','LEFT');
        $builder->where('akun.id_akun',$id_akun);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('akun');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('akun');
        $builder->where('id_akun',$data['id_akun']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('akun');
        $builder->where('jenis_akun','Homepage');
        $builder->orderBy('akun.id_akun','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // akun
    public function jenis_akun($jenis_akun)
    {
        $builder = $this->db->table('akun');
        $builder->where('jenis_akun',$jenis_akun);
        $builder->limit(5);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // akun
    public function jenis_akun_1($jenis_akun)
    {
        $builder = $this->db->table('akun');
        $builder->where('jenis_akun',$jenis_akun);
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // akun
    public function akun()
    {
        $builder = $this->db->table('akun');
        $builder->where('jenis_akun','Akun');
        $builder->orderBy('akun.id_akun','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}