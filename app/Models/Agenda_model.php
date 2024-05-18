<?php 
namespace App\Models;

use CodeIgniter\Model;

class Agenda_model extends Model
{

    protected $table = 'agenda';
    protected $primaryKey = 'id_agenda';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Listing
    public function listing_cari($keywords)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->like('agenda.nama_agenda',$keywords);
        $builder->orLike('agenda.isi',$keywords);
        $builder->orLike('agenda.keywords',$keywords);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Kategori
    public function menu_kategori()
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda' => 'Publish']);
        $builder->groupBy('agenda.id_kategori_agenda');
        $builder->orderBy('kategori_agenda.urutan','ASC');
        $builder->limit(9);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // kategori_agenda
    public function kategori_agenda_4($id_kategori_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama, kategori_agenda.keterangan AS konten');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda'   => 'Publish',
                            // 'jenis_agenda'    => 'Produk',
                            'agenda.id_kategori_agenda'    => $id_kategori_agenda]);
        $builder->orderBy('agenda.id_agenda','DESC');
        $builder->limit(4);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function beranda()
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda' => 'Publish']);
        $builder->orderBy('agenda.id_agenda','DESC');
        $builder->limit(9);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function paginasi()
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda' => 'Publish']);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function sidebar($limit)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda' => 'Publish']);
        $builder->orderBy('agenda.id_agenda','DESC');
        $this->limit((int)$limit);
        $query = $builder->get();
        return $query->getResultArray();
    }


    // home
    public function home()
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda' => 'Publish',
                            'jenis_agenda'  => 'Produk']);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // kategori_agenda
    public function kategori_agenda($id_kategori_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'status_agenda'   => 'Publish',
                            // 'jenis_agenda'    => 'Produk',
                            'agenda.id_kategori_agenda'    => $id_kategori_agenda]);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // kategori_agenda
    public function kategori_agenda_all($id_kategori_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'agenda.id_kategori_agenda'    => $id_kategori_agenda]);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total_kategori_agenda($id_kategori_agenda)
    {
        $builder = $this->db->table('agenda')->where('id_kategori_agenda',$id_kategori_agenda);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'agenda.id_user'    => $id_user]);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total_author($id_user)
    {
        $builder = $this->db->table('agenda')->where('id_user',$id_user);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // kategori_agenda
    public function jenis_agenda_all($jenis_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'agenda.jenis_agenda'    => $jenis_agenda]);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total_jenis_agenda($jenis_agenda)
    {
        $builder = $this->db->table('agenda')->where('jenis_agenda',$jenis_agenda);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // status_agenda
    public function status_agenda_all($status_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where( [  'agenda.status_agenda'    => $status_agenda]);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // status_agenda
    public function total_status_agenda($status_agenda)
    {
        $builder = $this->db->table('agenda')->where('status_agenda',$status_agenda);
        $query = $builder->get();
        return $query->getNumRows();
    }

    

    // total
    public function total_cari($keywords)
    {
        $builder = $this->db->table('agenda');
        $builder->like('agenda.nama_agenda',$keywords);
        $builder->orLike('agenda.isi',$keywords);
        $builder->orLike('agenda.keywords',$keywords);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('agenda');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // total
    public function total_status($status_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->where('status_agenda',$status_agenda);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where('agenda.id_agenda',$id_agenda);
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // read
    public function read($slug_agenda)
    {
        $builder = $this->db->table('agenda');
        $builder->select('agenda.*, kategori_agenda.nama_kategori_agenda, kategori_agenda.slug_kategori_agenda, users.nama');
        $builder->join('kategori_agenda','kategori_agenda.id_kategori_agenda = agenda.id_kategori_agenda','LEFT');
        $builder->join('users','users.id_user = agenda.id_user','LEFT');
        $builder->where('agenda.slug_agenda',$slug_agenda);
        $builder->where('agenda.status_agenda','Publish');
        $builder->orderBy('agenda.id_agenda','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('agenda');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('agenda');
        $builder->where('id_agenda',$data['id_agenda']);
        $builder->update($data);
    }

}