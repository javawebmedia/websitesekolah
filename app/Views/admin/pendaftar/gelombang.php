<?php
$id_gelombang 	= $gelombang->id_gelombang;
$menunggu 		= $m_siswa->status_siswa_gelombang('Menunggu',$id_gelombang);
$ditolak 		= $m_siswa->status_siswa_gelombang('Ditolak',$id_gelombang);
$diterima 		= $m_siswa->status_siswa_gelombang('Diterima',$id_gelombang);
?>
<p>
	<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Menunggu') ?>" class="btn btn-warning btn-xs">
		<i class="fa fa-clock"></i> <?php echo $this->website->angka($menunggu->total) ?> Menunggu
	</a>
	<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Ditolak') ?>"  class="btn btn-danger btn-xs">
		<i class="fa fa-times-circle"></i> <?php echo $this->website->angka($ditolak->total) ?> Ditolak
	</a>
	<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Diterima') ?>"  class="btn btn-success btn-xs"> 
		<i class="fa fa-check-circle"></i> <?php echo $this->website->angka($diterima->total) ?> Diterima
	</a>
	<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Semua') ?>" class="btn btn-secondary btn-xs"><i class="fa fa-tasks"></i> Semua Pendaftar</a>
</p>