<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/fasilitas'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/fasilitas/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/fasilitas/proses')) ?>
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
	<select name="id_kategori_fasilitas" class="form-control">
		<?php foreach($kategori_fasilitas as $kategori_fasilitas) { ?>
		<option value="<?php echo $kategori_fasilitas->id_kategori_fasilitas ?>">
			<?php echo $kategori_fasilitas->nama_kategori_fasilitas ?>
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
			<th width="5%">Gambar</th>
			<th width="35%">Judul/Nama</th>
			<th width="15%">Kategori &amp; Kondisi</th>
			<th width="15%">Status</th>
			<th width="15%">Author</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($fasilitas as $fasilitas) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_fasilitas[]" value="<?php echo $fasilitas->id_fasilitas ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($fasilitas->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$fasilitas->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $fasilitas->judul_fasilitas ?>
				<small>
					<br><i class="fa fa-graduation-cap"></i> <?php echo $fasilitas->kode_nomor_fasilitas ?>
					<br><i class="fa fa-calendar"></i> <?php echo $fasilitas->tahun_fasilitas ?> (<?php echo $this->website->tanggal_bulan($fasilitas->tanggal_fasilitas) ?>)
				
				</small>
			</td>
			<td><small><i class="fa fa-tags"></i> <?php echo $fasilitas->nama_kategori_fasilitas ?>
				<br><i class="fa fa-check-circle"></i> <?php echo $fasilitas->kondisi_fasilitas ?></small></td>
			<td>
				<?php if($fasilitas->status_fasilitas=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $fasilitas->status_fasilitas ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td><?php echo $fasilitas->nama ?></td>
			<td>
				
				<a href="<?php echo base_url('admin/fasilitas/edit/'.$fasilitas->id_fasilitas) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/fasilitas/delete/'.$fasilitas->id_fasilitas) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>