<?php 
echo form_open(base_url('admin/konfigurasi')); 
echo csrf_field(); 
?>

<h4>Informasi Dasar</h4>
<hr>
<div class="form-group row">
	<label class="col-3">Nama Website</label>
	<div class="col-9">
		<input type="text" name="namaweb" class="form-control" value="<?php echo $konfigurasi->namaweb ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Singkatan Website</label>
	<div class="col-9">
		<input type="text" name="singkatan" class="form-control" value="<?php echo $konfigurasi->singkatan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tagline Website</label>
	<div class="col-9">
		<input type="text" name="tagline" class="form-control" value="<?php echo $konfigurasi->tagline ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Alamat Website</label>
	<div class="col-6">
		<input type="text" name="website" class="form-control" value="<?php echo $konfigurasi->website ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Setting Pagination</label>
	<div class="col-3">
		<input type="number" name="paginasi" class="form-control" value="<?php echo $konfigurasi->paginasi ?>">
		<small class="text-gray">Paginasi back end</small>
	</div>
	<div class="col-3">
		<input type="number" name="paginasi_depan" class="form-control" value="<?php echo $konfigurasi->paginasi_depan ?>">
		<small class="text-gray">Paginasi front end</small>
	</div>
</div>



<hr>
<h4>Informasi Profil Website/Aplikasi</h4>
<hr>
<div class="form-group row">
	<label class="col-3">Tentang Website</label>
	<div class="col-9">
		<textarea name="tentang" class="form-control konten" rows="5"><?php echo $konfigurasi->tentang ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Deskripsi Ringkas</label>
	<div class="col-9">
		<textarea name="deskripsi" class="form-control"><?php echo $konfigurasi->deskripsi ?></textarea>
	</div>
</div>

<hr>
<h4>Kontak dan Alamat</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Official Email</label>
	<div class="col-6">
		<input type="text" name="email" class="form-control" value="<?php echo $konfigurasi->email ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Secondary Email</label>
	<div class="col-6">
		<input type="text" name="email_cadangan" class="form-control" value="<?php echo $konfigurasi->email_cadangan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Telepon</label>
	<div class="col-6">
		<input type="text" name="telepon" class="form-control" value="<?php echo $konfigurasi->telepon ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">HP</label>
	<div class="col-6">
		<input type="text" name="hp" class="form-control" value="<?php echo $konfigurasi->hp ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Alamat</label>
	<div class="col-9">
		<textarea name="alamat" class="form-control summernote"><?php echo $konfigurasi->alamat ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Google Map</label>
	<div class="col-9">
		<textarea name="google_map" class="form-control"><?php echo $konfigurasi->google_map ?></textarea>
	</div>
</div>

<hr>
<h4>Kontak Whatsapp</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Nomor Whatsapp <i class="fab fa-whatsapp text-success"></i></label>
	<div class="col-6">
		<input type="text" name="whatsapp" class="form-control" value="<?php echo $konfigurasi->whatsapp ?>">
		<small class="text-warning">Format nomor: 628122727427</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Pesan Whatsapp</label>
	<div class="col-9">
		<textarea name="pesan_whatsapp" class="form-control"><?php echo $konfigurasi->pesan_whatsapp ?></textarea>
	</div>
</div>

<hr>
<h4>Jejaring Sosial</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Facebook <i class="fab fa-facebook"></i></label>
	<div class="col-3">
		<input type="text" name="nama_facebook" class="form-control" value="<?php echo $konfigurasi->nama_facebook ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="facebook" class="form-control" value="<?php echo $konfigurasi->facebook ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Twitter <i class="fab fa-twitter"></i></label>
	<div class="col-3">
		<input type="text" name="nama_twitter" class="form-control" value="<?php echo $konfigurasi->nama_twitter ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="twitter" class="form-control" value="<?php echo $konfigurasi->twitter ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Instagram <i class="fab fa-instagram"></i></label>
	<div class="col-3">
		<input type="text" name="nama_instagram" class="form-control" value="<?php echo $konfigurasi->nama_instagram ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="instagram" class="form-control" value="<?php echo $konfigurasi->instagram ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Youtube <i class="fab fa-youtube"></i></label>
	<div class="col-3">
		<input type="text" name="nama_youtube" class="form-control" value="<?php echo $konfigurasi->nama_youtube ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="youtube" class="form-control" value="<?php echo $konfigurasi->youtube ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<hr>
<h4>Informasi Pendaftaran Online</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Fitur Website untuk Pendaftaran Online</label>
	<div class="col-6">
		<select name="fitur_pendaftaran" class="form-control">
			<option value="Off">Off - Non Aktif</option>
			<option value="On" <?php if($konfigurasi->fitur_pendaftaran=='On') { echo 'selected'; } ?>>On - Aktif</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Periode Pendaftaran Online</label>
	<div class="col-2">
		<input type="text" name="mulai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($konfigurasi->mulai_pendaftaran) ?>">
		<small class="text-secondary">Tanggal mulai</small>
	</div>
	<div class="col-2">
		<input type="text" name="selesai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($konfigurasi->selesai_pendaftaran) ?>">
		<small class="text-secondary">Tanggal selesai</small>
	</div>
	<div class="col-2">
		<input type="text" name="pengumuman_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($konfigurasi->pengumuman_pendaftaran) ?>">
		<small class="text-secondary">Tanggal pengumuman</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Informasi pendaftaran</label>
	<div class="col-9">
		<textarea name="keterangan_pendaftaran" class="form-control konten" rows="5"><?php echo $konfigurasi->keterangan_pendaftaran ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>