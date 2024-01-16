<?php 
namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['*'];

    // login
    public function login($username,$password)
    {
        $builder = $this->db->table('users');
        $builder->select('users.*,staff.nama AS nama_staff, staff.jabatan');
        $builder->join('staff','staff.id_staff = users.id_staff','LEFT');
        $builder->where([   'username'  => $username,
                            'password'  => SHA1($password)]);
        $query = $builder->get();
        return $query->getRow();
    }

    // listing
    public function listing()
    {
        $builder = $this->db->table('users');
        $builder->select('users.*,staff.nama AS nama_staff, staff.jabatan');
        $builder->join('staff','staff.id_staff = users.id_staff','LEFT');
        $builder->orderBy('users.id_user','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('users');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('users.id_user','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_user)
    {
        $builder = $this->db->table('users');
        $builder->select('users.*,staff.nama AS nama_staff, staff.jabatan');
        $builder->join('staff','staff.id_staff = users.id_staff','LEFT');
        $builder->where('users.id_user',$id_user);
        $builder->orderBy('users.id_user','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // kode_rahasia
    public function kode_rahasia($kode_rahasia)
    {
        $builder = $this->db->table('users');
        $builder->select('users.*,staff.nama AS nama_staff, staff.jabatan');
        $builder->join('staff','staff.id_staff = users.id_staff','LEFT');
        $builder->where('users.kode_rahasia',$kode_rahasia);
        $builder->orderBy('users.id_user','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // check
    public function check($email)
    {
        $builder = $this->db->table('users');
        $builder->select('users.*,staff.nama AS nama_staff, staff.jabatan');
        $builder->join('staff','staff.id_staff = users.id_staff','LEFT');
        $builder->where('users.email',$email);
        $builder->orderBy('users.id_user','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('users');
        $builder->where('id_user',$data['id_user']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('users');
        $builder->insert($data);
    }

    // tambah  log
    public function user_log($data)
    {
        $builder = $this->db->table('user_logs');
        $builder->insert($data);
    }
}