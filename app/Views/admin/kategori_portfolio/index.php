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
		$no=1; foreach($kategori_portfolio as $kategori_portfolio) { 
			$portfolio 	= $m_kategori_portfolio->portfolio($kategori_portfolio->id_kategori_portfolio);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_portfolio->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_portfolio->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_portfolio->nama_kategori_portfolio ?>
				<small>
					<br>Slug: <?php echo $kategori_portfolio->slug_kategori_portfolio ?>
				</small>
			</td>
			<td><?php echo $kategori_portfolio->keterangan ?></td>
			<td class="text-center"><?php if($portfolio) { echo $portfolio->total; }else{ echo 0; } ?> Portfolio</td>
			<td class="text-center"><?php echo $kategori_portfolio->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_portfolio/edit/'.$kategori_portfolio->id_kategori_portfolio) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_portfolio/delete/'.$kategori_portfolio->id_kategori_portfolio) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>