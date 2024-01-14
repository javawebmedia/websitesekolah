
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
      timer: 2000,
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
    timer: 2000,
    title: 'Alhamdulillah...',
    text: '<?php echo Session()->getFlashdata('sukses'); ?>',
  })
  <?php } ?>
  </script>
</script>
</body>
</html>