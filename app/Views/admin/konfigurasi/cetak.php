<?php  
use App\Libraries\Website;
$this->website          = new Website(); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title ?></title>
<link href="<?php echo base_url('assets/css/css-print.css') ?>" rel="stylesheet" media="print">
<link href="<?php echo base_url('assets/css/css-print.css') ?>" rel="stylesheet" media="screen">
</head>

<body>
<page size="A4" layout="portrait">
<div class="cetak">

	<table>
		<tbody>
			<tr>
				<td style="width: 1.8cm;">
					<img src="<?php echo $this->website->icon() ?>" style="width: 1.5cm; height: auto;">
				</td>
				<td>
					<h1>INFORMASI SEKOLAH
						<br><?php echo $sekolah->nama_sekolah ?>
					</h1>
				</td>
			</tr>
		</tbody>
	</table>
	<hr><br>

	<table class="printer">
	<tbody>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>DATA DASAR SEKOLAH</h3></td>
	  </tr>
		<tr>
			<td class="bg-light" width="30%">Nama lengkap sekolah</td>
			<td><?php echo $sekolah->nama_sekolah ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Singkat</td>
			<td><?php echo $sekolah->nama_singkat ?></td>
		</tr>
		<tr>
			<td class="bg-light">NPSN/NSS/NISN</td>
			<td><?php echo $sekolah->nis ?></td>
		</tr>
		<tr>
			<td class="bg-light">Status Sekolah</td>
			<td><?php echo $sekolah->status_sekolah ?></td>
		</tr>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>KONTAK DAN ALAMAT SEKOLAH</h3></td>
	  </tr>
		<tr>
			<td class="bg-light">Alamat</td>
			<td><?php echo nl2br($sekolah->alamat) ?></td>
		</tr>
		<tr>
			<td class="bg-light">Kelurahan</td>
			<td><?php echo $sekolah->kelurahan ?></td>
		</tr>
		<tr>
			<td class="bg-light">Kecamatan</td>
			<td><?php echo $sekolah->kecamatan ?></td>
		</tr>
		<tr>
			<td class="bg-light">Kabupaten</td>
			<td><?php echo $sekolah->kabupaten ?></td>
		</tr>
		<tr>
			<td class="bg-light">Provinsi</td>
			<td><?php echo $sekolah->provinsi ?></td>
		</tr>
		<tr>
			<td class="bg-light">Kode Pos</td>
			<td><?php echo $sekolah->kode_pos ?></td>
		</tr>
		<tr>
			<td class="bg-light">Telepon</td>
			<td><?php echo $sekolah->telepon ?></td>
		</tr>
		<tr>
			<td class="bg-light">Email</td>
			<td><?php echo $sekolah->email ?></td>
		</tr>
		<tr>
			<td class="bg-light">Website</td>
			<td><?php echo $sekolah->website ?></td>
		</tr>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>INFORMASI, AKREDITASI DAN YAYASAN</h3></td>
	  </tr>
		<tr>
			<td class="bg-light">Nama Yayasan</td>
			<td><?php echo $sekolah->nama_yayasan ?></td>
		</tr>
		<tr>
			<td class="bg-light">Tanggal berdiri Yayasan/Sekolah</td>
			<td><?php echo $this->website->tanggal_id($sekolah->tanggal_berdiri) ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Kepala Sekolah</td>
			<td><?php echo $sekolah->nama_kepsek ?></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Rombel</td>
			<td><?php echo $sekolah->jumlah_rombel ?></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Siswa</td>
			<td><?php echo $sekolah->jumlah_murid ?></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Pegawai</td>
			<td><?php echo $sekolah->jumlah_pegawai ?></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Akreditasi</td>
			<td><?php echo $sekolah->nilai_akreditasi ?>
			</td>
		</tr>
		<tr>
			<td class="bg-light">Tahun Akreditasi</td>
			<td><?php echo $sekolah->tahun_akreditasi ?></td>
		</tr>
		<tr>
			<td class="bg-light">Tanggal Akreditasi</td>
			<td><?php echo $this->website->tanggal_id($sekolah->tanggal_berlaku) ?></td>
		</tr>
		<tr>
			<td class="bg-light">Tanggal Kadaluarsa Akreditasi</td>
			<td><?php echo $this->website->tanggal_id($sekolah->tanggal_kadaluarsa) ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor Izin Sekolah</td>
			<td><?php echo $sekolah->nomor_izin ?></td>
		</tr>
		<tr>
			<td class="bg-light">Keterangan lain</td>
			<td><?php echo nl2br($sekolah->keterangan) ?></td>
		</tr>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>INFORMASI TANAH DAN BANGUNAN</h3></td>
	  </tr>
		<tr>
			<td class="bg-light">Luas Tanah</td>
			<td><?php echo $sekolah->luas_tanah ?> m<sup>2</sup></td>
		</tr>
		<tr>
			<td class="bg-light">Luas Bangunan</td>
			<td><?php echo $sekolah->luas_bangunan ?> m<sup>2</sup></td>
		</tr>
		<tr>
			<td class="bg-light">Status Kepemilikan</td>
			<td><?php echo $sekolah->status_tanah ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor IMB</td>
			<td><?php echo $sekolah->imb ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor Sertifikat Tanah</td>
			<td><?php echo $sekolah->nomor_sertifikat ?></td>
		</tr>
		
	</tbody>
</table>

<table>
	<tbody>
		<tr>
			<td width="60%"></td>
			<td>
				<?php echo $sekolah->kabupaten ?>, <?php echo $this->website->tanggal_bulan(date('Y-m-d')) ?>
				<br>
				<br>
				<br>
				<br>
				<br><strong><u><?php echo $sekolah->nama_kepsek ?></u></strong>
				<br>Kepala Sekolah
			</td>
		</tr>
	</tbody>
</table>
</div>
</page>
</body>
</html>