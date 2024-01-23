<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/download'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-info btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/download/tambah') ?>" class="btn btn-success">
							<i class="fa fa-plus"></i> Tambah Baru
						</a>
						<?php if(isset($_GET['keywords'])) { ?>
							<a href="<?php echo base_url('admin/download') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i>
							</a>
						<?php } ?>
          </span>
        </div>
        <?php echo form_close() ?>
	</div>
	<div class="col-md-6">
			<?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
	</div>
</div>
<hr>

<?php echo form_open(base_url('admin/download/proses')) ?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php','',CURRENT_URL()) ?>">
<div class="mailbox-controls">
<div class="input-group">
	<button type="submit" name="submit" value="Delete" class="btn btn-secondary" title="Hapus Download">
		<i class="fa fa-trash"></i>
	</button>
	<button type="submit" name="submit" value="Draft" class="btn btn-dark" title="Jangan Publikasikan">
		<i class="fa fa-eye-slash"></i>
	</button>
	<button type="submit" name="submit" value="Publish" class="btn btn-info" title="Publikasikan">
		<i class="fa fa-eye"></i>
	</button>
	<select name="jenis_download" class="form-control">
		<option value="Download">Download</option>
		<option value="Panduan">Panduan</option>
		<option value="Member">Member</option>
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
			<th width="50%">Judul</th>
			<th width="20%">Deskripsi</th>
			<th width="10%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($download as $download) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
          <input type="checkbox" name="id_download[]" value="<?php echo $download->id_download ?>" id="check_<?php echo $no ?>">
          <label for="check_<?php echo $no ?>"></label>
        </div>
				<?php echo $no ?>
			</td>
			
			<td><a href="<?php echo base_url('admin/download/edit/'.$download->id_download) ?>">
					<?php echo $download->judul_download ?>
				</a>
				<small>
					<br><i class="fa fa-download"></i> <?php echo base_url('download/unduh/'.$download->id_download) ?>
					<br><i class="fa fa-link"></i> Link file:<br><textarea class="form-control form-control-sm" title="Copy link gambar/file ini"><?php echo base_url('assets/upload/file/'.$download->gambar) ?></textarea>
					<i class="fa fa-calendar-check"></i> <?php echo $this->website->tanggal_bulan_menit($download->tanggal) ?>
					<br><i class="fa fa-calendar-plus"></i> <?php echo $this->website->tanggal_bulan_menit($download->tanggal_post) ?>
					<br><i class="fa fa-eye"></i> <?php echo $download->hits ?>
				</small>
			</td>
			<td><small>
				<i class="fa fa-tags"></i> <a href="<?php echo base_url('admin/download/kategori_download/'.$download->id_kategori_download) ?>">
					<?php echo $download->nama_kategori_download ?>
				</a>
				<br><i class="fa fa-home"></i> <a href="<?php echo base_url('admin/download/jenis_download/'.$download->jenis_download) ?>">
					<?php echo $download->jenis_download ?></a>
				<br><i class="fa fa-user"></i> <a href="<?php echo base_url('admin/download/author/'.$download->id_user) ?>"><?php echo $download->nama ?></a>
				<br><i class="fa fa-file-code"></i> <?php echo strtoupper($download->file_ext) ?>
				<br><i class="fas fa-file"></i> <?php echo $download->file_size ?> MB
			</small>
			</td>
			<td>
				<?php if($download->status_download=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $download->status_download ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td>
				<div  class="btn-group">
					
				
				<?php if($download->gambar=="") { echo '-'; }else{ ?>
					<a href="<?php echo base_url('admin/download/unduh/'.$download->id_download) ?>" class="btn btn-info btn-sm mt-1" target="_blank"><i class="fa fa-download"></i> Unduh</a>
				<?php } ?>
				<a href="<?php echo base_url('admin/download/edit/'.$download->id_download) ?>" class="btn btn-success btn-sm mt-1" title="Edit"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/download/delete/'.$download->id_download) ?>" class="btn btn-secondary btn-sm mt-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
				</div>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>
<?php echo form_close(); ?>