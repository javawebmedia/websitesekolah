<?php if(date('Y-m-d H:i')>="2022-05-05 17:00") { ?>

<?php if($siswa['skl']=="") {}else{ ?>
<div class="alert alert-success text-center">
	<h4>Hai <em><?php echo $siswa['nama_lengkap'] ?></em>.</h4>
	<hr>
	<h3>Anda dinyatakan:<br> <span class="badge badge-warning"><i class="fa fa-check"></i> LULUS</span></h3>
	<hr>
	<p>Scroll ke bawah untuk mengunduh Dokumen Kelulusan Anda.</p>
</div>
<?php } ?>
<table class="table table-bordered">
	<tbody>
		<tr>
		    <td class="text-center">
		        <h4><strong>PENGUMUMAN KELULUSAN SISWA
		        <br>SMAN 2 BLORA TAHUN PELAJARAN <?php $tahun = date('Y')-1; echo $tahun.'/'.date('Y'); ?>
		        </strong></h4>
		    </td>
		    </tr>
		    </tbody>
		    </table>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td class="bg-light" width="25%">Nama lengkap</td>
			<td><?php echo $siswa['nama_lengkap'] ?></td>
		</tr>
		<!--<tr>-->
		<!--	<td class="bg-light">Nama panggilan</td>-->
		<!--	<td><?php echo $siswa['nama_panggilan'] ?></td>-->
		<!--</tr>-->
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
			<td class="bg-light">Tempat, tanggal lahir</td>
			<td><?php echo strtoupper($siswa['tempat_lahir']) ?>, <?php echo strtoupper(hari($siswa['tanggal_lahir'])) ?></td>
		</tr>
		<tr>
			<td colspan="2" class="bg-success text-center">
				STATUS KELULUSAN</td>
		</tr>
		<tr>
			<td colspan="2" class="text-center">
				<?php if($siswa['status_siswa']=="" || $siswa['status_siswa']=="TIDAK LULUS") { ?>
					<p class="alert alert-warning">-</p>
				<?php }else{ ?>
				 Selamat, Anda dinyatakan<br>
					<button class="btn btn-success"><i class="fa fa-check-circle"></i>
					<?php if($siswa['skl'] !='' || $siswa['skl'] !=NULL) { echo 'LULUS'; }else{ echo $siswa['status_siswa']; } ?></button>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="bg-success text-center">
				DATA SKL (SURAT KETERANGAN LULUS)
					<?php if($siswa['skl']=="") {}else{ ?>
				 		<a href="<?php echo base_url('siswa/kelulusan/unduh') ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-download"></i> Unduh Dokumen</a>
				 	<?php } ?>
			 	</td>
		</tr>
		<tr>
			<td colspan="2" class="text-center">
				<?php if($siswa['skl']=="") { ?>
					<p class="alert alert-warning">
					    <br><strong>Catatan:</strong> <br>
Data dokumen kelulusan Anda belum tersedia. Raport dan SKL akan diberikan pada saat acara pelepasan (kecuali bagi yang berkepentingan dapat diambil mulai tanggal 9 Mei 2022)
					</p>
				<?php }else{ ?>
					<iframe src="<?php echo base_url('assets/upload/siswa/'.$siswa['skl']) ?>" style="width: 100%;" height="1200" allowfullscreen webkitallowfullscreen></iframe>
				<?php } ?>
			</td>
		</tr>
	</tbody>
</table>
<?php }else{ ?>
<p class="alert alert-success text-center">
    <i class="fa fa-exclamation-triangle"></i>
    <br>
    Upss... Mohon maaf, pengumuman kelulusan belum dibuka.</p>
<?php } ?>



