
    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-<?php echo $harga_produk['id_harga_produk'] ?>">
        <i class="fa fa-edit"></i> Edit
    </button>
    <a href="<?php echo base_url('admin/produk/delete_harga/'.$harga_produk['id_harga_produk'].'/'.$produk['id_produk']) ?>" class="btn btn-danger btn-xs delete-link" onclick="confirmation(event)"><i class="fa fa-trash"></i> Hapus</a></td>

<form action="<?php echo base_url('admin/produk/harga/'.$produk['id_produk']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>
<input type="hidden" name="id_harga_produk" value="<?php echo $harga_produk['id_harga_produk'] ?>">

<div class="modal fade" id="edit-<?php echo $harga_produk['id_harga_produk'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Biaya Sewa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-info">
                    Periode/tanggal diskon silakan update di data produk.
                </div>

                <div class="form-group row">
                    <label class="col-3">Biaya Sewa &amp; Deposit Produk</label>
                    
                    
                    <div class="col-sm-3">
                        <input type="number" name="biaya_deposit" class="form-control" required value="<?php echo $harga_produk['biaya_deposit'] ?>">
                        <small class="text-gray">Biaya <em>deposit</em></small>
                    </div>
                    <div class="col-3">
                        <input type="number" name="harga_produk" class="form-control" placeholder="harga" value="<?php echo $harga_produk['harga_produk'] ?>">
                        <small class="text-gray">Biaya Pendaftaran  <em>normal</em></small>
                    </div>

                    <div class="col-3">
                        <input type="number" name="harga_diskon" class="form-control" placeholder="harga diskon" value="<?php echo $harga_produk['harga_diskon'] ?>">
                        <small class="text-gray">Biaya Pendaftaran  <em>diskon</em></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Nama Varian/Type</label>
                    
                    <div class="col-9">
                        <input type="text" name="nama_harga_produk" class="form-control" placeholder="Nama harga" value="<?php echo $harga_produk['nama_harga_produk'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Keterangan</label>
                    <div class="col-9">
                        <textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $harga_produk['keterangan'] ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Urutan</label>
                    <div class="col-9">
                        <select name="status_harga_produk" class="form-control">
                            <option value="Publish">Publish</option>
                            <option value="Draft" <?php if($harga_produk['status_harga_produk']=="Draft") { echo "selected"; } ?>>Draft</option>
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