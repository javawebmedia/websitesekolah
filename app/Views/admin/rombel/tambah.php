<p class="text-right">
	<a href="<?php echo base_url('admin/rombel') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>
<?php 
echo form_open(base_url('admin/kelas')); 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Jenjang &amp; Status</label>
	<div class="col-7">
		<select name="id_jenjang" class="form-control select2" required>
			<option value="">Pilih Jenjang</option>
			<?php foreach($jenjang as $jenjang) { ?>
				<option value="<?php echo $jenjang->id_jenjang ?>" <?php if($kelas->id_jenjang==$jenjang->id_jenjang) { echo 'selected'; } ?>>
					<?php echo $jenjang->nama_jenjang ?> - <?php echo $jenjang->keterangan ?>
				</option>
			<?php } ?>
		</select>
	</div>
</div>

<?php echo form_close(); ?>