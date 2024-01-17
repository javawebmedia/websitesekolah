<div class="modal fade" id="modal-media">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Kelola Media</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="callout callout-info p-2">
					Klik <strong>Refresh</strong> untuk melihat data terakhir yang diunggah. Silakan copy link media di bawah ini untuk menggunakannya.
				</div>

				<div id="actions" class="row">
                  <div class="col-lg-6">
                    <div class="btn-group w-100">
                      <span class="btn btn-success btn-sm col fileinput-button">
                        <i class="fas fa-plus"></i>
                        <span>Pilih File</span>
                      </span>
                      <button type="submit" class="btn btn-primary btn-sm col start">
                        <i class="fas fa-upload"></i>
                        <span>Mulai Unggah</span>
                      </button>
                      <button type="reset" class="btn btn-warning btn-sm col cancel">
                        <i class="fas fa-times-circle"></i>
                        <span>Batalkan</span>
                      </button>
                      <button type="button" class="btn btn-success btn-sm col" id="Refresh">
                        <i class="fas fa-sync"></i>
                        <span>Refresh</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center">
                    <div class="fileupload-process w-100">
                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table table-striped files" id="previews">
                  <div id="template" class="row mt-2">
                    <div class="col-auto">
                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                    </div>
                    <div class="col d-flex align-items-center">
                        <p class="mb-0">
                          <span class="lead" data-dz-name></span>
                          (<span data-dz-size></span>)
                        </p>
                        <strong class="error text-danger" data-dz-errormessage></strong>
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                      <div class="btn-group">
                        <button class="btn btn-primary btn-sm start">
                          <i class="fas fa-upload"></i>
                          <span>Mulai</span>
                        </button>
                        <button data-dz-remove class="btn btn-warning btn-sm cancel">
                          <i class="fas fa-times-circle"></i>
                          <span>Batalkan</span>
                        </button>
                        <button data-dz-remove class="btn btn-danger btn-sm delete">
                          <i class="fas fa-trash"></i>
                          <span>Hapus</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

				<table class="table table-bordered table-sm" id="mediaListing">
				    <thead>
				        <tr class="text-center bg-secondary">
				        	<th width="10%">FILE</th>
							<th width="90%">LINK MEDIA</th>
				        </tr>
				    </thead>
				    <tbody id="listMedia">                    
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
	listMedia();		
	var table = $('#mediaListing').dataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [[ 0, "desc" ]]
    }); 

    // Refresh button click event
    $('#Refresh').on('click', function () {
        listMedia();
        table.DataTable().ajax.reload(); // Assuming your DataTable is initialized with ajax
    });

	// list all media in datatable
	function listMedia(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo base_url("admin/media/show") ?>',
			async : false,
			type :"GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success : function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++)
				{
					var datanya; // Declare the variable here

	                if (data[i].file_ext == 'jpg' || data[i].file_ext == 'jpeg' || data[i].file_ext == 'png' || data[i].file_ext == 'gif') {
	                    datanya = '<img class="img img-thumbnail" src="<?php echo base_url('assets/upload/file/') ?>' + data[i].gambar + '">';
	                } else {
	                    datanya = data[i].file_ext + ' (' + data[i].file_size + ' mb)';
	                }

	                html += '<tr id="' + data[i].id_media + '">' +
	                    '<td class="text-center text-uppercase">' + datanya + '</td>' +
	                    '<td><textarea class="form-control form-control-sm"><?php echo base_url('assets/upload/file/') ?>' + data[i].gambar + '</textarea></td>' +
	                    '</tr>';
				}
				$('#listMedia').html(html);					
			}
		});
	}
});
</script>