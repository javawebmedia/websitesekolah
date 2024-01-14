<form action="<?php echo base_url('admin/agenda/edit/'.$agenda['id_agenda']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama &amp; Kode Agenda Wisata</label>
	<div class="col-sm-9">
		<input type="text" name="nama_agenda" class="form-control form-control-lg text-capitalize" placeholder="Nama Agenda" required value="<?php echo $agenda['nama_agenda'] ?>">
		<small class="text-gray">Setiap awal kata gunakan huruf capital. Misal: <strong>Agenda Web Design</strong></small>
	</div>	
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Upload Foto/ Gambar dan Status Buka Pendaftaran (Kontingen)</label>
	<div class="col-sm-6">
		<input type="file" name="gambar" class="form-control" placeholder="Upload gambar" id="file">
		<div id="imagePreview"></div>
		<small class="text-gray">Gambar format: jpg, jpeg, png, gif, svg</small>
	</div>
	<div class="col-sm-3">
		<select name="status_pendaftaran" class="form-control">
			<option value="Buka">Buka</option>
			<option value="Tutup" 
			<?php if($agenda['status_pendaftaran']=="Tutup") { echo "selected"; } ?>>Tutup</option>
		</select>
		<small class="text-gray">Status Buka Pendaftaran (Kontingen)</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Tanggal Pendaftaran (Kontingen) Dibuka &amp; Ditutup</label>
	<div class="col-sm-4">
		<input type="text" name="tanggal_buka" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($agenda['tanggal_buka']) ?>">
		<small class="text-gray">Tanggal Buka</small>
	</div>
	<div class="col-sm-4">
		<input type="text" name="tanggal_tutup" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($agenda['tanggal_tutup']) ?>">
		<small class="text-gray">Tanggal Tutup</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Kategori, Status &amp; Kode</label>
	<div class="col-sm-4">
		<select name="id_kategori_agenda" class="form-control">
			<?php foreach($kategori_agenda as $kategori_agenda) { ?>
				<option value="<?php echo $kategori_agenda['id_kategori_agenda'] ?>" <?php if($kategori_agenda['id_kategori_agenda'] == $agenda['id_kategori_agenda']) { echo "selected"; } ?>><?php echo $kategori_agenda['nama_kategori_agenda'] ?></option>
			<?php } ?>

		</select>
		<small class="text-gray">Kategori Agenda</small>
	</div>
	<div class="col-sm-2">
		<select name="status_agenda" class="form-control">
			<option value="Publish">Published</option>
			<option value="Draft" 
			<?php if($agenda['status_agenda']=="Draft") { echo "selected"; } ?>
			>Draft</option>
		</select>
		<small class="text-gray">Status Publikasi</small>
	</div>
	<div class="col-sm-3">
		<input type="text" name="kode_agenda" class="form-control" placeholder="Kode Agenda" required value="<?php echo $agenda['kode_agenda'] ?>">
		<small class="text-gray">Gunakan huruf capital. Misal: <strong>WDEV</strong></small>
	</div>
</div>




<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Tanggal Periode Diskon</label>
	<div class="col-sm-2">
		<input type="text" name="tanggal_mulai" class="form-control tanggal" required value="<?php echo $this->website->tanggal_id($agenda['tanggal_mulai']) ?>">
		<small class="text-gray">Tanggal mulai</small>
	</div>
	<div class="col-sm-2">
		<input type="text" name="jam_mulai" class="form-control jam" required value="<?php echo $agenda['jam_mulai'] ?>">
		<small class="text-gray">Jam mulai: 08:00</small>
	</div>
	<div class="col-sm-2">
		<input type="text" name="tanggal_selesai" class="form-control tanggal" required value="<?php echo $this->website->tanggal_id($agenda['tanggal_selesai']) ?>">
		<small class="text-gray">Tanggal selesai</small>
	</div>
	<div class="col-sm-2">
		<input type="text" name="jam_selesai" class="form-control jam" required value="<?php echo $agenda['jam_selesai'] ?>">
		<small class="text-gray">Jam selesai: 12:00</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Biaya Pendaftaran (Kontingen)</label>
	<div class="col-sm-4">
		<input type="number" name="harga" class="form-control" required value="<?php echo $agenda['harga'] ?>">
		<small class="text-gray">Biaya Pendaftaran (Kontingen) normal</small>
	</div>
	<div class="col-sm-4">
		<input type="number" name="harga_diskon" class="form-control" required value="<?php echo $agenda['harga_diskon'] ?>">
		<small class="text-gray">Biaya Pendaftaran (Kontingen) <em>Diskon</em></small>
	</div>
</div>

<hr>
<h4 class="text-center mb-1">Venue/Tempat Pelaksanaan</h4>
<br>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama Tempat</label>
	<div class="col-sm-9">
		<input type="text" name="nama_tempat" class="form-control" required value="<?php echo $agenda['nama_tempat'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Link Google Map</label>
	<div class="col-sm-9">
		<input type="text" name="link_google_map" class="form-control" required value="<?php echo $agenda['link_google_map'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Alamat lengkap</label>
	<div class="col-sm-9">
		<textarea name="alamat" class="form-control nilai" ><?php echo $agenda['alamat'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Iframe Google Map</label>
	<div class="col-sm-8">
		<textarea name="google_map" class="form-control"><?php echo $agenda['google_map'] ?></textarea>
	</div>
</div>

<hr>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Deskripsi Ringkas</label>
	<div class="col-sm-8">
		<textarea name="deskripsi" class="form-control" placeholder="Deskripsi Agenda"><?php echo $agenda['deskripsi'] ?></textarea>
		<small class="text-gray">Penjelasan secara ringkas agenda</small>
	</div>
</div>


	<div class="form-group row">
		<label class="col-sm-3 control-label text-right">Deskripsi Lengkap</label>
		<div class="col-sm-9">
			<textarea name="isi" id="isi"  class="form-control konten" placeholder="Deskripsi Agenda"><?php echo $agenda['isi'] ?></textarea>
		</div>
	</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Keywords (untuk pencarian Google)</label>
	<div class="col-sm-8">
		<textarea name="keywords" class="form-control"><?php echo $agenda['keywords'] ?></textarea>
		<small class="text-gray">Gunakan koma sebagai pemisah, misalnya: <strong>web design, desain grafis, agenda web, agenda android</strong></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Urutan</label>
	<div class="col-sm-8">
		<input type="text" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $agenda['urutan'] ?>">
	</div>
</div>

	

	<div class="form-group row">
		<label class="col-sm-3 control-label text-right"></label>
		<div class="col-sm-8">
			<div class="form-group btn-group pull-right">
				<button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button>
				<input type="reset" name="reset" class="btn btn-info btn-lg" value="Reset">
			</div>

		</div>
	</div>
	<?php
// Form close
	echo form_close();
	?>