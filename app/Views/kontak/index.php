 <!-- /header -->
    <section class="wrapper image-wrapper bg-image" data-image-src="<?php echo $this->website->banner() ?>">
      <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h1 class="display-1 mb-3 text-warning"><?php echo $title ?></h1>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
 <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container pb-11">
        <div class="row mb-14 mb-md-16">
          <div class="col-xl-10 mx-auto mt-n19">
            <div class="card">
              <div class="row gx-0">
                <div class="col-lg-6 align-self-stretch">
                  <div class="map map-full rounded-top rounded-lg-start">
                    <style type="text/css" media="screen">
                        iframe {
                            width:100%; 
                            height: 100%; 
                            border:0;
                        }
                    </style>

                    <?php echo $konfigurasi->google_map ?>
                   
                  </div>
                  <!-- /.map -->
                </div>
                <!--/column -->
                <div class="col-lg-6">
                  <div class="p-10 p-md-11 p-lg-14">
                    <div class="d-flex flex-row">
                      <div>
                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                      </div>
                      <div class="align-self-start justify-content-start">
                        <h5 class="mb-1">Alamat</h5>
                        <address>
                            <?php echo $this->website->alamat() ?>
                        </address>
                      </div>
                    </div>
                    <!--/div -->
                    <div class="d-flex flex-row">
                      <div>
                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                      </div>
                      <div>
                        <h5 class="mb-1">Telepon</h5>
                        <p><?php echo $konfigurasi->telepon ?> <br /><?php echo $konfigurasi->hp ?></p>
                      </div>
                    </div>
                    <!--/div -->
                    <div class="d-flex flex-row">
                      <div>
                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                      </div>
                      <div>
                        <h5 class="mb-1">E-mail</h5>
                        <p class="mb-0"><a href="mailto:<?php echo $konfigurasi->email ?>" class="link-body"><?php echo $konfigurasi->email ?></a></p>
                      </div>
                    </div>
                    <!--/div -->
                  </div>
                  <!--/div -->
                </div>
                <!--/column -->
              </div>
              <!--/.row -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        
      </div>
      <!-- /.container -->
    </section>

