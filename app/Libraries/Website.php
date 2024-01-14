<?php 
namespace App\Libraries;
use App\Models\Konfigurasi_model;
use App\Models\Sekolah_model;

class Website
{
	// namaweb
	public function namaweb()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->namaweb;
	}

	// singkatan
	public function singkatan()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->singkatan;
	}

	// website
	public function website()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->website;
	}

	// metatext
	public function metatext()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->metatext;
	}

	// fitur_pendaftaran
	public function fitur_pendaftaran()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->fitur_pendaftaran;
	}

	// kepsek
	public function kepsek()
	{
		$m_konfigurasi 	= new Sekolah_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->nama_kepsek;
	}

	// whatsapp
	public function whatsapp()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->whatsapp;
	}

	// pesan_whatsapp
	public function pesan_whatsapp()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$pesan 			= str_replace(' ','%20',$konfigurasi->pesan_whatsapp);
		return $pesan;
	}

	// namasekolah
	public function namasekolah()
	{
		$m_konfigurasi 	= new Sekolah_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->nama_sekolah;
	}

	// alamat
	public function alamat()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return nl2br($konfigurasi->alamat);
	}

	// facebok
	public function facebook()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->facebook;
	}

	// nama_facebook
	public function nama_facebook()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->nama_facebook;
	}

	// youtube
	public function youtube()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->facebook;
	}

	// nama_youtube
	public function nama_youtube()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->nama_youtube;
	}

	// instagram
	public function instagram()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->facebook;
	}

	// nama_instagram
	public function nama_instagram()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->nama_instagram;
	}

	// github
	public function twitter()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->twitter;
	}

	// nama_github
	public function nama_twitter()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->nama_twitter;
	}

	// website
	public function websitenya()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->website;
	}

	// keywords
	public function keywords()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->keywords;
	}

	// description
	public function description()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->deskripsi;
	}

	// tagline
	public function tagline()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->tagline;
	}

	// paginasi
	public function paginasi()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->paginasi;
	}

	// paginasi_depan
	public function paginasi_depan()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return $konfigurasi->paginasi_depan;
	}

	// icon
	public function icon()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return base_url('assets/upload/image/'.$konfigurasi->icon);
	}

	// banner
	public function banner()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return base_url('assets/upload/image/'.$konfigurasi->banner);
	}

	// logo
	public function logo()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		return base_url('assets/upload/image/'.$konfigurasi->logo);
	}

	// tanggal_bulan
	public function tanggal_id($tanggal)
	{
		if($tanggal=='' || $tanggal==NULL || $tanggal=='0000-00-00' || $tanggal=='1970-01-01') {
			return FALSE;
		}else{
			$hasil = date('d-m-Y',strtotime($tanggal));
			return $hasil;
		}
	}

	// Romawi
	public function romawi($bulan)
	{
		if($bulan=='01') {
			$romawi = 'I';
		}elseif($bulan=='02') {
			$romawi = 'II';
		}elseif($bulan=='03') {
			$romawi = 'III';
		}elseif($bulan=='04') {
			$romawi = 'IV';
		}elseif($bulan=='05') {
			$romawi = 'V';
		}elseif($bulan=='06') {
			$romawi = 'VI';
		}elseif($bulan=='07') {
			$romawi = 'VII';
		}elseif($bulan=='08') {
			$romawi = 'VIII';
		}elseif($bulan=='09') {
			$romawi = 'IX';
		}elseif($bulan=='10') {
			$romawi = 'X';
		}elseif($bulan=='11') {
			$romawi = 'XI';
		}elseif($bulan=='12') {
			$romawi = 'XII';
		}
		return $romawi;
	}

	// Romawi
	public function bulan($bulan)
	{
		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}
		return $nama_bulan;
	}

	// Romawi
	public function bulan_pendek($bulan)
	{
		if($bulan=='01') {
			$nama_bulan_pendek = 'Jan';
		}elseif($bulan=='02') {
			$nama_bulan_pendek = 'Feb';
		}elseif($bulan=='03') {
			$nama_bulan_pendek = 'Mar';
		}elseif($bulan=='04') {
			$nama_bulan_pendek = 'Apr';
		}elseif($bulan=='05') {
			$nama_bulan_pendek = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan_pendek = 'Jun';
		}elseif($bulan=='07') {
			$nama_bulan_pendek = 'Jul';
		}elseif($bulan=='08') {
			$nama_bulan_pendek = 'Agus';
		}elseif($bulan=='09') {
			$nama_bulan_pendek = 'Sep';
		}elseif($bulan=='10') {
			$nama_bulan_pendek = 'Okt';
		}elseif($bulan=='11') {
			$nama_bulan_pendek = 'Nov';
		}elseif($bulan=='12') {
			$nama_bulan_pendek = 'Des';
		}
		return $nama_bulan_pendek;
	}

	// Romawi
	public function hari($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}

		$hasil = $nama_hari.', '.date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// tanggal_bulan
	public function tanggal_bulan($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}

		$hasil = date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// tanggal_bulan
	public function tanggal_bulan_menit($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}

		$hasil = date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal)).' '.date('H:i',strtotime($tanggal));
		return $hasil;
	}

	// tanggal_bulan
	public function tanggal_singkat($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		if($bulan=='01') {
			$nama_bulan = 'Jan';
		}elseif($bulan=='02') {
			$nama_bulan = 'Feb';
		}elseif($bulan=='03') {
			$nama_bulan = 'Mar';
		}elseif($bulan=='04') {
			$nama_bulan = 'Apr';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Jun';
		}elseif($bulan=='07') {
			$nama_bulan = 'Jul';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agus';
		}elseif($bulan=='09') {
			$nama_bulan = 'Sep';
		}elseif($bulan=='10') {
			$nama_bulan = 'Okt';
		}elseif($bulan=='11') {
			$nama_bulan = 'Nov';
		}elseif($bulan=='12') {
			$nama_bulan = 'Des';
		}

		$hasil = date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// Tanggal input
	public function tanggal_input($tanggal)
	{
		if($tanggal=='' || $tanggal==NULL || $tanggal=='0000-00-00' || $tanggal=='1970-01-01') {
			return FALSE;
		}else{
			$hasil = date('Y-m-d',strtotime($tanggal));
			return $hasil;
		}
	}

	// Tanggal input
	public function tanggal_add($tanggal)
	{
		if($tanggal=='' || $tanggal==NULL || $tanggal=='0000-00-00' || $tanggal=='1970-01-01') {
			$hasil = NULL;
			return $hasil;
		}else{
			$hasil = date('Y-m-d',strtotime($tanggal));
			// Live Server
			$proses = strtoupper(date('d-M-Y',strtotime($tanggal)));
			// Offline Server
			// $proses = strtoupper(date('Y-m-d',strtotime($tanggal)));
			return $proses;
		}
	}

	// Tanggal input
	public function tanggal_oci($tanggal)
	{
		if($tanggal=='' || $tanggal==NULL || $tanggal=='0000-00-00' || $tanggal=='1970-01-01') {
			$hasil = NULL;
			return $hasil;
		}else{
			$hasil = date('Y-m-d',strtotime($tanggal));
			// return "to_date('".$hasil."','dd-mm-yy hh24:mi:ss')";
			return $hasil;
		}
	}

	// Nomor
	public function angka($angka)
	{
		$hasil = number_format($angka,'0',',','.');
		return $hasil;
	}
}