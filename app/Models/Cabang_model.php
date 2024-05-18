<?php 
namespace App\Models;

use CodeIgniter\Model;

class Cabang_model extends Model
{

    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->like('cabang.judul_cabang',$keywords,'BOTH');
        $this->orLike('cabang.isi',$keywords,'BOTH');
        $this->orLike('cabang.keywords',$keywords,'BOTH');
        $this->orLike('cabang.ringkasan',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->like('cabang.judul_cabang',$keywords,'BOTH');
        $this->orLike('cabang.isi',$keywords,'BOTH');
        $this->orLike('cabang.keywords',$keywords,'BOTH');
        $this->orLike('cabang.ringkasan',$keywords,'BOTH');
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // home
    public function main()
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'status_cabang' => 'Publish',
                            'jenis_cabang'  => 'Cabang']);
        $this->orderBy('cabang.tanggal_publish','DESC');
    }

    // home
    public function beranda()
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'status_cabang' => 'Publish',
                            'jenis_cabang'  => 'Cabang']);
        $this->orderBy('cabang.tanggal_publish','DESC');
        $this->limit(6);
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function sidebar()
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'status_cabang' => 'Publish',
                            'jenis_cabang'  => 'Cabang']);
        $this->orderBy('cabang.tanggal_publish','DESC');
        $this->limit(10);
        $query = $this->get();
        return $query->getResult();
    }


    // home
    public function home()
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'status_cabang' => 'Publish',
                            'jenis_cabang'  => 'Cabang']);
        $this->orderBy('cabang.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function jenis_publish($jenis_cabang)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'status_cabang' => 'Publish',
                            'jenis_cabang'  => $jenis_cabang
                        ]);
        $this->orderBy('cabang.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori_cabang
    public function kategori_cabang($id_kategori_cabang)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'status_cabang'         => 'Publish',
                            'jenis_cabang'          => 'Cabang',
                            'cabang.id_kategori_cabang'    => $id_kategori_cabang]);
        $this->orderBy('cabang.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori_cabang
    public function kategori_cabang_all($id_kategori_cabang,$limit,$start)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'cabang.id_kategori_cabang'    => $id_kategori_cabang]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('cabang.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_kategori_cabang($id_kategori_cabang)
    {
        $this->table('cabang')->where('id_kategori_cabang',$id_kategori_cabang);
        $query = $this->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'cabang.id_user'    => $id_user]);
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_author($id_user)
    {
        $this->table('cabang')->where('id_user',$id_user);
        $query = $this->get();
        return $query->getNumRows();
    }

    // kategori_cabang
    public function jenis_cabang_all($jenis_cabang,$limit,$start)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'cabang.jenis_cabang'    => $jenis_cabang]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_cabang($jenis_cabang)
    {
        $this->table('cabang')->where('jenis_cabang',$jenis_cabang);
        $query = $this->get();
        return $query->getNumRows();
    }

    // status_cabang
    public function status_cabang_all($status_cabang,$limit,$start)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where( [  'cabang.status_cabang'    => $status_cabang]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // status_cabang
    public function total_status_cabang($status_cabang)
    {
        $this->table('cabang')->where('status_cabang',$status_cabang);
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $this->table('cabang');
        $query = $this->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_cabang)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where('cabang.id_cabang',$id_cabang);
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // detail
    public function detail2($id_cabang)
    {
        $this->table('cabang');
        $this->select('*');
        $this->where('cabang.id_cabang',$id_cabang);
        $query = $this->get();
        return $query->getRow();
    }

    // read
    public function read($slug_cabang)
    {
        $this->table('cabang');
        $this->select('cabang.*, kategori_cabang.nama_kategori_cabang, kategori_cabang.slug_kategori_cabang, users.nama');
        $this->join('kategori_cabang','kategori_cabang.id_kategori_cabang = cabang.id_kategori_cabang','LEFT');
        $this->join('users','users.id_user = cabang.id_user','LEFT');
        $this->where('cabang.slug_cabang',$slug_cabang);
        $this->where('cabang.status_cabang','Publish');
        $this->orderBy('cabang.id_cabang','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('cabang');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('cabang');
        $builder->where('id_cabang',$data['id_cabang']);
        $builder->update($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('cabang');
        $builder->insert($data);
    }

}