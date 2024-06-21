<?php include('tambah.php'); ?>
<table class="table tabelku table-sm" id="example3">
	<thead>
		<tr class="text-center bg-light">
			<th width="5%">No</th>
			<th width="10%">Logo</th>
			<th width="30%">Nama</th>
			<th width="20%">Keterangan</th>
			<th width="10%">Urutan</th>
			<th width="10%">Status Wajib</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($jenis_dokumen as $jenis_dokumen) { 
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($jenis_dokumen->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$jenis_dokumen->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $jenis_dokumen->nama_jenis_dokumen ?>
				<small>
					<br>Slug: <?php echo $jenis_dokumen->slug_jenis_dokumen ?>
				</small>
			</td>
			<td><?php echo $jenis_dokumen->keterangan ?></td>
			<td class="text-center"><?php echo $jenis_dokumen->urutan ?></td>
			<td class="text-center">
				<?php if($jenis_dokumen->status_jenis_dokumen=='Wajib') { ?>
					<span class="badge bg-info">
						<i class="fa fa-check-circle"></i> <?php echo $jenis_dokumen->status_jenis_dokumen ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-times-circle"></i> <?php echo $jenis_dokumen->status_jenis_dokumen ?>
					</span>
				<?php } ?>
			</td>
			<td>
				<a href="<?php echo base_url('admin/jenis_dokumen/edit/'.$jenis_dokumen->id_jenis_dokumen) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/jenis_dokumen/delete/'.$jenis_dokumen->id_jenis_dokumen) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>