<div class="container">
	<div class="row">
        <div class="col-md-6 offset-3">
        	<?php echo form_open(base_url('signin')); ?>

				<input type="hidden" name="pengalihan" value="<?php echo Session()->get('pengalihan'); ?>">

				<div class="form-group mb-3">
					<label class="label" for="name">Username</label>
					<input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
				</div>
				<div class="form-group mb-3">
					<label class="label" for="password">Password</label>
					<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
				</div>
				<div class="form-group">
					<button type="reset" name="reset" value="reset" class="btn btn-dark btn-lg">
						<i class="fa fa-times"></i> Reset
					</button>
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">
						 Login <i class="fa fa-chevron-circle-right"></i>
					</button>
				</div>
				
			
			<?php echo form_close(); ?>
			<hr style="border-top: solid thin #666;">
			<p class="text-center">
				Kembali ke <a href="<?php echo base_url() ?>">Beranda</a> | Belum punya akun? <a href="<?php echo base_url('register') ?>">Register</a>
			</p>
        </div>
    </div>
</div>