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
		$no=1; foreach($kategori_staff as $kategori_staff) { 
			$staff 	= $m_kategori_staff->staff($kategori_staff->id_kategori_staff);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($kategori_staff->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$kategori_staff->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $kategori_staff->nama_kategori_staff ?>
				<small>
					<br>Slug: <?php echo $kategori_staff->slug_kategori_staff ?>
				</small>
			</td>
			<td><?php echo $kategori_staff->keterangan ?></td>
			<td class="text-center"><?php if($staff) { echo $staff->total; }else{ echo 0; } ?> Staff</td>
			<td class="text-center"><?php echo $kategori_staff->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_staff/edit/'.$kategori_staff->id_kategori_staff) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_staff/delete/'.$kategori_staff->id_kategori_staff) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>