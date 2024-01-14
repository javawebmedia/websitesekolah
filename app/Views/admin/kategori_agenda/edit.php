<form action="<?php echo base_url('admin/kategori_agenda/edit/'.$kategori_agenda['id_kategori_agenda']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Nama &amp; Status Kategori Agenda</label>
	<div class="col-6">
		<input type="text" name="nama_kategori_agenda" class="form-control" placeholder="Nama kategori agenda" value="<?php echo $kategori_agenda['nama_kategori_agenda'] ?>" required>
	</div>
	<div class="col-3">
		<select name="status_kategori_agenda" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($kategori_agenda['status_kategori_agenda']=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Kategori Agenda</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar/ Logo</label>
	
	<div class="col-9">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar/ Logo" value="<?php echo $kategori_agenda['gambar'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $kategori_agenda['keterangan'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil kategori agenda" value="<?php echo $kategori_agenda['urutan'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/kategori_agenda/') ?>" class="btn btn-default">
			<i class="fa fa-backward"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>