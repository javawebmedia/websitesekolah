
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
// Error upload 
if(isset($error)) {
	echo '<div class="alert alert-warning">';
	echo $error;
	echo '</div>';
}

// Validasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form buka 
echo form_open_multipart(base_url('admin/produk/harga/'.$produk->id_produk),array('class'	=> 'form-horizontal'));
?>
<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Status Biaya Pendaftaran (Kontingen) <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <select name="status_harga_produk" class="form-control select2">
      	<option value="Buka">Buka</option>
      	<option value="Tutup">Tutup</option>
      </select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama Paket Biaya Pendaftaran (Kontingen) <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <input type="text" name="nama_harga_produk" class="form-control" value="<?php echo set_value('nama_harga_produk') ?>">
      <small class="text-gray">Misal: Paket Group 3-5 Orang</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Biaya Pendaftaran (Kontingen)/Biaya Investasi <span class="text-danger">*</span></label>
	<div class="col-sm-9">
      <input type="number" name="biaya_produk" class="form-control" value="<?php echo set_value('biaya_produk') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Minimal &amp; Maksimal Peserta<span class="text-danger">*</span></label>
	<div class="col-sm-4">
      <input type="number" name="minimal_peserta" class="form-control" value="<?php echo set_value('minimal_peserta') ?>">
      <small class="text-gray">Minimal peserta</small>
	</div>
	<div class="col-sm-4">
      <input type="number" name="maksimal_peserta" class="form-control" value="<?php echo set_value('maksimal_peserta') ?>">
      <small class="text-gray">Maksimal peserta</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Keterangan</label>
	<div class="col-sm-9">
      <textarea name="keterangan" class="form-control" placeholder="Keterangan"><?php echo set_value('keterangan') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="btn-group">
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="Simpan Data">
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
