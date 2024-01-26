<div class="row">
  <div class="col-md-4">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
        <?php if($siswa['gambar']=="" || $siswa['gambar']==NULL || is_null($siswa['gambar'])) { ?>
        	<?php if($siswa['jenis_kelamin']=="P") { ?>
	          	<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url() ?>/assets/admin/dist/img/user4-128x128.jpg" alt="<?php echo $siswa['nama_lengkap'] ?>">
	        <?php }else{ ?>
	        	<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url() ?>/assets/admin/dist/img/user2-160x160.jpg" alt="<?php echo $siswa['nama_lengkap'] ?>">
         <?php }}else{ ?>
         	<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/upload/siswa/'.$siswa['gambar']) ?>" alt="<?php echo $siswa['nama_lengkap'] ?>">
         <?php } ?>
        </div>

        <h3 class="profile-username text-center"><?php echo $siswa['nama_lengkap'] ?></h3>

        <p class="text-muted text-center">NIS/NISN: <?php echo $siswa['nis'] ?> / <?php echo $siswa['nisn'] ?></p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Tempat lahir</b> <a class="float-right"><?php echo $siswa['tempat_lahir'] ?></a>
          </li>
          <li class="list-group-item">
            <b>Tanggal lahir</b> <a class="float-right"><?php echo hari($siswa['tanggal_lahir']) ?></a>
          </li>
          <li class="list-group-item">
            <b>Nama wali</b> <a class="float-right"><?php echo $siswa['nama_wali'] ?></a>
          </li>
          <li class="list-group-item">
            <b>No. Peserta</b> <a class="float-right"><?php echo $siswa['no_peserta'] ?></a>
          </li>
        </ul>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

    <div class="col-md-8">
    	<div class="card">
    		<div class="card-header">
    			DATA PROFIL SISWA <a href="<?php echo base_url('siswa/akun') ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-edit"></i> Update Profi</a>
    		</div>
    		<div class="card-body">
    			<table class="table table-bordered">
    				<tbody>
    					<tr>
    						<td class="bg-light" width="25%">Nama lengkap</td>
    						<td><?php echo $siswa['nama_lengkap'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Nama panggilan</td>
    						<td><?php echo $siswa['nama_panggilan'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">NIS/NISN</td>
    						<td><?php echo $siswa['nis'] ?> / <?php echo $siswa['nisn'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Jurusan/Kelas/ABS</td>
    						<td><?php echo $siswa['jurusan'] ?> / <?php echo $siswa['kelas'] ?> / <?php echo $siswa['abs'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Nomor Peserta</td>
    						<td><?php echo $siswa['no_peserta'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Tempat lahir</td>
    						<td><?php echo $siswa['tempat_lahir'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Tanggal lahir</td>
    						<td><?php echo hari($siswa['tanggal_lahir']) ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Nama Wali</td>
    						<td><?php echo $siswa['nama_wali'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Telepon/HP</td>
    						<td><?php echo $siswa['telepon'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Email</td>
    						<td><?php echo $siswa['email'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Alamat</td>
    						<td><?php echo $siswa['alamat'] ?></td>
    					</tr>
    					<tr>
    						<td class="bg-light">Info lain</td>
    						<td><?php echo $siswa['keterangan'] ?></td>
    					</tr>
    				</tbody>
    			</table>
    		</div>
    		<div class="card-footer">
    			Last update: <?php echo tanggal_bulan_menit($siswa['tanggal_update']) ?>
    		</div>
    	</div>
    </div>
</div>