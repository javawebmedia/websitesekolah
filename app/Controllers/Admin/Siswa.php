<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Siswa_model;
use App\Models\Rombel_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
use App\Models\Jenjang_model;
use App\Models\Pekerjaan_model;
use App\Models\Hubungan_model;
use App\Models\Siswa_rombel_model;
use App\Models\Agama_model;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Siswa extends BaseController
{

	// mainpage
	public function index()
	{
		
		$m_siswa 	= new Siswa_model();
		$siswa 	= $m_siswa->listing();
		$pager 				= service('pager'); 

		// siswa
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$totalnya 		= $m_siswa->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$totalnya->total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $totalnya->total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $siswa 		= $m_siswa->paginasi_cari($keywords,$perPage, $page);
		}else{
			$totalnya 		= $m_siswa->total();
			$title 			= 'Data Master Siswa ('.$totalnya->total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $totalnya->total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $siswa 		= $m_siswa->paginasi($perPage, $page);
		}
		// end siswa
		$data = [	'title'			=> $title,
					'siswa'		=> $siswa,
					'm_siswa'		=> $m_siswa,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/siswa/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// detail
	public function detail($id_siswa)
	{
		
		$m_siswa 	= new Siswa_model();
		$siswa 		= $m_siswa->detail($id_siswa);

		$data = [	'title'			=> $siswa->nama_siswa,
					'siswa'			=> $siswa,
					'm_siswa'		=> $m_siswa,
					'content'		=> 'admin/siswa/detail'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// cetak
	public function cetak($id_siswa)
	{
		
		$m_siswa 	= new Siswa_model();
		$siswa 		= $m_siswa->detail($id_siswa);

		$data = [	'title'			=> $siswa->nama_siswa,
					'siswa'			=> $siswa,
					'm_siswa'		=> $m_siswa,
					'content'		=> 'admin/siswa/detail'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// unduh
	public function unduh($id_siswa)
	{
		
		$m_siswa 	= new Siswa_model();
		$siswa 		= $m_siswa->detail($id_siswa);

		$data = [	'title'			=> $siswa->nama_siswa,
					'siswa'			=> $siswa,
					'm_siswa'		=> $m_siswa,
					'content'		=> 'admin/siswa/detail'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// import
	public function import()
	{
		
		$m_siswa 			= new Siswa_model();
		$m_rombel 			= new Rombel_model();
		$m_siswa_rombel 	= new Siswa_rombel_model();
		$m_hubungan 		= new Hubungan_model();
		$m_jenjang 			= new Jenjang_model;
		$m_pekerjaan 		= new Pekerjaan_model();
		$m_kelas 			= new Kelas_model();
		$m_agama 			= new Agama_model();
		$rombel 			= $m_rombel->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate([
			'ID_USER' 		=> 'required',
			'file_excel'	=> [
					                'ext_in[file_excel,xlsx,xls,csv]',
					                'max_size[file_excel,4096]',
            					],
		])) {
			// File upload
			$avatar  		= $this->request->getFile('file_excel');
			$namabaru 		= $avatar->getName();
            $avatar->move(WRITEPATH . '../assets/upload/file/',$namabaru);
           	// Masuk database
	        $reader     	= \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
	        $reader->setReadDataOnly(TRUE);
	        $spreadsheet  	= $reader->load('../assets/upload/file/'.$namabaru);
	        $worksheet    	= $spreadsheet->getActiveSheet();
	        $i=1;
	        $rows[]="";
	        foreach ($worksheet->getRowIterator() as $row) 
	        {
	            $cellIterator   = $row->getCellIterator();
	            $hasil          = $cellIterator->setIterateOnlyExistingCells(FALSE); 

	            $cells = [];
	            foreach ($cellIterator as $cell) {
	                $cells[] = $cell->getValue();
	            }
	            $rows[] = $cells;
	            if($i>5) 
	            {
	            	if($rows[$i][1]=='') {
	            		// do nothing
	            	}else{
		            	$id_rombel 					= $this->request->getPost('id_rombel');
		            	$import_rombel 				= $this->request->getPost('import_rombel');
		            	$rombel_detail 				= $m_rombel->detail($id_rombel);
		            	$kelas_detail 				= $m_kelas->detail($rombel_detail->id_kelas);
		            	$slug_siswa 				= strtolower(url_title($rows[$i][3])).'-'.$rows[$i][1].'-'.$rows[$i][2];

		            	$keywords_agama 			= $rows[$i][8];
		            	$keywords_hubungan 			= $rows[$i][11];
		            	$keywords_pekerjaan_ayah 	= $rows[$i][17];
		            	$keywords_pekerjaan_ibu 	= $rows[$i][18];
		            	$keywords_pekerjaan_wali 	= $rows[$i][22];
		            	
		            	$agama 						= $m_agama->cari($keywords_agama);
		            	$hubungan 					= $m_hubungan->cari($keywords_hubungan);
		            	$pekerjaan_ayah 			= $m_pekerjaan->cari($keywords_pekerjaan_ayah);
		            	$pekerjaan_ibu 				= $m_pekerjaan->cari($keywords_pekerjaan_ibu);
		            	$pekerjaan_wali 			= $m_pekerjaan->cari($keywords_pekerjaan_wali);

		            	if($agama) {
		            		$id_agama 			= $agama->id_agama;
		            	}else{
		            		$id_agama 			= 0;
		            	}
		            	if($hubungan) {
		            		$id_hubungan 		= $hubungan->id_hubungan;
		            	}else{
		            		$id_hubungan 		= 0;
		            	}
		            	if($pekerjaan_ayah) {
		            		$id_pekerjaan_ayah 		= $pekerjaan_ayah->id_pekerjaan;
		            	}else{
		            		$id_pekerjaan_ayah 		= 0;
		            	}
		            	if($pekerjaan_ibu) {
		            		$id_pekerjaan_ibu 		= $pekerjaan_ibu->id_pekerjaan;
		            	}else{
		            		$id_pekerjaan_ibu 		= 0;
		            	}
		            	if($pekerjaan_wali) {
		            		$id_pekerjaan_wali 		= $pekerjaan_wali->id_pekerjaan;
		            	}else{
		            		$id_pekerjaan_wali 		= $id_pekerjaan_ayah;
		            	}

		            	$tanggal_lahir 		= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[$i][7]);

	            		$tanggal_masuk 		= $rows[$i][26];

	            		$tanggal_pindah 	= $rows[$i][30];

		                // Get data
		                $data = [	'id_user'				=> $this->session->get('id_user'),
									'id_agama'				=> $id_agama,
									'id_agama_ayah'			=> $id_agama,
									'id_agama_ibu'			=> $id_agama,
									'id_agama_wali'			=> $id_agama,
									'id_pekerjaan_ayah'		=> $id_pekerjaan_ayah,
									'id_pekerjaan_ibu'		=> $id_pekerjaan_ibu,
									'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
									'id_jenjang_ayah'		=> 0,
									'id_jenjang_ibu'		=> 0,
									'id_jenjang_wali'		=> 0,
									'id_tahun'				=> $rombel_detail->id_tahun,
									'id_kelas'				=> $rombel_detail->id_kelas,
									'id_jenjang'			=> $kelas_detail->id_jenjang,
									'id_hubungan'			=> $id_hubungan,
									'slug_siswa'			=> $slug_siswa,
									'nis'					=> $rows[$i][1],
									'nisn'					=> $rows[$i][2],
									'status_wn'				=> $rows[$i][9],
									'negara_asal'			=> '-',
									'nama_siswa'			=> $rows[$i][3],
									'nama_panggilan'		=> $rows[$i][4],
									'tempat_lahir'			=> $rows[$i][6],
									'tanggal_lahir'			=> date_timestamp_get($tanggal_lahir) ? $tanggal_lahir->format('Y-m-d') : null,
									'alamat'				=> $rows[$i][12],
									'telepon'				=> $rows[$i][13],
									'kode_pos'				=> $rows[$i][14],
									'website'				=> '-',
									'email'					=> '',
									'jenis_kelamin'			=> $rows[$i][5],
									'berkebutuhan_khusus'	=> '-',
									'isi'					=> '-',
									'nama_ayah'				=> $rows[$i][15],
									'nama_ibu'				=> $rows[$i][16],
									'nama_wali'				=> $rows[$i][21],
									'alamat_ayah'			=> $rows[$i][19],
									'alamat_ibu'			=> $rows[$i][19],
									'alamat_wali'			=> $rows[$i][23],
									'telepon_ayah'			=> $rows[$i][20],
									'telepon_ibu'			=> $rows[$i][20],
									'telepon_wali'			=> $rows[$i][24],
									'goldar_siswa'			=> '-',
									'hobi_siswa'			=> '-',
									'penyakit_siswa'		=> '-',
									'tinggi'				=> '',
									'berat'					=> '',
									'kelompok'				=> $rows[$i][25],
									'tanggal_masuk'			=> $tanggal_masuk,
									'jenis_siswa'			=> $rows[$i][1],
									'asal_sekolah'			=> $rows[$i][27],
									'alamat_sekolah_asal'	=> $rows[$i][28],
									'dari_kelompok'			=> $rows[$i][29],
									'tanggal_pindah'		=> $tanggal_pindah,
									'anak_ke'				=> $rows[$i][10],
									'jumlah_saudara'		=> '',
									'gambar'				=> '',
									'status_siswa'			=> $this->request->getPost('status_siswa'),
									'tanggal_baca'			=> date('Y-m-d H:i:s'),
									'tanggal_post'			=> date('Y-m-d H:i:s')
								];
						$m_siswa->tambah($data);
						// masuk ke rombel kelas
						$siswa = $m_siswa->read($slug_siswa);
						if($siswa) {
							if($import_rombel=='Ya') {
								$data = [	'id_user'				=> $this->session->get('id_user'),
											'id_rombel'				=> $rombel_detail->id_rombel,
											'id_tahun'				=> $rombel_detail->id_tahun,
											'id_siswa'				=> $siswa->id_siswa,
											'id_kelas'				=> $rombel_detail->id_kelas,
											'status_siswa_rombel'	=> $this->request->getPost('status_siswa'),
											'keterangan'			=> '-',
										];
								$m_siswa_rombel->tambah($data);
							}
						}
					}
					
	            }
	            $i++;
	        }
			// masuk database
			$this->session->setFlashdata('sukses','Data telah siswa telah berhasil diimport.');
			return redirect()->to(base_url('admin/siswa'));
        }else{

			$data = [	'title'			=> 'Import Data Siswa',
						'm_siswa'		=> $m_siswa,
						'rombel'		=> $rombel,
						'content'		=> 'admin/siswa/import'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// proses
	public function proses()
	{
		
		$m_siswa	= new Siswa_model();
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_siswa 	= $this->request->getVar('id_siswa');
		if(empty($this->request->getVar('id_siswa')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih siswa. Pilih salah satu siswa');
		}
		if($submit=='update') {
   			for($i=0; $i < sizeof($id_siswa);$i++) {
				$data = array(	'id_siswa'		=> $id_siswa[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_siswa'	=> $this->request->getVar('status_siswa')
							);
   				$m_siswa->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Siswa berhasil diupdate statusnya');
		}elseif($submit=='delete') {
			for($i=0; $i < sizeof($id_siswa);$i++) {
				$data = array(	'id_siswa'		=> $id_siswa[$i]);
   				$m_siswa->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Siswa berhasil dihapus');
		}
	}

	// tambah
	public function tambah()
	{
		
		$m_siswa 	= new Siswa_model();
		$siswa 	= $m_siswa->last_id();
		if($siswa) {
			$urutan = $siswa->id_siswa+1;
		}else{
			$urutan = 1;
		}

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_siswa' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {

			if($this->request->getPost('identitas_wali')=='Ayah') {
				$id_agama_wali 		= $this->request->getPost('id_agama_ayah');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_ayah');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_ayah');
				$nama_wali			= $this->request->getPost('nama_ayah');
				$alamat_wali 		= $this->request->getPost('alamat_ayah');
				$telepon_wali		= $this->request->getPost('telepon_ayah');
			}elseif($this->request->getPost('identitas_wali')=='Ibu') {
				$id_agama_wali 		= $this->request->getPost('id_agama_ibu');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_ibu');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_ibu');
				$nama_wali			= $this->request->getPost('nama_ibu');
				$alamat_wali 		= $this->request->getPost('alamat_ibu');
				$telepon_wali		= $this->request->getPost('telepon_ibu');
			}else{
				$id_agama_wali 		= $this->request->getPost('id_agama_wali');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_wali');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_wali');
				$nama_wali			= $this->request->getPost('nama_wali');
				$alamat_wali 		= $this->request->getPost('alamat_wali');
				$telepon_wali		= $this->request->getPost('telepon_wali');
			}
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  					= $this->request->getFile('gambar');
				$nama_siswabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_siswabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_siswabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_siswabaru);
	        	// masuk database
	        	$slug_siswa 	= strtolower(url_title($this->request->getVar('nama_siswa'))).'-'.$this->request->getPost('nis').'-'.$this->request->getPost('nisn');
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'id_agama'				=> $this->request->getPost('id_agama'),
							'id_agama_ayah'			=> $this->request->getPost('id_agama_ayah'),
							'id_agama_ibu'			=> $this->request->getPost('id_agama_ibu'),
							'id_agama_wali'			=> $id_agama_wali,
							'id_pekerjaan_ayah'		=> $this->request->getPost('id_pekerjaan_ayah'),
							'id_pekerjaan_ibu'		=> $this->request->getPost('id_pekerjaan_ibu'),
							'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
							'id_jenjang_ayah'		=> $this->request->getPost('id_jenjang_ayah'),
							'id_jenjang_ibu'		=> $this->request->getPost('id_jenjang_ibu'),
							'id_jenjang_wali'		=> $id_jenjang_wali,
							'id_tahun'				=> $this->request->getPost('id_tahun'),
							'id_kelas'				=> $this->request->getPost('id_kelas'),
							'id_jenjang'			=> $this->request->getPost('id_jenjang'),
							'id_hubungan'			=> $this->request->getPost('id_hubungan'),
							'slug_siswa'			=> $slug_siswa,
							'nis'					=> $this->request->getPost('nis'),
							'nisn'					=> $this->request->getPost('nisn'),
							'status_wn'				=> $this->request->getPost('status_wn'),
							'negara_asal'			=> $this->request->getPost('negara_asal'),
							'nama_siswa'			=> $this->request->getPost('nama_siswa'),
							'nama_panggilan'		=> $this->request->getPost('nama_panggilan'),
							'tempat_lahir'			=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'			=> $this->website->tanggal_input($this->request->getPost('tanggal_lahir')),
							'alamat'				=> $this->request->getPost('alamat'),
							'telepon'				=> $this->request->getPost('telepon'),
							'kode_pos'				=> $this->request->getPost('kode_pos'),
							'website'				=> $this->request->getPost('website'),
							'email'					=> $this->request->getPost('email'),
							'jenis_kelamin'			=> $this->request->getPost('jenis_kelamin'),
							'berkebutuhan_khusus'	=> $this->request->getPost('berkebutuhan_khusus'),
							'isi'					=> $this->request->getPost('isi'),
							'nama_ayah'				=> $this->request->getPost('nama_ayah'),
							'nama_ibu'				=> $this->request->getPost('nama_ibu'),
							'nama_wali'				=> $nama_wali,
							'alamat_ayah'			=> $this->request->getPost('alamat_ayah'),
							'alamat_ibu'			=> $this->request->getPost('alamat_ibu'),
							'alamat_wali'			=> $alamat_wali,
							'telepon_ayah'			=> $this->request->getPost('telepon_ayah'),
							'telepon_ibu'			=> $this->request->getPost('telepon_ibu'),
							'telepon_wali'			=> $telepon_wali,
							'goldar_siswa'			=> $this->request->getPost('goldar_siswa'),
							'hobi_siswa'			=> $this->request->getPost('hobi_siswa'),
							'penyakit_siswa'		=> $this->request->getPost('penyakit_siswa'),
							'tinggi'				=> $this->request->getPost('tinggi'),
							'berat'					=> $this->request->getPost('berat'),
							'kelompok'				=> $this->request->getPost('kelompok'),
							'tanggal_masuk'			=> $this->website->tanggal_input($this->request->getPost('tanggal_masuk')),
							'jenis_siswa'			=> $this->request->getPost('jenis_siswa'),
							'asal_sekolah'			=> $this->request->getPost('asal_sekolah'),
							'alamat_sekolah_asal'	=> $this->request->getPost('alamat_sekolah_asal'),
							'dari_kelompok'			=> $this->request->getPost('dari_kelompok'),
							'tanggal_pindah'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pindah')),
							'anak_ke'				=> $this->request->getPost('anak_ke'),
							'jumlah_saudara'		=> $this->request->getPost('jumlah_saudara'),
							'gambar'				=> $nama_siswabaru,
							'status_siswa'			=> $this->request->getPost('status_siswa'),
							'tanggal_baca'			=> date('Y-m-d H:i:s'),
							'tanggal_post'			=> date('Y-m-d H:i:s')
						];
				$m_siswa->tambah($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/siswa'));
			}else{
				// masuk database
				$slug_siswa 	= strtolower(url_title($this->request->getVar('nama_siswa'))).'-'.$urutan;
				$data = [	'id_user'				=> $this->session->get('id_user'),
							'id_agama'				=> $this->request->getPost('id_agama'),
							'id_agama_ayah'			=> $this->request->getPost('id_agama_ayah'),
							'id_agama_ibu'			=> $this->request->getPost('id_agama_ibu'),
							'id_agama_wali'			=> $id_agama_wali,
							'id_pekerjaan_ayah'		=> $this->request->getPost('id_pekerjaan_ayah'),
							'id_pekerjaan_ibu'		=> $this->request->getPost('id_pekerjaan_ibu'),
							'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
							'id_jenjang_ayah'		=> $this->request->getPost('id_jenjang_ayah'),
							'id_jenjang_ibu'		=> $this->request->getPost('id_jenjang_ibu'),
							'id_jenjang_wali'		=> $id_jenjang_wali,
							'id_tahun'				=> $this->request->getPost('id_tahun'),
							'id_kelas'				=> $this->request->getPost('id_kelas'),
							'id_jenjang'			=> $this->request->getPost('id_jenjang'),
							'id_hubungan'			=> $this->request->getPost('id_hubungan'),
							'slug_siswa'			=> $slug_siswa,
							'nis'					=> $this->request->getPost('nis'),
							'nisn'					=> $this->request->getPost('nisn'),
							'status_wn'				=> $this->request->getPost('status_wn'),
							'negara_asal'			=> $this->request->getPost('negara_asal'),
							'nama_siswa'			=> $this->request->getPost('nama_siswa'),
							'nama_panggilan'		=> $this->request->getPost('nama_panggilan'),
							'tempat_lahir'			=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'			=> $this->website->tanggal_input($this->request->getPost('tanggal_lahir')),
							'alamat'				=> $this->request->getPost('alamat'),
							'telepon'				=> $this->request->getPost('telepon'),
							'kode_pos'				=> $this->request->getPost('kode_pos'),
							'website'				=> $this->request->getPost('website'),
							'email'					=> $this->request->getPost('email'),
							'jenis_kelamin'			=> $this->request->getPost('jenis_kelamin'),
							'berkebutuhan_khusus'	=> $this->request->getPost('berkebutuhan_khusus'),
							'isi'					=> $this->request->getPost('isi'),
							'nama_ayah'				=> $this->request->getPost('nama_ayah'),
							'nama_ibu'				=> $this->request->getPost('nama_ibu'),
							'nama_wali'				=> $nama_wali,
							'alamat_ayah'			=> $this->request->getPost('alamat_ayah'),
							'alamat_ibu'			=> $this->request->getPost('alamat_ibu'),
							'alamat_wali'			=> $alamat_wali,
							'telepon_ayah'			=> $this->request->getPost('telepon_ayah'),
							'telepon_ibu'			=> $this->request->getPost('telepon_ibu'),
							'telepon_wali'			=> $telepon_wali,
							'goldar_siswa'			=> $this->request->getPost('goldar_siswa'),
							'hobi_siswa'			=> $this->request->getPost('hobi_siswa'),
							'penyakit_siswa'		=> $this->request->getPost('penyakit_siswa'),
							'tinggi'				=> $this->request->getPost('tinggi'),
							'berat'					=> $this->request->getPost('berat'),
							'kelompok'				=> $this->request->getPost('kelompok'),
							'tanggal_masuk'			=> $this->website->tanggal_input($this->request->getPost('tanggal_masuk')),
							'jenis_siswa'			=> $this->request->getPost('jenis_siswa'),
							'asal_sekolah'			=> $this->request->getPost('asal_sekolah'),
							'alamat_sekolah_asal'	=> $this->request->getPost('alamat_sekolah_asal'),
							'dari_kelompok'			=> $this->request->getPost('dari_kelompok'),
							'tanggal_pindah'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pindah')),
							'anak_ke'				=> $this->request->getPost('anak_ke'),
							'jumlah_saudara'		=> $this->request->getPost('jumlah_saudara'),
							// 'gambar'				=> $nama_siswabaru,
							'status_siswa'			=> $this->request->getPost('status_siswa'),
							'tanggal_baca'			=> date('Y-m-d H:i:s'),
							'tanggal_post'			=> date('Y-m-d H:i:s')
						];
				// masuk database
				$m_siswa->tambah($data);
				$this->session->setFlashdata('sukses','Data telah ditambah');
				return redirect()->to(base_url('admin/siswa'));
			}
	    }else{
			$data = [	'title'		=> 'Tambah Data Siswa',
						'siswa'	=> $siswa,
						'urutan'	=> $urutan,
						'content'	=> 'admin/siswa/tambah'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_siswa)
	{
		
		$m_siswa 	= new Siswa_model();
		$siswa 	= $m_siswa->detail($id_siswa);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_siswa' 	=> 'required',
				'gambar'	 			=> [
								                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
								                'max_size[gambar,4096]',
			            					],
        	])) {
			if($this->request->getPost('identitas_wali')=='Ayah') {
				$id_agama_wali 		= $this->request->getPost('id_agama_ayah');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_ayah');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_ayah');
				$nama_wali			= $this->request->getPost('nama_ayah');
				$alamat_wali 		= $this->request->getPost('alamat_ayah');
				$telepon_wali		= $this->request->getPost('telepon_ayah');
			}elseif($this->request->getPost('identitas_wali')=='Ibu') {
				$id_agama_wali 		= $this->request->getPost('id_agama_ibu');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_ibu');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_ibu');
				$nama_wali			= $this->request->getPost('nama_ibu');
				$alamat_wali 		= $this->request->getPost('alamat_ibu');
				$telepon_wali		= $this->request->getPost('telepon_ibu');
			}else{
				$id_agama_wali 		= $this->request->getPost('id_agama_wali');
				$id_pekerjaan_wali 	= $this->request->getPost('id_pekerjaan_wali');
				$id_jenjang_wali	= $this->request->getPost('id_jenjang_wali');
				$nama_wali			= $this->request->getPost('nama_wali');
				$alamat_wali 		= $this->request->getPost('alamat_wali');
				$telepon_wali		= $this->request->getPost('telepon_wali');
			}
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$nama_siswabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$nama_siswabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$nama_siswabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$nama_siswabaru);
	        	// masuk database
	        	$slug_siswa 	= strtolower(url_title($this->request->getVar('nama_siswa'))).$this->request->getVar('nis');
				$data = [	'id_siswa'				=> $id_siswa,
							'id_user'				=> $this->session->get('id_user'),
							'id_agama'				=> $this->request->getPost('id_agama'),
							'id_agama_ayah'			=> $this->request->getPost('id_agama_ayah'),
							'id_agama_ibu'			=> $this->request->getPost('id_agama_ibu'),
							'id_agama_wali'			=> $id_agama_wali,
							'id_pekerjaan_ayah'		=> $this->request->getPost('id_pekerjaan_ayah'),
							'id_pekerjaan_ibu'		=> $this->request->getPost('id_pekerjaan_ibu'),
							'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
							'id_jenjang_ayah'		=> $this->request->getPost('id_jenjang_ayah'),
							'id_jenjang_ibu'		=> $this->request->getPost('id_jenjang_ibu'),
							'id_jenjang_wali'		=> $id_jenjang_wali,
							'id_tahun'				=> $this->request->getPost('id_tahun'),
							'id_kelas'				=> $this->request->getPost('id_kelas'),
							'id_jenjang'			=> $this->request->getPost('id_jenjang'),
							'id_hubungan'			=> $this->request->getPost('id_hubungan'),
							'slug_siswa'			=> $slug_siswa,
							'nis'					=> $this->request->getPost('nis'),
							'nisn'					=> $this->request->getPost('nisn'),
							'status_wn'				=> $this->request->getPost('status_wn'),
							'negara_asal'			=> $this->request->getPost('negara_asal'),
							'nama_siswa'			=> $this->request->getPost('nama_siswa'),
							'nama_panggilan'		=> $this->request->getPost('nama_panggilan'),
							'tempat_lahir'			=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'			=> $this->website->tanggal_input($this->request->getPost('tanggal_lahir')),
							'alamat'				=> $this->request->getPost('alamat'),
							'telepon'				=> $this->request->getPost('telepon'),
							'kode_pos'				=> $this->request->getPost('kode_pos'),
							'website'				=> $this->request->getPost('website'),
							'email'					=> $this->request->getPost('email'),
							'jenis_kelamin'			=> $this->request->getPost('jenis_kelamin'),
							'berkebutuhan_khusus'	=> $this->request->getPost('berkebutuhan_khusus'),
							'isi'					=> $this->request->getPost('isi'),
							'nama_ayah'				=> $this->request->getPost('nama_ayah'),
							'nama_ibu'				=> $this->request->getPost('nama_ibu'),
							'nama_wali'				=> $nama_wali,
							'alamat_ayah'			=> $this->request->getPost('alamat_ayah'),
							'alamat_ibu'			=> $this->request->getPost('alamat_ibu'),
							'alamat_wali'			=> $alamat_wali,
							'telepon_ayah'			=> $this->request->getPost('telepon_ayah'),
							'telepon_ibu'			=> $this->request->getPost('telepon_ibu'),
							'telepon_wali'			=> $telepon_wali,
							'goldar_siswa'			=> $this->request->getPost('goldar_siswa'),
							'hobi_siswa'			=> $this->request->getPost('hobi_siswa'),
							'penyakit_siswa'		=> $this->request->getPost('penyakit_siswa'),
							'tinggi'				=> $this->request->getPost('tinggi'),
							'berat'					=> $this->request->getPost('berat'),
							'kelompok'				=> $this->request->getPost('kelompok'),
							'tanggal_masuk'			=> $this->website->tanggal_input($this->request->getPost('tanggal_masuk')),
							'jenis_siswa'			=> $this->request->getPost('jenis_siswa'),
							'asal_sekolah'			=> $this->request->getPost('asal_sekolah'),
							'alamat_sekolah_asal'	=> $this->request->getPost('alamat_sekolah_asal'),
							'dari_kelompok'			=> $this->request->getPost('dari_kelompok'),
							'tanggal_pindah'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pindah')),
							'anak_ke'				=> $this->request->getPost('anak_ke'),
							'jumlah_saudara'		=> $this->request->getPost('jumlah_saudara'),
							'gambar'				=> $nama_siswabaru,
							'status_siswa'			=> $this->request->getPost('status_siswa'),
						];
				$m_siswa->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/siswa'));
			}else{
				// masuk database
				$slug_siswa 	= strtolower(url_title($this->request->getVar('nama_siswa'))).$this->request->getVar('nis');
				$data = [	'id_siswa'				=> $id_siswa,
							'id_user'				=> $this->session->get('id_user'),
							'id_agama'				=> $this->request->getPost('id_agama'),
							'id_agama_ayah'			=> $this->request->getPost('id_agama_ayah'),
							'id_agama_ibu'			=> $this->request->getPost('id_agama_ibu'),
							'id_agama_wali'			=> $id_agama_wali,
							'id_pekerjaan_ayah'		=> $this->request->getPost('id_pekerjaan_ayah'),
							'id_pekerjaan_ibu'		=> $this->request->getPost('id_pekerjaan_ibu'),
							'id_pekerjaan_wali'		=> $id_pekerjaan_wali,
							'id_jenjang_ayah'		=> $this->request->getPost('id_jenjang_ayah'),
							'id_jenjang_ibu'		=> $this->request->getPost('id_jenjang_ibu'),
							'id_jenjang_wali'		=> $id_jenjang_wali,
							'id_tahun'				=> $this->request->getPost('id_tahun'),
							'id_kelas'				=> $this->request->getPost('id_kelas'),
							'id_jenjang'			=> $this->request->getPost('id_jenjang'),
							'id_hubungan'			=> $this->request->getPost('id_hubungan'),
							'slug_siswa'			=> $slug_siswa,
							'nis'					=> $this->request->getPost('nis'),
							'nisn'					=> $this->request->getPost('nisn'),
							'status_wn'				=> $this->request->getPost('status_wn'),
							'negara_asal'			=> $this->request->getPost('negara_asal'),
							'nama_siswa'			=> $this->request->getPost('nama_siswa'),
							'nama_panggilan'		=> $this->request->getPost('nama_panggilan'),
							'tempat_lahir'			=> $this->request->getPost('tempat_lahir'),
							'tanggal_lahir'			=> $this->website->tanggal_input($this->request->getPost('tanggal_lahir')),
							'alamat'				=> $this->request->getPost('alamat'),
							'telepon'				=> $this->request->getPost('telepon'),
							'kode_pos'				=> $this->request->getPost('kode_pos'),
							'website'				=> $this->request->getPost('website'),
							'email'					=> $this->request->getPost('email'),
							'jenis_kelamin'			=> $this->request->getPost('jenis_kelamin'),
							'berkebutuhan_khusus'	=> $this->request->getPost('berkebutuhan_khusus'),
							'isi'					=> $this->request->getPost('isi'),
							'nama_ayah'				=> $this->request->getPost('nama_ayah'),
							'nama_ibu'				=> $this->request->getPost('nama_ibu'),
							'nama_wali'				=> $nama_wali,
							'alamat_ayah'			=> $this->request->getPost('alamat_ayah'),
							'alamat_ibu'			=> $this->request->getPost('alamat_ibu'),
							'alamat_wali'			=> $alamat_wali,
							'telepon_ayah'			=> $this->request->getPost('telepon_ayah'),
							'telepon_ibu'			=> $this->request->getPost('telepon_ibu'),
							'telepon_wali'			=> $telepon_wali,
							'goldar_siswa'			=> $this->request->getPost('goldar_siswa'),
							'hobi_siswa'			=> $this->request->getPost('hobi_siswa'),
							'penyakit_siswa'		=> $this->request->getPost('penyakit_siswa'),
							'tinggi'				=> $this->request->getPost('tinggi'),
							'berat'					=> $this->request->getPost('berat'),
							'kelompok'				=> $this->request->getPost('kelompok'),
							'tanggal_masuk'			=> $this->website->tanggal_input($this->request->getPost('tanggal_masuk')),
							'jenis_siswa'			=> $this->request->getPost('jenis_siswa'),
							'asal_sekolah'			=> $this->request->getPost('asal_sekolah'),
							'alamat_sekolah_asal'	=> $this->request->getPost('alamat_sekolah_asal'),
							'dari_kelompok'			=> $this->request->getPost('dari_kelompok'),
							'tanggal_pindah'		=> $this->website->tanggal_input($this->request->getPost('tanggal_pindah')),
							'anak_ke'				=> $this->request->getPost('anak_ke'),
							'jumlah_saudara'		=> $this->request->getPost('jumlah_saudara'),
							// 'gambar'				=> $nama_siswabaru,
							'status_siswa'			=> $this->request->getPost('status_siswa'),
						];
				$m_siswa->edit($data);
				// masuk database
				$this->session->setFlashdata('sukses','Data telah disimpan');
				return redirect()->to(base_url('admin/siswa'));
			}
	    }else{
			$data = [	'title'				=> 'Edit Siswa: '.$siswa->nama_siswa,
						'siswa'	=> $siswa,
						'content'			=> 'admin/siswa/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_siswa)
	{
		
		$m_siswa = new Siswa_model();
		$data = ['id_siswa'	=> $id_siswa];
		$m_siswa->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/siswa'));
	}
}