<?php 
if($popup) {
 ?>

 <div class="modal fade modal-popup" id="modal-02" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-lg">
          <div class="modal-body">
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="row">
              <div class="col-md-6 text-center">
                <figure class="mb-3">
                    <a href="<?php echo $popup->website ?>" target="_blank">
                        <img src="<?php echo base_url('assets/upload/image/'.$popup->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$popup->gambar) ?> 2x" alt="<?php echo $popup->judul_galeri ?>" class="img-thumbnail rounded" />
                    </a>
                </figure>
              </div>
              <!-- /column -->
              <div class="col-md-6">
                  <h3><a href="<?php echo $popup->website ?>" target="_blank"><?php echo $popup->judul_galeri ?></a></h3>
                  <hr class="mt-0 mb-1 p-0">
                    <div class="mb-3">
                        <?php echo $popup->isi ?>
                    </div>

                    <div id="mc_embed_signup">
                   
                    <a href="<?php echo $popup->website ?>" class="btn btn-primary btn-sm" target="_blank">
                        Lihat detail &nbsp;<i class="fa fa-chevron-right"></i>
                    </a>
                  </div>
              </div>
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
          </div>
          <!--/.modal-body -->
        </div>
        <!--/.modal-content -->
      </div>
      <!--/.modal-dialog -->
    </div>
    <!--/.modal -->
    <?php } ?>