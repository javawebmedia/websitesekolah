<?php 
namespace App\Models;

use CodeIgniter\Model;

class Konfigurasi_model extends Model
{

    // Listing
    public function listing()
    {
        $builder = $this->db->table('konfigurasi');
        $builder->select('*');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('konfigurasi');
        $builder->where('id_konfigurasi',$data['id_konfigurasi']);
        $builder->update($data);
    }
}