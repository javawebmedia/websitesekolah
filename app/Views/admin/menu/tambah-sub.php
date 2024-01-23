<script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","<?php echo base_url('admin/menu/sub') ?>?q="+str,true);
    xmlhttp.send();
  }
}
</script>
<?php 
echo form_open(base_url('admin/menu')); 
echo csrf_field(); 
?>
<div class="modal-basic modal fade show" id="modal-sub" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-bg-white ">
			<div class="modal-header">
				<h6 class="modal-title">Tambah Sub Menu</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="jenis" value="sub_menu">
				<div class="form-group row">
					<label class="col-3">Parent Menu</label>
					<div class="col-9">
						<select name="id_menu" class="form-control select2" onchange="showUser(this.value)" required>
							<option value="">Pilih Parent Menu</option>
							<?php foreach($menu2 as $menu2) { ?>
							<option value="<?php echo $menu2->id_menu ?>">
								<?php echo $menu2->nama_menu ?>
							</option>
						<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Sub Menu</label>
					<div class="col-9">
						<input type="text" name="nama_menu" class="form-control" placeholder="Nama menu" value="<?php echo set_value('nama_menu') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Alamat/Link</label>
					<div class="col-9">
						
							<input type="text" name="link" class="form-control" placeholder="Alamat/link menu" value="<?php echo set_value('link') ?>" required>
							<small>Format: <strong><?php echo base_url() ?></strong></small>
						
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Status Sub Menu</label>
					<div class="col-9">
						<select name="status_sub_menu" class="form-control">
							<option value="Draft">Draft</option>
							<option value="Publish">Publish</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Icon</label>
					<div class="col-9">
						<input type="text" name="icon" class="form-control" placeholder="Icon menu" value="<?php echo set_value('icon') ?>">
						<small>Icon menggunakan referensi: <a href="https://fontawesome.com/v5/search" target="_blank">https://fontawesome.com/v5/search</a></small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nomor urut</label>
					<div class="col-9">
						<div id="txtHint">
							<input type="number" name="urutan" class="form-control" placeholder="Nomor urut" value="<?php echo set_value('urutan') ?>">
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan lain</label>
					<div class="col-9">
						<textarea class="form-control" name="keterangan" placeholder="Keterangan"><?php echo set_value('keterangan') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3"></label>
					<div class="col-9">
						
						<button type="submit" class="btn btn-success">Simpan&nbsp;<i class="fa fa-arrow-right"></i> </button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- ends: .modal-Basic -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>

