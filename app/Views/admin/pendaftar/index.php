<p>
	<a href="<?php echo base_url('admin/gelombang') ?>" class="btn btn-info">
		<i class="fa fa-edit"></i> Kelola Gelombang/Periode Pendaftaran
	</a>
</p>

<table class="table table-bordered tabelku">
	<thead>
		<tr class="bg-light">
			<th rowspan="2">No</th>
			<th rowspan="2">Gelombang</th>
			<th colspan="3" class="text-center">Status Pendaftar</th>
			<th rowspan="2">Kelola</th>
		</tr>
		<tr class="bg-light">
			<th class="text-center">Menunggu</th>
			<th class="text-center">Tidak Diterima</th>
			<th class="text-center">Diterima</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($gelombang as $gelombang) {
			$id_gelombang 	= $gelombang->id_gelombang;
			$menunggu 		= $m_siswa->status_siswa_gelombang('Menunggu',$id_gelombang);
			$ditolak 		= $m_siswa->status_siswa_gelombang('Ditolak',$id_gelombang);
			$diterima 		= $m_siswa->status_siswa_gelombang('Diterima',$id_gelombang);
		 ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><strong><?php echo $gelombang->judul ?></strong>
				<small>
					<br>Buka: <?php echo $gelombang->tanggal_buka ?>
					<br>Tutup: <?php echo $gelombang->tanggal_tutup ?>
					<br>Pengumuman: <?php echo $gelombang->tanggal_pengumuman ?>
				</small>
			</td>
			<td class="text-center">
				<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Menunggu') ?>">
					<?php echo $this->website->angka($menunggu->total) ?>
				</a>
			</td>
			<td class="text-center">
				<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Ditolak') ?>">
					<?php echo $this->website->angka($ditolak->total) ?>
				</a>
			</td>
			<td class="text-center">
				<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Diterima') ?>">
					<?php echo $this->website->angka($diterima->total) ?>
				</a>
			</td>
			<td>
				<a href="<?php echo base_url('admin/pendaftar/gelombang/'.$gelombang->id_gelombang.'/Semua') ?>" class="btn btn-secondary btn-xs"><i class="fa fa-tasks"></i> Kelola</a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>

