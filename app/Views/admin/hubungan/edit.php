<p class="text-right">
	<a href="<?php echo base_url('admin/hubungan') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/hubungan/edit/'.$hubungan->id_hubungan)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama Hubungan Keluarga</label>
	<div class="col-9">
		<input type="text" name="nama_hubungan" class="form-control" placeholder="Nama hubungan" value="<?php echo $hubungan->nama_hubungan ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan Lengkap</label>
	<div class="col-9">
		<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Lengkap" value="<?php echo $hubungan->keterangan ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $hubungan->urutan ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/hubungan') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>