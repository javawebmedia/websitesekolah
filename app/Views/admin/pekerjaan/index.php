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
		<?php $no=1; foreach($pekerjaan as $pekerjaan) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $pekerjaan->nama_pekerjaan ?></td>
			<td><?php echo $pekerjaan->urutan ?></td>
			<td>
				<a href="<?php echo base_url('admin/pekerjaan/edit/'.$pekerjaan->id_pekerjaan) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/pekerjaan/delete/'.$pekerjaan->id_pekerjaan) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>