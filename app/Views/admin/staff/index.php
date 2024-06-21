<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/staff'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/staff/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/staff/proses')) ?>
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
	<select name="id_kategori_staff" class="form-control">
		<?php foreach($kategori_staff as $kategori_staff) { ?>
		<option value="<?php echo $kategori_staff->id_kategori_staff ?>">
			<?php echo $kategori_staff->nama_kategori_staff ?>
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
		<tr class="text-center bg-light">
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle">
					<i class="far fa-square"></i>
        </button>
			</th>
			<th width="5%">Foto</th>
			<th width="20%">Nama</th>
			<th width="20%">Informasi</th>
			<th width="20%">Kontak</th>
			<th width="5%">L/P</th>
			<th width="5%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($staff as $staff) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_staff[]" value="<?php echo $staff->id_staff ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td><?php if($staff->gambar=="") { echo '-'; }else{ ?>
				<img src="<?php echo base_url('assets/upload/staff/thumbs/'.$staff->gambar) ?>" class="img img-thumbnail">
			<?php } ?>
			</td>
			<td><?php echo $staff->nama ?>
				<small>
					<br><i class="fa fa-sitemap"></i> <?php echo $staff->nama_kategori_staff ?>
					<br><i class="fa fa-sort-numeric-up"></i> No: <?php echo $staff->urutan ?>
				</small>
			</td>
			<td>
				<small>
					<i class="fas fa-couch"></i> <?php echo $staff->jabatan ?>
					<br><i class="fa fa-calendar-check"></i> <?php echo $staff->tempat_lahir ?>, <?php echo $this->website->tanggal_id($staff->tanggal_lahir) ?>
					<br><i class="fa fa-tasks"></i> <?php echo $staff->keahlian ?>
				</small>
			</td>
			<td><small>
				<i class="fa fa-phone"></i> <?php echo $staff->telepon ?>
				<br><i class="fa fa-envelope"></i> <?php echo $staff->email ?>
				<br><i class="fa fa-globe"></i> <?php echo $staff->website ?>
				<br><i class="fa fa-map"></i> <?php echo $staff->alamat ?>
				</small>
			</td>
			<td class="text-center"><?php if($staff->jenis_kelamin=='P') { ?>
					<span class="badge bg-info">
						<i class="fa fa-female"></i> Perempuan
					</span>
				<?php }else{ ?>
					<span class="badge bg-success">
						<i class="fa fa-male"></i> Laki-laki
					</span>
				<?php } ?>
			</td>
			<td>
				<?php if($staff->status_staff=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $staff->status_staff ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td>
				<a href="<?php echo base_url('admin/user?id_staff='.$staff->id_staff) ?>" class="btn btn-warning btn-sm"><i class="fa fa-lock"></i> Akses</a>
				<a href="<?php echo base_url('admin/staff/edit/'.$staff->id_staff) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/staff/delete/'.$staff->id_staff) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>
<?php echo form_close(); ?>