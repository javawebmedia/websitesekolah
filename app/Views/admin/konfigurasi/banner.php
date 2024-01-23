<form action="<?php echo base_url('admin/konfigurasi/banner') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<input type="hidden" name="id_konfigurasi" value="<?php echo $konfigurasi->id_konfigurasi ?>">

<div class="form-group row">
	<label class="col-3">Ringkasan Tentang Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<textarea name="ringkasan" class="form-control"><?php echo $konfigurasi->ringkasan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tentang Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<textarea name="tentang" class="form-control konten" rows="5"><?php echo $konfigurasi->tentang ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Text Link About Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="link_text" class="form-control" value="<?php echo $konfigurasi->link_text ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Link About Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="link_website" class="form-control" value="<?php echo $konfigurasi->link_website ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Link Video Profil <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="link_video" class="form-control" value="<?php echo $konfigurasi->link_video ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Upload Banner Baru <span class="text-danger">*</span></label>
	<div class="col-6">
		<input type="file" name="banner" value="<?php echo $konfigurasi->banner ?>" class="form-control">
		<small class="text-secondary">Format: JPG, PNG, GIF</small>
	</div>
	<div class="col-3">
		<img src="<?php echo $this->website->banner() ?>" class="img img-thumbnail">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/konfigurasi') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i>
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan dan Update</button>
	</div>
</div>

<?php echo form_close(); ?>