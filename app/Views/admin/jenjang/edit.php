<p class="text-right">
	<a href="<?php echo base_url('admin/jenjang') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/jenjang/edit/'.$jenjang->id_jenjang)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Jenjang Pendidikan</label>
	<div class="col-7">
		<input type="text" name="nama_jenjang" class="form-control" placeholder="Nama jenjang" value="<?php echo $jenjang->nama_jenjang ?>" required>
	</div>

	<div class="col-2">
		<select name="status_aktif" class="form-control">
			<option value="Ya">Ya Aktif</option>
			<option value="Tidak" <?php if($jenjang->status_aktif=='Tidak') { echo 'selected'; } ?>>Tidak Aktif</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan Lengkap</label>
	<div class="col-9">
		<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Lengkap" value="<?php echo $jenjang->keterangan ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $jenjang->urutan ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/jenjang') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>