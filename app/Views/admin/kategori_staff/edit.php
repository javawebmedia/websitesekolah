<?php echo form_open_multipart(base_url('admin/kategori_staff/edit/'.$kategori_staff->id_kategori_staff)) ?>

<div class="form-group row">
	<label class="col-3">Nama &amp; Status</label>
	<div class="col-6">
		<input type="text" name="nama_kategori_staff" class="form-control" placeholder="Nama kategori staff" value="<?php echo $kategori_staff->nama_kategori_staff ?>" required>
		<small class="text-secondary">Nama Kategori Staff</small>
	</div>
	<div class="col-3">
		<select name="status_kategori_staff" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($kategori_staff->status_kategori_staff=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Kategori Staff</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar/ Logo</label>
	
	<div class="col-8">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar/ Logo" value="<?php echo $kategori_staff->gambar ?>">
	</div>
	<div class="col-1">
		<?php if($kategori_staff->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_staff->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $kategori_staff->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo $kategori_staff->urutan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/kategori_staff/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>