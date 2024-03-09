<?php  
use App\Libraries\Website;
$this->website          = new Website(); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title ?></title>
<link href="<?php echo base_url('assets/css/css-print.css') ?>" rel="stylesheet" media="print">
<link href="<?php echo base_url('assets/css/css-print.css') ?>" rel="stylesheet" media="screen">
</head>

<body>
<page size="A4" layout="portrait">
<div class="cetak">

	<table>
		<tbody>
			<tr>
				<td style="width: 1.8cm;">
					<img src="<?php echo $this->website->icon() ?>" style="width: 1.5cm; height: auto;">
				</td>
				<td>
					<h1>INFORMASI PENDAFTARAN SISWA BARU
						<br><?php echo $konfigurasi->namaweb ?>
					</h1>
				</td>
			</tr>
		</tbody>
	</table>
	<hr><br>
	<table class="table table-bordered printer">
        <tbody>
          <tr>
            <td class="bg-light" width="35%">Nama lengkap</td>
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
          <tr>
            <td class="bg-light">Kode Pendaftaran</td>
            <td><?php echo $siswa->kode_siswa ?></td>
          </tr>
        </tbody>
      </table>
    
	
</div>
</page>
</body>
</html>