
<script>
$('.waktu').timepicker({
    timeFormat: 'h:mm',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
})
</script>
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    
</div>
<div class="modal-body">

<?php
// Form buka 
echo form_open_multipart(base_url('admin/agenda/jadwal/'.$agenda['id_agenda']),array('class'	=> 'form-horizontal'));
?>
<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama Tempat <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <input type="text" name="nama_tempat" class="form-control" placeholder="Nama jadwal" value="<?php if(isset($_POST['nama_tempat'])) { echo set_value('nama_tempat'); }else{ echo $agenda['nama_tempat']; } ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama Jadwal <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <input type="text" name="nama_jadwal" class="form-control" placeholder="Nama jadwal" value="<?php echo set_value('nama_jadwal') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Pembicara <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <input type="text" name="pembicara" class="form-control" placeholder="Pembicara" value="<?php echo set_value('pembicara') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Peserta <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <input type="text" name="peserta" class="form-control" placeholder="Peserta" value="<?php echo set_value('peserta') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Tanggal dan Jam Mulai<span class="text-danger">*</span></label>
	<div class="col-sm-4">
      <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo set_value('tanggal_mulai') ?>">
      <small class="text-gray">Tanggal mulai</small>
	</div>
	<div class="col-sm-4">
      <input type="text" name="jam_mulai" id="jam_mulai" class="form-control waktu" placeholder="00:00:00" value="<?php echo set_value('jam_mulai') ?>">
      <small class="text-gray">Jam mulai</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Tanggal dan Jam Selesai<span class="text-danger">*</span></label>
	<div class="col-sm-4">
      <input type="text" name="tanggal_selesai" id="tanggal_selesai" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo set_value('tanggal_selesai') ?>">
      <small class="text-gray">Tanggal selesai</small>
	</div>
	<div class="col-sm-4">
      <input type="text" name="jam_selesai" id="jam_selesai" class="form-control waktu" placeholder="00:00:00" value="<?php echo set_value('jam_selesai') ?>">
      <small class="text-gray">Jam selesai</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-left">Keterangan <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <textarea name="keterangan" class="form-control nilai" placeholder="Keterangan"><?php echo set_value('keterangan') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="btn-group">
			<button type="submit" name="simpan" class="btn btn-primary btn-lg" value="Simpan Data">
				<i class="fa fa-save"></i> Simpan Data
			</button>
			<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">
				<i class="fa fa-times"></i> Close
			</button>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<?php
// Form close 
echo form_close();
?>

</div>
</div>
</div>
</div>
