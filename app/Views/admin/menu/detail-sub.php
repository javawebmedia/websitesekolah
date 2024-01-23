
<div class="modal-basic modal fade show" id="DetailMenu<?php echo $menu->id_menu ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content modal-bg-white ">
			<div class="modal-header">
				<h6 class="modal-title">Sub Menu</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<?php if($sub_menu) { ?>
					<table class="table table-sm">
						<thead>
							<tr class="bg-light">
								<th width="50%">Nama</th>
								<th>Status</th>
								<th>Urutan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
					
				<?php foreach($sub_menu as $sub_menu) { ?>
					<tr>
						<td><strong><?php echo $sub_menu->nama_sub_menu ?></strong>
							<br><small>
								<i class="fa fa-link"></i> <?php echo $sub_menu->link ?>
								<br><i class="fa fa-newspaper"></i> <?php echo $sub_menu->keterangan ?></small>
						</td>
						<td>
							<?php if($sub_menu->status_sub_menu=='Publish') { ?>
								<span class="badge bg-info">
									<i class="fa fa-eye"></i> <?php echo $sub_menu->status_sub_menu ?>
								</span>
							<?php }else{ ?>
								<span class="badge bg-secondary">
									<i class="fa fa-eye-slash"></i> Not Published
								</span>
							<?php } ?>
						</td>
						<td><?php echo $sub_menu->urutan ?></td>
						<td>
							<a href="<?php echo base_url('admin/menu/edit_sub/'.$sub_menu->id_sub_menu) ?>" title="Edit sub menu" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i></a>
							<a href="<?php echo base_url('admin/menu/delete_sub/'.$sub_menu->id_sub_menu) ?>" title="Delete sub menu" class="btn btn-xs btn-secondary delete-link"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					
				<?php } ?>
					</tbody>
					</table>
					<?php } ?>

			</div>
		</div>
	</div>
	<!-- ends: .modal-Basic -->
</div>
<!-- /.modal -->
