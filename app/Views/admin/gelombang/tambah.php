<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<form action="<?php echo base_url('admin/gelombang') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
					<label class="col-3">Nama Periode Pendaftaran</label>
					<div class="col-9">
						<input type="text" name="judul" class="form-control" placeholder="Nama Periode Pendaftaran PSB" value="<?php echo set_value('judul') ?>" required>
						<small class="text-secondary">Nama Periode Pendaftaran PSB</small>
					</div>
				
				</div>

				<div class="form-group row">

					<label class="col-3">Tahun ajaran dan status</label>

					<div class="col-3">
						<input type="number" name="tahun" value="<?php echo set_value('tahun') ?>" placeholder="Tahun" class="form-control" required>
						<small class="text-secondary">Tahun: <?php echo date('Y') ?></small>
					</div>

					<div class="col-3">
						<input type="text" name="tahun_ajaran" value="<?php echo set_value('tahun_ajaran') ?>" placeholder="Tahun ajaran" class="form-control" required>
						<small class="text-secondary">Tahun Ajaran: <?php echo date('Y') ?>/<?php echo date('Y')+1; ?></small>
					</div>

					<div class="col-3">
						<select name="status_gelombang" class="form-control">
							<option value="Buka">Buka</option>
							<option value="Tutup">Tutup</option>
						</select>
						<small class="text-secondary">Status Periode Pendaftaran PSB</small>
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
						<textarea name="isi" placeholder="Keterangan" class="form-control konten"><?php echo set_value('isi') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tanggal buka, tutup, dan pengumuman PSB</label>

					<div class="col-3">
						<input type="text" name="tanggal_buka" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo set_value('tanggal_buka') ?>">
						<small class="text-secondary">Tanggal buka pendaftaran</small>
					</div>
					
					<div class="col-3">
						<input type="text" name="tanggal_tutup" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo set_value('tanggal_tutup') ?>">
						<small class="text-secondary">Tanggal tutup pendaftaran</small>
					</div>

					<div class="col-3">
						<input type="text" name="tanggal_pengumuman" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo set_value('tanggal_pengumuman') ?>">
						<small class="text-secondary">Tanggal pengumuman pendaftaran</small>
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