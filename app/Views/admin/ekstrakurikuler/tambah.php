<p class="text-right">
	<a href="<?php echo base_url('admin/ekstrakurikuler') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/ekstrakurikuler/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Judul Ekstrakurikuler</label>
	<div class="col-md-10">
		<input type="text" name="judul_ekstrakurikuler" class="form-control" value="<?php echo set_value('judul_ekstrakurikuler') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Nama Penanggung Jawab</label>
	<div class="col-md-6">
		<input type="text" name="nama_penanggung_jawab" class="form-control" value="<?php echo set_value('nama_penanggung_jawab') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload Gambar Ekstrakurikuler</label>
	<div class="col-md-6">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
	</div>
</div>


<div class="form-group row">
	<label class="col-md-2">Kategori &amp; Status</label>
	<div class="col-md-2">
		<select name="id_kategori_ekstrakurikuler" class="form-control select2">
			<?php foreach($kategori_ekstrakurikuler as $kategori_ekstrakurikuler) { ?>
			<option value="<?php echo $kategori_ekstrakurikuler->id_kategori_ekstrakurikuler ?>">
				<?php echo $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="status_ekstrakurikuler" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft">Draft</option>
		</select>
		<small class="text-secondary">Status Tampil</small>
	</div>
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya">Aktif</option>
			<option value="Tidak">Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Isi Ekstrakurikuler</label>
	<div class="col-md-10">
		<textarea name="isi" class="form-control konten"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Text untuk tombol link</label>
	<div class="col-md-10">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Link/URL untuk Banner</label>
	<div class="col-md-10">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<a href="<?php echo base_url('admin/ekstrakurikuler') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>