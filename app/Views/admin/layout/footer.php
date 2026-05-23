</div>
</div>
              <!-- /.card-body -->
              <div class="card-footer">
                Page rendered: {elapsed_time} | Versi Framework: <?= CodeIgniter\CodeIgniter::CI_VERSION ?>
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved  | Versi Framework: <?= CodeIgniter\CodeIgniter::CI_VERSION ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php 
$sek  = date('Y');
$awal = $sek-100;
?>

<script>
  tinymce.init({
    selector: '.nilai',
    height: 150,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'bold italic backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  });
// ISI
  tinymce.init({
    selector: '#isi',
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    height: 500,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample code table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | blocks fontfamily fontsize | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table'
  });
// KONTEN
  tinymce.init({
    selector: '.konten',
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
    toolbar_mode: 'scrolling',
    height: 400,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample code table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: [
        'blocks fontfamily fontsize bold italic strikethrough forecolor backcolor copy | code fullscreen preview | save print | pagebreak anchor codesample',
        'undo redo | alignleft aligncenter alignright alignjustify | link image media table | numlist bullist outdent indent | charmap emoticons removeformat | ltr rtl'
    ],
    visual_table_class: 'tiny-table',

    // Integrasi Bootstrap
    content_style: `
        @import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
        body { font-family: 'Arial', sans-serif; font-size: 16px; padding: 20px;}
        img { max-width: 100%; height: auto; display: block; margin: 10px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dee2e6; padding: 8px; text-align: left; }
    `,

    // Menyesuaikan gambar agar tidak melebihi lebar textarea
    setup: function (editor) {
        editor.on('init', function () {
            editor.getBody().style.maxWidth = "100%"; 
        });
    }
});


  // ckeditor
  tinymce.init({
    selector: '.ckeditor',
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    height: 300,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample code table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table'
  });

</script>
<script>
  $( ".datepicker" ).datepicker({
    inline: true,
    changeYear: true,
    changeMonth: true,
    dateFormat: "dd-mm-yy",
    yearRange: "<?php echo $awal ?>:<?php $tahundepan = date('Y')+2; echo $tahundepan; ?>"
  });

  $( ".tanggal" ).datepicker({
    inline: true,
    changeYear: true,
    changeMonth: true,
    dateFormat: "dd-mm-yy",
    yearRange: "<?php echo $awal ?>:<?php $tahundepan = date('Y')+2; echo $tahundepan; ?>"
  });

  $( ".tanggalan" ).datepicker({
    inline: true,
    changeYear: true,
    changeMonth: true,
    dateFormat: "dd-mm-yy",
    yearRange: "<?php echo $awal ?>:<?php $tahundepan = date('Y')+2; echo $tahundepan; ?>"
  });

</script>


<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- pace-progress -->
<script src="<?php echo base_url() ?>assets/admin/plugins/pace-progress/pace.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/admin/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url() ?>assets/admin/plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function(){
    $('input.jam').timepicker({
        timeFormat: 'HH:mm:ss',
        // year, month, day and seconds are not important
        minTime: new Date(0, 0, 0, 8, 0, 0),
        maxTime: new Date(0, 0, 0, 15, 0, 0),
        // time entries start being generated at 6AM but the plugin 
        // shows only those within the [minTime, maxTime] interval
        startHour: 6,
        // the value of the first item in the dropdown, when the input
        // field is empty. This overrides the startHour and startMinute 
        // options
        startTime: new Date(0, 0, 0, 8, 20, 0),
        // items in the dropdown are separated by at interval minutes
        interval: 10
    });
});

  // Popup Delete
  $(document).on("click", ".delete-link", function(e){
    e.preventDefault();
    url = $(this).attr("href");
    Swal.fire({
        title: 'Anda yakin?',
        text: "Jika dihapus, data tidak dapat dikembalikan lagi!",
        icon: 'info',
        timer: 5000,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Data!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url: url,
              success: function(resp){
                window.location.href = url;
              }
            });
        }
      })
  });

 // Popup Delete
$(document).on("click", ".disable-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  Swal.fire({
    title:"Yakin akan mengupdate data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});


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
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
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
</body>
</html>
