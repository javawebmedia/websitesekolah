<p class="text-right">
	<a href="<?php echo base_url('admin/kelas') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/kelas/edit/'.$kelas->id_kelas)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Jenjang &amp; Status</label>
	<div class="col-7">
		<select name="id_jenjang" class="form-control select2" required>
			<option value="">Pilih Jenjang</option>
			<?php foreach($jenjang as $jenjang) { ?>
				<option value="<?php echo $jenjang->id_jenjang ?>" <?php if($kelas->id_jenjang==$jenjang->id_jenjang) { echo 'selected'; } ?>>
					<?php echo $jenjang->nama_jenjang ?> - <?php echo $jenjang->keterangan ?>
				</option>
			<?php } ?>
		</select>
	</div>
	<div class="col-2">
		<select name="status_kelas" class="form-control select2" required>
			<option value="Aktif">Aktif</option>
			<option value="Non Aktif" <?php if($kelas->status_kelas=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Nama Kelas</label>
	<div class="col-9">
		<input type="text" name="nama_kelas" class="form-control" placeholder="Nama kelas" value="<?php echo $kelas->nama_kelas ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan Lengkap</label>
	<div class="col-9">
		<textarea name="keterangan" class="form-control" placeholder="Keterangan Lengkap"><?php echo $kelas->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $kelas->urutan ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/kelas') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>