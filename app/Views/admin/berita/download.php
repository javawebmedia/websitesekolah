<div class="modal fade" id="modal-download">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">File Download</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="callout callout-info p-2">
					Anda dapat mengelola data file download di <a href="<?php echo base_url('admin/download') ?>">Kelola File Download</a>. <br>Silakan copy link gambar di bawah ini untuk menggunakan link download.
				</div>

				<table class="table table-bordered table-sm" id="downloadListing">
				    <thead>
				        <tr class="text-center bg-secondary">
				        	<th width="20%">FILE</th>
							<th width="80%">LINK DOWNLOAD</th>
				        </tr>
				    </thead>
				    <tbody id="listDownload">                    
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
	listDownload();		
	var table = $('#downloadListing').dataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [[ 0, "desc" ]]
    }); 
	// list all download in datatable
	function listDownload(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo base_url("admin/download/show") ?>',
			async : false,
			type:"get",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success : function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<tr id="'+data[i].id_download+'">'+
							'<td class="text-center text-uppercase">'+data[i].file_ext+' ('+data[i].file_size+' mb)</td>'+
							'<td>'+data[i].judul_download+'<br>'+'<textarea class="form-control form-control-sm"><?php echo base_url('download/unduh/') ?>'+data[i].id_download+'</textarea></td>'+
							'</tr>';
				}
				$('#listDownload').html(html);					
			}
		});
	}

});
</script>