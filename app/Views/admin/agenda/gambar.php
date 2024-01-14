<p>
    <a href="<?php echo base_url('admin/agenda') ?>" class="btn btn-dark">
        <i class="fa fa-backward"></i> Kembali
    </a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Baru
    </button>
</p>
<form action="<?php echo base_url('admin/agenda/gambar/'.$agenda['id_agenda']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="form-group row">
                    <label class="col-3">Gambar Agenda</label>
                    
                    <div class="col-9">
                        <input type="file" name="gambar" class="form-control" placeholder="gambar" value="<?php echo set_value('gambar') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Nama Gambar Agenda</label>
                    
                    <div class="col-9">
                        <input type="text" name="nama_gambar_agenda" class="form-control" placeholder="Nama gambar" value="<?php echo set_value('nama_gambar_agenda') ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Keterangan</label>
                    <div class="col-9">
                        <textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo set_value('keterangan') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Urutan</label>
                    <div class="col-9">
                        <input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil kategori_agenda" value="<?php if(isset($_POST['urutan'])) { echo set_value('urutan'); }else{ echo count($gambar_agenda)+1; } ?>">
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-success" name="simpan"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>
<table class="table table-bordered projects" id="dataTables-example">
<thead>
<tr>
    <th>#</th>
    <th>Gambar</th>
    <th>Judul gambar</th>
    <th>Keterangan</th>
    <th>Urutan</th>
    <th>Action</th>
</tr>
</thead>
<tbody>


<tr class="odd gradeX bg-primary">
    <td><?php echo 1 ?></td>
    <td>
    <?php if($agenda['gambar'] != "") { ?>
    <img src="<?php echo base_url('assets/upload/image/thumbs/'.$agenda['gambar']) ?>" width="60" class="img img-responsive">
    <?php }else{ echo 'Tidak ada'; } ?>
    </td>
    <td><?php echo $agenda['nama_agenda'] ?></td>
    <td><?php echo 'Gambar utama' ?></td>
    <td>1</td>
    <td></td>
</tr>

<?php $i=2; foreach($gambar_agenda as $gambar_agenda) { ?>

<tr class="odd gradeX">
    <td><?php echo $i ?></td>
    <td>
    <?php if($gambar_agenda['gambar'] != "") { ?>
    <img src="<?php echo base_url('assets/upload/image/thumbs/'.$gambar_agenda['gambar']) ?>" width="60" class="img img-responsive">
    <?php }else{ echo 'Tidak ada'; } ?>
    </td>
    <td><?php echo $gambar_agenda['nama_gambar_agenda'] ?></td>
    <td><?php echo $gambar_agenda['keterangan'] ?></td>
    <td><?php echo $gambar_agenda['urutan'] ?></td>
    <td> 
        <?php include('edit_gambar.php') ?>
        
</tr>

<?php $i++; } ?>

</tbody>
</table>