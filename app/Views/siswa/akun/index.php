<form action="<?php echo base_url('siswa/akun') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php 
    echo csrf_field(); 
    ?>
    <input type="hidden" name="id_siswa" value="<?php echo $siswa['id_siswa'] ?>">
    <table class="table table-bordered">
       <tbody>
          <tr>
             <td class="bg-light" width="25%">Nama lengkap</td>
             <td><?php echo $siswa['nama_lengkap'] ?></td>
         </tr>
         <tr>
             <td colspan="2" class="text-center bg-dark">Ganti Password dan Upload Foto</td>
         </tr>
         <tr>
             <td class="bg-light">Password</td>
             <td><input type="password" name="password" class="form-control" value="">
                <span class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong jika tidak ingin mengganti password</span>
             </td>
         </tr>
         <tr>
             <td class="bg-light">Konfirmasi Password</td>
             <td><input type="password" name="konfirmasi_password" class="form-control" value="">
                <span class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong jika tidak ingin mengganti password</span>
             </td>
         </tr>
         <tr>
             <td class="bg-light">Upload foto</td>
             <td><input type="file" name="gambar" class="form-control"></td>
         </tr>
         <tr>
             <td></td>
             <td>
                 <button class="btn btn-success" type="submit" name="submit">
                     <i class="fa fa-save"></i> Simpan
                 </button>
             </td>
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
</form>