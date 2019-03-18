<?php $this->load->view('common/header1') ?>
								
								
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>
							  			<form method="post" onsubmit="default" action="<?php echo base_url()."change_password" ?>" method="post" role="form">
								  			<div class="innerLR">
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('old_password') ? form_error('old_password') : translate('old_password') ?></label>
										    		<input type="password" class="form-control" name="old_password" placeholder="<?php translate('old_password') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
												
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('new_password') ? form_error('new_password') : translate('new_password') ?></label>
										    		<input type="password" class="form-control" name="new_password" placeholder="<?php translate('new_password') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
												
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
													
										    		<label for="exampleInputPassword1"><?php echo form_error('confirm_password') ? form_error('confirm_password') : translate('confirm_password') ?></label>
										    		<input type="password" class="form-control" name="confirm_password" placeholder="<?php translate('confirm_password') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
											</div>
											<div class="innerLR">	
										  		<button type="submit" class="btn btn-primary"><?php translate('change_password') ?></button>
									  		</div>
									  		
									</div><!-- end panel-body -->
								</div>
										</form>
								<div class="clearfix"></div>					

			
<?php $this->load->view('common/footer1') ?>
