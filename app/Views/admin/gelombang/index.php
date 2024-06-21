<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="10%">Gambar</th>
			<th width="30%">Nama Periode PSB</th>
			<th width="10%">Tanggal Buka</th>
			<th width="10%">Tanggal Tutup</th>
			<th width="10%">Tanggal Pengumuman</th>
			<th width="10%">Jumlah</th>
			<th width="10%">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($gelombang as $gelombang) { 
			$siswa 	= $m_gelombang->siswa($gelombang->id_gelombang);
		?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center">
				<?php if($gelombang->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$gelombang->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo $gelombang->judul ?>
				<small>
					<br>Slug: <?php echo $gelombang->slug ?>
				</small>
			</td>
			<td><?php echo $gelombang->tanggal_buka ?></td>
			<td><?php echo $gelombang->tanggal_tutup ?></td>
			<td><?php echo $gelombang->tanggal_pengumuman ?></td>
			<td class="text-center"><?php if($siswa) { echo $siswa->total; }else{ echo 0; } ?> Anak</td>
			<td class="text-center"><?php echo $gelombang->status_gelombang ?></td>
			<td>
				<a href="<?php echo base_url('admin/gelombang/edit/'.$gelombang->id_gelombang) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/gelombang/delete/'.$gelombang->id_gelombang) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>