<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Rombel_model;
use App\Models\Jenjang_model;
use App\Models\Tahun_model;
use App\Models\Kelas_model;
use App\Models\Siswa_model;
use App\Models\Staff_model;
use App\Models\Siswa_rombel_model;
use App\Models\Staff_rombel_model;
use App\Models\Nilai_perkembangan_model;
use App\Models\Nilai_raport_model;

class Rombel extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_rombel 		= new Rombel_model();
		$m_jenjang 		= new Jenjang_model();
		$m_tahun 		= new Tahun_model();
		$m_kelas 		= new Kelas_model();
		$m_tahun 		= new Tahun_model();
		$tahun 			= $m_tahun->listing();
		if(isset($_GET['id_tahun'])) {
			$akhir 			= $m_rombel->akhir_tahun($_GET['id_tahun']);
			$kelas 			= $m_kelas->all_jenjang();
			if($akhir) {
				$jenjang 		= $m_rombel->all_jenjang($akhir->id_tahun);
				$rombel 		= $m_rombel->akhir();
				$tahun_ajaran 	= $m_tahun->detail($akhir->id_tahun);
			}else{
				$jenjang 		= '';
				$rombel 		= '';
				$tahun_ajaran 	= '';
			}	
		}else{
			$akhir 			= $m_rombel->akhir();
			$kelas 			= $m_kelas->all_jenjang();
			if($akhir) {
				$jenjang 		= $m_rombel->all_jenjang($akhir->id_tahun);
				$rombel 		= $m_rombel->akhir();
				$tahun_ajaran 	= $m_tahun->detail($akhir->id_tahun);
			}else{
				$jenjang 		= '';
				$rombel 		= '';
				$tahun_ajaran 	= '';
			}	
		}

		$data = [	'title'			=> 'Master Rombongan Belajar (Rombel)',
					'jenjang'		=> $jenjang,
					'rombel'		=> $rombel,
					'm_rombel'		=> $m_rombel,
					'tahun'			=> $tahun,
					'm_kelas'		=> $m_kelas,
					'kelas'			=> $kelas,
					'akhir'			=> $akhir,
					'tahun_ajaran'	=> $tahun_ajaran,
					'content'		=> 'admin/rombel/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// anggota
	public function anggota($id_rombel)
	{
		
		$m_rombel 		= new Rombel_model();
		$m_jenjang 		= new Jenjang_model();
		$m_tahun 		= new Tahun_model();
		$m_kelas 		= new Kelas_model();
		$m_siswa 		= new Siswa_model();
		$m_staff 		= new Staff_model();
		$m_staff_rombel = new Staff_rombel_model();
		$siswa 			= $m_siswa->status_siswa('Aktif');
		$staff 			= $m_staff->listing();
		$rombel 		= $m_rombel->detail($id_rombel);
		$staff_rombel 	= $m_staff_rombel->rombel($id_rombel);


		if(isset($_POST['staff'])) {
			$data = [	'id_user'				=> $this->request->getPost('id_user'),
						'id_rombel'				=> $this->request->getPost('id_rombel'),
						'id_tahun'				=> $this->request->getPost('id_tahun'),
						'id_staff'				=> $this->request->getPost('id_staff'),
						'id_kelas'				=> $this->request->getPost('id_kelas'),
						'status_staff_rombel'	=> 'Aktif',
						'id_kelas'				=> $this->request->getPost('id_kelas'),
						'status_guru_rombel'	=> $this->request->getPost('status_guru_rombel'),
						'keterangan'			=> '-',
					];
			$m_staff_rombel->tambah($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/rombel/anggota/'.$id_rombel));
		}

		$data = [	'title'			=> 'Kelola Siswa dan Guru',
					'rombel'		=> $rombel,
					'siswa'			=> $siswa,
					'staff'			=> $staff,
					'staff_rombel'	=> $staff_rombel,
					'content'		=> 'admin/rombel/anggota'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// kelola
	public function kelola()
	{
		
		if(isset($_GET['lihat'])) {
			return redirect()->to(base_url('admin/rombel?id_tahun='.$this->request->getVar('id_tahun')));
		}
		$id_tahun 		= $_GET['id_tahun'];
		$m_rombel 		= new Rombel_model();
		$m_jenjang 		= new Jenjang_model();
		$m_tahun 		= new Tahun_model();
		$m_kelas 		= new Kelas_model();
		$akhir 			= $m_rombel->akhir();
		$tahun 			= $m_tahun->listing();
		$tahun_ajaran 	= $m_tahun->detail($id_tahun);
		$kelas 			= $m_kelas->all_jenjang();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'id_tahun' 	=> 'required',
        	])) {
			// masuk database
			$id_tahunnya 	= $this->request->getVar('id_tahun');
			$id_kelas 		= $this->request->getVar('id_kelas');
			if(empty($id_kelas)) {
				$this->session->setFlashdata('sukses','Anda belum memilih kelas atau bisa jadi semua kelas sudah masuk ke dalam rombongan belajar');
				return redirect()->to(base_url('admin/rombel/kelola?id_tahun='.$id_tahun));
			}
			// proses hapus
			// $data 			= ['id_tahun'	=> $id_tahunnya];
			// $m_rombel->hapus($data);

			for($i=0; $i < sizeof($id_kelas);$i++) {
				$data = array(	'id_user'		=> $this->session->get('id_user'),
								'id_kelas'		=> $id_kelas[$i],
								'id_tahun'		=> $id_tahunnya,
								'tahun_mulai'	=> $this->request->getVar('tahun_mulai'),
								'tahun_selesai'	=> $this->request->getVar('tahun_selesai'),
								'status_rombel'	=> $this->request->getVar('status_rombel'),
								'keterangan'	=> $this->request->getVar('keterangan')
							);
   				$m_rombel->tambah($data);
   			}
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/rombel/kelola?id_tahun='.$id_tahun));
	    }

		$data = [	'title'			=> 'Kelola Rombongan Belajar: '.$tahun_ajaran->nama_tahun,
					'kelas'			=> $kelas,
					'm_kelas'		=> $m_kelas,
					'm_rombel'		=> $m_rombel,
					'tahun'			=> $tahun,
					'tahun_ajaran'	=> $tahun_ajaran,
					'content'		=> 'admin/rombel/kelola'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_rombel)
	{
		
		$m_rombel 	= new Rombel_model();
		$m_jenjang 	= new Jenjang_model();
		$rombel 		= $m_rombel->detail($id_rombel);
		$jenjang 	= $m_jenjang->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama_rombel' 	=> 'required|min_length[1]',
        	])) {
			
			$data = [	'id_rombel'		=> $id_rombel,
						'id_user'		=> $this->session->get('id_user'),
						'id_jenjang'	=> $this->request->getPost('id_jenjang'),
						'nama_rombel'	=> $this->request->getPost('nama_rombel'),
						'status_rombel'	=> $this->request->getPost('status_rombel'),
						'keterangan'	=> $this->request->getPost('keterangan'),
						'urutan'		=> $this->request->getPost('urutan')
				];
			$m_rombel->edit($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/rombel#jenjang'.$this->request->getPost('id_jenjang')));
	    }else{
			$data = [	'title'		=> 'Edit Rombongan Belajar: '.$rombel->nama_rombel,
						'rombel'	=> $rombel,
						'jenjang'	=> $jenjang,
						'content'	=> 'admin/rombel/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// tambah_siswa
	public function tambah_siswa()
	{
		
		$m_siswa_rombel 	= new Siswa_rombel_model();
		$data = [	'id_user'				=> $this->request->getPost('id_user'),
					'id_rombel'				=> $this->request->getPost('id_rombel'),
					'id_tahun'				=> $this->request->getPost('id_tahun'),
					'id_siswa'				=> $this->request->getPost('id_siswa'),
					'id_kelas'				=> $this->request->getPost('id_kelas'),
					'status_siswa_rombel'	=> $this->request->getPost('status_siswa_rombel'),
					'keterangan'			=> '-',
				];
		$check = $m_siswa_rombel->check($data);
		if($check) {}else{
			$m_siswa_rombel->tambah($data);
		}
		echo json_encode($data);
	}

	// siswa_rombel
	public function siswa_rombel($id_rombel)
	{
		
		header('Content-Type: application/json; charset=utf-8');
		$m_rombel 				= new Rombel_model();
		$m_siswa_rombel 		= new Siswa_rombel_model();
		$m_nilai_perkembangan 	= new Nilai_perkembangan_model();
		$m_nilai_raport 		= new Nilai_raport_model();
		$siswa_rombel 			= $m_siswa_rombel->rombel($id_rombel);

		$response 			= array();
		$no_urut=1;
		foreach($siswa_rombel as $siswa_rombel)
		{
			$total_perkembangan = $m_nilai_perkembangan->total_siswa($siswa_rombel->id_siswa_rombel);
			$raport1 			= $m_nilai_raport->total_siswa($siswa_rombel->id_siswa_rombel,1);
			$raport2 			= $m_nilai_raport->total_siswa($siswa_rombel->id_siswa_rombel,2);
			$raport3 			= $m_nilai_raport->total_siswa($siswa_rombel->id_siswa_rombel,3);
			$raport4 			= $m_nilai_raport->total_siswa($siswa_rombel->id_siswa_rombel,4);

			if($total_perkembangan) {
				$nilai_perkembangan = $total_perkembangan;
			}else{
				$nilai_perkembangan = 0;
			}
			if($raport1) {
				$nilai_raport1 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/1/1').'" class="btn btn-success btn-xs m-1" title="Isi/update raport"><i class="fa fa-check-circle"></i> Sudah</a><a href="'.base_url('admin/raport/unduh_siswa/'.$siswa_rombel->id_siswa_rombel.'/1/1').'" class="btn btn-outline-danger btn-xs m-1" target="_blank"><i class="fa fa-file-pdf"></i> Cetak</a>';
				$status_raport1 = 1;
			}else{
				$nilai_raport1 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/1/1').'" class="btn btn-secondary btn-xs" title="Isi/update raport"><i class="fa fa-times-circle"></i> Belum</a>';
				$status_raport1 = 0;
			}
			if($raport2) {
				$nilai_raport2 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/2/1').'" class="btn btn-success btn-xs mb-1" title="Isi/update raport"><i class="fa fa-check-circle"></i> Sudah</a><a href="'.base_url('admin/raport/unduh_siswa/'.$siswa_rombel->id_siswa_rombel.'/2/1').'" class="btn btn-outline-danger btn-xs m-1" target="_blank"><i class="fa fa-file-pdf"></i> Cetak</a>';
				$status_raport2 = 1;
			}else{
				$nilai_raport2 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/2/1').'" class="btn btn-secondary btn-xs" title="Isi/update raport"><i class="fa fa-times-circle"></i> Belum</a>';
				$status_raport2 = 0;
			}
			if($raport3) {
				$nilai_raport3 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/3/2').'" class="btn btn-success btn-xs mb-1" title="Isi/update raport"><i class="fa fa-check-circle"></i> Sudah</a><a href="'.base_url('admin/raport/unduh_siswa/'.$siswa_rombel->id_siswa_rombel.'/3/2').'" class="btn btn-outline-danger btn-xs m-1" target="_blank"><i class="fa fa-file-pdf"></i> Cetak</a>';
				$status_raport3 = 1;
			}else{
				$nilai_raport3 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/3/2').'" class="btn btn-secondary btn-xs" title="Isi/update raport"><i class="fa fa-times-circle"></i> Belum</a>';
				$status_raport3 = 0;
			}
			if($raport4) {
				$nilai_raport4 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/4/2').'" class="btn btn-success btn-xs mb-1" title="Isi/update raport"><i class="fa fa-check-circle"></i> Sudah</a><a href="'.base_url('admin/raport/unduh_siswa/'.$siswa_rombel->id_siswa_rombel.'/4/2').'" class="btn btn-outline-danger btn-xs m-1" target="_blank"><i class="fa fa-file-pdf"></i> Cetak</a>';
				$status_raport4 = 1;
			}else{
				$nilai_raport4 = '<a href="'.base_url('admin/raport/siswa/'.$siswa_rombel->id_siswa_rombel.'/4/2').'" class="btn btn-secondary btn-xs" title="Isi/update raport"><i class="fa fa-times-circle"></i> Belum</a>';
				$status_raport4 = 0;
			}
			$response[] = array(	"no_urut"			=> $no_urut,
									"id_siswa_rombel"	=> $siswa_rombel->id_siswa_rombel,
									"nama_siswa"		=> $siswa_rombel->nama_siswa,
									"nis"		=> $siswa_rombel->nis,
									"nisn"		=> $siswa_rombel->nisn,
									"ttl"				=> $siswa_rombel->tempat_lahir.', '.$this->website->tanggal_id($siswa_rombel->tanggal_lahir),
									"jenis_kelamin"		=> $siswa_rombel->jenis_kelamin,
									"nilai_perkembangan"=> $nilai_perkembangan,
									"nilai_raport1"		=> $nilai_raport1,
									"nilai_raport2"		=> $nilai_raport2,
									"nilai_raport3"		=> $nilai_raport3,
									"nilai_raport4"		=> $nilai_raport4,
									"status_raport1"	=> $status_raport1,
									"status_raport2"	=> $status_raport2,
									"status_raport3"	=> $status_raport3,
									"status_raport4"	=> $status_raport4,
									"status_rombel"		=> $siswa_rombel->status_rombel	
								);
		$no_urut++; }
		echo json_encode($response);
	}

	// guru_rombel
	public function guru_rombel($id_rombel)
	{
		
		$m_rombel 			= new Rombel_model();
		$m_siswa_rombel 	= new Siswa_rombel_model();
		$siswa_rombel 		= $m_siswa_rombel->rombel($id_rombel);

		$response 			= array();
		$no_urut=1;
		foreach($siswa_rombel as $siswa_rombel)
		{
			$response[] = array(	"no_urut"			=> $no_urut,
									"id_siswa_rombel"	=> $siswa_rombel->id_siswa_rombel,
									"nama_siswa"		=> $siswa_rombel->nama_siswa,
									"ttl"				=> $siswa_rombel->tempat_lahir.', '.$this->website->tanggal_id($siswa_rombel->tanggal_lahir),
									"jenis_kelamin"		=> $siswa_rombel->jenis_kelamin,
									"status_rombel"		=> $siswa_rombel->status_rombel	
								);
		$no_urut++; }
		echo json_encode($response);
	}

	// cetak
	public function cetak($id_rombel)
	{
		
		$m_rombel 		= new Rombel_model();
		$m_jenjang 		= new Jenjang_model();
		$m_tahun 		= new Tahun_model();
		$m_kelas 		= new Kelas_model();
		$m_siswa 		= new Siswa_model();
		$m_staff 		= new Staff_model();
		$m_staff_rombel = new Staff_rombel_model();
		$m_siswa_rombel = new Siswa_rombel_model();
		$siswa_rombel 	= $m_siswa_rombel->rombel($id_rombel);
		$siswa 			= $m_siswa->status_siswa('Aktif');
		$staff 			= $m_staff->listing();
		$rombel 		= $m_rombel->detail($id_rombel);
		$staff_rombel 	= $m_staff_rombel->rombel($id_rombel);

		$data = [	'title'			=> 'Cetak Rombongan Belajar',
					'rombel'		=> $rombel,
					'siswa'			=> $siswa,
					'staff'			=> $staff,
					'siswa_rombel'	=> $siswa_rombel,
					'staff_rombel'	=> $staff_rombel
				];
		echo view('admin/rombel/cetak',$data);
	}

	// unduh
	public function unduh($id_rombel)
	{
		
		$m_rombel 		= new Rombel_model();
		$m_jenjang 		= new Jenjang_model();
		$m_tahun 		= new Tahun_model();
		$m_kelas 		= new Kelas_model();
		$m_siswa 		= new Siswa_model();
		$m_staff 		= new Staff_model();
		$m_staff_rombel = new Staff_rombel_model();
		$m_siswa_rombel = new Siswa_rombel_model();
		$siswa_rombel 	= $m_siswa_rombel->rombel($id_rombel);
		$siswa 			= $m_siswa->status_siswa('Aktif');
		$staff 			= $m_staff->listing();
		$rombel 		= $m_rombel->detail($id_rombel);
		$staff_rombel 	= $m_staff_rombel->rombel($id_rombel);

		$data = [	'title'			=> 'Cetak Rombongan Belajar',
					'rombel'		=> $rombel,
					'siswa'			=> $siswa,
					'staff'			=> $staff,
					'siswa_rombel'	=> $siswa_rombel,
					'staff_rombel'	=> $staff_rombel
				];
		// echo view('admin/rombel/cetak',$data);
		$mpdf = new \Mpdf\Mpdf([
						'default_font_size' => 11,
						'default_font' => 'nunito-regular'
					]);
		$html = view('admin/rombel/cetak',$data);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		// buka di browser
		$mpdf->Output('Informasi-Kelas-'.$rombel->nama_kelas.'.pdf','I'); 
	}

	// excel
	public function excel($id_rombel)
	{
		
		$m_rombel 		= new Rombel_model();
		$m_jenjang 		= new Jenjang_model();
		$m_tahun 		= new Tahun_model();
		$m_kelas 		= new Kelas_model();
		$m_siswa 		= new Siswa_model();
		$m_staff 		= new Staff_model();
		$m_staff_rombel = new Staff_rombel_model();
		$m_siswa_rombel = new Siswa_rombel_model();
		$siswa_rombel 	= $m_siswa_rombel->rombel($id_rombel);
		$siswa 			= $m_siswa->status_siswa('Aktif');
		$staff 			= $m_staff->listing();
		$rombel 		= $m_rombel->detail($id_rombel);
		$staff_rombel 	= $m_staff_rombel->rombel($id_rombel);

		$data = [	'title'			=> 'Cetak Rombongan Belajar',
					'rombel'		=> $rombel,
					'siswa'			=> $siswa,
					'staff'			=> $staff,
					'siswa_rombel'	=> $siswa_rombel,
					'staff_rombel'	=> $staff_rombel
				];
		echo view('admin/rombel/excel',$data);
	}

	// delete_staff
	public function delete_staff($id_staff_rombel,$id_rombel)
	{
		
		$m_rombel 			= new Rombel_model();
		$m_staff_rombel 	= new Staff_rombel_model();
		$data = ['id_staff_rombel' => $id_staff_rombel];
		$m_staff_rombel->hapus($data);
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/rombel/anggota/'.$id_rombel));
	}

	// hapus
	public function hapus()
	{
		
		$m_rombel 			= new Rombel_model();
		$m_siswa_rombel 	= new Siswa_rombel_model();
		$data = ['id_siswa_rombel' => $this->request->getPost('id_siswa_rombel')];
		$m_siswa_rombel->hapus($data);
		echo json_encode($data);
	}

	// delete
	public function delete($id_rombel)
	{
		
		$m_rombel 		= new Rombel_model();
		$m_siswa_rombel = new Siswa_rombel_model();
		$siswa 			= $m_siswa_rombel->rombel($id_rombel);
		if($siswa) {
			$this->session->setFlashdata('warning','Data rombongan belajar tidak dapat dihapus karena sudah ada siswanya');
			return redirect()->to(base_url('admin/rombel'));
		}else{
			if(isset($_GET['id_tahun'])) {
				$data = ['id_rombel'	=> $id_rombel];
				$m_rombel->delete($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah dihapus');
				return redirect()->to(base_url('admin/rombel/kelola?id_tahun='.$_GET['id_tahun'].'&submit=submit'));
			}else{
				$data = ['id_rombel'	=> $id_rombel];
				$m_rombel->delete($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah dihapus');
				return redirect()->to(base_url('admin/rombel'));
			}
		}
	}
}