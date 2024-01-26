<script type='text/javascript'>
$(document).ready(function(){

listSiswa();		
var table = $('#guruListing').dataTable({
	"searching": true,
  "ordering": true
}); 
// list all rombel in datatable
function listSiswa(){
	$.ajax({
		type  : 'GET',
		url   : '<?php echo base_url("admin/rombel/guru_rombel/".$rombel->id_rombel) ?>',
		async : false,
		dataType : 'json',
		success : function(data){
			var html = '';
			var i;
			for(i=0; i<data.length; i++){
				html += '<tr id="'+data[i].id_guru_rombel+'">'+
						'<td class="text-center">'+data[i].no_urut+'</td>'+
						'<td>'+data[i].nama_guru+'</td>'+
						'<td>'+data[i].jenis_kelamin+'</td>'+
						'<td>'+data[i].ttl+'</td>'+	
						'<td>'+
							'<a href="javascript:void(0);" class="btn btn-light btn-sm deleteRecord" data-id="'+data[i].id_guru_rombel+'" title="Hapus"><i class="fa fa-trash"></i></a>'+
						'</td>'+
						'</tr>';
			}
			$('#listRecords').html(html);					
		}

	});
}

// save new rombel record
$('#simpan').submit('click',function(){
	var id_user = $('#id_user').val();
	var id_guru = $('#id_guru').val();
	var id_rombel = $('#id_rombel').val();
	var id_kelas = $('#id_kelas').val();
	var id_tahun = $('#id_tahun').val();
	var status_guru_rombel = $('#status_guru_rombel').val();
	$.ajax({
		type : "POST",
		url  : "<?php echo base_url('admin/rombel/tambah_guru') ?>",
		dataType 	: "JSON",
		data 			: { 
									id_user: id_user, 
									id_guru:id_guru,
									id_rombel:id_rombel, 
									id_kelas:id_kelas,
									id_tahun:id_tahun,
									id_tahun:id_tahun,
									status_guru_rombel: status_guru_rombel
								},
		success: function(data){
			$('#id_guru').val("");
			listSiswa();
			Swal.fire({
					  icon: 'success',
					  title: 'Berhasil',
					  timer: 1000,
					  heightAuto: false,
					  text: 'Data guru telah ditambahkan',
					});
		}
	});
	return false;
});

// show delete form
	$('#listRecords').on('click','.deleteRecord',function(){
		var pesertaId = $(this).data('id');            
		$('#deleteEmpModal').modal('show');
		$('#deleteEmpId').val(pesertaId);
	});

	// delete rombel record
	 $('#deleteEmpForm').on('submit',function(){
		var pesertaId = $('#deleteEmpId').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url('admin/rombel/hapus') ?>",
			dataType : "JSON",  
			data : { id_guru_rombel:pesertaId },
			success: function(data){
				$("#"+pesertaId).remove();
				$('#deleteEmpId').val("");
				$('#deleteEmpModal').modal('hide');
				listSiswa();
				Swal.fire({
					  icon: 'success',
					  title: 'Berhasil',
					  timer: 1000,
					  heightAuto: false,
					  text: 'Data guru telah dihapus',
					});
			}
		});
		return false;
	});

 

});
</script>

<!-- Delete -->
<form id="deleteEmpForm" method="post">
    <div class="modal fade" id="deleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Hapus Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
               <strong>Yakin ingin menghapus rombel ini?</strong>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="deleteEmpId" id="deleteEmpId" class="form-control">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Ya, Hapus</button>
          </div>
        </div>
      </div>
    </div>
</form>