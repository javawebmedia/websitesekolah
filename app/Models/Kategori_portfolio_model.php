<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kategori_portfolio_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'kategori_portfolio';
    protected $primaryKey       = 'id_kategori_portfolio';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_portfolio');
        $builder->select('*');
        $builder->orderBy('kategori_portfolio.id_kategori_portfolio','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // listing
    public function portfolio($id_kategori_portfolio)
    {
        $builder = $this->db->table('portfolio');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_kategori_portfolio',$id_kategori_portfolio);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_portfolio');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_portfolio.id_kategori_portfolio','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_kategori_portfolio)
    {
        $builder = $this->db->table('kategori_portfolio');
        $builder->where('id_kategori_portfolio',$id_kategori_portfolio);
        $builder->orderBy('kategori_portfolio.id_kategori_portfolio','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_kategori_portfolio)
    {
        $builder = $this->db->table('kategori_portfolio');
        $builder->where('slug_kategori_portfolio',$slug_kategori_portfolio);
        $builder->orderBy('kategori_portfolio.id_kategori_portfolio','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('kategori_portfolio');
        $builder->where('id_kategori_portfolio',$data['id_kategori_portfolio']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kategori_portfolio');
        $builder->insert($data);
    }

    // tambah  log
    public function kategori_portfolio_log($data)
    {
        $builder = $this->db->table('kategori_portfolio_logs');
        $builder->insert($data);
    }
}