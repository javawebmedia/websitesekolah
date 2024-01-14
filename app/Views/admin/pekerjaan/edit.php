<p class="text-right">
	<a href="<?php echo base_url('admin/pekerjaan') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/pekerjaan/edit/'.$pekerjaan->id_pekerjaan)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Pekerjaan</label>
	<div class="col-9">
		<input type="text" name="nama_pekerjaan" class="form-control" placeholder="Nama pekerjaan" value="<?php echo $pekerjaan->nama_pekerjaan ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $pekerjaan->urutan ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/pekerjaan') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>