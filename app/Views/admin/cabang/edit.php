<p class="text-right">
	<a href="<?php echo base_url('admin/cabang') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<form action="<?php echo base_url('admin/cabang/edit/'.$cabang->id_cabang) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Nama Cabang</label>
	<div class="col-md-9">
		<input type="text" name="nama_cabang" class="form-control" value="<?php echo $cabang->nama_cabang ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Nama Singkat &amp; Nomor <span class="text-danger">*</span></label>
	<div class="col-md-6">
		<input type="text" name="singkatan" class="form-control" placeholder="Nama Singkat" value="<?php echo $cabang->singkatan ?>">
	</div>
	<div class="col-md-3">
		<input type="text" name="nomor" class="form-control" placeholder="Nomor" value="<?php echo $cabang->nomor ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Pelatih &amp; HP/Telepon <span class="text-danger">*</span></label>
	<div class="col-md-6">
		<input type="text" name="nama_pelatih" class="form-control" placeholder="Nama Pelatih Penanggung Jawab" value="<?php echo $cabang->nama_pelatih ?>">
	</div>
	<div class="col-md-3">
		<input type="text" name="telepon" class="form-control" placeholder="Nomor telepon/HP" value="<?php echo $cabang->telepon ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Google Map &amp; Email <span class="text-danger">*</span></label>
	<div class="col-md-6">
		<input type="text" name="google_map" class="form-control" placeholder="Link Google Map" value="<?php echo $cabang->google_map ?>">
	</div>
	<div class="col-md-3">
		<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $cabang->email ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Alamat lengkap</label>
	<div class="col-md-9">
		<textarea name="alamat" class="form-control"><?php echo $cabang->alamat ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Cabang</label>
	<div class="col-md-9">
		<input type="file" name="gambar" class="form-control" value="<?php echo $cabang->gambar ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-3">
		<select name="id_kategori_cabang" class="form-control">
			<?php foreach($kategori_cabang as $kategori_cabang) { ?>
			<option value="<?php echo $kategori_cabang->id_kategori_cabang ?>" <?php if($cabang->id_kategori_cabang==$kategori_cabang->id_kategori_cabang) { echo 'selected'; } ?>>
				<?php echo $kategori_cabang->nama_kategori_cabang ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="jenis_cabang" class="form-control">
			<option value="Cabang">Cabang</option>
			<option value="Pusat" <?php if($cabang->jenis_cabang=="Pusat") { echo 'selected'; } ?>>Pusat</option>
		</select>
		<small class="text-secondary">Jenis cabang</small>
	</div>
	<div class="col-md-2">
		<select name="status_cabang" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($cabang->status_cabang=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status publikasi</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="icon" class="form-control" value="<?php echo $cabang->icon ?>">
		<small class="text-secondary">Icon <a href="https://fontawesome.com/icons" target="_blank">Fontawsome</a></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Informasi Cabang</label>
	<div class="col-md-9">
		<textarea name="isi" class="form-control konten"><?php echo $cabang->isi ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Keyword Cabang (untuk SEO Google)</label>
	<div class="col-md-9">
		<textarea name="keywords" class="form-control"><?php echo $cabang->keywords ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Tanggal Aktif &amp; Urutan</label>
	<div class="col-md-6">
		<input type="text" name="tanggal_publish" class="form-control tanggal" value="<?php if(isset($_POST['tanggal_publis'])) { echo $cabang->tanggal_publish; }else{ echo $this->website->tanggal_id(set_value('tanggal_publish')); } ?>">
		<small class="text-secondary">Format <strong>dd-mm-yyyy</strong>. Misal: <?php echo date('d-m-Y') ?></small>
	
		<input type="hidden" name="jam" class="form-control jam" value="<?php if(isset($_POST['jam'])) { echo $cabang->jam; }else{ echo date('H:i:s',strtotime($cabang->tanggal_publish)); } ?>">
	</div>
	<div class="col-md-2">
		<input type="number" name="urutan" class="form-control" value="<?php if(isset($_POST['urutan'])) { echo $cabang->urutan; }else{ echo $cabang->urutan; } ?>">
		<small class="text-secondary">Nomor urut tampil</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/cabang') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="reset" class="btn btn-secondary"><i class="fa fa-times"></i> Reset</button>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>