<?php $this->load->view('common/header1') ?>
		<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
								  	<div class="panel-body">
							  			<form method="post" action="<?php echo base_url()."edit_level/$lev_id/$course_id"; ?>">
								  			<div class="innerLR">
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
												
								  				<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>	
											  		<label for="inputTitle"><?php translate('course_lev_name') ?></label>
										    		<input type="text" class="form-control" value="<?php echo set_value('lev_name') ? set_value('lev_name') : $level->lev_name ?>" name="lev_name" placeholder="<?php translate('course_lev_name') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    	</div>
										    	<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>	
											  		<label for="inputTitle">سعر التسجيل</label>
										    		<input type="text" class="form-control" value="<?php echo set_value('lev_price') ? set_value('lev_price') : $level->price ?>" name="lev_price" placeholder="سعر التسجيل" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    	</div>
											  	
											  	
												
										  		
									  		</div>
									  		    <button type="submit" class="btn btn-primary"><?php translate('edit') ?></button>
										</form>
							  		</div>						
	</div>
	<div class="clearfix"></div>	
<?php $this->load->view('common/footer1') ?>

