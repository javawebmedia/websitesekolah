<?php 
namespace App\Models;

use CodeIgniter\Model;

class Video_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db       = \Config\Database::connect();
    }

    protected $table = 'video';
    protected $primaryKey = 'id_video';
    protected $allowedFields = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('video');
        $builder->select('*');
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // home
    public function home()
    {
        $builder = $this->db->table('video');
        $builder->select('*');
        $builder->where([   'status_video'  => 'Publish',
                            'posisi_video'  => 'Beranda']);
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // semua
    public function semua($limit,$start)
    {
        $builder = $this->db->table('video');
        $builder->select('*');
        $builder->limit($limit,$start);
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_aktif
    public function status_aktif($status_aktif)
    {
        $builder = $this->db->table('video');
        $builder->select('*');
        $builder->where('status_aktif',$status_aktif);
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('video');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_video)
    {
        $builder = $this->db->table('video');
        $builder->where('id_video',$id_video);
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_video)
    {
        $builder = $this->db->table('video');
        $builder->where('slug_video',$slug_video);
        $builder->orderBy('video.id_video','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('video');
        $builder->where('id_video',$data['id_video']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('video');
        $builder->insert($data);
    }

    // tambah  log
    public function video_log($data)
    {
        $builder = $this->db->table('video_logs');
        $builder->insert($data);
    }
}