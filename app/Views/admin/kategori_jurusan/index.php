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
		<?php $no=1; foreach($kategori_jurusan as $kategori_jurusan) { ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php if($kategori_jurusan['gambar']=="") { echo '-'; }else{ ?>
				<img src="<?php echo base_url('assets/upload/kategori_jurusan/thumbs/'.$kategori_jurusan['gambar']) ?>" class="img img-thumbnail">
			<?php } ?>
			</td>
			<td><?php echo $kategori_jurusan['nama_kategori_jurusan'] ?></td>
			<td><?php echo $kategori_jurusan['keterangan'] ?></td>
			<td><?php echo $kategori_jurusan['slug_kategori_jurusan'] ?></td>
			<td><?php echo $kategori_jurusan['urutan'] ?></td>
			<td>
				<a href="<?php echo base_url('admin/kategori_jurusan/edit/'.$kategori_jurusan['id_kategori_jurusan']) ?>" class="btn btn-secondary btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/kategori_jurusan/delete/'.$kategori_jurusan['id_kategori_jurusan']) ?>" class="btn btn-secondary btn-xs mb-1 delete-link" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>