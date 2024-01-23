<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<form action="<?php echo base_url('admin/link_website') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Nama Link</label>
					<div class="col-9">
						<input type="text" name="nama_link_website" class="form-control" placeholder="Nama kategori link_website" value="<?php echo set_value('nama_link_website') ?>" required>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-3">Link Website</label>
					<div class="col-9">
						<input type="url" name="link_website" class="form-control" placeholder="Alamat website" value="<?php echo set_value('link_website') ?>" required>
						<small class="text-secondary">Format: <strong><?php echo base_url() ?></strong></small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Metode Status Link</label>
					<div class="col-6">
						<select name="metode_link" class="form-control">
							<option value="_self">_self (Di jendela yang sama)</option>
							<option value="_blank">_blank (Membuka tab baru)</option>
						</select>
						<small class="text-secondary">Status Link Website</small>
					</div>
					<div class="col-3">
						<select name="status_link_website" class="form-control">
							<option value="Publish">Publish</option>
							<option value="Draft">Draft</option>
						</select>
						<small class="text-secondary">Status Link Website</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Gambar/ Logo</label>
					
					<div class="col-9">
						<input type="file" name="gambar" class="form-control" placeholder="Gambar? logo" value="<?php echo set_value('gambar') ?>">
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