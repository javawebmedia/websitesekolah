<p class="text-right">
	<a href="<?php echo base_url('admin/prestasi') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/prestasi/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Prestasi</label>
	<div class="col-md-9">
		<input type="text" name="judul_prestasi" class="form-control" value="<?php echo set_value('judul_prestasi') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Penyelenggara dan Hadiah</label>
	<div class="col-md-5">
		<input type="text" name="penyelenggara" class="form-control" value="<?php echo set_value('penyelenggara') ?>">
		<small class="text-secondary">Penyelenggara kegitan. Misal: Kementerian Pendidikan dan Kebudayaan</small>
	</div>
	<div class="col-md-4">
		<input type="text" name="hadiah_prestasi" class="form-control" value="<?php echo set_value('hadiah_prestasi') ?>">
		<small class="text-secondary">Hadiah dan Penghargaan. Misal: Piala dan Uang Tunai</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Nama Penerima Prestasi/Penghargaan</label>
	<div class="col-md-6">
		<input type="text" name="nama_penerima" class="form-control" value="<?php echo set_value('nama_penerima') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Level, Tahun &amp; Tanggal</label>
	<div class="col-md-2">
		<select name="jenjang_prestasi" class="form-control">
			<option value="Sekolah">Sekolah</option>
			<option value="Kelurahan">Kelurahan</option>
			<option value="Kecamatan">Kecamatan</option>
			<option value="Kabupaten">Kabupaten</option>
			<option value="Provinsi">Provinsi</option>
			<option value="Nasional">Nasional</option>
			<option value="Internasional">Internasional</option>
		</select>
		<small class="text-secondary">Jenjang Prestasi</small>
	</div>
	<div class="col-md-2">
		<input type="number" name="tahun_prestasi" class="form-control" value="<?php if(isset($_POST['tahun_prestasi'])) { echo set_value('tahun_prestasi'); }else{ echo date('Y'); } ?>">
		<small class="text-secondary">Tahun Prestasi</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="tanggal_prestasi" class="form-control tanggal" value="<?php if(isset($_POST['tanggal_prestasi'])) { echo set_value('tanggal_prestasi'); }else{ echo date('d-m-Y'); } ?>">
		<small class="text-secondary">Tanggal Prestasi</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori &amp; Status</label>
	<div class="col-md-4">
		<select name="id_kategori_prestasi" class="form-control select2">
			<?php foreach($kategori_prestasi as $kategori_prestasi) { ?>
			<option value="<?php echo $kategori_prestasi->id_kategori_prestasi ?>">
				<?php echo $kategori_prestasi->nama_kategori_prestasi ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="status_prestasi" class="form-control">
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
	<label class="col-md-3">Upload Gambar Prestasi</label>
	<div class="col-md-6">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
	</div>
</div>


<div class="form-group row">
	<label class="col-md-3">Isi Prestasi</label>
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
		<a href="<?php echo base_url('admin/prestasi') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>