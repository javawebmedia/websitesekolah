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
		$no=1; foreach($kategori_fasilitas as $kategori_fasilitas) { 
			$fasilitas 	= $m_kategori_fasilitas->fasilitas($kategori_fasilitas->id_kategori_fasilitas);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_fasilitas->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_fasilitas->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_fasilitas->nama_kategori_fasilitas ?>
				<small>
					<br>Slug: <?php echo $kategori_fasilitas->slug_kategori_fasilitas ?>
				</small>
			</td>
			<td><?php echo $kategori_fasilitas->keterangan ?></td>
			<td class="text-center"><?php if($fasilitas) { echo $fasilitas->total; }else{ echo 0; } ?> Fasilitas</td>
			<td class="text-center"><?php echo $kategori_fasilitas->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_fasilitas/edit/'.$kategori_fasilitas->id_kategori_fasilitas) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_fasilitas/delete/'.$kategori_fasilitas->id_kategori_fasilitas) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>