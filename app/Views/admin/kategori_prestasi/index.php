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
		$no=1; foreach($kategori_prestasi as $kategori_prestasi) { 
			$prestasi 	= $m_kategori_prestasi->prestasi($kategori_prestasi->id_kategori_prestasi);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_prestasi->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_prestasi->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_prestasi->nama_kategori_prestasi ?>
				<small>
					<br>Slug: <?php echo $kategori_prestasi->slug_kategori_prestasi ?>
				</small>
			</td>
			<td><?php echo $kategori_prestasi->keterangan ?></td>
			<td class="text-center"><?php if($prestasi) { echo $prestasi->total; }else{ echo 0; } ?> Prestasi</td>
			<td class="text-center"><?php echo $kategori_prestasi->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_prestasi/edit/'.$kategori_prestasi->id_kategori_prestasi) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_prestasi/delete/'.$kategori_prestasi->id_kategori_prestasi) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>