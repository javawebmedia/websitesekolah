<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<form action="<?php echo base_url('admin/video') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Judul &amp; Status</label>
					<div class="col-9">
						<input type="text" name="judul" class="form-control" placeholder="Judul Judul" value="<?php echo set_value('judul') ?>" required>
						<small class="text-secondary">Judul Video</small>
					</div>
					
				</div>

				<div class="form-group row">
					<label class="col-3">Kode Video Youtube</label>
					<div class="col-9">
		                  
							<input type="text" name="video" class="form-control" placeholder="Kode video youtube" value="<?php echo set_value('video') ?>" required>
							
						
						<small class="text-secondary">Misal: https://youtu.be/cxLeZXObWDA?si=r_WiHBY4V91cb7Ql. Klik <strong>Share</strong> pada video Youtube. Lalu copy link yang disediakan.</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Gambar Thumbnail dan Status</label>
					
					<div class="col-3">
						<input type="file" name="gambar" class="form-control" placeholder="Gambar? logo" value="<?php echo set_value('gambar') ?>">
						<small class="text-secondary">Gambar Thumbnail Video. Format: JPG, JPEG, PNG, GIF</small>
					</div>
					<div class="col-3">
						<select name="status_video" class="form-control">
							<option value="Publish">Publish</option>
							<option value="Draft">Draft</option>
						</select>
						<small class="text-secondary">Status Video</small>
					</div>
					<div class="col-3">
						<select name="posisi_video" class="form-control">
							<option value="Beranda">Beranda</option>
							<option value="Video">Galeri Video</option>
						</select>
						<small class="text-secondary">Posisi Video</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan</label>
					<div class="col-9">
						<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo set_value('keterangan') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Urutan</label>
					<div class="col-9">
						<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo set_value('urutan') ?>">
					</div>
				</div>

			</div>
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>