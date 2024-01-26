<?php 
use App\Models\Siswa_rombel_model;
use App\Models\Staff_rombel_model;
use App\Models\Kelas_model;
$m_siswa_rombel = new Siswa_rombel_model();
$m_staff_rombel = new Staff_rombel_model();
$m_kelas 				= new Kelas_model();
echo form_open(base_url('admin/rombel/kelola'), ' method="get"'); 
?>

<div class="row">

  <div class="col-md-8">
    <div class="input-group rounded">                  
      <select name="id_tahun" class="form-control select2" required>
      	<option value="">Pilih Tahun Ajaran</option>
      	<?php foreach($tahun as $tahun) { ?>
      		<option value="<?php echo $tahun->id_tahun ?>" <?php if(isset($_GET['id_tahun']) && $_GET['id_tahun']==$tahun->id_tahun) { echo 'selected'; } ?>><?php echo $tahun->tahun_mulai ?>/<?php echo $tahun->tahun_selesai ?> - <?php echo $tahun->nama_tahun ?></option>
      	<?php } ?>
      </select>
      <span class="input-group-btn ">
      	<button type="submit" name="lihat" value="lihat" class="btn btn-info btn-flat">
        	<i class="fa fa-eye"></i> Lihat Rombongan Belajar
        </button>
        <button type="submit" name="submit" value="submit" class="btn btn-success btn-flat">
        	<i class="fa fa-plus-circle"></i> Buat Rombongan Belajar
        </button>
        
      </span>
    </div>
  </div>
  
</div>

<?php echo form_close() ?>

<br>

<?php if($jenjang) { ?>
	<div class="callout callout-info">
		<strong>Perhatian </strong> Berikut ini adalah data kelas <strong class="text-danger"><em>Rombongan Belajar <?php echo $rombel->nama_tahun ?></em></strong>
	</div>

	<table class="table table-sm border-bottom" id="example3">
	<thead>
		<tr class="bg-light table-striped text-center">
			<th width="5%">No</th>
			<th width="15%" class="text-left align-middle">Nama</th>
			<th width="10%" class="text-left align-middle">Status</th>
			<th width="10%" class="text-center align-middle">Jumlah Siswa</th>
			<th width="20%" class="text-left align-middle">Wali Kelas</th>
			<th width="20%" class="text-left align-middle">Guru</th>
			
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($kelas as $kelas) { 
			$kelasnya = $m_kelas->jenjang($kelas->id_jenjang);
		?>
		<tr class="bg-light" id="jenjang<?php echo $kelas->id_jenjang ?>">
			<td colspan="6"><strong><?php echo $kelas->nama_jenjang ?> (<?php echo $kelas->keterangan_jenjang ?>)</strong></td>
			<td></td>
		</tr>

		<?php 
		if($kelasnya) { 
			$i=1; 
			foreach($kelasnya as $kelasnya) { 
				$check 	= $m_rombel->check($tahun_ajaran->id_tahun,$kelasnya->id_kelas);
				$wali 	= $m_staff_rombel->total_rombel($tahun_ajaran->id_tahun,$kelasnya->id_kelas,'Wali');
				$guru 	= $m_staff_rombel->total_rombel($tahun_ajaran->id_tahun,$kelasnya->id_kelas,'Guru');
				$siswa 	= $m_siswa_rombel->total_rombel($tahun_ajaran->id_tahun,$kelasnya->id_kelas);
		?>
		<tr>
			<td class="text-center"><?php echo $i ?>.</td>
			<td><?php echo $kelasnya->nama_kelas ?></td>
			<td>
				<?php 
				if($check) { 
					if($check->status_rombel=='Aktif') {
				?>
					<span class="badge bg-success"><i class="fa fa-check-circle"></i> <?php echo $check->status_rombel ?></span>
				<?php }else{ ?>
					<span class="badge bg-secondary"><i class="fa fa-times"></i> <?php echo $check->status_rombel ?></span>
				<?php 
				} }
				?>
			</td>
			<td class="text-center"><?php if($siswa) { echo $siswa->total; }else{  } ?></td>
			<td>
				<?php foreach($wali as $wali) { echo $wali->nama.'<br>'; } ?>

			</td>
			<td>
				<?php foreach($guru as $guru) { echo $guru->nama.'<br>'; } ?>
			</td>
			
			<td>
				<?php if($check) { ?>
					<a href="<?php echo base_url('admin/rombel/anggota/'.$check->id_rombel) ?>" class="btn btn-info btn-sm mb-1" title="Kelola Guru &amp; Siswa"><i class="fa fa-users"></i></a>
					<a href="<?php echo base_url('admin/rombel/unduh/'.$check->id_rombel) ?>" class="btn btn-danger btn-sm mb-1" target="_blank" title="Unduh PDF"><i class="fa fa-file-pdf"></i></a>
					<a href="<?php echo base_url('admin/rombel/cetak/'.$check->id_rombel) ?>" class="btn btn-dark btn-sm mb-1" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>
					<a href="<?php echo base_url('admin/rombel/excel/'.$check->id_rombel) ?>" class="btn btn-success btn-sm mb-1" target="_blank" title="Unduh Excel"><i class="fa fa-file-excel"></i></a>
					<?php if($siswa->total > 0) { ?>
						<a href="#" class="btn btn-light disabled btn-sm  mb-1 delete-link"><i class="fa fa-trash"></i></a>
					<?php }else{ ?>
						<a href="<?php echo base_url('admin/rombel/delete/'.$check->id_rombel) ?>" class="btn btn-secondary btn-sm  mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
					<?php } ?>
				<?php } ?>
			</td>
		</tr>
		<?php $i++; }} $no++; } ?>
	</tbody>
</table>

<?php }else{ ?>
<div class="callout callout-info text-left">
	<strong>Perhatian!</strong> 
	<?php if($akhir) { ?>
		Belum ada rombel yang dibuat untuk <?php echo $tahun_ajaran->nama_tahun ?>.
	<?php }else{ ?>
		Belum ada rombel yang dibuat.
	<?php } ?>
</div>
<?php } ?>