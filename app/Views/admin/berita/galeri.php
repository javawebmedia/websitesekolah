<div class="modal fade" id="modal-galeri">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Galeri Gambar</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="callout callout-info p-2">
					Anda dapat mengelola data galeri di <a href="<?php echo base_url('admin/galeri') ?>">Kelola Galeri</a>.
					<br>Silakan copy link gambar di bawah ini untuk menggunakan link gambar.
				</div>

				<table class="table table-bordered table-sm" id="galeriListing">
				    <thead>
				        <tr class="text-center bg-secondary">
				        	<th width="10%">GAMBAR</th>
							<th width="90%">LINK GAMBAR</th>
				        </tr>
				    </thead>
				    <tbody id="listGaleri">                    
				    </tbody>
				</table>

			</div>
			<!-- modal body -->
			<div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
            </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	$(document).ready(function(){
	listGaleri();		
	var table = $('#galeriListing').dataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [[ 0, "desc" ]]
    }); 
	// list all galeri in datatable
	function listGaleri(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo base_url("admin/galeri/show") ?>',
			async : false,
			type:"get",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success : function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<tr id="'+data[i].id_galeri+'">'+
							'<td class="text-center"><img src="<?php echo base_url('assets/upload/image/thumbs/') ?>/'+data[i].gambar+'" class="img img-thumbnail"></td>'+
							'<td>'+data[i].judul_galeri+'<br>'+'<textarea class="form-control form-control-sm"><?php echo base_url('assets/upload/image/') ?>'+data[i].gambar+'</textarea></td>'+
							'</tr>';
				}
				$('#listGaleri').html(html);					
			}
		});
	}

});
</script>