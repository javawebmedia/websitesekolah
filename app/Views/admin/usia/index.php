<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="20%">Rentang</th>
			<th width="20%">Keterangan</th>
			<th width="10%">Status Aktif</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($usia as $usia) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $usia->nama_usia ?></td>
			<td class="text-center"><?php echo $usia->minimal ?> - <?php echo $usia->maksimal ?> Tahun</td>
			<td><?php echo $usia->keterangan ?></td>
			<td class="text-center">
				<?php if($usia->status_aktif=='Ya') { ?>
					<span class="badge bg-secondary"><i class="fa fa-eye"></i> <?php echo $usia->status_aktif ?></span>
				<?php }else{ ?>
					<span class="badge bg-light"><i class="fa fa-eye-slash"></i> <?php echo $usia->status_aktif ?></span>
				<?php } ?>	
			</td>
			<td class="text-center"><?php echo $usia->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/usia/edit/'.$usia->id_usia) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/usia/delete/'.$usia->id_usia) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>