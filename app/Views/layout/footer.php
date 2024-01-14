<?php 
use App\Models\Menu_model;
$m_menu         = new Menu_model();
$nav_profil     = $m_menu->profil('Profil');
?>
<!--==============================
Footer Area
==============================-->
<footer class="footer-wrapper footer-layout1">
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xxl-4 col-xl-4">
                    <div class="widget footer-widget">
                        <div class="as-widget-about">
                            
                            <h4 class="widget_title"><?php echo $this->website->namaweb() ?></h4>
                            <p class="about-text"><?php echo $this->website->alamat() ?></p>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="as-widget-about">
                            <h3 class="widget_title">Follow Us On:</h3>
                            <div class="as-social">
                                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-4">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Tentang kami</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <?php foreach($nav_profil as $nav_profil) { ?>
                                    <li><a href="<?php echo base_url('profil/'.$nav_profil->slug_berita) ?>"><?php echo $nav_profil->judul_berita ?></a></li>
                                <?php } ?>
                                <li><a href="<?php echo base_url('staff') ?>">Team <?php echo $this->website->namaweb() ?></a></li>
                                <li><a href="<?php echo base_url('kontak') ?>">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright-wrap">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> <?php echo date('Y') ?> <a href="<?php echo $this->website->website() ?>"><?php echo $this->website->namaweb() ?></a>. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 text-end d-none d-lg-block">
                    <div class="footer-links">
                        <ul>
                            <li><a href="https://javawebmedia.com">Java Web Media</a></li>
                            <li><a href="<?php echo base_url('login') ?>">Login Admin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--********************************
        Code End  Here 
******************************** -->
<!-- Scroll To Top -->
<a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>
<!--==============================
All Js File
============================== -->
<!-- Jquery -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Slick Slider -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/slick.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/bootstrap.min.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/jquery.counterup.min.js"></script>
<!-- Isotope Filter -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/isotope.pkgd.min.js"></script>
<!-- Main Js File -->
<script src="<?php echo base_url() ?>assets/javawebmedia/assets/js/main.js"></script>
<script>
    <?php if(isset($_GET['logout'])) { ?>
    Swal.fire({
      icon: 'success',
      heightAuto: false,
      timer: 3000,
      title: 'Sukses...',
      text: 'Anda berhasil logout.',
    })
  <?php }if(Session()->getFlashdata('warning')) { ?>
  // Notifikasi
  Swal.fire({
    icon: 'warning',
    title: 'Oops...',
    timer: 3000,
    heightAuto: false,
    text: '<?php echo Session()->getFlashdata('warning'); ?>',
  })
  <?php } ?>
  <?php if(Session()->getFlashdata('sukses')) { ?>
  // Notifikasi
  Swal.fire({
    icon: 'success',
    heightAuto: false,
    timer: 3000,
    title: 'Alhamdulillah...',
    text: '<?php echo Session()->getFlashdata('sukses'); ?>',
  })
  <?php } ?>
</script>
</body>
</html>