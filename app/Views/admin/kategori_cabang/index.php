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
		$no=1; foreach($kategori_cabang as $kategori_cabang) { 
			$cabang 	= $m_kategori_cabang->cabang($kategori_cabang->id_kategori_cabang);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_cabang->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_cabang->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_cabang->nama_kategori_cabang ?>
				<small>
					<br>Slug: <?php echo $kategori_cabang->slug_kategori_cabang ?>
				</small>
			</td>
			<td><?php echo $kategori_cabang->keterangan ?></td>
			<td class="text-center"><?php if($cabang) { echo $cabang->total; }else{ echo 0; } ?> Cabang</td>
			<td class="text-center"><?php echo $kategori_cabang->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_cabang/edit/'.$kategori_cabang->id_kategori_cabang) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_cabang/delete/'.$kategori_cabang->id_kategori_cabang) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>