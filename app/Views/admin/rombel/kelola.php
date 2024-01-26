<table class="table table-sm table-bordered">
	<tbody>
		<tr>
			<td class="bg-light" width="20%">Tahun Ajaran</td>
			<td><?php echo $tahun_ajaran->nama_tahun ?></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Kelas</td>
			<td></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Siswa</td>
			<td></td>
		</tr>
	</tbody>
</table>


<?php 
use App\Models\Siswa_rombel_model;
use App\Models\Staff_rombel_model;
use App\Models\Kelas_model;
$m_siswa_rombel = new Siswa_rombel_model();
$m_staff_rombel = new Staff_rombel_model();
$m_kelas 				= new Kelas_model();
echo form_open(base_url('admin/rombel/kelola?id_tahun='.$tahun_ajaran->id_tahun)); 
echo csrf_field(); 
?>
<div class="input-group mt-3 mb-2 alert alert-light">
	<select name="status_rombel" class="form-control col-md-3">
		<option value="Aktif">Aktif</option>
		<option value="Non Aktif">Non Aktif</option>
	</select>
	<input type="text" name="keterangan" class="form-control" placeholder="Catatan">
	<span class="input-group-append">
		<button type="submit" name="submit" value="Update" class="btn btn-success">
			<i class="fa fa-search"></i> Simpan &amp; Update
		</button>
		<a href="<?php echo base_url('admin/rombel') ?>" class="btn btn-secondary">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
	</span>
</div>

<input type="hidden" name="id_tahun" value="<?php echo $tahun_ajaran->id_tahun ?>">
<input type="hidden" name="tahun_mulai" value="<?php echo $tahun_ajaran->tahun_mulai ?>">
<input type="hidden" name="tahun_selesai" value="<?php echo $tahun_ajaran->tahun_selesai ?>">

<div class="clearfix"></div>
    <div class="table-responsive mailbox-messages">

<table class="table table-sm border-bottom" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">
				<div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
              </div>
			</th>
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
			<td class="text-center">
				<?php if($check) { ?>
					<span class="btn btn-secondary btn-sm">
						<i class="fa fa-check-circle"></i>
					</span>
				<?php }else{ ?>
					<div class="icheck-primary">
		              <input type="checkbox" name="id_kelas[]" value="<?php echo $kelasnya->id_kelas ?>" id="check<?php echo $i ?>_<?php echo $no ?>">
		              <label for="check<?php echo $i ?>_<?php echo $no ?>"></label>
		            </div>
				<?php } ?>
				
			</td>
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
			<td><?php foreach($wali as $wali) { echo $wali->nama.'<br>'; } ?></td>
			<td><?php foreach($guru as $guru) { echo $guru->nama.'<br>'; } ?></td>
			
			<td>
				<?php if($check) { ?>
					<a href="<?php echo base_url('admin/rombel/anggota/'.$check->id_rombel) ?>" class="btn btn-info btn-sm"><i class="fa fa-users"></i> Kelola Guru &amp; Siswa</a>
					<?php if($siswa->total > 0) { ?>
						<a href="#" class="btn btn-light disabled btn-sm  mb-1 delete-link"><i class="fa fa-trash"></i></a>
					<?php }else{ ?>
					<a href="<?php echo base_url('admin/rombel/delete/'.$check->id_rombel.'?id_tahun='.$tahun_ajaran->id_tahun) ?>" class="btn btn-secondary btn-sm delete-link"><i class="fa fa-trash"></i></a>
				<?php }} ?>
			</td>
		</tr>
		<?php $i++; }} $no++; } ?>
	</tbody>
</table>
</div>

<?php echo form_close() ?>