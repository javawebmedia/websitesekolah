<?php echo form_open_multipart(base_url('admin/jenis_dokumen/edit/'.$jenis_dokumen->id_jenis_dokumen)) ?>

<div class="form-group row">
	<label class="col-3">Nama &amp; Status</label>
	<div class="col-6">
		<input type="text" name="nama_jenis_dokumen" class="form-control" placeholder="Nama jenis dokumen pendaftaran" value="<?php echo $jenis_dokumen->nama_jenis_dokumen ?>" required>
		<small class="text-secondary">Nama Jenis Dokumen Pendaftaran</small>
	</div>
	<div class="col-3">
		<select name="status_jenis_dokumen" class="form-control">
			<option value="Wajib">Wajib</option>
			<option value="Tidak Wajib" <?php if($jenis_dokumen->status_jenis_dokumen=="Tidak Wajib") { echo 'selected'; } ?>>Tidak Wajib</option>
		</select>
		<small class="text-secondary">Status Jenis Dokumen Pendaftaran</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar/ Logo</label>
	
	<div class="col-8">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar/ Logo" value="<?php echo $jenis_dokumen->gambar ?>">
	</div>
	<div class="col-1">
		<?php if($jenis_dokumen->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$jenis_dokumen->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $jenis_dokumen->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo $jenis_dokumen->urutan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/jenis_dokumen/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>