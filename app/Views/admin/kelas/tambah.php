<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?php 
echo form_open(base_url('admin/kelas')); 
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
					<label class="col-3">Jenjang &amp; Status</label>
					<div class="col-7">
						<select name="id_jenjang" class="form-control select2" required>
							<option value="">Pilih Jenjang</option>
							<?php foreach($jenjang as $jenjang) { ?>
								<option value="<?php echo $jenjang->id_jenjang ?>">
									<?php echo $jenjang->nama_jenjang ?> - <?php echo $jenjang->keterangan ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-2">
						<select name="status_kelas" class="form-control select2" required>
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif">Non Aktif</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Kelas</label>
					<div class="col-9">
						<input type="text" name="nama_kelas" class="form-control" placeholder="Nama kelas" value="<?php echo set_value('nama_kelas') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan Lengkap</label>
					<div class="col-9">
						<textarea type="text" name="keterangan" class="form-control" placeholder="Keterangan Lengkap"><?php echo set_value('keterangan') ?></textarea> 
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