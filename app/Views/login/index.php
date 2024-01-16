

								<?php 
								$validation = \Config\Services::validation();
								$errors = $validation->getErrors();
								if(!empty($errors))
								{
									echo '<span class="text-danger">'.$validation->listErrors().'</span>';
								}
								?>

								<?php if (session('msg')) : ?>
									<div class="alert alert-info alert-dismissible">
										<?= session('msg') ?>
										<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
									</div>
								<?php endif ?>

								<?php echo form_open(base_url('login'), 'class="signin-form"'); ?>

								<input type="hidden" name="pengalihan" value="<?php echo Session()->get('pengalihan'); ?>">

								<div class="form-group mb-3">
									<label class="label" for="name">Username</label>
									<input type="text" name="username" class="form-control" placeholder="Username" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" name="password" class="form-control" placeholder="Password" required>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
								</div>
								
								<p class="text-center">
									Kembali ke <a href="<?php echo base_url() ?>">Beranda</a> | Lupa Password? <a href="<?php echo base_url('login/lupa') ?>">Reset</a>
								</p>
							
							<?php echo form_close(); ?>


