<?php 
namespace App\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{

    protected $table        = 'menu';
    protected $primaryKey   = 'id_menu';
    protected $allowedFields = ['*'];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('menu');
        $builder->select('*');
        $builder->orderBy('urutan','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // akhir
    public function akhir()
    {
        $builder = $this->db->table('menu');
        $builder->select('*');
        $builder->orderBy('urutan','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_menu)
    {
        $builder = $this->db->table('menu')
                ->select('*')
                ->where('id_menu',$id_menu);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('menu')
                    ->select('COUNT(*) AS total');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('menu');
        $builder->where('id_menu',$data['id_menu']);
        $builder->update($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('menu');
        $builder->insert($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('menu');
        $builder->insert($data);
    }

}