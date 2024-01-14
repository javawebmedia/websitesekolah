<p class="text-right">
	<a href="<?php echo base_url('admin/usia') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/usia/edit/'.$usia->id_usia)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Kelompok Usia</label>
	<div class="col-6">
		<input type="text" name="nama_usia" class="form-control" placeholder="Nama usia" value="<?php echo $usia->nama_usia ?>" required>
	</div>

	<div class="col-2">
		<select name="status_aktif" class="form-control">
			<option value="Ya">Ya Aktif</option>
			<option value="Tidak" <?php if($usia->status_aktif=='Tidak') { echo 'selected'; } ?>>Tidak Aktif</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Rentang Usia</label>
	<div class="col-4">
		<input type="number" name="minimal" class="form-control" placeholder="Minimal" value="<?php echo $usia->minimal ?>" required>
	</div>
	<div class="col-4">
		<input type="number" name="maksimal" class="form-control" placeholder="Maksimal" value="<?php echo $usia->maksimal ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan Lengkap</label>
	<div class="col-9">
		<textarea name="keterangan" class="form-control" placeholder="Keterangan Lengkap"><?php echo $usia->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $usia->urutan ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/usia') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>