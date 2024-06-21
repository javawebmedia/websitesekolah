<?php include('tambah.php'); ?>
<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="5%">Logo</th>
			<th width="20%">Nama</th>
			<th width="30%">Keterangan</th>
			<th width="10%">Slug</th>
			<th width="10%">Urutan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($kategori_agenda as $kategori_agenda) { ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php if($kategori_agenda['gambar']=="") { echo '-'; }else{ ?>
				<img src="<?php echo base_url('assets/upload/kategori_agenda/thumbs/'.$kategori_agenda['gambar']) ?>" class="img img-thumbnail">
			<?php } ?>
			</td>
			<td><?php echo $kategori_agenda['nama_kategori_agenda'] ?></td>
			<td><?php echo $kategori_agenda['keterangan'] ?></td>
			<td><?php echo $kategori_agenda['slug_kategori_agenda'] ?></td>
			<td><?php echo $kategori_agenda['urutan'] ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_agenda/edit/'.$kategori_agenda['id_kategori_agenda']) ?>" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_agenda/delete/'.$kategori_agenda['id_kategori_agenda']) ?>" class="btn btn-dark btn-xs mb-1" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>