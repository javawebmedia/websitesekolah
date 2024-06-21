<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="50%">Keterangan</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($hubungan as $hubungan) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $hubungan->nama_hubungan ?></td>
			<td><?php echo $hubungan->keterangan ?></td>
			<td><?php echo $hubungan->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/hubungan/edit/'.$hubungan->id_hubungan) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/hubungan/delete/'.$hubungan->id_hubungan) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>