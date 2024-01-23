<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_download_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_download';
    protected $primaryKey       = 'id_kategori_download';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_download');
        $builder->select('*');
        $builder->orderBy('kategori_download.id_kategori_download','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function download($id_kategori_download)
    {
        $builder = $this->db->table('download');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_download',$id_kategori_download);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_download');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_download.id_kategori_download','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_download)
    {
        $builder = $this->db->table('kategori_download');
        $builder->where('id_kategori_download',$id_kategori_download);
        $builder->orderBy('kategori_download.id_kategori_download','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_kategori_download)
    {
        $builder = $this->db->table('kategori_download');
        $builder->where('slug_kategori_download',$slug_kategori_download);
        $builder->orderBy('kategori_download.id_kategori_download','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_download');
        $builder->where('id_kategori_download',$data['id_kategori_download']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_download');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_download_log($data)
    {
        $builder = $this->db->table('kategori_download_logs');
        $builder->insert($data);
    }
}