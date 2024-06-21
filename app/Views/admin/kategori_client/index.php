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
		$no=1; foreach($kategori_client as $kategori_client) { 
			$client 	= $m_kategori_client->client($kategori_client->id_kategori_client);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_client->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_client->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_client->nama_kategori_client ?>
				<small>
					<br>Slug: <?php echo $kategori_client->slug_kategori_client ?>
				</small>
			</td>
			<td><?php echo $kategori_client->keterangan ?></td>
			<td class="text-center"><?php if($client) { echo $client->total; }else{ echo 0; } ?> Client</td>
			<td class="text-center"><?php echo $kategori_client->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_client/edit/'.$kategori_client->id_kategori_client) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_client/delete/'.$kategori_client->id_kategori_client) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>