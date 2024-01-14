<p>
    <a href="<?php echo base_url('admin/agenda') ?>" class="btn btn-dark">
        <i class="fa fa-backward"></i> Kembali
    </a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Baru
    </button>
</p>
<form action="<?php echo base_url('admin/agenda/lokasi/'.$agenda['id_agenda']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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

                <div class="alert alert-info">
                    Pilih lokasi desa untuk agenda.
                </div>
                <div class="form-group row">
                    <label class="col-4">Nama Desa</label>
                    <div class="col-8">
                        <select name="id_desa" class="form-control" required="">
                            <option value="">Pilih lokasi agenda</option>
                            <?php foreach($desa as $desa){ ?>
                                <option value="<?php echo $desa['id_desa']; ?>"><?php echo $desa['nama_desa']; ?></option>
                            <?php } ?>
                        </select>
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
<table class="table table-bordered" id="dataTables-example">
<thead>
<tr>
    <th>#</th>
    <th>Produk</th>
    <th>Desa</th>
    <th>Action</th>
</tr>
</thead>
<tbody>


<?php $i=1; foreach($lokasi_agenda as $lokasi_agenda) { ?>

<tr class="odd gradeX">
    <td><?php echo $i ?></td>
    <td>
    <?php echo $agenda['nama_agenda']  ?>
    </td>
    <td><?php echo $lokasi_agenda['nama_desa'] ?></td>
    <td> 
        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-<?php echo $lokasi_agenda['id_lokasi_agenda'] ?>">
        <i class="fa fa-edit"></i> Edit
    </button>
    <a href="<?php echo base_url('admin/agenda/delete_lokasi/'.$lokasi_agenda['id_lokasi_agenda'].'/'.$agenda['id_agenda']) ?>" class="btn btn-danger btn-xs delete-link" onclick="confirmation(event)"><i class="fa fa-trash"></i> Hapus</a>
        <?php include('edit_lokasi.php') ?>
    </td>  
</tr>

<?php $i++; } ?>

</tbody>
</table>