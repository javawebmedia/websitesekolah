<form action="<?php echo base_url('admin/konfigurasi/logo') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<input type="hidden" name="id_konfigurasi" value="<?php echo $konfigurasi->id_konfigurasi ?>">
<div class="form-group row">
	<label class="col-3">Upload Logo Baru</label>
	<div class="col-6">
		<input type="file" name="logo" value="<?php echo $konfigurasi->logo ?>" class="form-control">
		<small class="text-secondary">Format: JPG, PNG, GIF</small>
		<br>
		<button type="submit" class="btn btn-success mt-2"><i class="fa fa-save"></i> Simpan</button>
	</div>
	<div class="col-3">
		<img src="<?php echo $this->website->logo() ?>" class="img img-thumbnail">
	</div>
</div>



<?php echo form_close(); ?>