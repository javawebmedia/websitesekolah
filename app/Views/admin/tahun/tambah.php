<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?php 
echo form_open(base_url('admin/tahun')); 
echo csrf_field(); 
$tahun_selesai = date('Y')+1;
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
					<label class="col-3">Tahun Ajaran</label>
					<div class="col-2">
						<input type="number" name="tahun_mulai" class="form-control" placeholder="Tahun Mulai" value="<?php if(isset($_POST['tahun_mulai'])) { echo set_value('tahun_mulai'); }else{ echo date('Y'); } ?>" required>
					</div>
					<div class="col-1 text-center">/</div>
					<div class="col-2">
						<input type="number" name="tahun_selesai" class="form-control" placeholder="Tahun Selesai" value="<?php if(isset($_POST['tahun_selesai'])) { echo set_value('tahun_selesai'); }else{ echo $tahun_selesai; } ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Jenjang</label>
					<div class="col-9">
						<input type="text" name="nama_tahun" class="form-control" placeholder="Nama tahun" value="<?php echo set_value('nama_tahun') ?>" required>
						<small class="text-gray">Misal: Tahun Ajaran <?php echo date('Y').'/'.$tahun_selesai; ?></small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan Lengkap</label>
					<div class="col-9">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan Lengkap"><?php echo set_value('keterangan') ?></textarea>
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