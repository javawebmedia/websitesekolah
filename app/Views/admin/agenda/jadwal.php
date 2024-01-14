<?php include('tambah_jadwal.php') ?>
<hr>
<?php
echo form_open(base_url('admin/agenda/proses_jadwal'));
?>
<p>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Tambah">
          <i class="fa fa-plus"></i> TAMBAH JADWAL
        </button>
      </p>
  
    <table id="example1" class="display table table-bordered table-sm" cellspacing="0" width="100%">
	<thead>
		<tr class="bg-info">
			<th width="5%">NO</th>
			<th width="15%">TANGGAL</th>
			<th width="15%">LOKASI</th>
			<th width="15%">KETERANGAN</th>
			<th width="15%">PEMBICARA</th>
			<th width="15%"></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($jadwal as $jadwal) { ?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo date('d-m-Y',strtotime($jadwal->tanggal_mulai)) ?></td>
			<td><?php echo $jadwal->nama_tempat ?></td>
			<td><?php echo $jadwal->keterangan ?></td>
			<td><?php echo $jadwal->pembicara ?></td>
			<td>
				<div class="btn-group">
	           

	                <a href="<?php echo base_url('admin/agenda/edit_jadwal/'.$jadwal->id_jadwal) ?>" 
	                  class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

	                  <a href="<?php echo base_url('admin/agenda/delete_jadwal/'.$agenda['id_agenda'].'/'.$jadwal->id_jadwal) ?>" class="btn btn-danger btn-xs delete-link"><i class="fa fa-trash"></i></a>
	                </div>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
