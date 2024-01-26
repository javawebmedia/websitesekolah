<?php if(date('Y-m-d')>="2021-05-03") { ?>

<?php if($siswa['raport']=="") {}else{ ?>
<div class="alert alert-success text-center">
	<h4>Hai <em><?php echo $siswa['nama_lengkap'] ?></em>.</h4>
	<hr>
	<h3>Raport Anda:<br> <span class="badge badge-warning"><i class="fa fa-check"></i> TERSEDIA</span></h3>
	<hr>
	<p>Scroll ke bawah untuk mengunduh Dokumen Raport Anda.</p>
</div>
<?php } ?>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td class="bg-light" width="25%">Nama lengkap</td>
			<td><?php echo $siswa['nama_lengkap'] ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nama panggilan</td>
			<td><?php echo $siswa['nama_panggilan'] ?></td>
		</tr>
		<tr>
			<td class="bg-light">NIS/NISN</td>
			<td><?php echo $siswa['nis'] ?> / <?php echo $siswa['nisn'] ?></td>
		</tr>
		<tr>
			<td class="bg-light">Jurusan/Kelas/ABS</td>
			<td><?php echo $siswa['jurusan'] ?> / <?php echo $siswa['kelas'] ?> / <?php echo $siswa['abs'] ?></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor Peserta</td>
			<td><?php echo $siswa['no_peserta'] ?></td>
		</tr>
		<tr>
			<td class="bg-light">Tempat lahir</td>
			<td><?php echo $siswa['tempat_lahir'] ?></td>
		</tr>
		<tr>
			<td class="bg-light">Tanggal lahir</td>
			<td><?php echo hari($siswa['tanggal_lahir']) ?></td>
		</tr>
		<tr>
			<td colspan="2" class="bg-secondary">
				<h4>Berikut adalah data/dokumen raport Anda.
					<?php if($siswa['raport']=="") {}else{ ?>
				 		<a href="<?php echo base_url('siswa/kelulusan/download') ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-download"></i> Unduh Dokumen</a>
				 	<?php } ?>
			 	</h4></td>
		</tr>
		<tr>
			<td colspan="2">
				<?php if($siswa['raport']=="") { ?>
					<p class="alert alert-warning">Data raport Anda belum tersedia.</p>
				<?php }else{ ?>
					<iframe src="<?php echo base_url('assets/upload/raport/'.$siswa['raport']) ?>" style="width: 100%;" height="1200" allowfullscreen webkitallowfullscreen></iframe>
				<?php } ?>
			</td>
		</tr>
	</tbody>
</table>
<?php }else{ ?>
<p class="alert alert-success text-center">
    <i class="fa fa-exclamation-triangle"></i>
    <br>
    Upss... Mohon maaf, pengumuman belum dibuka.</p>
<?php } ?>



