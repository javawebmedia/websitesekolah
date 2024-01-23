<p class="text-right">
	<a href="<?php echo base_url('admin/fasilitas') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/fasilitas/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul/Nama Fasilitas</label>
	<div class="col-md-9">
		<input type="text" name="judul_fasilitas" class="form-control" value="<?php echo set_value('judul_fasilitas') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kode/Nomor Fasilitas</label>
	<div class="col-md-6">
		<input type="text" name="kode_nomor_fasilitas" class="form-control" value="<?php echo set_value('kode_nomor_fasilitas') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Fasilitas</label>
	<div class="col-md-6">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kondisi, Tahun &amp; Tanggal</label>
	<div class="col-md-2">
		<select name="kondisi_fasilitas" class="form-control">
			<option value="Baik">Baik</option>
			<option value="Rusak">Rusak</option>
			<option value="Hilang">Hilang</option>
		</select>
		<small class="text-secondary">Kondisi Fasilitas</small>
	</div>
	<div class="col-md-2">
		<input type="number" name="tahun_fasilitas" class="form-control" value="<?php echo set_value('tahun_fasilitas') ?>">
		<small class="text-secondary">Tahun Fasilitas</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="tanggal_fasilitas" class="form-control tanggal" value="<?php echo set_value('tanggal_fasilitas') ?>">
		<small class="text-secondary">Tanggal Fasilitas</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori &amp; Status</label>
	<div class="col-md-4">
		<select name="id_kategori_fasilitas" class="form-control select2">
			<?php foreach($kategori_fasilitas as $kategori_fasilitas) { ?>
			<option value="<?php echo $kategori_fasilitas->id_kategori_fasilitas ?>">
				<?php echo $kategori_fasilitas->nama_kategori_fasilitas ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="status_fasilitas" class="form-control">
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
	<label class="col-md-3">Isi Fasilitas</label>
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
		<a href="<?php echo base_url('admin/fasilitas') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>