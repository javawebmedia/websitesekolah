<p class="text-right">
	<a href="<?php echo base_url('admin/client') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/client/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Nama Client</label>
	<div class="col-md-9">
		<input type="text" name="nama_client" class="form-control" value="<?php echo set_value('nama_client') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Jenis Kelamin, Tempat, dan Tanggal Lahir</label>
	<div class="col-md-3">
		<select name="jenis_kelamin" class="form-control">
			<option value="">Pilih Jenis Kelamin</option>
			<option value="Pria">Pria</option>
			<option value="Wanita">Wanita</option>
		</select>
		<small class="text-secondary">Jenis kelamin</small>
	</div>
	<div class="col-md-3">
		<input type="text" name="tempat_lahir" class="form-control" value="<?php echo set_value('tempat_lahir') ?>">
		<small class="text-secondary">Tempat lahir</small>
	</div>
	<div class="col-md-3">
		<input type="text" name="tanggal_lahir" class="form-control tanggal" value="<?php echo set_value('tanggal_lahir') ?>">
		<small class="text-secondary">Format: dd-mm-yyyy</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Telepon dan Website</label>
	<div class="col-md-3">
		<input type="text" name="telepon" class="form-control" value="<?php echo set_value('telepon') ?>">
		<small class="text-secondary">Telepon</small>
	</div>
	<div class="col-md-6">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website') ?>">
		<small class="text-secondary">Alamat website</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Alamat</label>
	<div class="col-md-9">
		<textarea name="alamat" class="form-control"><?php echo set_value('alamat') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Email (Username) &amp; Password</label>
	<div class="col-md-5">
		<input type="email" name="email" class="form-control" value="<?php echo set_value('email') ?>">
		<small class="text-secondary">Email</small>
	</div>
	<div class="col-md-4">
		<input type="text" name="password" class="form-control" value="<?php echo set_value('password') ?>">
		<small class="text-secondary">Password minimal 6 karakter</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Perusahaan/Organisasi &amp; Pimpinan</label>
	<div class="col-md-5">
		<input type="text" name="nama_perusahaan" class="form-control" value="<?php echo set_value('nama_perusahaan') ?>">
		<small class="text-secondary">Nama perusahaan/organisasi</small>
	</div>
	<div class="col-md-4">
		<input type="text" name="pimpinan" class="form-control" value="<?php echo set_value('pimpinan') ?>">
		<small class="text-secondary">Nama pimpinan</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-3">
		<select name="id_kategori_client" class="form-control">
			<?php foreach($kategori_client as $kategori_client) { ?>
			<option value="<?php echo $kategori_client->id_kategori_client ?>">
				<?php echo $kategori_client->nama_kategori_client ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-3">
		<select name="jenis_client" class="form-control">
			<option value="Perusahaan">Perusahaan</option>
			<option value="Perorangan">Perorangan</option>
			<option value="Pemerintahan">Pemerintahan</option>
		</select>
		<small class="text-secondary">Jenis client</small>
	</div>
	<div class="col-md-3">
		<select name="status_client" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft">Unpublished</option>
		</select>
		<small class="text-secondary">Status client</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Testimoni Client</label>
	<div class="col-md-9">
		<textarea name="isi_testimoni" class="form-control konten"><?php echo set_value('isi_testimoni') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Client</label>
	<div class="col-md-9">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/client') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i>
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>