<p class="text-right">
	<a href="<?php echo base_url('admin/portfolio') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/portfolio/edit/'.$portfolio->id_portfolio) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Portfolio</label>
	<div class="col-md-9">
		<input type="text" name="judul_portfolio" class="form-control" value="<?php echo $portfolio->judul_portfolio ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Portfolio</label>
	<div class="col-md-8">
		<input type="file" name="gambar" class="form-control" value="<?php echo $portfolio->gambar ?>">
	</div>
	<div class="col-md-1">
		<img src="<?php echo base_url('assets/upload/image/thumbs/'.$portfolio->gambar) ?>" class="img img-thumbnail">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-3">
		<select name="id_kategori_portfolio" class="form-control">
			<?php foreach($kategori_portfolio as $kategori_portfolio) { ?>
			<option value="<?php echo $kategori_portfolio->id_kategori_portfolio ?>" <?php if($portfolio->id_kategori_portfolio==$kategori_portfolio->id_kategori_portfolio) { echo 'selected'; } ?>>
				<?php echo $kategori_portfolio->nama_kategori_portfolio ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="jenis_portfolio" class="form-control">
			<option value="Portfolio">Portfolio</option>
			<option value="Homepage" <?php if($portfolio->jenis_portfolio=="Homepage") { echo 'selected'; } ?>>Homepage Slider</option>
			<option value="Header" <?php if($portfolio->jenis_portfolio=="Header") { echo 'selected'; } ?>>Header Halaman</option>
			<option value="Pop Up" <?php if($portfolio->jenis_portfolio=="Pop Up") { echo 'selected'; } ?>>Pop Up Homepage</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya">Aktif</option>
			<option value="Tidak" <?php if($portfolio->status_text=="Tidak") { echo 'selected'; } ?>>Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
	<div class="col-md-2">
		<select name="status_portfolio" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($portfolio->status_portfolio=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status status_portfolio</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Portfolio</label>
	<div class="col-md-9">
		<textarea name="isi" class="form-control konten"><?php echo $portfolio->isi ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Text untuk tombol link</label>
	<div class="col-md-9">
		<input type="text" name="text_website" class="form-control" value="<?php echo $portfolio->text_website ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL untuk Banner</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo $portfolio->website ?>">
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