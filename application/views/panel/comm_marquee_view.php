<?php $this->load->view('common/header1') ?>
<form onsubmit="default" action="<?php echo base_url()."user_info" ?>" method="post" role="form">
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
										<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>
                        			<form method="post" onsubmit="default" action="<?php echo base_url()."change_password" ?>" method="post" role="form">
								  			<div class="innerLR">
										  		<div class="form-group " <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('commision') ? form_error('commision') : translate('commision') ?></label>
										    		<input type="text" class="form-control" name="commision" value="<?php echo set_value('commision') ? set_value('commision') : $result->comm ?>" placeholder="<?php translate('commision') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('fath_comm') ? form_error('fath_comm') : translate('fath_comm') ?></label>
										    		<input type="text" class="form-control" name="fath_comm" value="<?php echo set_value('fath_comm') ? set_value('fath_comm') : $result->fath_comm ?>" placeholder="<?php translate('fath_comm') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('max_pay') ? form_error('max_pay') : translate('max_pay') ?></label>
										    		<input type="text" class="form-control" name="max_pay" value="<?php echo set_value('max_pay') ? set_value('max_pay') : $result->max_pay ?>" placeholder="<?php translate('max_pay') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('expanses') ? form_error('expanses') : translate('expanses') ?></label>
										    		<input type="text" class="form-control" name="expanses" value="<?php echo set_value('expanses') ? set_value('expanses') : $result->expanses ?>" placeholder="<?php translate('expanses') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php echo form_error('marquee') ? form_error('marquee') : translate('marquee') ?></label>
										    		<textarea class="form-control" name="marquee" style="height: 100px" placeholder="<?php translate('marquee') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    			<?php echo set_value('marquee') ? set_value('marquee') : $result->marquee ?>
										    		</textarea>
										  		</div>
											
										</div>		
										 
										<div class="innerLR">
												<div class="form-group" style="margin-top: 20px">
													<button type="submit" class="btn btn-primary"><?php translate('save') ?></button>
												</div>
										</div>
									  		</div><!-- end row -->
</div>
 </form>
<?php $this->load->view('common/footer1') ?>
