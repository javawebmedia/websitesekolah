<p class="text-right">
	<a href="<?php echo base_url('admin/siswa/edit/'.$siswa->id_siswa) ?>" class="btn btn-outline-success btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="<?php echo base_url('admin/siswa/cetak/'.$siswa->id_siswa) ?>" class="btn btn-outline-dark btn-sm" target="_blank">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="<?php echo base_url('admin/siswa/unduh/'.$siswa->id_siswa) ?>" class="btn btn-outline-danger btn-sm" target="_blank">
		<i class="fa fa-file-pdf"></i> Unduh
	</a>
	<a href="<?php echo base_url('admin/siswa') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header bg-light text-center">
				FOTO SISWA
			</div>
			<div class="card-body text-center">
				<?php if($siswa->gambar=='') { ?>
					<div class="alert alert-info">
						Belum Ada foto
					</div>
				<?php }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/'.$siswa->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
				<hr>
				<?php echo $siswa->nama_siswa ?>
				<hr>
				<?php echo $siswa->nis ?>/<?php echo $siswa->nisn ?>
				<hr>
				<?php echo $siswa->status_siswa ?>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-header bg-light text-center">
				DATA DASAR SISWA
			</div>
			<div class="card-body">
				<table class="table table-bordered printer">
					<tbody>
						<tr>
							<td class="bg-light" width="25%">Nama lengkap</td>
							<td><?php echo $siswa->nama_siswa ?></td>
						</tr>
						<tr>
							<td class="bg-light">Nama panggilan</td>
							<td><?php echo $siswa->nama_panggilan ?></td>
						</tr>
						<tr>
							<td class="bg-light">Jenis Kelamin</td>
							<td><?php echo $siswa->jenis_kelamin ?></td>
						</tr>
						<tr>
							<td class="bg-light">Tempat, tanggal lahir</td>
							<td><?php echo $siswa->tempat_lahir ?>, <?php echo $this->website->tanggal_id($siswa->tanggal_lahir) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>