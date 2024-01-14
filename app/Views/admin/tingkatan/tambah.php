<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<form action="<?php echo base_url('admin/tingkatan') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
					<label class="col-3">Nama &amp; Status</label>
					<div class="col-5">
						<input type="text" name="nama_tingkatan" class="form-control" placeholder="Nama kategori anggota" value="<?php echo set_value('nama_tingkatan') ?>" required>
						<small class="text-secondary">Nama Tingkatan Pesilat</small>
					</div>
					<div class="col-2">
						<select name="jenis_tingkatan" class="form-control">
							<option value="Siswa">Siswa</option>
							<option value="Kader">Kader</option>
							<option value="Pendekar">Pendekar</option>
						</select>
						<small class="text-secondary">Jenis Tingkatan</small>
					</div>
					<div class="col-2">
						<select name="status_tingkatan" class="form-control">
							<option value="Publish">Publish</option>
							<option value="Draft">Draft</option>
						</select>
						<small class="text-secondary">Status Tingkatan</small>
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