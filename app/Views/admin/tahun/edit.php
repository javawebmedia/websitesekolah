<p class="text-right">
	<a href="<?php echo base_url('admin/tahun') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
echo form_open(base_url('admin/tahun/edit/'.$tahun->id_tahun)); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Tahun Ajaran</label>
	<div class="col-2">
		<input type="number" name="tahun_mulai" class="form-control" placeholder="Tahun Mulai" value="<?php if(isset($_POST['tahun_mulai'])) { echo set_value('tahun_mulai'); }else{ echo $tahun->tahun_mulai; } ?>" required>
	</div>
	<div class="col-1 text-center">/</div>
	<div class="col-2">
		<input type="number" name="tahun_selesai" class="form-control" placeholder="Tahun Selesai" value="<?php if(isset($_POST['tahun_selesai'])) { echo set_value('tahun_selesai'); }else{ echo $tahun->tahun_selesai; } ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Nama Jenjang</label>
	<div class="col-9">
		<input type="text" name="nama_tahun" class="form-control" placeholder="Nama tahun" value="<?php echo $tahun->nama_tahun ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" class="form-control" placeholder="Keterangan Lengkap"><?php echo $tahun->keterangan ?></textarea>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/tahun') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>