<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/portfolio'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/portfolio/tambah') ?>" class="btn btn-success">
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

<?php echo form_open(base_url('admin/portfolio/proses')) ?>
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
	<select name="id_kategori_portfolio" class="form-control">
		<?php foreach($kategori_portfolio as $kategori_portfolio) { ?>
		<option value="<?php echo $kategori_portfolio->id_kategori_portfolio ?>">
			<?php echo $kategori_portfolio->nama_kategori_portfolio ?>
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
			<th width="35%">Judul</th>
			<th width="15%">Kategori &amp; Jenis</th>
			<th width="10%">Status</th>
			<th width="15%">Author</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($portfolio as $portfolio) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_portfolio[]" value="<?php echo $portfolio->id_portfolio ?>" id="check_<?php echo $no ?>">
					<label for="check_<?php echo $no ?>"></label>
				</div>
				<?php echo $no ?>
			</td>
			<td>
				<?php if($portfolio->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$portfolio->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $portfolio->judul_portfolio ?>
				<small>
					<br><i class="fa fa-link"></i> <?php echo $portfolio->website ?>
					<br><i class="fa fa-tasks"></i> <?php echo $portfolio->status_text ?>
					<br><i class="fa fa-thumbs"></i> <?php echo $portfolio->text_website ?>
					<textarea title="Copy link gambar/file ini" class="form-control"><?php echo base_url('assets/upload/image/'.$portfolio->gambar) ?></textarea>
				</small>
			</td>
			<td><small><i class="fa fa-tags"></i> <?php echo $portfolio->nama_kategori_portfolio ?>
				<br><i class="fa fa-home"></i> <?php echo $portfolio->jenis_portfolio ?></small></td>
			<td><?php if($portfolio->status_portfolio=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $portfolio->status_portfolio ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
				
			</td>
			<td><?php echo $portfolio->nama ?></td>
			<td>
				
				<a href="<?php echo base_url('admin/portfolio/edit/'.$portfolio->id_portfolio) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/portfolio/delete/'.$portfolio->id_portfolio) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>