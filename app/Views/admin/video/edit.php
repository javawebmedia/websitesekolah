<?php echo form_open_multipart(base_url('admin/video/edit/'.$video->id_video)) ?>

<div class="form-group row">
	<label class="col-3">Judul &amp; Status</label>
	<div class="col-6">
		<input type="text" name="judul" class="form-control" placeholder="Judul Judul" value="<?php echo $video->judul ?>" required>
		<small class="text-secondary">Judul Video</small>
	</div>
	
</div>

<div class="form-group row">
	<label class="col-3">Kode Video Youtube</label>
	<div class="col-9">
		<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fab fa-youtube"></i> https://www.youtube.com/watch?v=</span>
          </div>
			<input type="text" name="video" class="form-control" placeholder="Kode video youtube" value="<?php echo $video->video ?>" required>
			
		</div>
		<small class="text-secondary">Misal: <strong>https://www.youtube.com/watch?v=<strong class="text-danger">rqQOCRdUreE</strong></strong>. Ambil kode berwarna merah.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar Thumbnail  dan Status</label>
	
	<div class="col-5">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar Thumbnail" value="<?php echo $video->gambar ?>">
		<small class="text-secondary">Gambar Thumbnail Video. Format: JPG, JPEG, PNG, GIF</small>
	</div>
	<div class="col-3">
		<select name="status_video" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($video->status_video=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Video</small>
	</div>
	<div class="col-1">
		<?php if($video->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$video->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $video->keterangan ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo $video->urutan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/video/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>