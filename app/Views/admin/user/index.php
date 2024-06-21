<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr class="bg-secondary text-center">
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="30%">Staff</th>
			<th width="20%">Username</th>
			<th width="10%">Level</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($user as $user) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $user->nama ?></td>
			<td><?php echo $user->nama_staff ?>
				<small class="text-gray">
					<br><i class="fa fa-chair"></i> <?php echo $user->jabatan ?>
					<br><i class="fa fa-envelope"></i> <?php echo $user->email ?>
				</small>
			</td>
			<td><?php echo $user->username ?></td>
			<td><?php echo $user->akses_level ?></td>
			<td>
				<a href="<?php echo base_url('admin/user/edit/'.$user->id_user) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/user/delete/'.$user->id_user) ?>" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>