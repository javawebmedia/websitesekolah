<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="10%">Logo</th>
			<th width="30%">Nama</th>
			<th width="20%">Keterangan</th>
			<th width="10%">Jumlah</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($kategori_download as $kategori_download) { 
			$download 	= $m_kategori_download->download($kategori_download->id_kategori_download);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_download->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_download->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_download->nama_kategori_download ?>
				<small>
					<br>Slug: <?php echo $kategori_download->slug_kategori_download ?>
				</small>
			</td>
			<td><?php echo $kategori_download->keterangan ?></td>
			<td class="text-center"><?php if($download) { echo $download->total; }else{ echo 0; } ?> Download</td>
			<td class="text-center"><?php echo $kategori_download->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_download/edit/'.$kategori_download->id_kategori_download) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_download/delete/'.$kategori_download->id_kategori_download) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>