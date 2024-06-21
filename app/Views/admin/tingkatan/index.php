<?php include('tambah.php'); ?>
<table class="table table-bordered" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="10%">Logo</th>
			<th width="20%">Nama</th>
			<th width="10%">Jenis</th>
			<th width="20%">Keterangan</th>
			<th width="10%">Jumlah</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($tingkatan as $tingkatan) { 
			$anggota 	= $m_tingkatan->anggota($tingkatan->id_tingkatan);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($tingkatan->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/'.$tingkatan->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $tingkatan->nama_tingkatan ?>
				<small>
					<br>Slug: <?php echo $tingkatan->slug_tingkatan ?>
				</small>
			</td>
			<td><?php echo $tingkatan->jenis_tingkatan ?></td>
			<td><?php echo $tingkatan->keterangan ?></td>
			<td class="text-center"><?php if($anggota) { echo $anggota->total; }else{ echo 0; } ?> Pesilat</td>
			<td class="text-center"><?php echo $tingkatan->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/tingkatan/edit/'.$tingkatan->id_tingkatan) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/tingkatan/delete/'.$tingkatan->id_tingkatan) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>