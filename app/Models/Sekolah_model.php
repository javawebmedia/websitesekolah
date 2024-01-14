<?php 
namespace App\Models;

use CodeIgniter\Model;

class Sekolah_model extends Model
{

    // Listing
    public function listing()
    {
        $builder = $this->db->table('sekolah');
        $builder->select('*');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('sekolah');
        $builder->where('id_sekolah',$data['id_sekolah']);
        $builder->update($data);
    }
}