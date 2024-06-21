<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/ekstrakurikuler'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/ekstrakurikuler/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/ekstrakurikuler/proses')) ?>
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
	<select name="id_kategori_ekstrakurikuler" class="form-control">
		<?php foreach($kategori_ekstrakurikuler as $kategori_ekstrakurikuler) { ?>
		<option value="<?php echo $kategori_ekstrakurikuler->id_kategori_ekstrakurikuler ?>">
			<?php echo $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler ?>
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
			<th width="35%">Judul</th>
			<th width="15%">Kategori</th>
			<th width="15%">Status</th>
			<th width="15%">Author</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($ekstrakurikuler as $ekstrakurikuler) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_ekstrakurikuler[]" value="<?php echo $ekstrakurikuler->id_ekstrakurikuler ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($ekstrakurikuler->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$ekstrakurikuler->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $ekstrakurikuler->judul_ekstrakurikuler ?>
				<small>
					<br><i class="fa fa-graduation-cap"></i> <?php echo $ekstrakurikuler->nama_penanggung_jawab ?>				
				</small>
			</td>
			<td><?php echo $ekstrakurikuler->nama_kategori_ekstrakurikuler ?></td>
			<td>
				<?php if($ekstrakurikuler->status_ekstrakurikuler=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $ekstrakurikuler->status_ekstrakurikuler ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td><?php echo $ekstrakurikuler->nama ?></td>
			<td>
				
				<a href="<?php echo base_url('admin/ekstrakurikuler/edit/'.$ekstrakurikuler->id_ekstrakurikuler) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/ekstrakurikuler/delete/'.$ekstrakurikuler->id_ekstrakurikuler) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>