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
		$no=1; foreach($kategori_galeri as $kategori_galeri) { 
			$galeri 	= $m_kategori_galeri->galeri($kategori_galeri->id_kategori_galeri);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_galeri->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_galeri->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_galeri->nama_kategori_galeri ?>
				<small>
					<br>Slug: <?php echo $kategori_galeri->slug_kategori_galeri ?>
				</small>
			</td>
			<td><?php echo $kategori_galeri->keterangan ?></td>
			<td class="text-center"><?php if($galeri) { echo $galeri->total; }else{ echo 0; } ?> Galeri</td>
			<td class="text-center"><?php echo $kategori_galeri->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_galeri/edit/'.$kategori_galeri->id_kategori_galeri) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_galeri/delete/'.$kategori_galeri->id_kategori_galeri) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>