<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/berita'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/berita/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/berita/proses')) ?>
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
	<select name="jenis_berita" class="form-control">
		<option value="Berita">Berita</option>
		<option value="Profil">Profil</option>
		<option value="Layanan">Layanan</option>
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
			<th width="40%">Judul</th>
			<th width="25%">Kategori - Jenis - Penulis</th>
			<th width="10%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($berita as $berita) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
          <input type="checkbox" name="id_berita[]" value="<?php echo $berita->id_berita ?>" id="check_<?php echo $no ?>">
          <label for="check_<?php echo $no ?>"></label>
        </div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($berita->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$berita->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><a href="<?php echo base_url('admin/berita/edit/'.$berita->id_berita) ?>">
					<?php echo $berita->judul_berita ?>
				</a>
				<small>
					<br><i class="fa fa-calendar-check"></i> <?php echo $this->website->tanggal_bulan_menit($berita->tanggal_publish) ?>
					<br><i class="fa fa-calendar-plus"></i> <?php echo $this->website->tanggal_bulan_menit($berita->tanggal_post) ?>
					<br><i class="fa fa-eye"></i> <?php echo $berita->hits ?> | <i class="fa fa-sort-numeric-up"></i> <?php echo $berita->urutan ?> | <i class="<?php echo $berita->icon ?>"></i> <?php echo $berita->icon ?>
				</small>
			</td>
			<td><small>
				<i class="fa fa-tags"></i> <a href="<?php echo base_url('admin/berita/kategori/'.$berita->id_kategori) ?>">
					<?php echo $berita->nama_kategori ?>
				</a>
				<br><i class="fa fa-home"></i> <a href="<?php echo base_url('admin/berita/jenis_berita/'.$berita->jenis_berita) ?>">
					<?php echo $berita->jenis_berita ?>
				</a>
				<br><i class="fa fa-user"></i> <a href="<?php echo base_url('admin/berita/author/'.$berita->id_user) ?>">
						<?php echo $berita->nama ?>
					</a>
			</small>
			</td>
			<td>
				<a href="<?php echo base_url('admin/berita/status_berita/'.$berita->status_berita) ?>">
				<?php if($berita->status_berita=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $berita->status_berita ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
				</a>
			</td>
			<td class="btn-group">
				<a href="<?php echo base_url('berita/read/'.$berita->slug_berita) ?>" class="btn btn-primary btn-sm mt-1" target="_blank" title="Baca"><i class="fa fa-eye"></i></a>
				<a href="<?php echo base_url('admin/berita/edit/'.$berita->id_berita) ?>" class="btn btn-success btn-sm mt-1" title="Edit"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/berita/delete/'.$berita->id_berita) ?>" class="btn btn-secondary btn-sm mt-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>
<?php echo form_close(); ?>