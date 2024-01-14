<form action="<?php echo base_url('admin/agenda/lokasi/'.$agenda['id_agenda']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>
<input type="hidden" name="id_lokasi_agenda" value="<?php echo $lokasi_agenda['id_lokasi_agenda'] ?>">

<div class="modal fade" id="edit-<?php echo $lokasi_agenda['id_lokasi_agenda'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Lokasi Agenda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    Pilih lokasi desa untuk agenda.
                </div>
                <div class="form-group row">
                    <label class="col-4">Nama Desa</label>
                    <div class="col-8">
                        <?php
                        use App\Models\Desa_model;
                        $m_desa = new Desa_model();
                        $desa = $m_desa->listing();?>
                        <select name="id_desa" class="form-control" required="">
                            <option value="">Pilih lokasi agenda</option>
                            <?php foreach($desa as $desa){ ?>
                                <option value="<?php echo $desa['id_desa']; ?>" <?php if($desa['id_desa'] == $lokasi_agenda['id_desa']) { echo "Selected";} ?>><?php echo $desa['nama_desa']; ?></option>
                            <?php } ?>
                        </select>
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