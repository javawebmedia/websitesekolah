<?php 
$uri = service('uri');
?>
<form action="<?php echo base_url('admin/agenda/cari') ?>" method="get" accept-charset="utf-8" enctype="multipart/form-data">
<div class="row">

  <div class="col-md-5">
    <br>
    <div class="input-group">                  
      <input type="text" name="keywords" class="form-control" placeholder="Ketik kata kunci pencarian agenda...." value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" required>
      <span class="input-group-btn ">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
        <a href="<?php echo base_url('admin/agenda/tambah') ?>" class="btn btn-success btn-flat">
        <i class="fa fa-plus"></i> Tambah</a>
      </span>
    </div>
  </div>
  <div class="col-md-7 text-left">
    <?php if(isset($pagin)) { echo $pagin; } ?>
  </div>
</div>
<?php echo form_close(); ?>
<div class="clearfix"><hr></div>
<?php
echo form_open(base_url('admin/agenda/proses'));
?>
<div class="row">
  <div class="col-md-4">
    <div class="input-group input-group-sm">
      <button class="btn btn-dark btn-xs mb-1" type="submit" name="hapus" onClick="check();" >
          <i class="fa fa-trash"></i>
        </button> 
      <select name="id_kategori_agenda" class="form-control">
        <?php foreach($kategori_agenda as $kategori_agenda) { ?>
          <option value="<?php echo $kategori_agenda['id_kategori_agenda'] ?>"><?php echo $kategori_agenda['nama_kategori_agenda'] ?></option>
        <?php } ?>
      </select>
      <span class="input-group-btn" >
        <button type="submit" class="btn btn-dark btn-flat btn-sm" name="update">Update</button>
      </span>
    </div>
  </div>

  <div class="col-md-8">
      

        <button class="btn btn-secondary btn-sm" type="submit" name="draft" onClick="check();" >
          <i class="fa fa-eye-slash"></i> Jangan Publikasikan
        </button>

        <button class="btn btn-dark btn-xs mb-1" type="submit" name="publish" onClick="check();" >
          <i class="fa fa-eye"></i> Publish
        </button>

        
        <?php 
        $url_navigasi = $uri->getSegment(2); 
        if($uri->getSegment(3) != "") { 
          ?>
          <a href="<?php echo base_url('admin/'.$url_navigasi) ?>" class="btn btn-dark">
            <small ><i class="fa fa-arrow-circle-left"></i> Kembali</small></a>
          <?php } ?>
        </div>
    </div>
    <div class="clearfix"><hr></div>
    <div class="table-responsive mailbox-messages">
      <table id="example11" class="display table table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr class="bg-light text-center align-middle">
            <th width="5%">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
              </div>
            </th>
            <th width="5%" class="align-middle">GAMBAR</th>
            <th width="20%" class="align-middle">NAMA</th>
            <th width="20%" class="align-middle">VENUE</th>
            <th width="20%" class="align-middle">PENDAFTARAN</th>
            <th width="10%" class="align-middle">STATUS</th> 
            <th width="15%" class="align-middle">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php 
            $i=1; foreach($agenda as $agenda) { 
            $id_agenda  = $agenda['id_agenda'];
            ?>

            <tr class="odd gradeX">
              <td class="text-center">
                <div class="icheck-primary">
                  <input type="checkbox" name="id_agenda[]" value="<?php echo $agenda['id_agenda'] ?>" id="check<?php echo $i ?>">
                  <label for="check<?php echo $i ?>"></label>
                </div>
              </td>
              <td>
                <?php if($agenda['gambar']=="") { echo '-'; }else{ ?>
                  <img src="<?php echo base_url('assets/upload/image/thumbs/'.$agenda['gambar']) ?>" class="img img-thumbnail">
                <?php } ?>
              </td>
              
              <td><a href="<?php echo base_url('agenda/detail/'.$agenda['slug_agenda']) ?>" class="text-capitalize" target="_blank">
                <?php echo $agenda['nama_agenda'] ?> <sup><i class="fa fa-search"></i></sup></a>
                <small>
                  <br><i class="fa fa-code"></i> <?php echo $agenda['kode_agenda'] ?>
                  <br><i class="fa fa-check-circle"></i> <?php echo $agenda['urutan'] ?>
                  <br><i class="fa fa-tags"></i> <a href="<?php echo base_url('admin/agenda/kategori/'.$agenda['id_kategori_agenda']) ?>" class="text-capitalize">
                <?php echo $agenda['nama_kategori_agenda'] ?></a></small></td>
                <td><?php echo $agenda['nama_tempat'] ?>
                <small>
                  <br><i class="fa fa-map"></i> <?php echo $agenda['link_google_map'] ?>
                  <br><i class="fa fa-home"></i> <?php echo strip_tags($agenda['alamat']) ?>
                </small>
                </td>
                <td>Rp <?php echo number_format($agenda['harga'],'0',',','.') ?>
                  <small>
                    <br><i class="fa fa-shopping-cart"></i> Rp <?php echo number_format($agenda['harga_diskon'],'0',',','.') ?>
                    <br><i class="fa fa-calendar-check"></i> <?php echo $this->website->tanggal_id($agenda['tanggal_buka']) ?> sd <?php echo $this->website->tanggal_id($agenda['tanggal_tutup']) ?>
                    <br><i class="fa fa-calendar-times"></i> <?php echo $this->website->tanggal_id($agenda['tanggal_mulai']) ?> sd <?php echo $this->website->tanggal_id($agenda['tanggal_selesai']) ?>
                  </small>
                </td>
                <td class="text-center">
                  <a href="<?php echo base_url('admin/agenda/status_agenda/'.$agenda['status_agenda']) ?>">
                    <?php if($agenda['status_agenda']=='Publish') { ?>
                      <span class="badge bg-dark mb-1">
                        <i class="fa fa-eye"></i> <?php echo $agenda['status_agenda'] ?>
                      </span>
                    <?php }else{ ?>
                      <span class="badge bg-secondary mb-1">
                        <i class="fa fa-eye-slash"></i> Not Published
                      </span>
                    <?php } ?>
                    </a>
                    <?php if($agenda['status_pendaftaran']=='Buka') { ?>
                      <span class="badge bg-info mb-1">
                        <i class="fa fa-check-circle"></i> <?php echo $agenda['status_pendaftaran'] ?>
                      </span>
                    <?php }else{ ?>
                      <span class="badge bg-warning mb-1">
                        <i class="fa fa-times-circle"></i> Tutup
                      </span>
                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <div class="btn-group mb-2">
                        <a class="btn btn-success btn-xs" href="<?php echo base_url('admin/agenda/gambar/'.$agenda['id_agenda']) ?>"><i class="fa fa-image"></i> Gambar</a>

                        <a class="btn btn-info btn-xs" href="<?php echo base_url('agenda/detail/'.$agenda['slug_agenda']) ?>" target="_blank"><i class="fa fa-eye"></i></a>


                        <a href="<?php echo base_url('admin/agenda/edit/'.$agenda['id_agenda']) ?>" 
                          class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                          <a href="<?php echo base_url('admin/agenda/delete/'.$agenda['id_agenda']) ?>" class="btn btn-danger btn-xs delete-link" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
                        </div>

                      <div class="btn-group mb-2">
                        <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/agenda/jadwal/'.$agenda['id_agenda']) ?>"><i class="fa fa-calendar-check"></i> Jadwal Agenda</a>
                      </div>

                      
                      </td>
                    </tr>

                    <?php $i++; } ?>

                  </tbody>
                </table>
              </div>

              <?php echo form_close(); ?>

              <div class="clearfix"><hr></div>
              <div class="pull-right"><?php if(isset($pagin)) { echo $pagin; } ?></div>
