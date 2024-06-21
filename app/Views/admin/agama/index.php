<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="60%">Nama</th>
			<th width="20%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($agama as $agama) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $agama->nama_agama ?></td>
			<td><?php echo $agama->urutan ?></td>
			<td>
				
				<a href="<?php echo base_url('admin/agama/edit/'.$agama->id_agama) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/agama/delete/'.$agama->id_agama) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>