<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/cabang'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/cabang/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/cabang/proses')) ?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php','',CURRENT_URL()) ?>">
<div class="mailbox-controls">
<div class="input-group">
	<button type="submit" name="submit" value="Delete" class="btn btn-secondary" title="Hapus Cabang">
		<i class="fa fa-trash"></i>
	</button>
	<button type="submit" name="submit" value="Draft" class="btn btn-dark" title="Jangan Publikasikan">
		<i class="fa fa-eye-slash"></i>
	</button>
	<button type="submit" name="submit" value="Publish" class="btn btn-info" title="Publikasikan">
		<i class="fa fa-eye"></i>
	</button>
	<select name="jenis_cabang" class="form-control">
		<option value="Cabang">Cabang</option>
		<option value="Pusat">Pusat</option>
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
			<th width="30%">Nama</th>
			<th width="20%">Kategori - Jenis - Penulis</th>
			<th width="15%">Pesilat</th>
			<th width="10%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($cabang as $cabang) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
          <input type="checkbox" name="id_cabang[]" value="<?php echo $cabang->id_cabang ?>" id="check_<?php echo $no ?>">
          <label for="check_<?php echo $no ?>"></label>
        </div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($cabang->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$cabang->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><a href="<?php echo base_url('admin/cabang/edit/'.$cabang->id_cabang) ?>">
					<?php echo $cabang->nama_cabang ?> (<?php echo $cabang->singkatan ?>)
				</a>
				<small>
					<br><i class="fa fa-user"></i> Pelatih: <?php echo $cabang->nama_pelatih ?>
					<br><i class="fa fa-phone"></i> HP/WA: <?php echo $cabang->telepon ?>
					<br><i class="fa fa-map"></i> Google Map: <a href="<?php echo $cabang->google_map ?>" target="_blank"><?php echo $cabang->google_map ?></a>
					<br><i class="fa fa-eye"></i> <?php echo $cabang->hits ?> | <i class="fa fa-sort-numeric-up"></i> <?php echo $cabang->urutan ?> | <i class="fa fa-home"></i> <i class="<?php echo $cabang->icon ?>"></i> <?php echo $cabang->icon ?>
				</small>
			</td>
			<td><small>
				<i class="fa fa-tags"></i> <a href="<?php echo base_url('admin/cabang/kategori_cabang/'.$cabang->id_kategori_cabang) ?>">
					<?php echo $cabang->nama_kategori_cabang ?>
				</a>
				<br><i class="fa fa-home"></i> <a href="<?php echo base_url('admin/cabang/jenis_cabang/'.$cabang->jenis_cabang) ?>"></a>
					<?php echo $cabang->jenis_cabang ?>
				<br><i class="fa fa-user"></i> <a href="<?php echo base_url('admin/cabang/author/'.$cabang->id_user) ?>">
						<?php echo $cabang->nama ?>
					</a>
			</small>
			</td>
			<td></td>
			<td>
				<a href="<?php echo base_url('admin/cabang/status_cabang/'.$cabang->status_cabang) ?>">
				<?php if($cabang->status_cabang=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $cabang->status_cabang ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Unpublished
					</span>
				<?php } ?>
				</a>
			</td>
			<td class="btn-group">
				<a href="<?php echo base_url('admin/cabang/detail/'.$cabang->id_cabang) ?>" class="btn btn-primary btn-sm mt-1" target="_blank" title="Baca"><i class="fa fa-eye"></i></a>
				<a href="<?php echo base_url('admin/cabang/edit/'.$cabang->id_cabang) ?>" class="btn btn-success btn-sm mt-1" title="Edit"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/cabang/delete/'.$cabang->id_cabang) ?>" class="btn btn-secondary btn-sm mt-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>
<?php echo form_close(); ?>