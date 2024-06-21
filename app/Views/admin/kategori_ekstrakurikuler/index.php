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
		$no=1; foreach($kategori_ekstrakurikuler as $kategori_ekstrakurikuler) { 
			$ekstrakurikuler 	= $m_kategori_ekstrakurikuler->ekstrakurikuler($kategori_ekstrakurikuler->id_kategori_ekstrakurikuler);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_ekstrakurikuler->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_ekstrakurikuler->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler ?>
				<small>
					<br>Slug: <?php echo $kategori_ekstrakurikuler->slug_kategori_ekstrakurikuler ?>
				</small>
			</td>
			<td><?php echo $kategori_ekstrakurikuler->keterangan ?></td>
			<td class="text-center"><?php if($ekstrakurikuler) { echo $ekstrakurikuler->total; }else{ echo 0; } ?> Ekstrakurikuler</td>
			<td class="text-center"><?php echo $kategori_ekstrakurikuler->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_ekstrakurikuler/edit/'.$kategori_ekstrakurikuler->id_kategori_ekstrakurikuler) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_ekstrakurikuler/delete/'.$kategori_ekstrakurikuler->id_kategori_ekstrakurikuler) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>