<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/akun_pendaftar'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/akun_pendaftar/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/akun_pendaftar/proses')) ?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/','',CURRENT_URL()) ?>">
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

	<select name="status_akun" class="form-control">
		<option value="Aktif">Aktif</option>
		<option value="Menunggu">Menunggu</option>
		<option value="Non-Aktif">Non-Aktif</option>
	</select>

	<span class="input-group-append">
		<button type="submit" name="submit" value="Update" class="btn btn-warning">
			<i class="fa fa-search"></i> Update
		</button>
	</span>
</div>



<div class="table-responsive mailbox-messages mt-2">		

<table class="table table-sm table-hover" id="example1">
	<thead>
		<tr class="text-left bg-light">
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle">
					<i class="far fa-square"></i>
        		</button>
			</th>
			<th width="15%">Nama</th>
			<th width="20%">Email</th>
			<th width="15%">Jenis</th>
			<th width="8%">NIS</th>
			<th width="12%">NISN</th>
			<th width="15%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($akun as $akun) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_akun[]" value="<?php echo $akun->id_akun ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td><?php echo $akun->nama ?></td>
			<td><?php echo $akun->email ?></td>
			<td><?php echo $akun->jenis_akun ?></td>
			<td><?php echo $akun->nis ?></td>
			<td><?php echo $akun->nisn ?></td>
			<td class="text-left">
				
				<?php if($akun->status_akun=='Aktif') { ?>
					<span class="badge bg-success">
						<i class="fa fa-check-circle"></i> <?php echo $akun->status_akun ?>
					</span>
				<?php }elseif($akun->status_akun=='Menunggu') { ?>
						<span class="badge bg-warning">
							<i class="fa fa-clock"></i> <?php echo $akun->status_akun ?>
						</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-times-circle"></i> <?php echo $akun->status_akun ?>
					</span>
				<?php } ?>
				
			</td>
			<td>
				
				<a href="<?php echo base_url('admin/akun_pendaftar/edit/'.$akun->id_akun) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/akun_pendaftar/delete/'.$akun->id_akun) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>