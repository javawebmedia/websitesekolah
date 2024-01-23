<?php if($client) { ?>
<section class="wrapper bg-light">
  <div class="container pt-3 pt-md-6">
        <div class="px-lg-5 mb-4 mb-md-6">
            <div class="row gx-0 gx-md-8 gx-xl-12 gy-8 align-items-center">
              <?php foreach($client as $client) { ?>
              <div class="col-4 col-md-2">
                <figure class="px-1 px-md-0 px-lg-1 px-xl-2 px-xxl-3">
                  <img src="<?php echo base_url('assets/upload/image/'.$client->gambar) ?>" alt="<?php echo $client->nama_client ?>" /></figure>
              </div>
              <!--/column -->
              <?php } ?>
            </div>
            <!--/.row -->
          </div>
          <!-- /div -->
  </div>
</section>
<?php } ?>