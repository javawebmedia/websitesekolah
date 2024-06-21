<?php 
namespace App\Controllers\Siswa;
use CodeIgniter\Controller;
use App\Models\Akun_model;

class Akun extends BaseController
{
	public function index()
	{
		$m_akun 	= new Akun_model();
		$id_akun 	= Session()->get('id_akun');
		$akun 		= $m_akun->detail($id_akun);

		// proses
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 						=> 'required',
				'email' 					=> 'required|valid_email',
				'alamat' 					=> 'min_length[32]',
				'password' 					=> 'min_length[6]|max_length[32]',
				'telepon'					=> 'required',
				'konfirmasi_password' 		=> 'required|matches[password]',
        	])) {
        		$data = array(
					'id_akun'			=> $id_akun,
					'status_akun'		=> $akun->status_akun,
					'nama'				=> $this->request->getVar('nama'),
					'email'				=> $this->request->getVar('email'),
					'username'			=> $this->request->getVar('email'),
					'password'			=> sha1($this->request->getVar('password')),
					'password_hint'		=> $this->request->getVar('password'),
					'telepon'			=> $this->request->getVar('telepon'),
					'alamat'			=> $this->request->getVar('alamat')
	        	);
	        	$m_akun->edit($data);
        		return redirect()->to(base_url('siswa/akun'))->with('sukses', 'Akun berhasil diupdate');
        }else{
			$data = [   'title'     	=> 'Data Akun',
						'description'   => 'Data Akun',
	                    'keywords'      => 'Data Akun',
	                    'akun'			=> $akun,
						'content'		=> 'siswa/akun/index'
	                ];
	        return view('siswa/layout/wrapper',$data);
	    }
	}
}