
<?php 
echo form_open(base_url('admin/menu')); 
echo csrf_field(); 
?>
<input type="hidden" name="id_konfigurasi" value="<?php echo $konfigurasi->id_konfigurasi ?>">
<div class="modal-basic modal fade show" id="modal-posisi" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-bg-white ">
			<div class="modal-header">
				<h6 class="modal-title">Setting Posisi Menu</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				

				<div class="form-group row">
					<label class="col-3">Letakkan Menu Tambahan adalah Setelah Menu?</label>
					<div class="col-9">

						<!-- radio -->
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_1" name="letak_menu" value="Home" <?php if($konfigurasi->letak_menu=='Home') { echo 'checked'; } ?>>
                          <label for="letak_menu_1" class="custom-control-label">Home</label>
                        </div>
         
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_2" name="letak_menu" value="Berita" <?php if($konfigurasi->letak_menu=='Berita') { echo 'checked'; } ?>>
                          <label for="letak_menu_2" class="custom-control-label">Berita</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_3" name="letak_menu" value="Profil" <?php if($konfigurasi->letak_menu=='Profil') { echo 'checked'; } ?>>
                          <label for="letak_menu_3" class="custom-control-label">Profil</label>
                        </div>
                       	<div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_7" name="letak_menu" value="Prestasi" <?php if($konfigurasi->letak_menu=='Prestasi') { echo 'checked'; } ?>>
                          <label for="letak_menu_7" class="custom-control-label">Prestasi</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_4" name="letak_menu" value="Galeri" <?php if($konfigurasi->letak_menu=='Galeri') { echo 'checked'; } ?>>
                          <label for="letak_menu_4" class="custom-control-label">Galeri</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_5" name="letak_menu" value="Unduhan" <?php if($konfigurasi->letak_menu=='Unduhan') { echo 'checked'; } ?>>
                          <label for="letak_menu_5" class="custom-control-label">Unduhan</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="letak_menu_6" name="letak_menu" value="Tautan" <?php if($konfigurasi->letak_menu=='Tautan') { echo 'checked'; } ?>>
                          <label for="letak_menu_6" class="custom-control-label">Tautan</label>
                        </div>
                      </div>

					
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3"></label>
					<div class="col-9">
						
						<button type="submit" class="btn btn-success" name="posisiMenu" value="posisiMenu">Simpan &amp; Update Posisi Menu <i class="fa fa-arrow-right"></i> </button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- ends: .modal-Basic -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>