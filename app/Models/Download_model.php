<?php 
namespace App\Models;

use CodeIgniter\Model;

class Download_model extends Model
{

    protected $table = 'download';
    protected $primaryKey = 'id_download';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->like('download.judul_download',$keywords,'BOTH');
        $this->orLike('download.isi',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->like('download.judul_download',$keywords,'BOTH');
        $this->orLike('download.isi',$keywords,'BOTH');
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // kategori_download
    public function kategori_download($id_kategori_download)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->where( [  'status_download'         => 'Publish',
                            'jenis_download'          => 'Download',
                            'download.id_kategori_download'    => $id_kategori_download]);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // kategori_download
    public function kategori_download_all($id_kategori_download,$jenis_download,$limit,$start)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->where( [ 'download.id_kategori_download' => $id_kategori_download,
                        'download.jenis_download'       => $jenis_download
                    ]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_kategori_download($id_kategori_download)
    {
        $this->table('download')->where('id_kategori_download',$id_kategori_download);
        $query = $this->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->where( [  'download.id_user'    => $id_user]);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_author($id_user)
    {
        $this->table('download')->where('id_user',$id_user);
        $query = $this->get();
        return $query->getNumRows();
    }

    // kategori_download
    public function jenis_download_all($jenis_download,$limit,$start)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->where( [  'download.jenis_download'    => $jenis_download]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_download($jenis_download)
    {
        $this->table('download')->where('jenis_download',$jenis_download);
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $this->table('download');
        $query = $this->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_download)
    {
        $this->table('download');
        $this->select('download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download, users.nama');
        $this->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
        $this->join('users','users.id_user = download.id_user','LEFT');
        $this->where('download.id_download',$id_download);
        $this->orderBy('download.id_download','DESC');
        $query = $this->get();
        return $query->getRow();
    }


    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('download');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('download');
        $builder->where('id_download',$data['id_download']);
        $builder->update($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('download');
        $builder->insert($data);
    }

}