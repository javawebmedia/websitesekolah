<?php 
use App\Models\Menu_model;
$m_menu         = new Menu_model();
$nav_profil     = $m_menu->profil('Profil');
$nav_berita     = $m_menu->berita();
?>
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-8 offset-2 text-center">
            <p class="mb-3">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo $this->website->logo() ?>" alt="<?php echo $this->website->namaweb() ?>" style="max-width: 250px; max-height: 120px; width: auto; height: auto;">
                </a>
            </p>
        </div>
    </div>
</div>