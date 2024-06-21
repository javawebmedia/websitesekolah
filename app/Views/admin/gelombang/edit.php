<?php echo form_open_multipart(base_url('admin/gelombang/edit/'.$gelombang->id_gelombang)) ?>

<div class="form-group row">
					<label class="col-3">Nama Periode Pendaftaran</label>
					<div class="col-9">
						<input type="text" name="judul" class="form-control" placeholder="Nama Periode Pendaftaran PSB" value="<?php echo $gelombang->judul ?>" required>
						<small class="text-secondary">Nama Periode Pendaftaran PSB</small>
					</div>
				
				</div>

				<div class="form-group row">

					<label class="col-3">Tahun ajaran dan status</label>

					<div class="col-3">
						<input type="number" name="tahun" value="<?php echo $gelombang->tahun ?>" placeholder="Tahun" class="form-control" required>
						<small class="text-secondary">Tahun: <?php echo date('Y') ?></small>
					</div>

					<div class="col-3">
						<input type="text" name="tahun_ajaran" value="<?php echo $gelombang->tahun_ajaran ?>" placeholder="Tahun ajaran" class="form-control" required>
						<small class="text-secondary">Tahun Ajaran: <?php echo date('Y') ?>/<?php echo date('Y')+1; ?></small>
					</div>

					<div class="col-3">
						<select name="status_gelombang" class="form-control">
							<option value="Buka">Buka</option>
							<option value="Tutup" <?php if($gelombang->status_gelombang=='Tutup') { echo 'selected'; } ?>>Tutup</option>
						</select>
						<small class="text-secondary">Status Periode Pendaftaran PSB</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Gambar/ Logo</label>
					
					<div class="col-9">
						<input type="file" name="gambar" class="form-control" placeholder="Gambar? logo" value="<?php echo $gelombang->gambar ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan</label>
					<div class="col-9">
						<textarea name="isi" placeholder="Keterangan" class="form-control konten"><?php echo $gelombang->isi ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tanggal buka, tutup, dan pengumuman PSB</label>

					<div class="col-3">
						<input type="text" name="tanggal_buka" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($gelombang->tanggal_buka)) ?>">
						<small class="text-secondary">Tanggal buka pendaftaran</small>
					</div>
					
					<div class="col-3">
						<input type="text" name="tanggal_tutup" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($gelombang->tanggal_tutup)) ?>">
						<small class="text-secondary">Tanggal tutup pendaftaran</small>
					</div>

					<div class="col-3">
						<input type="text" name="tanggal_pengumuman" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($gelombang->tanggal_pengumuman)) ?>">
						<small class="text-secondary">Tanggal pengumuman pendaftaran</small>
					</div>
				</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/gelombang/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php echo form_close(); ?>