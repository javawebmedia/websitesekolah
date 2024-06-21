<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="10%">Gambar</th>
			<th width="30%">Nama</th>
			<th width="20%">Keterangan</th>
			<th width="10%">Status</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($link_website as $link_website) { 
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($link_website->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$link_website->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $link_website->nama_link_website ?>
				<small>
					<br><i class="fa fa-link"></i> <?php echo $link_website->link_website ?>
					<br><i class="fa fa-globe"></i> <?php echo $link_website->metode_link ?>
				</small>
			</td>
			<td><?php echo $link_website->keterangan ?></td>
			<td>
				<?php if($link_website->status_link_website=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $link_website->status_link_website ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td class="text-center"><?php echo $link_website->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/link_website/edit/'.$link_website->id_link_website) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/link_website/delete/'.$link_website->id_link_website) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>