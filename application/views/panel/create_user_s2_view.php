<?php $this->load->view('common/header1'); ?>
<div class="row">
			
	<!-- col-table -->
	<div class="col-table">
		
		<!-- col-table-row -->
		<div class="col-table-row">
			

			<!-- col-app -->
			<div class="col-app col-unscrollable">

				<!-- col-app -->
				
				<div class="col-app">

					<div class="login">
					
						
						
						<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

						  	<div class="panel-body" width="100%">
					  			<form method="post" action="<?php echo base_url()."register_course"; ?>">
						  			<div class="innerLR">		
								  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
											<h4 ><?php translate('register_course') ?></h4>
											<br>
								    		<label for="exampleInputPassword1" ><?php translate('course_cat') ?></label>
								    		<select onchange="courses(this.value)" class="form-control" id="select2_1" placeholder="<?php translate('course_cat') ?>" name="course_cat">
						           				<option></option>
										    	<?php foreach ($course_cat->result() as $row) { ?>
													<option value="<?php echo $row->cat_id ?>"> <?php echo $row->cat_name; ?></option>
												<?php } ?>
										    </select>
								  		</div>
								  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
								    		<label for="exampleInputPassword1"><?php translate('course') ?></label>
								    		<select onchange="levels(this.value)" class="form-control" id="select2_2" placeholder="<?php translate('course') ?>" name="course">
						           				<option></option>
										    </select>
								  		</div>
										
								  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
								    		<label for="exampleInputPassword1"><?php translate('course_lvl') ?></label>
								    		<select style="width: 100%;" id="select2_3" name="course_lvl" class="form-control" placeholder="<?php translate('course_lvl') ?>">
						           				<option></option>
										    </select>
								  		</div>
								  		<input class="btn btn-primary" type="submit" value="<?php translate('register') ?>"  />
							  		</div>
							  		
								</form>
					  		</div>
						
						</div>
						<div class="clearfix"></div>					

					</div>
					
				</div>
				<!-- // END col-app -->

			</div>
			<!-- // END col-app.col-unscrollable -->

		</div>
		<!-- // END col-table-row -->
	
	</div>
	<!-- // END col-table -->
	
</div>
<!-- // END col-separator.box -->
<?php $this->load->view('common/footer1'); ?>
<script type="text/javascript">

	function courses(id) {
		$.ajax({
          	url: '<?php echo base_url(); ?>get_courses/' + id,
          	success: function(data) {
          		if (data) {
          			//alert(1);
          			$("#select2_2").html(data);
          		};
        	}
    	});
	}
	
	function levels(id) {
		//alert(4);
		$.ajax({
          	url: '<?php echo base_url(); ?>get_lvls/' + id,
          	success: function(data) {
          		if (data) {
          			$("#select2_3").html(data);
          		};
        	}
    	});
	}
	
</script>