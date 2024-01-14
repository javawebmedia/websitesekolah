
    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-<?php echo $gambar_agenda['id_gambar_agenda'] ?>">
        <i class="fa fa-edit"></i> Edit
    </button>
    <a href="<?php echo base_url('admin/agenda/delete_gambar/'.$gambar_agenda['id_gambar_agenda'].'/'.$agenda['id_agenda']) ?>" class="btn btn-danger btn-xs delete-link" onclick="confirmation(event)"><i class="fa fa-trash"></i> Hapus</a></td>

<form action="<?php echo base_url('admin/agenda/gambar/'.$agenda['id_agenda']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>
<input type="hidden" name="id_gambar_agenda" value="<?php echo $gambar_agenda['id_gambar_agenda'] ?>">

<div class="modal fade" id="edit-<?php echo $gambar_agenda['id_gambar_agenda'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Gambar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="form-group row">
                    <label class="col-3">Gambar Agenda</label>
                    
                    <div class="col-9">
                        <input type="file" name="gambar" class="form-control" placeholder="gambar" value="<?php echo $gambar_agenda['gambar'] ?>">
                        <img src="<?php echo base_url('assets/upload/image/thumbs/'.$gambar_agenda['gambar']) ?>" width="60" class="img img-thumbnail" style="width: 100px; height: auto;">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Nama Gambar Agenda</label>
                    
                    <div class="col-9">
                        <input type="text" name="nama_gambar_agenda" class="form-control" placeholder="Nama gambar" value="<?php echo $gambar_agenda['nama_gambar_agenda'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Keterangan</label>
                    <div class="col-9">
                        <textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $gambar_agenda['keterangan'] ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Urutan</label>
                    <div class="col-9">
                        <input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil kategori_agenda" value="<?php echo $gambar_agenda['urutan'] ?>">
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" name="update" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>