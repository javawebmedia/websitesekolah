<?php echo form_open_multipart(base_url('admin/link_website/edit/'.$link_website->id_link_website)) ?>

<div class="form-group row">
	<label class="col-3">Nama &amp; Status</label>
	<div class="col-9">
		<input type="text" name="nama_link_website" class="form-control" placeholder="Nama kategori link_website" value="<?php echo $link_website->nama_link_website ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Link Website</label>
	<div class="col-9">
		<input type="url" name="link_website" class="form-control" placeholder="Alamat website" value="<?php echo $link_website->link_website ?>" required>
		<small class="text-secondary">Format: <strong><?php echo base_url() ?></strong></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Metode Status Link</label>
	<div class="col-6">
		<select name="metode_link" class="form-control">
			<option value="_self">_self (Di jendela yang sama)</option>
			<option value="_blank" <?php if($link_website->metode_link=="_blank") { echo 'selected'; } ?>>_blank (Membuka tab baru)</option>
		</select>
		<small class="text-secondary">Status Link Website</small>
	</div>
	<div class="col-3">
		<select name="status_link_website" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($link_website->status_link_website=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Link Website</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar/ Logo</label>
	
	<div class="col-8">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar/ Logo" value="<?php echo $link_website->gambar ?>">
	</div>
	<div class="col-1">
		<?php if($link_website->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$link_website->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $link_website->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo $link_website->urutan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/link_website/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>