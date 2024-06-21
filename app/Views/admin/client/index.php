<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/client'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/client/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/client/proses')) ?>
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
	<select name="id_kategori_client" class="form-control">
		<?php foreach($kategori_client as $kategori_client) { ?>
		<option value="<?php echo $kategori_client->id_kategori_client ?>">
			<?php echo $kategori_client->nama_kategori_client ?>
		</option>
		<?php } ?>
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
		<tr class="text-center bg-light">
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle">
					<i class="far fa-square"></i>
        		</button>
			</th>
			<th width="8%">Gambar</th>
			<th width="35%">Client</th>
			<th width="25%">Kategori &amp; Jenis</th>
			<th width="15%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($client as $client) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_client[]" value="<?php echo $client->id_client ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($client->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$client->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $client->nama_client ?>
				<small>
					<br><i class="fa fa-envelope"></i> <?php echo $client->email ?>
					<br><i class="fa fa-phone"></i> <?php echo $client->telepon ?>
				</small>
			</td>
			<td><small><i class="fa fa-tags"></i> <?php echo $client->nama_kategori_client ?>
				<br><i class="fa fa-home"></i> <?php echo $client->jenis_client ?></small></td>
			<td class="text-center">
				
				<?php if($client->status_client=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $client->status_client ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Unpublished
					</span>
				<?php } ?>
				
			</td>
			<td>
				
				<a href="<?php echo base_url('admin/client/edit/'.$client->id_client) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/client/delete/'.$client->id_client) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>