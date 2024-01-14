<?php 
use App\Models\Agama_model;
use App\Models\Jenjang_model;
use App\Models\Pekerjaan_model;
use App\Models\Hubungan_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
$m_agama 		= new Agama_model();
$m_jenjang 		= new Jenjang_model();
$m_pekerjaan 	= new Pekerjaan_model();
$m_hubungan 	= new Hubungan_model();
$m_tahun 		= new Tahun_model();
$m_kelas 		= new Kelas_model();
echo form_open_multipart(base_url('admin/siswa/edit/'.$siswa->id_siswa));
echo csrf_field(); 
?>
<p class="text-right">
	<a href="<?php echo base_url('admin/siswa') ?>" class="btn btn-outline-info">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-2">
		<!-- data dasar siswa -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>FOTO SISWA</h4>
			</div>
			<div class="card-body text-center">
				<?php if($siswa->gambar=='') { ?>
					<div class="alert alert-info">
						Belum Ada foto
					</div>
				<?php }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/'.$siswa->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-md-10">
		<!-- data dasar siswa -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>DATA DASAR SISWA</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-3">Nama Lengkap<span class="text-danger">*</span></label>
					<div class="col-6">
						<input type="text" name="nama_siswa" class="form-control form-control-lg" placeholder="Nama lengkap siswa" value="<?php if(isset($_POST['nama_siswa'])) { echo set_value('nama_siswa'); }else{ echo $siswa->nama_siswa; } ?>" required>
						<small class="text-secondary">Nama lengkap Siswa</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Panggilan<span class="text-danger">*</span></label>
					<div class="col-6">
						<input type="text" name="nama_panggilan" class="form-control" placeholder="Nama panggilan" value="<?php if(isset($_POST['nama_panggilan'])) { echo set_value('nama_panggilan'); }else{ echo $siswa->nama_panggilan; } ?>">
						<small class="text-secondary">Nama panggilan</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">NIS dan NISN</label>
					<div class="col-3">
						<input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa (NIS)" value="<?php if(isset($_POST['nis'])) { echo set_value('nis'); }else{ echo $siswa->nis; } ?>">
						<small class="text-secondary">Nomor Induk Siswa (NIS)</small>
					</div>
					<div class="col-3">
						<input type="text" name="nisn" class="form-control" placeholder="Nomor Induk Siswa Nasional (NISN)" value="<?php if(isset($_POST['nisn'])) { echo set_value('nisn'); }else{ echo $siswa->nisn; } ?>">
						<small class="text-secondary">Nomor Induk Siswa Nasional (NISN)</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Agama &amp; Status Kewarganegaraan<span class="text-danger">*</span></label>
					<div class="col-2">
						<?php $agama = $m_agama->listing(); ?>
						<select name="id_agama" class="form-control select2">
							<?php foreach($agama as $agama) { ?>
								<option value="<?php echo $agama->id_agama ?>" <?php if(set_value('id_agama')==$agama->id_agama) { echo 'selected'; } ?>>
									<?php echo $agama->nama_agama ?>
								</option>
							<?php } ?>
						</select>
						<small class="text-gray">Agama Siswa. <a href="<?php echo base_url('admin/agama') ?>" target="_blank">Kelola?</a></small>
					</div>
					<div class="col-2">
						<select name="status_wn" class="form-control">
							<option value="WNI">WNI</option>
							<option value="WNA" <?php if(set_value('status_wn')=='WNA') { echo 'selected'; }elseif($siswa->status_wn=='WNA') { echo 'selected'; } ?>>WNA</option>
						</select>
					</div>
					<div class="col-3">
						<input type="text" name="negara_asal" class="form-control" value="<?php if(isset($_POST['negara_asal'])) { echo set_value('negara_asal'); }else{ echo $siswa->negara_asal; } ?>" placeholder="Negara asal (jika WNA)">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Jenis Kelamin<span class="text-danger">*</span></label>
					<div class="col-3">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="jenis_kelamin" type="radio" id="customRadio1" value="L"  <?php if(set_value('jenis_kelamin')=='L') { echo 'checked'; }elseif($siswa->jenis_kelamin=='L') { echo 'checked'; }elseif($siswa->jenis_kelamin=='Laki-laki') { echo 'checked'; } ?> required>
								<label for="customRadio1" class="custom-control-label">Laki-laki</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="jenis_kelamin" type="radio" id="customRadio2" value="P" <?php if(set_value('jenis_kelamin')=='P') { echo 'checked'; }elseif($siswa->jenis_kelamin=='P') { echo 'checked'; }elseif($siswa->jenis_kelamin=='Perempuan') { echo 'checked'; } ?> required>
								<label for="customRadio2" class="custom-control-label">Perempuan</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Status/Hubungan Anak dengan Wali<span class="text-danger">*</span></label>
					<div class="col-3">
						<?php $hubungan = $m_hubungan->listing(); ?>
						<select name="id_hubungan" class="form-control select2">
							<?php foreach($hubungan as $hubungan) { ?>
								<option value="<?php echo $hubungan->id_hubungan ?>" <?php if(set_value('id_hubungan')==$hubungan->id_hubungan) { echo 'selected'; }elseif($siswa->id_hubungan==$hubungan->id_hubungan) { echo 'selected'; } ?>>
									<?php echo $hubungan->nama_hubungan ?>
								</option>
							<?php } ?>
						</select>
						<small class="text-gray">Status Anak. <a href="<?php echo base_url('admin/hubungan') ?>" target="_blank">Kelola?</a></small>
					</div>
					<div class="col-2">
						<input type="number" name="anak_ke" class="form-control" placeholder="Anak nomor ke?" value="<?php if(isset($_POST['anak_ke'])) { echo set_value('anak_ke'); }else{ echo $siswa->anak_ke; } ?>" required>
						<small class="text-gray">Anak nomor ke</small>
					</div>
					<div class="col-2">
						<input type="number" name="jumlah_saudara" class="form-control" placeholder="Jumlah saudara" value="<?php if(isset($_POST['jumlah_saudara'])) { echo set_value('jumlah_saudara'); }else{ echo $siswa->jumlah_saudara; } ?>" required>
						<small class="text-gray">Jumlah saudara</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tempat dan Tanggal Lahir<span class="text-danger">*</span></label>
					<div class="col-3">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="<?php if(isset($_POST['tempat_lahir'])) { echo set_value('tempat_lahir'); }else{ echo $siswa->tempat_lahir; } ?>" required>
						<small class="text-secondary">Tempat lahir</small>
					</div>
					<div class="col-3">
						<input type="text" name="tanggal_lahir" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php if(isset($_POST['tanggal_lahir'])) { echo set_value('tanggal_lahir'); }else{ echo $this->website->tanggal_id($siswa->tanggal_lahir); } ?>" required>
						<small class="text-secondary">Tanggal lahir</small>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-3">Alamat<span class="text-danger">*</span></label>
					<div class="col-9">
						<textarea name="alamat" placeholder="Alamat" class="form-control" required><?php if(isset($_POST['alamat'])) { echo set_value('alamat'); }else{ echo $siswa->alamat; } ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Kode Pos</label>
					<div class="col-6">
						<input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" value="<?php if(isset($_POST['kode_pos'])) { echo set_value('kode_pos'); }else{ echo $siswa->kode_pos; } ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Telepon dan Email</label>
					<div class="col-3">
						<input type="text" name="telepon" class="form-control" placeholder="Telepon/HP" value="<?php if(isset($_POST['telepon'])) { echo set_value('telepon'); }else{ echo $siswa->telepon; } ?>">
						<small class="text-secondary">Telepon/HP</small>
					</div>
					<div class="col-3">
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo set_value('email'); }else{ echo $siswa->email; } ?>">
						<small class="text-secondary">Email (Username)</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Gambar/Foto</label>

					<div class="col-6">
						<input type="file" name="gambar" class="form-control" placeholder="Gambar/Foto" value="<?php if(isset($_POST['nama_siswa'])) { echo set_value('gambar'); }else{ echo $siswa->gambar; } ?>">
					</div>
				</div>

			</div>
			<div class="card-footer bg-light text-right border-top">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- data dasar siswa -->

		<!-- data dasar siswa -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>DATA PENERIMAAN DI SEKOLAH</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-3">Jenis Masuk Siswa<span class="text-danger">*</span></label>
					<div class="col-3">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="jenis_siswa" type="radio" id="jenis_siswa1" value="Langsung"  <?php if(set_value('jenis_siswa')=='Langsung') { echo 'checked'; }elseif($siswa->jenis_siswa=='Langsung') { echo 'checked'; } ?> required>
								<label for="jenis_siswa1" class="custom-control-label">Langsung</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="jenis_siswa" type="radio" id="jenis_siswa2" value="Pindahan" <?php if(set_value('jenis_siswa')=='Pindahan') { echo 'checked'; }elseif($siswa->jenis_siswa=='Pindahan') { echo 'checked'; } ?> required>
								<label for="jenis_siswa2" class="custom-control-label">Pindahan</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Status Siswa<span class="text-danger">*</span></label>
					<div class="col-3">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="status_siswa" type="radio" id="status_siswa1" value="Aktif"  <?php if(set_value('status_siswa')=='Aktif') { echo 'checked'; }elseif($siswa->status_siswa=='Aktif') { echo 'checked'; } ?> required>
								<label for="status_siswa1" class="custom-control-label">Aktif</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="status_siswa" type="radio" id="status_siswa2" value="Lulus" <?php if(set_value('status_siswa')=='Lulus') { echo 'checked'; }elseif($siswa->status_siswa=='Lulus') { echo 'checked'; } ?> required>
								<label for="status_siswa2" class="custom-control-label">Lulus</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="status_siswa" type="radio" id="status_siswa3" value="Pindah" <?php if(set_value('status_siswa')=='Pindah') { echo 'checked'; }elseif($siswa->status_siswa=='Pindah') { echo 'checked'; } ?> required>
								<label for="status_siswa3" class="custom-control-label">Pindah</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="status_siswa" type="radio" id="status_siswa4" value="Meninggal" <?php if(set_value('status_siswa')=='Meninggal') { echo 'checked'; }elseif($siswa->status_siswa=='Meninggal') { echo 'checked'; } ?> required>
								<label for="status_siswa4" class="custom-control-label">Meninggal</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tahun Ajaran Saat Masuk<span class="text-danger">*</span></label>
					<div class="col-6">
						<?php $tahun = $m_tahun->listing(); ?>
						<select name="id_tahun" class="form-control select2" required>
							<option value="">Pilih Tahun Ajaran</option>
							<?php foreach($tahun as $tahun) { ?>
								<option value="<?php echo $tahun->id_tahun ?>" <?php if(set_value('id_tahun')==$tahun->id_tahun) { echo 'selected'; }elseif($siswa->id_tahun==$tahun->id_tahun) { echo 'selected'; } ?>>
									<?php echo $tahun->tahun_mulai ?>/<?php echo $tahun->tahun_selesai ?> - <?php echo $tahun->nama_tahun ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Jenjang/Kelompok Saat Masuk<span class="text-danger">*</span></label>
					<div class="col-6">
						<?php $jenjang = $m_jenjang->listing(); ?>
						<select name="id_jenjang" class="form-control select2" required>
							<option value="">Pilih Kelompok/Jenjang</option>
							<?php foreach($jenjang as $jenjang) { ?>
								<option value="<?php echo $jenjang->id_jenjang ?>" <?php if(set_value('id_jenjang')==$jenjang->id_jenjang) { echo 'selected'; }elseif($siswa->id_jenjang==$jenjang->id_jenjang) { echo 'selected'; } ?>>
									<?php echo $jenjang->nama_jenjang ?>
								</option>
							<?php } ?>
						</select>
						<small class="text-gray">Jenjang/Kelompok Saat Masuk. <a href="<?php echo base_url('admin/jenjang') ?>" target="_blank">Kelola?</a></small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Kelas Saat Masuk<span class="text-danger">*</span></label>
					<div class="col-6">
						<?php $kelas = $m_kelas->listing(); ?>
						<select name="id_kelas" class="form-control select2" required>
							<option value="">Pilih Kelas</option>
							<?php foreach($kelas as $kelas) { ?>
								<option value="<?php echo $kelas->id_kelas ?>" <?php if(set_value('id_kelas')==$kelas->id_kelas) { echo 'selected'; }elseif($siswa->id_kelas==$kelas->id_kelas) { echo 'selected'; } ?>>
									<?php echo $kelas->nama_jenjang ?> - <?php echo $kelas->nama_kelas ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tanggal Masuk<span class="text-danger">*</span></label>
					<div class="col-6">
						<input type="text" name="tanggal_masuk" class="form-control tanggal" placeholder="Tanggal masuk" value="<?php if(isset($_POST['tanggal_masuk'])) { echo set_value('tanggal_masuk'); }else{ echo $this->website->tanggal_id($siswa->tanggal_masuk); } ?>" required>
						<small class="text-gray">Tanggal masuk. Format: dd-mm-yyyy</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Sekolah Asal</label>
					<div class="col-6">
						<input type="text" name="asal_sekolah" class="form-control" placeholder="Nama Sekolah Asal" value="<?php if(isset($_POST['asal_sekolah'])) { echo set_value('asal_sekolah'); }else{ echo $siswa->asal_sekolah; } ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Alamat Sekolah Asal</label>
					<div class="col-6">
						<textarea name="alamat_sekolah_asal" class="form-control" placeholder="Alamat Sekolah Asal"><?php if(isset($_POST['alamat_sekolah_asal'])) { echo set_value('alamat_sekolah_asal'); }else{ echo $siswa->alamat_sekolah_asal; } ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tanggal Pindah (Sesuai Surat Pindah)</label>
					<div class="col-6">
						<input type="text" name="tanggal_pindah" class="form-control tanggal" placeholder="Tanggal pindah" value="<?php if(isset($_POST['tanggal_pindah'])) { echo set_value('tanggal_pindah'); }else{ echo $this->website->tanggal_id($siswa->tanggal_pindah); } ?>">
						<small class="text-gray">Tanggal pindah (Jika siswa pindahan). Format: dd-mm-yyyy</small>
					</div>
				</div>

			</div>
			<div class="card-footer bg-light text-right border-top">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>

		<!-- data dasar siswa -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>DATA KESEHATAN DAN INFORMASI SISWA LAINNYA</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-3">Golongan Darah Siswa</label>
					<div class="col-6">
						<select name="goldar_siswa" class="form-control">
							<option value="">Pilih Golongan Darah</option>
							<option value="A" <?php if(set_value('goldar_siswa')=='A') { echo 'selected'; }elseif($siswa->goldar_siswa=='A') { echo 'selected'; } ?>>A</option>
							<option value="B" <?php if(set_value('goldar_siswa')=='A') { echo 'selected'; }elseif($siswa->goldar_siswa=='B') { echo 'selected'; } ?>>B</option>
							<option value="AB" <?php if(set_value('goldar_siswa')=='A') { echo 'selected'; }elseif($siswa->goldar_siswa=='AB') { echo 'selected'; } ?>>AB</option>
							<option value="O" <?php if(set_value('goldar_siswa')=='A') { echo 'selected'; }elseif($siswa->goldar_siswa=='O') { echo 'selected'; } ?>>O</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tinggi dan Berat Badan Siswa</label>
					<div class="col-3">
						<input type="number" name="tinggi" class="form-control" placeholder="Tinggi Badan" value="<?php if(isset($_POST['tinggi'])) { echo set_value('tinggi'); }else{ echo $siswa->tinggi; } ?>">
						<small class="text-gray">Tinggi Badan dalam Centimeter</small>
					</div>
					<div class="col-3">
						<input type="number" name="berat" class="form-control" placeholder="Berat Badan" value="<?php if(isset($_POST['berat'])) { echo set_value('berat'); }else{ echo $siswa->berat; } ?>">
						<small class="text-gray">Berat Badan dalam Kilogram</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Penyakit yang pernah/sedang diderita Siswa</label>
					<div class="col-6">
						<textarea name="penyakit_siswa" class="form-control" placeholder="Penyakit yang pernah/sedang diderita Siswa"><?php if(isset($_POST['penyakit_siswa'])) { echo set_value('penyakit_siswa'); }else{ echo $siswa->penyakit_siswa; } ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Hobi Siswa</label>
					<div class="col-6">
						<textarea name="hobi_siswa" class="form-control" placeholder="Hobi siswa"><?php if(isset($_POST['hobi_siswa'])) { echo set_value('hobi_siswa'); }else{ echo $siswa->hobi_siswa; } ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Apakah Siswa Berkebutuhan Khusus?</label>
					<div class="col-3">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="berkebutuhan_khusus" type="radio" id="berkebutuhan_khusus1" value="Tidak"  <?php if(set_value('berkebutuhan_khusus')=='Tidak') { echo 'checked'; }elseif($siswa->berkebutuhan_khusus=='Tidak') { echo 'checked'; } ?> required>
								<label for="berkebutuhan_khusus1" class="custom-control-label">Tidak</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="berkebutuhan_khusus" type="radio" id="berkebutuhan_khusus2" value="Ya" <?php if(set_value('berkebutuhan_khusus')=='Ya') { echo 'checked'; }elseif($siswa->berkebutuhan_khusus=='Ya') { echo 'checked'; } ?> required>
								<label for="berkebutuhan_khusus2" class="custom-control-label">Ya</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Deskripsi Ringkas Tentang Siswa</label>
					<div class="col-6">
						<textarea name="isi" class="form-control" placeholder="Deskripsi Ringkas Tentang Siswa"><?php if(isset($_POST['isi'])) { echo set_value('isi'); }else{ echo $siswa->isi; } ?></textarea>
						<small class="text-gray">Misal: Siswa ini berkebutuhan khusus</small>
					</div>
				</div>

			</div>
			<div class="card-footer bg-light text-right border-top">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>

		<!-- data ayah -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>DATA ORANG TUA SISWA - AYAH</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-3">Nama Ayah<span class="text-danger">*</span></label>
					<div class="col-6">
						<input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?php if(isset($_POST['nama_ayah'])) { echo set_value('nama_ayah'); }else{ echo $siswa->nama_ayah; } ?>">
						<small class="text-secondary">Nama ayah</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Agama Ayah</label>
					<div class="col-6">
						<?php $agama = $m_agama->listing(); ?>
						<select name="id_agama_ayah" class="form-control select2">
							<option value="">Pilih Agama</option>
							<?php foreach($agama as $agama) { ?>
								<option value="<?php echo $agama->id_agama ?>" <?php if(set_value('id_agama_ayah')==$agama->id_agama) { echo 'selected'; }elseif($siswa->id_agama_ayah==$agama->id_agama) { echo 'selected'; } ?>>
									<?php echo $agama->nama_agama ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Pekerjaan Ayah</label>
					<div class="col-6">
						<?php $pekerjaan = $m_pekerjaan->listing(); ?>
						<select name="id_pekerjaan_ayah" class="form-control select2">
							<option value="">Pilih Pekerjaan</option>
							<?php foreach($pekerjaan as $pekerjaan) { ?>
								<option value="<?php echo $pekerjaan->id_pekerjaan ?>" <?php if(set_value('id_pekerjaan_ayah')==$pekerjaan->id_pekerjaan) { echo 'selected'; }elseif($siswa->id_pekerjaan_ayah==$pekerjaan->id_pekerjaan) { echo 'selected'; } ?>>
									<?php echo $pekerjaan->nama_pekerjaan ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Pendidikan Ayah</label>
					<div class="col-6">
						<?php $jenjang = $m_jenjang->listing(); ?>
						<select name="id_jenjang_ayah" class="form-control select2">
							<option value="">Pilih Jenjang Pendidikan</option>
							<?php foreach($jenjang as $jenjang) { ?>
								<option value="<?php echo $jenjang->id_jenjang ?>" <?php if(set_value('id_jenjang_ayah')==$jenjang->id_jenjang) { echo 'selected'; }elseif($siswa->id_jenjang_ayah==$jenjang->id_jenjang) { echo 'selected'; } ?>>
									<?php echo $jenjang->nama_jenjang ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Alamat Ayah<span class="text-danger">*</span></label>
					<div class="col-6">
						<textarea name="alamat_ayah" placeholder="Alamat Ayah" class="form-control"><?php if(isset($_POST['alamat_ayah'])) { echo set_value('alamat_ayah'); }else{ echo $siswa->alamat_ayah; } ?></textarea>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-3">Telepon/HP Ayah</label>
					<div class="col-6">
						<input type="text" name="telepon_ayah" class="form-control" placeholder="Telepon/HP Ayah" value="<?php if(isset($_POST['telepon_ayah'])) { echo set_value('telepon_ayah'); }else{ echo $siswa->telepon_ayah; } ?>">
					</div>
				</div>

			</div>
			<div class="card-footer bg-light text-right border-top">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>

		<!-- data ibu -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>DATA ORANG TUA SISWA - IBU</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-3">Nama Ibu<span class="text-danger">*</span></label>
					<div class="col-6">
						<input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?php if(isset($_POST['nama_ibu'])) { echo set_value('nama_ibu'); }else{ echo $siswa->nama_ibu; } ?>">
						<small class="text-secondary">Nama ibu</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Agama Ibu</label>
					<div class="col-6">
						<?php $agama = $m_agama->listing(); ?>
						<select name="id_agama_ibu" class="form-control select2">
							<option value="">Pilih Agama</option>
							<?php foreach($agama as $agama) { ?>
								<option value="<?php echo $agama->id_agama ?>" <?php if(set_value('id_agama_ibu')==$agama->id_agama) { echo 'selected'; }elseif($siswa->id_agama_ibu==$agama->id_agama) { echo 'selected'; } ?>>
									<?php echo $agama->nama_agama ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Pekerjaan Ibu</label>
					<div class="col-6">
						<?php $pekerjaan = $m_pekerjaan->listing(); ?>
						<select name="id_pekerjaan_ibu" class="form-control select2">
							<option value="">Pilih Pekerjaan</option>
							<?php foreach($pekerjaan as $pekerjaan) { ?>
								<option value="<?php echo $pekerjaan->id_pekerjaan ?>" <?php if(set_value('id_pekerjaan_ibu')==$pekerjaan->id_pekerjaan) { echo 'selected'; }elseif($siswa->id_pekerjaan_ibu==$pekerjaan->id_pekerjaan) { echo 'selected'; } ?>>
									<?php echo $pekerjaan->nama_pekerjaan ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Pendidikan Ibu</label>
					<div class="col-6">
						<?php $jenjang = $m_jenjang->listing(); ?>
						<select name="id_jenjang_ibu" class="form-control select2">
							<option value="">Pilih Jenjang Pendidikan</option>
							<?php foreach($jenjang as $jenjang) { ?>
								<option value="<?php echo $jenjang->id_jenjang ?>" <?php if(set_value('id_jenjang_ibu')==$jenjang->id_jenjang) { echo 'selected'; }elseif($siswa->id_jenjang_ibu==$jenjang->id_jenjang) { echo 'selected'; } ?>>
									<?php echo $jenjang->nama_jenjang ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Alamat Ibu<span class="text-danger">*</span></label>
					<div class="col-6">
						<textarea name="alamat_ibu" placeholder="Alamat Ibu" class="form-control"><?php if(isset($_POST['alamat_ibu'])) { echo set_value('alamat_ibu'); }else{ echo $siswa->alamat_ibu; } ?></textarea>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-3">Telepon/HP Ibu</label>
					<div class="col-6">
						<input type="text" name="telepon_ibu" class="form-control" placeholder="Telepon/HP Ibu" value="<?php if(isset($_POST['telepon_ibu'])) { echo set_value('telepon_ibu'); }else{ echo $siswa->telepon_ibu; } ?>">
					</div>
				</div>

			</div>
			<div class="card-footer bg-light text-right border-top">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>

		<!-- data wali -->
		<div class="card">
			<div class="card-header bg-light text-center">
				<h4>DATA ORANG TUA SISWA - WALI MURID</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-3">Identitas Wali Murid</label>
					<div class="col-3">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="identitas_wali" type="radio" id="identitas_wali1" value="Ayah" onclick="Ayah()" <?php if(set_value('identitas_wali')=='Ayah') { echo 'checked'; } ?>>
								<label for="identitas_wali1" class="custom-control-label">Sama dengan Ayah</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="identitas_wali" type="radio" id="identitas_wali2" value="Ibu" onclick="Ibu()" <?php if(set_value('identitas_wali')=='Ibu') { echo 'checked'; } ?>>
								<label for="identitas_wali2" class="custom-control-label">Sama dengan Ibu</label>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" name="identitas_wali" type="radio" id="identitas_wali3" value="Berbeda" onclick="Berbeda()" <?php if(set_value('identitas_wali')=='Berbeda') { echo 'checked'; }else{ echo 'checked'; } ?>>
								<label for="identitas_wali3" class="custom-control-label">Berbeda dengan Ayah dan Ibu</label>
							</div>
						</div>
					</div>
				</div>

				<div id="myDIV">

					<div class="form-group row">
						<label class="col-3">Nama Wali<span class="text-danger">*</span></label>
						<div class="col-6">
							<input type="text" name="nama_wali" class="form-control" placeholder="Nama Wali" value="<?php if(isset($_POST['nama_wali'])) { echo set_value('nama_wali'); }else{ echo $siswa->nama_wali; } ?>">
							<small class="text-secondary">Nama wali</small>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-3">Agama Wali</label>
						<div class="col-6">
							<?php $agama = $m_agama->listing(); ?>
							<select name="id_agama_wali" class="form-control select2">
								<option value="">Pilih Agama</option>
								<?php foreach($agama as $agama) { ?>
									<option value="<?php echo $agama->id_agama ?>" <?php if(set_value('id_agama_wali')==$agama->id_agama) { echo 'selected'; }elseif($siswa->id_agama_wali==$agama->id_agama) { echo 'selected'; } ?>>
										<?php echo $agama->nama_agama ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-3">Pekerjaan Wali</label>
						<div class="col-6">
							<?php $pekerjaan = $m_pekerjaan->listing(); ?>
							<select name="id_pekerjaan_wali" class="form-control select2">
								<option value="">Pilih Pekerjaan</option>
								<?php foreach($pekerjaan as $pekerjaan) { ?>
									<option value="<?php echo $pekerjaan->id_pekerjaan ?>" <?php if(set_value('id_pekerjaan_wali')==$pekerjaan->id_pekerjaan) { echo 'selected'; }elseif($siswa->id_pekerjaan_wali==$pekerjaan->id_pekerjaan) { echo 'selected'; } ?>>
										<?php echo $pekerjaan->nama_pekerjaan ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-3">Pendidikan Wali</label>
						<div class="col-6">
							<?php $jenjang = $m_jenjang->listing(); ?>
							<select name="id_jenjang_wali" class="form-control select2">
								<option value="">Pilih Jenjang Pendidikan</option>
								<?php foreach($jenjang as $jenjang) { ?>
									<option value="<?php echo $jenjang->id_jenjang ?>"  <?php if(set_value('id_jenjang_wali')==$jenjang->id_jenjang) { echo 'selected'; }elseif($siswa->id_jenjang_wali==$jenjang->id_jenjang) { echo 'selected'; } ?>>
										<?php echo $jenjang->nama_jenjang ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-3">Alamat Wali<span class="text-danger">*</span></label>
						<div class="col-6">
							<textarea name="alamat_wali" placeholder="Alamat Wali" class="form-control"><?php if(isset($_POST['alamat_wali'])) { echo set_value('alamat_wali'); }else{ echo $siswa->alamat_wali; } ?></textarea>
						</div>
					</div>


					<div class="form-group row">
						<label class="col-3">Telepon/HP Wali</label>
						<div class="col-6">
							<input type="text" name="telepon_wali" class="form-control" placeholder="Telepon/HP Wali" value="<?php if(isset($_POST['telepon_wali'])) { echo set_value('telepon_wali'); }else{ echo $siswa->telepon_wali; } ?>">
						</div>
					</div>
				</div>

			</div>
			<div class="card-footer bg-light text-right border-top">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>

<script>
	function Ayah() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}

	function Ibu() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}

	function Berbeda() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>