<?php echo form_open_multipart(base_url('admin/tingkatan/edit/'.$tingkatan->id_tingkatan)) ?>

<div class="form-group row">
	<label class="col-3">Nama &amp; Status</label>
	<div class="col-5">
		<input type="text" name="nama_tingkatan" class="form-control" placeholder="Nama kategori anggota" value="<?php echo $tingkatan->nama_tingkatan ?>" required>
		<small class="text-secondary">Nama Tingkatan</small>
	</div>
	<div class="col-2">
		<select name="jenis_tingkatan" class="form-control">
			<option value="Siswa">Siswa</option>
			<option value="Kader" <?php if($tingkatan->jenis_tingkatan=="Kader") { echo 'selected'; } ?>>Draft</option>
			<option value="Pendekar" <?php if($tingkatan->jenis_tingkatan=="Pendekar") { echo 'selected'; } ?>>Pendekar</option>
		</select>
		<small class="text-secondary">Jenis Tingkatan</small>
	</div>
	<div class="col-2">
		<select name="status_tingkatan" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($tingkatan->status_tingkatan=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Tingkatan</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar/ Logo</label>
	
	<div class="col-8">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar/ Logo" value="<?php echo $tingkatan->gambar ?>">
	</div>
	<div class="col-1">
		<?php if($tingkatan->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$tingkatan->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $tingkatan->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo $tingkatan->urutan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/tingkatan/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>