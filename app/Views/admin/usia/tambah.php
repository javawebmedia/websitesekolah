<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?php 
echo form_open(base_url('admin/usia')); 
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
					<label class="col-3">Nama Kelompok &amp; Status Usia</label>
					<div class="col-6">
						<input type="text" name="nama_usia" class="form-control" placeholder="Nama usia" value="<?php echo set_value('nama_usia') ?>" required>
					</div>
				
					<div class="col-2">
						<select name="status_aktif" class="form-control">
							<option value="Ya">Ya Aktif</option>
							<option value="Tidak">Tidak Aktif</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Rentang Usia</label>
					<div class="col-4">
						<input type="number" name="minimal" class="form-control" placeholder="Minimal" value="<?php echo set_value('minimal') ?>" required>
					</div>
					<div class="col-4">
						<input type="number" name="maksimal" class="form-control" placeholder="Maksimal" value="<?php echo set_value('maksimal') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan Lengkap</label>
					<div class="col-9">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan Lengkap"><?php echo set_value('keterangan') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Urutan</label>
					<div class="col-9">
						<input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo set_value('urutan') ?>" required>
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