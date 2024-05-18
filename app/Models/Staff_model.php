<?php 
namespace App\Models;

use CodeIgniter\Model;

class Staff_model extends Model
{

    protected $table = 'staff';
    protected $primaryKey = 'id_staff';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function home($jumlah)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'status_staff' => 'Publish']);
        $this->limit($jumlah);
        $this->orderBy('staff.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->like('staff.nama',$keywords,'BOTH');
        $this->orLike('staff.jabatan',$keywords,'BOTH');
        $this->orLike('staff.keahlian',$keywords,'BOTH');
        $this->orLike('staff.email',$keywords,'BOTH');
        $this->orLike('staff.alamat',$keywords,'BOTH');
        $this->orLike('staff.telepon',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->like('staff.nama',$keywords,'BOTH');
        $this->orLike('staff.jabatan',$keywords,'BOTH');
        $this->orLike('staff.keahlian',$keywords,'BOTH');
        $this->orLike('staff.email',$keywords,'BOTH');
        $this->orLike('staff.alamat',$keywords,'BOTH');
        $this->orLike('staff.telepon',$keywords,'BOTH');
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // home
    public function jenis_publish($jenis_staff)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'status_staff' => 'Publish',
                        'jenis_staff'  => $jenis_staff
                        ]);
        $this->orderBy('staff.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori_staff
    public function kategori_staff($id_kategori_staff)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'status_staff'         => 'Publish',
                            'staff.id_kategori_staff'    => $id_kategori_staff]);
        $this->orderBy('staff.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori_staff
    public function kategori_staff_all($id_kategori_staff,$limit,$start)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'staff.id_kategori_staff'    => $id_kategori_staff]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('staff.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_kategori_staff($id_kategori_staff)
    {
        $this->table('staff')->where('id_kategori_staff',$id_kategori_staff);
        $query = $this->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'staff.id_user'    => $id_user]);
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_author($id_user)
    {
        $this->table('staff')->where('id_user',$id_user);
        $query = $this->get();
        return $query->getNumRows();
    }

    // kategori_staff
    public function jenis_staff_all($jenis_staff,$limit,$start)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'staff.jenis_staff'    => $jenis_staff]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_staff($jenis_staff)
    {
        $this->table('staff')->where('jenis_staff',$jenis_staff);
        $query = $this->get();
        return $query->getNumRows();
    }

    // status_staff
    public function status_staff_all($status_staff,$limit,$start)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where( [  'staff.status_staff'    => $status_staff]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // status_staff
    public function total_status_staff($status_staff)
    {
        $this->table('staff')->where('status_staff',$status_staff);
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $this->table('staff');
        $query = $this->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_staff)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where('staff.id_staff',$id_staff);
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // detail
    public function detail2($id_staff)
    {
        $this->table('staff');
        $this->select('*');
        $this->where('staff.id_staff',$id_staff);
        $query = $this->get();
        return $query->getRow();
    }

    // read
    public function read($slug_staff)
    {
        $this->table('staff');
        $this->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff, users.nama AS nama_user');
        $this->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
        $this->join('users','users.id_user = staff.id_user','LEFT');
        $this->where('staff.slug_staff',$slug_staff);
        $this->where('staff.status_staff','Publish');
        $this->orderBy('staff.id_staff','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('staff');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('staff');
        $builder->where('id_staff',$data['id_staff']);
        $builder->update($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('staff');
        $builder->insert($data);
    }

}