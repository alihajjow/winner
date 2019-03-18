<?php $this->load->view('common/header1') ?>
<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="panel-body">
				<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>

					<form method="post" action="<?php echo base_url()."insert_tutors"?>" role="form">
							  <div class="innerLR">
								  <div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		<label for="inputTitle"><?php translate('tutors_name') ?></label>
									    		<input type="text" class="form-control" name="tutors_name" placeholder="<?php translate('tutors_name') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
						          </div>
								  <div class="form-group" <?php echo LANG() == 'en' ? 'cat_name' : 'style="text-align: right"' ?>>
										  		<label for="inputTitle"><?php translate('cat_name') ?></label>
							                  	<select style="width: 100%;" style="text-align: right" id="select2_1" class="col-md-6 form-control" name="cat_id">
				                   				<option></option>
	        							       <?php foreach ($cats->result() as $cat) { ?>
											 		  <option value="<?php echo $cat->cat_id ?>"> <?php echo $cat->cat_name ?></option>
											  	 <?php } ?>
	     								     	  </select>
								  </div>
								
							   </div>
							    
								<div class="innerLR">
													<br><br>
													<button type="submit" class="btn btn-primary">  <?php translate('add') ?></button>
								</div>
								</div>
			</div><!-- end panel-body -->
</div>
										</form>
								<div class="clearfix"></div>					
<?php $this->load->view('common/footer1') ?>



































