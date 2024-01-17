<?php 
namespace App\Models;

use CodeIgniter\Model;

class Media_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'media';
    protected $primaryKey = 'id_media';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('media');
        $builder->select('*');
        $builder->orderBy('media.id_media','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // all
    public function all()
    {
        $builder = $this->db->table('media');
        $builder->select('gambar, file_ext, file_size, id_media');
        $builder->orderBy('media.id_media','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_aktif
    public function status_aktif($status_aktif)
    {
        $builder = $this->db->table('media');
        $builder->select('*');
        $builder->where('status_aktif',$status_aktif);
        $builder->orderBy('media.id_media','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('media');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('media.id_media','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_media)
    {
        $builder = $this->db->table('media');
        $builder->where('id_media',$id_media);
        $builder->orderBy('media.id_media','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('media');
        $builder->where('id_media',$data['id_media']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('media');
        $builder->insert($data);
    }

    // tambah  log
    public function media_log($data)
    {
        $builder = $this->db->table('media_logs');
        $builder->insert($data);
    }
}