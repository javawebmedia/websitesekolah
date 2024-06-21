<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header bg-light">
				<strong>MENU DASAR</strong>
			</div>
			<div class="card-body">
				<?php 
				echo form_open(base_url('admin/menu')); 
				echo csrf_field(); 
				?>
				<input type="hidden" name="id_konfigurasi" value="<?php echo $konfigurasi->id_konfigurasi ?>">
				<div class="callout callout-info p-2">
					Anda dapat mengaktifkan dan menonaktifkan menu bawaan melalui pengaturan di bawah ini.
				</div>
				<table class="table table-sm">
					<thead>
						<tr class="bg-light">
							<th width="50%">Menu</th>
							<th colspan="2" width="50%" class="text-center">Aktif/Tidak?</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Home</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_home1" name="menu_home" value="Publish" <?php if($konfigurasi->menu_home=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_home1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_home2" name="menu_home" value="Draft" value="Publish" <?php if($konfigurasi->menu_home=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_home2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Berita</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_berita1" name="menu_berita" value="Publish" <?php if($konfigurasi->menu_berita=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_berita1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_berita2" name="menu_berita" value="Draft" value="Publish" <?php if($konfigurasi->menu_berita=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_berita2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Profil</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_profil1" name="menu_profil" value="Publish" <?php if($konfigurasi->menu_profil=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_profil1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_profil2" name="menu_profil" value="Draft" value="Publish" <?php if($konfigurasi->menu_profil=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_profil2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Prestasi</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_prestasi1" name="menu_prestasi" value="Publish" <?php if($konfigurasi->menu_prestasi=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_prestasi1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_prestasi2" name="menu_prestasi" value="Draft" value="Publish" <?php if($konfigurasi->menu_prestasi=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_prestasi2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Galeri</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_galeri1" name="menu_galeri" value="Publish" <?php if($konfigurasi->menu_galeri=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_galeri1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_galeri2" name="menu_galeri" value="Draft" value="Publish" <?php if($konfigurasi->menu_galeri=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_galeri2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Unduhan</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_unduhan1" name="menu_unduhan" value="Publish" <?php if($konfigurasi->menu_unduhan=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_unduhan1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_unduhan2" name="menu_unduhan" value="Draft" value="Publish" <?php if($konfigurasi->menu_unduhan=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_unduhan2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Tautan</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_tautan1" name="menu_tautan" value="Publish" <?php if($konfigurasi->menu_tautan=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_tautan1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_tautan2" name="menu_tautan" value="Draft" value="Publish" <?php if($konfigurasi->menu_tautan=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_tautan2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td>Kontak</td>
							<td class="text-center" width="25%">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_kontak1" name="menu_kontak" value="Publish" <?php if($konfigurasi->menu_kontak=='Publish') { echo 'checked'; } ?>>
		                          <label for="menu_kontak1" class="custom-control-label">Ya</label>
		                        </div>		                       
							</td>
							<td class="text-center">
		                        <div class="custom-control custom-radio">
		                          <input class="custom-control-input" type="radio" id="menu_kontak2" name="menu_kontak" value="Draft" value="Publish" <?php if($konfigurasi->menu_kontak=='Draft') { echo 'checked'; } ?>>
		                          <label for="menu_kontak2" class="custom-control-label">Tidak</label>
		                        </div>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right">
								<button type="submit" class="btn btn-secondary w-100" name="updateMenu" value="updateMenu"><i class="fa fa-save"></i> Simpan &amp; Update</button>
							</td>
						</tr>
					</tbody>
				</table>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-header bg-light">
				<strong>MENU TAMBAHAN</strong>
			</div>
			<div class="card-body">
				<p>
					<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-posisi">
						<i class="fa fa-sitemap"></i> Setting Posisi Menu
					</button>
					<button type="button" class="btn btn-success btn-xs mb-1" data-toggle="modal" data-target="#modal-basic">
						<i class="fa fa-plus-circle"></i> Tambah Menu
					</button>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-sub">
						<i class="fa fa-plus-circle"></i> Tambah Sub Menu
					</button>
					<!-- <a href="<?php echo base_url('admin/menu/urutkan') ?>" class="btn btn-info btn-sm">
						<i class="fa fa-bars"></i> Urutkan Menu
					</a> -->
				</p>
<?php 
include('posisi.php'); 
include('tambah.php'); 
include('tambah-sub.php'); 
?>
<table class="table table-sm table-bordered">
	<thead>
		<tr class="bg-light">
			<th width="5%">No</th>
			<th width="50%">Nama</th>
			<th width="10%">Status</th>
			<th width="5%">Urutan</th>
			<th width="10%" class="text-center">Sub Menu</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($menu as $menu) {
			$sub_menu = $m_sub_menu->menu($menu->id_menu);
		?>
		<tr>
			<td class="text-center align-top"><?php echo $no ?></td>
			<td class="align-top"><strong><?php echo $menu->nama_menu ?></strong>
				<small>
					<br><i class="fa fa-link"></i> <?php if($menu->link=="#") { echo $menu->link; }else{ echo $menu->link; } ?>
					<br><i class="fa fa-newspaper"></i><?php echo $menu->keterangan ?>
					<br><i class="<?php echo $menu->icon ?>"></i> <?php echo $menu->icon ?>
					
				</small>
			</td>
			<td>
				<?php if($menu->status_menu=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo $menu->status_menu ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td class="align-top text-center"><?php echo $menu->urutan ?></td>
			<td class="text-center">
				<?php if($sub_menu) { ?>
					
					<span class="badge badge-info w-100">
						<i class="fa fa-sitemap"></i> Terdapat <?php echo count($sub_menu) ?> sub menu
					</span>
				<?php }else{ ?>
					<span class="badge badge-secondary w-100">
						<i class="fa fa-times-circle"></i> Tidak ada sub menu
					</span>
				<?php } ?>
			</td>
			<td class="align-top">
				<?php if($sub_menu) { ?>
					<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#DetailMenu<?php echo $menu->id_menu ?>">
						<i class="fa fa-eye"></i> Sub Menu
					</button>
					<!-- <a href="<?php echo base_url('admin/menu/urutkan_sub/'.$menu->id_menu) ?>" class="btn btn-primary btn-xs" title="Urutkan"><i class="fa fa-bars"></i></a> -->
				<?php include('detail-sub.php');} ?>
				<a href="<?php echo base_url('admin/menu/edit/'.$menu->id_menu) ?>" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/menu/delete/'.$menu->id_menu) ?>" class="btn btn-dark btn-xs delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
			</div>
		</div>
	</div>
</div>