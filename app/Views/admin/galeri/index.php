<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/galeri'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/galeri/tambah') ?>" class="btn btn-success">
				<i class="fa fa-plus"></i> Tambah Baru
			</a>
          </span>
        </div>
        <?php echo form_close() ?>
	</div>
	<div class="col-md-6">
			<?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
	</div>
</div>
<hr>

<?php echo form_open(base_url('admin/galeri/proses')) ?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php','',CURRENT_URL()) ?>">
<div class="mailbox-controls">
<div class="input-group">
	<button type="submit" name="submit" value="Delete" class="btn btn-secondary" title="Hapus Berita">
		<i class="fa fa-trash"></i>
	</button>
	<button type="submit" name="submit" value="Draft" class="btn btn-dark" title="Jangan Publikasikan">
		<i class="fa fa-eye-slash"></i>
	</button>
	<button type="submit" name="submit" value="Publish" class="btn btn-info" title="Publikasikan">
		<i class="fa fa-eye"></i>
	</button>
	<select name="id_kategori_galeri" class="form-control">
		<?php foreach($kategori_galeri as $kategori_galeri) { ?>
		<option value="<?php echo $kategori_galeri->id_kategori_galeri ?>">
			<?php echo $kategori_galeri->nama_kategori_galeri ?>
		</option>
		<?php } ?>
	</select>
	<span class="input-group-append">
		<button type="submit" name="submit" value="Update" class="btn btn-warning">
			<i class="fa fa-search"></i> Update
		</button>
	</span>
</div>

<div class="table-responsive mailbox-messages mt-1">		

<table class="table table-sm table-hover" id="example2">
	<thead>
		<tr class="text-left bg-light">
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle">
					<i class="far fa-square"></i>
        		</button>
			</th>
			<th width="8%">Gambar</th>
			<th width="45%">Judul</th>
			<th width="15%">Kategori &amp; Jenis</th>
			<th width="15%">Author</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($galeri as $galeri) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_galeri[]" value="<?php echo $galeri->id_galeri ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($galeri->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$galeri->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $galeri->judul_galeri ?>
				<small>
					<br><i class="fa fa-link"></i> <?php echo $galeri->website ?>
					<br><i class="fa fa-tasks"></i> <?php echo $galeri->status_text ?>
					<br><i class="fa fa-newspaper"></i> <?php echo $galeri->text_website ?>
					<textarea title="Copy link gambar/file ini" class="form-control"><?php echo base_url('assets/upload/image/'.$galeri->gambar) ?></textarea>
				</small>
			</td>
			<td><small><i class="fa fa-tags"></i> <?php echo $galeri->nama_kategori_galeri ?>
				<br><i class="fa fa-home"></i> <?php echo $galeri->jenis_galeri ?></small></td>
			<td><?php echo $galeri->nama ?></td>
			<td>
				
				<a href="<?php echo base_url('admin/galeri/edit/'.$galeri->id_galeri) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/galeri/delete/'.$galeri->id_galeri) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>