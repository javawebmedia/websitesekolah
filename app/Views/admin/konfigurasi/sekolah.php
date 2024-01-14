<?php 
echo form_open(base_url('admin/konfigurasi/sekolah')); 
echo csrf_field(); 
?>

<p class="text-right">
	<a href="<?php echo base_url('admin/konfigurasi/unduh') ?>" class="btn btn-outline-danger" target="_blank">
		<i class="fa fa-file-pdf"></i> Cetak/Unduh
	</a>
	<button type="submit" class="btn btn-success" name="submit" value="submit">
		<i class="fa fa-save"></i> Simpan dan Update
	</button>
</p>

<table class="table table-sm table-bordered">
	<tbody>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>DATA DASAR SEKOLAH</h3></td>
	  </tr>
		<tr>
			<td class="bg-light" width="25%">Nama lengkap sekolah</td>
			<td><input type="text" name="nama_sekolah" class="form-control" value="<?php echo $sekolah->nama_sekolah ?>"></td>
		</tr>
		<tr>
			<td class="bg-light" width="25%">Nama lengkap sekolah cover</td>
			<td><input type="text" name="nama_sekolah_cover" class="form-control" value="<?php echo $sekolah->nama_sekolah_cover ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Singkat</td>
			<td><input type="text" name="nama_singkat" class="form-control" value="<?php echo $sekolah->nama_singkat ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">NPSN/NSS/NISN</td>
			<td><input type="text" name="nis" class="form-control" value="<?php echo $sekolah->nis ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Status Sekolah</td>
			<td><input type="text" name="status_sekolah" class="form-control" value="<?php echo $sekolah->status_sekolah ?>"></td>
		</tr>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>KONTAK DAN ALAMAT SEKOLAH</h3></td>
	  </tr>
		<tr>
			<td class="bg-light">Alamat</td>
			<td><textarea name="alamat" class="form-control"><?php echo $sekolah->alamat ?></textarea></td>
		</tr>
		<tr>
			<td class="bg-light">Kelurahan</td>
			<td><input type="text" name="kelurahan" class="form-control" value="<?php echo $sekolah->kelurahan ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Kecamatan</td>
			<td><input type="text" name="kecamatan" class="form-control" value="<?php echo $sekolah->kecamatan ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Kabupaten</td>
			<td><input type="text" name="kabupaten" class="form-control" value="<?php echo $sekolah->kabupaten ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Provinsi</td>
			<td><input type="text" name="provinsi" class="form-control" value="<?php echo $sekolah->provinsi ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Kode Pos</td>
			<td><input type="text" name="kode_pos" class="form-control" value="<?php echo $sekolah->kode_pos ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Telepon</td>
			<td><input type="text" name="telepon" class="form-control" value="<?php echo $sekolah->telepon ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Email</td>
			<td><input type="email" name="email" class="form-control" value="<?php echo $sekolah->email ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Website</td>
			<td><input type="text" name="website" class="form-control" value="<?php echo $sekolah->website ?>"></td>
		</tr>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>INFORMASI, AKREDITASI DAN YAYASAN</h3></td>
	  </tr>
		<tr>
			<td class="bg-light">Nama Yayasan</td>
			<td><input type="text" name="nama_yayasan" class="form-control" value="<?php echo $sekolah->nama_yayasan ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Yayasan Cover Rapor</td>
			<td><input type="text" name="nama_cover" class="form-control" value="<?php echo $sekolah->nama_cover ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Kota Cover Rapor</td>
			<td><input type="text" name="kota_cover" class="form-control" value="<?php echo $sekolah->kota_cover ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Yayasan Tampil di Footer Rapor</td>
			<td><input type="text" name="nama_footer" class="form-control" value="<?php echo $sekolah->nama_footer ?>"></td>
		</tr>

		<tr>
			<td class="bg-light">Tanggal berdiri Yayasan/Sekolah</td>
			<td><input type="text" name="tanggal_berdiri" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($sekolah->tanggal_berdiri) ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nama Kepala Sekolah</td>
			<td><input type="text" name="nama_kepsek" class="form-control" value="<?php echo $sekolah->nama_kepsek ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Rombel</td>
			<td><input type="text" name="jumlah_rombel" class="form-control" value="<?php echo $sekolah->jumlah_rombel ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Siswa</td>
			<td><input type="text" name="jumlah_murid" class="form-control" value="<?php echo $sekolah->jumlah_murid ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Pegawai</td>
			<td><input type="text" name="jumlah_pegawai" class="form-control" value="<?php echo $sekolah->jumlah_pegawai ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah Akreditasi</td>
			<td>
				<select name="nilai_akreditasi" class="form-control">
					<option value="A">A</option>
					<option value="B" <?php if($sekolah->nilai_akreditasi=='B') { echo 'selected'; } ?>>B</option>
					<option value="C" <?php if($sekolah->nilai_akreditasi=='C') { echo 'selected'; } ?>>C</option>
					<option value="D" <?php if($sekolah->nilai_akreditasi=='D') { echo 'selected'; } ?>>D</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="bg-light">Tahun Akreditasi</td>
			<td><input type="text" name="tahun_akreditasi" class="form-control" value="<?php echo $sekolah->tahun_akreditasi ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Tanggal Akreditasi</td>
			<td><input type="text" name="tanggal_berlaku" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($sekolah->tanggal_berlaku) ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Tanggal Kadaluarsa Akreditasi</td>
			<td><input type="number" name="tanggal_kadaluarsa" class="form-control tanggal" value="<?php echo $this->website->tanggal_id($sekolah->tanggal_kadaluarsa) ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor Izin Sekolah</td>
			<td><input type="text" name="nomor_izin" class="form-control" value="<?php echo $sekolah->nomor_izin ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Keterangan lain</td>
			<td><textarea name="keterangan" class="form-control"><?php echo $sekolah->keterangan ?></textarea></td>
		</tr>
		<tr>
		  <td colspan="2" class="bg-secondary text-center"><h3>INFORMASI TANAH DAN BANGUNAN</h3></td>
	  </tr>
		<tr>
			<td class="bg-light">Luas Tanah</td>
			<td><input type="text" name="luas_tanah" class="form-control" value="<?php echo $sekolah->luas_tanah ?>">
				<small class="text-secondary">Dalam meter persegi</small></td>
		</tr>
		<tr>
			<td class="bg-light">Luas Bangunan</td>
			<td><input type="text" name="luas_bangunan" class="form-control" value="<?php echo $sekolah->luas_bangunan ?>"><small class="text-secondary">Dalam meter persegi</small></td>
		</tr>
		<tr>
			<td class="bg-light">Status Kepemilikan</td>
			<td><input type="text" name="status_tanah" class="form-control" value="<?php echo $sekolah->status_tanah ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor IMB</td>
			<td><input type="text" name="imb" class="form-control" value="<?php echo $sekolah->imb ?>"></td>
		</tr>
		<tr>
			<td class="bg-light">Nomor Sertifikat Tanah</td>
			<td><input type="text" name="nomor_sertifikat" class="form-control" value="<?php echo $sekolah->nomor_sertifikat ?>"></td>
		</tr>
		
		<tr>
			<td class="bg-light"></td>
			<td>
				<button type="submit" class="btn btn-success" name="submit" value="submit">
					<i class="fa fa-save"></i> Simpan
				</button>
			</td>
		</tr>
	</tbody>
</table>

<?php echo form_close() ?>