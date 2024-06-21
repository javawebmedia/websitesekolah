<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example3">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="20%">Tahun Ajaran</th>
			<th width="30%">Keterangan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($tahun as $tahun) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $tahun->nama_tahun ?></td>
			<td><?php echo $tahun->tahun_mulai ?>/<?php echo $tahun->tahun_selesai ?></td>
			<td><?php echo $tahun->keterangan ?></td>
			<td>
				<a href="<?php echo base_url('admin/tahun/edit/'.$tahun->id_tahun) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/tahun/delete/'.$tahun->id_tahun) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>