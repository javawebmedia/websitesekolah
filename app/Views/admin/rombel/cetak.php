<?php  
use App\Libraries\Website;
use App\Models\Sekolah_model;
$this->website 	= new Website(); 
$m_sekolah 		= new Sekolah_model();
$sekolah 		= $m_sekolah->listing();
$id_sekolah 	= $sekolah->id_sekolah;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title ?></title>
<link href="<?php echo base_url('assets/css/css-print.css') ?>" rel="stylesheet" media="print">
<link href="<?php echo base_url('assets/css/css-print.css') ?>" rel="stylesheet" media="screen">
</head>

<body onload="print()">
<page size="A4" layout="portrait">
<div class="cetak">

	<table>
		<tbody>
			<tr>
				<td style="width: 1.8cm;">
					<img src="<?php echo $this->website->icon() ?>" style="width: 1.5cm; height: auto;">
				</td>
				<td>
					<h1>INFORMASI KELAS
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
				<td class="bg-light" width="20%">Tahun Ajaran</td>
				<td><?php echo $rombel->nama_tahun ?></td>
			</tr>
			<tr>
				<td class="bg-light" >Kelas</td>
				<td><?php echo $rombel->nama_kelas ?></td>
			</tr>
			<tr>
				<td class="bg-light" >Jenjang</td>
				<td><?php echo $rombel->nama_jenjang ?></td>
			</tr>
		</tbody>
	</table>

	<h3>Data Guru dan Wali Kelas</h3>
	<table class="printer">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="60%">Nama Guru</th>
				<th>Status Guru</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($staff_rombel as $staff_rombel) { ?>
			<tr>
				<td class="text-center"><?php echo $no ?></td>
				<td><?php echo $staff_rombel->nama ?></td>
				<td><?php echo $staff_rombel->status_guru_rombel ?> Kelas</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>

	
	<h3>Data Siswa</h3>
	<table class="printer">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="30%">Nama</th>
				<th>L/P</th>
				<th>TTL</th>
			</tr>
		</thead>
		<tbody>  
			<?php $no=1; foreach($siswa_rombel as $siswa_rombel) { ?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $siswa_rombel->nama_siswa ?></td>
				<td><?php echo $siswa_rombel->jenis_kelamin ?></td>
				<td><?php echo $siswa_rombel->tempat_lahir.', '.$this->website->tanggal_id($siswa_rombel->tanggal_lahir); ?></td>
			</tr>    
			<?php $no++; } ?>                    
		</tbody>
	</table>



<table class="printer">
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