<p class="text-right">
	<a href="<?php echo base_url('admin/rombel/unduh/'.$rombel->id_rombel) ?>" class="btn btn-danger btn-sm mb-1" target="_blank"><i class="fa fa-file-pdf"></i></a>
	<a href="<?php echo base_url('admin/rombel/cetak/'.$rombel->id_rombel) ?>" class="btn btn-dark btn-sm mb-1" target="_blank"><i class="fa fa-print"></i></a>
	<a href="<?php echo base_url('admin/rombel/excel/'.$rombel->id_rombel) ?>" class="btn btn-success btn-sm mb-1" target="_blank"><i class="fa fa-file-excel"></i></a>
	<a href="<?php echo base_url('admin/rombel') ?>" class="btn btn-outline-info btn-sm mb-1"><i class="fa fa-arrow-left"></i> Kembali</a>
</p>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Informasi Rombongan Belajar</strong>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td class="bg-light" width="20%">Tahun Ajaran</td>
							<td><?php echo $rombel->nama_tahun ?></td>
						</tr>
						<tr>
							<td class="bg-light" >Kelas</td>
							<td><?php echo $rombel->nama_kelas ?></td>
						</tr>
						<tr>
							<td class="bg-light" >Jenjang</td>
							<td><?php echo $rombel->nama_jenjang ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Guru &amp; Wali Kelas</strong>
			</div>
			<div class="card-body">
				<?php echo form_open(base_url('admin/rombel/anggota/'.$rombel->id_rombel),' class="mb-2 alert alert-light"') ?>
					<input type="hidden" name="id_rombel" id="id_rombel" value="<?php echo $rombel->id_rombel ?>">
					<input type="hidden" name="id_kelas" id="id_kelas" value="<?php echo $rombel->id_kelas ?>">
					<input type="hidden" name="id_tahun" id="id_tahun" value="<?php echo $rombel->id_tahun ?>">
					<input type="hidden" name="status_siswa_rombel" id="status_siswa_rombel" value="Aktif">
					<input type="hidden" name="id_user" id="id_user" value="<?php echo $this->session->get('id_user') ?>">

					<div class="input-group">                  
						<select name="id_staff" class="form-control select2 col-md-6" id="id_guru" required>
							<option value="">Pilih Staff/Pegawai</option>
							<?php foreach($staff as $staff) { ?>
								<option value="<?php echo $staff->id_staff ?>">
									<?php echo $staff->nama ?> - <?php echo $staff->jabatan ?>
								</option>
							<?php } ?>
						</select>
						<select name="status_guru_rombel" class="form-control" required>
							<option value="Guru">Guru Kelas</option>
							<option value="Wali">Wali Kelas</option>
						</select>
						<span class="input-group-btn ">
							<button type="submit" name="staff" class="btn btn-secondary btn-flat"><i class="fa fa-plus"></i> Tambah</button>
						</span>
					</div>

				</form>

				<table class="table table-sm mt-2 table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="80%">Nama</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($staff_rombel as $staff_rombel) { ?>
						<tr>
							<td class="text-center"><?php echo $no ?></td>
							<td><?php echo $staff_rombel->nama ?>
							<small><br>Status: <strong><?php echo $staff_rombel->status_guru_rombel ?> Kelas</strong></small>
							</td>
							<td>
								<a href="<?php echo base_url('admin/rombel/delete_staff/'.$staff_rombel->id_staff_rombel.'/'.$rombel->id_rombel) ?>" class="btn btn-light btn-sm delete-link">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
		</div>

		<div class="col-md-12">
	
		<div class="card">
			<div class="card-header">
				<strong>Siswa (Peserta Didik)</strong>
			</div>
			<div class="card-body">
				<form id="simpan" method="post" class="mb-2 alert alert-light">

					<input type="hidden" name="id_rombel" id="id_rombel" value="<?php echo $rombel->id_rombel ?>">
					<input type="hidden" name="id_kelas" id="id_kelas" value="<?php echo $rombel->id_kelas ?>">
					<input type="hidden" name="id_tahun" id="id_tahun" value="<?php echo $rombel->id_tahun ?>">
					<input type="hidden" name="status_siswa_rombel" id="status_siswa_rombel" value="Aktif">
					<input type="hidden" name="id_user" id="id_user" value="<?php echo $this->session->get('id_user') ?>">

					<div class="input-group">                  
						<select name="id_siswa" class="form-control select2 col-md-6" id="id_siswa" required>
							<option value="">Pilih Siswa</option>
							<?php foreach($siswa as $siswa) { ?>
								<option value="<?php echo $siswa->id_siswa ?>">
									<?php echo $siswa->nama_siswa ?> (NIS/NISN: <?php echo $siswa->nis ?>/<?php echo $siswa->nisn ?>)
								</option>
							<?php } ?>
						</select>
						
						<span class="input-group-btn ">
							<button type="submit" name="siswa" class="btn btn-secondary btn-flat">
								<i class="fa fa-plus"></i> Tambah
							</button>
					</div>

				</form>

				<table class="table table-sm mt-2 table-bordered table-striped" id="siswaListing">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="30%">Nama</th>
							<th>L/P</th>
							<th>TTL</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="listRecords">                    
    				</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>

<?php include('app.php') ?>