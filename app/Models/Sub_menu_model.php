<?php 
namespace App\Models;

use CodeIgniter\Model;

class Sub_menu_model extends Model
{

    protected $table = 'sub_menu';
    protected $primaryKey = 'id_sub_menu';
    protected $allowedFields = ['*'];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('sub_menu');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    // Listing
    public function akhir()
    {
        $builder = $this->db->table('sub_menu');
        $builder->orderBy('urutan','DESC');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    // Listing
    public function akhir_menu($id_menu)
    {
        $builder = $this->db->table('sub_menu');
        $builder->select('*');
        $builder->where('id_menu',$id_menu);
        $builder->orderBy('urutan','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // sub
    public function menu($id_menu)
    {
        $builder = $this->db->table('sub_menu');
        $builder->select('*');
        $builder->orderBy('urutan','ASC');
        $builder->where('id_menu',$id_menu);
        $query = $builder->get();
        return $query->getResult();
    }

    // detail
    public function detail($id_sub_menu)
    {
        $builder = $this->db->table('sub_menu')
                ->select('*')
                ->where('id_sub_menu',$id_sub_menu);
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('sub_menu')
                    ->select('COUNT(*) AS total');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('sub_menu');
        $builder->where('id_sub_menu',$data['id_sub_menu']);
        $builder->update($data);
    }

     // hapus
    public function hapus($data)
    {
        $builder = $this->db->table('sub_menu');
        $builder->where('id_menu',$data['id_menu']);
        $builder->delete($data);
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('sub_menu');
        $builder->insert($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('sub_menu');
        $builder->insert($data);
    }

}