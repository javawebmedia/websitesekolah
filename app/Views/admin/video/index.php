<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="10%">Gambar</th>
			<th width="30%">Judul</th>
			<th width="20%">Video</th>
			<th width="10%">Status</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($video as $video) { 
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($video->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$video->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $video->judul ?>
				<small>
					<br><strong>Kode:</strong> <?php echo $video->video ?>
					<br><strong>Posisi:</strong> <?php echo $video->posisi_video ?>
					<br><strong>Slug:</strong> <?php echo $video->slug_video ?>
				</small>
			</td>
			<td>
				<div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $video->video ?>?rel=0" allowfullscreen></iframe>
				</div>
			</td>
			<td>
				<?php if($video->status_video=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $video->status_video ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td class="text-center"><?php echo $video->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/video/edit/'.$video->id_video) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/video/delete/'.$video->id_video) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>