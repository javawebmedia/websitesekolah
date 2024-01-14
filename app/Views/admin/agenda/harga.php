<p>
    <a href="<?php echo base_url('admin/produk') ?>" class="btn btn-dark">
        <i class="fa fa-backward"></i> Kembali
    </a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Baru
    </button>
</p>
<form action="<?php echo base_url('admin/produk/harga/'.$produk['id_produk']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                    Periode/tanggal diskon silakan update di data produk.
                </div>
                <div class="form-group row">
                    <label class="col-4">Biaya Pendaftaran (Kontingen) Normal &amp; Diskon</label>
                    <div class="col-4">
                        <input type="number" name="harga_produk" class="form-control" placeholder="harga" value="<?php echo set_value('harga_produk') ?>" required>
                        <small class="text-gray">Biaya Pendaftaran (Kontingen) <em>normal</em></small>
                    </div>
                    <div class="col-4">
                        <input type="number" name="harga_diskon" class="form-control" placeholder="harga diskon" value="<?php echo set_value('harga_diskon') ?>" required>
                        <small class="text-gray">Biaya Pendaftaran (Kontingen) <em>diskon</em></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-4">Nama Varian/Type</label>
                    
                    <div class="col-8">
                        <input type="text" name="nama_harga_produk" class="form-control" placeholder="Nama harga" value="<?php echo set_value('nama_harga_produk') ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-4">Keterangan</label>
                    <div class="col-8">
                        <textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo set_value('keterangan') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-4">Status</label>
                    <div class="col-8">
                        <select name="status_harga_produk" class="form-control">
                            <option value="Publish">Publish</option>
                            <option value="Draft">Draft</option>
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
    <th>Biaya Pendaftaran (Kontingen) Normal</th>
    <th>Biaya Pendaftaran (Kontingen) Diskon</th>
    <th>Nama Varian</th>
    <th>Keterangan</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>


<?php $i=1; foreach($harga_produk as $harga_produk) { ?>

<tr class="odd gradeX">
    <td><?php echo $i ?></td>
    <td>
    <?php echo angka($harga_produk['harga_produk'])  ?>
    </td>
    <td>
    <?php echo angka($harga_produk['harga_diskon'])  ?>
    </td>
    <td><?php echo $harga_produk['nama_harga_produk'] ?></td>
    <td><?php echo $harga_produk['keterangan'] ?></td>
    <td><?php echo $harga_produk['status_harga_produk'] ?></td>
    <td> 
        <?php include('edit_harga.php') ?>
        
</tr>

<?php $i++; } ?>

</tbody>
</table>