<p class="text-right">
	<a href="<?php echo base_url('admin/siswa') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header bg-secondary text-center">
				<strong>TEMPLATE IMPORT</strong>
			</div>
			<div class="card-body text-center bg-light">
				<p><strong class="text-danger">
						<i class="fa fa-exclamation-circle"></i> Perhatian
					</strong>
				<hr>
				Pastikan Anda mengimpor data siswa dengan benar. Silakan unduh template impor siswa di bawah ini. Jangan mengubah posisi kolom yang ada pada template. Baca baik-baik petunjuk pada template sebelum melakukan import. 
				<br>Data siswa yang akan diimport harus dikelompokkan perkelas dan rombongan belajar (Rombel). Silakan <a href="<?php echo base_url('admin/rombel') ?>">Kelola Rombel di sini</a>
			</p>
			<p>
				<a href="<?php echo base_url('assets/template/template-siswa.xlsx') ?>" class="btn btn-info btn-sm" target="_blank">
					<i class="fa fa-file-excel"></i> Unduh Template Impor
				</a>
			</p>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header bg-light">
				<strong>FORMULIR IMPORT</strong>
			</div>
			<div class="card-body">
				<?php echo form_open_multipart(base_url('admin/siswa/import')); ?>
				<input type="hidden" name="ID_USER" value="<?php echo Session()->get('id_user'); ?>">
				<div class="form-group">
					<label>Status Siswa</label>
					<select name="status_siswa" class="form-control" required>
						<option value="Aktif">Aktif</option>
						<option value="Lulus">Lulus</option>
						<option value="Pindah">Pindah</option>
						<option value="Meninggal">Meninggal</option>
					</select>
				</div>

				<div class="form-group">
					<label>Pilih Rombongan Belajar (Kelas dan Tahun Ajaran)</label>
					<select name="id_rombel" class="form-control select2" required>
						<option value="">Pilih Kelas dan Tahun Ajaran</option>
						<?php foreach($rombel as $rombel) { ?>
							<option value="<?php echo $rombel->id_rombel ?>">
								<?php echo $rombel->nama_kelas ?> (<?php echo $rombel->nama_jenjang ?>) - <?php echo $rombel->nama_tahun ?>
							</option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group">
					<label>Import Sekalian pada Rombongan Belajar yang dipilih di atas?</label>
					<select name="import_rombel" class="form-control" required>
						<option value="">Pilih Salah Satu</option>
						<option value="Ya">Ya</option>
						<option value="Tidak">Tidak</option>
					</select>
				</div>

				<div class="form-group">
					<label>Pilih file excel</label>
					<input type="file" name="file_excel" class="form-control" required>
					<small class="text-danger">Format: xls, xlsx, csv dengan ukuran maksimal 8MB</small>
				</div>

				

				<div class="form-group">

					<button type="submit" class="btn btn-success" name="submit" value="submit">
						<i class="fa fa-upload"></i> Upload dan Import
					</button>
					<a href="<?php echo base_url('admin/siswa') ?>" class="btn btn-outline-info">
						<i class="fa fa-arrow-left"></i> Kembali
					</a>
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>
