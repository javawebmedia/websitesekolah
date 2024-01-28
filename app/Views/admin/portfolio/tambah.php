<p class="text-right">
	<a href="<?php echo base_url('admin/portfolio') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/portfolio/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Portfolio</label>
	<div class="col-md-9">
		<input type="text" name="judul_portfolio" class="form-control" value="<?php echo set_value('judul_portfolio') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Portfolio</label>
	<div class="col-md-9">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-3">
		<select name="id_kategori_portfolio" class="form-control">
			<?php foreach($kategori_portfolio as $kategori_portfolio) { ?>
			<option value="<?php echo $kategori_portfolio->id_kategori_portfolio ?>">
				<?php echo $kategori_portfolio->nama_kategori_portfolio ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="jenis_portfolio" class="form-control">
			<option value="Portfolio">Portfolio</option>
			<option value="Homepage">Homepage Slider</option>
			<option value="Header">Header Halaman</option>
			<option value="Pop Up">Pop Up Homepage</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya">Aktif</option>
			<option value="Tidak">Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
	<div class="col-md-2">
		<select name="status_portfolio" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft">Draft</option>
		</select>
		<small class="text-secondary">Status status_portfolio</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Portfolio</label>
	<div class="col-md-9">
		<textarea name="isi" class="form-control konten"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Text untuk tombol link</label>
	<div class="col-md-9">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL untuk Banner</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/portfolio') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>