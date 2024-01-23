<?php 
use App\Models\Nav_model;
use App\Models\Konfigurasi_model;
$m_menu         = new Nav_model();
$nav_profil     = $m_menu->profil('Profil');
$site_setting   = $m_site->listing();
?>
<!--==============================
Footer Area
==============================-->
<footer class="bg-navy text-inverse">
    <div class="container py-13 py-md-15">
      <div class="row gy-6 gy-lg-0">
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <img class="mb-4 img-fluid" src="<?php echo $this->website->logo() ?>" srcset="<?php echo $this->website->logo() ?> 2x" alt="<?php echo $this->website->namaweb() ?>" />
            <p class="mb-4">© <?php echo date('Y') ?> <?php echo $this->website->namaweb() ?>. <br class="d-none d-lg-block" />All rights reserved.</p>
            <nav class="nav social ">
              <a href="<?php echo $site_setting->twitter ?>"><i class="uil uil-twitter"></i></a>
              <a href="<?php echo $site_setting->twitter ?>"><i class="uil uil-facebook-f"></i></a>
              <a href="#"><i class="uil uil-tiktok"></i></a>
              <a href="<?php echo $site_setting->twitter ?>"><i class="uil uil-instagram"></i></a>
              <a href="<?php echo $site_setting->twitter ?>"><i class="uil uil-youtube"></i></a>
            </nav>
            <!-- /.social -->
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <h4 class="widget-title  mb-3 text-white">Hubungi Kami</h4>
            <address class="pe-xl-15 pe-xxl-17"><?php echo $site_setting->alamat ?></address>
            <a href="mailto:<?php echo $site_setting->email ?>" class="link-body"><?php echo $site_setting->email ?></a><br /> <?php echo $site_setting->telepon ?>
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <h4 class="widget-title  mb-3 text-white">Tentang Kami</h4>
            <ul class="list-unstyled text-reset mb-0">
              <li><a href="<?php echo base_url('profil') ?>">Profil Kami</a></li>
              <li><a href="<?php echo base_url('berita') ?>">Berita dan Artikel</a></li>
              <li><a href="<?php echo base_url('prestasi') ?>">Prestasi &amp; Penghargaan</a></li>
              <li><a href="<?php echo base_url('download') ?>">Download File</a></li>
              <li><a href="<?php echo base_url('galeri') ?>">Galeri Gambar</a></li>
              <li><a href="<?php echo base_url('video') ?>">Galeri Video</a></li>
            </ul>
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </footer>
  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>
  <script src="<?php echo base_url() ?>assets/template/assets/js/plugins.js"></script>
  <script src="<?php echo base_url() ?>assets/template/assets/js/theme.js"></script>
  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
// adada
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })

  
</script>
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