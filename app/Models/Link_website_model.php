<?php 
namespace App\Models;

use CodeIgniter\Model;

class Link_website_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'link_website';
    protected $primaryKey       = 'id_link_website';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('link_website');
        $builder->select('*');
        $builder->orderBy('link_website.id_link_website','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function link_website($id_link_website)
    {
        $builder = $this->db->table('link_website');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_link_website',$id_link_website);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('link_website');
        $builder->select('COUNT(*) AS total');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_link_website)
    {
        $builder = $this->db->table('link_website');
        $builder->where('id_link_website',$id_link_website);
        $builder->orderBy('link_website.id_link_website','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_link_website)
    {
        $builder = $this->db->table('link_website');
        $builder->where('slug_link_website',$slug_link_website);
        $builder->orderBy('link_website.id_link_website','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('link_website');
        $builder->where('id_link_website',$data['id_link_website']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('link_website');
        $builder->insert($data);
    }

    // tambah  log
    public function link_website_log($data)
    {
        $builder = $this->db->table('link_website_logs');
        $builder->insert($data);
    }
}