<?php $this->load->view('common/header1') ?>
<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<h4 class="innerAll border-bottom text-center bg-primary"><?php translate('transfer') ?></h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">
								
								<div class="placeholder text-center"><i class="fa fa-pencil"></i></div>
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		
							  			<form method="post" action="<?php echo base_url()."transfer"; ?>">
								  			<div class="innerLR" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>		
										  		<label for="inputTitle"><?php translate('to_user') ?></label>
									    		<input type="text" class="form-control" name="to_emp" placeholder="<?php translate('to_emp') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>

					                   	<?php 	/*	<select style="width: 100%;" id="select2_1" name="to_emp">
					                   				<option></option>
		        							       <?php foreach ($users->result() as $user) { ?>
												   <option value="<?php echo $user->emp_id ?>"> <?php echo $user->f_name.' '.$user->l_name ?></option>
												   <?php } ?>
		     								       </select>
										  		*/?>
										  		<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php translate('amount') ?></label>
										    		<input type="text" class="form-control" name="amount" placeholder="<?php translate('amount') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										  		<label style="float: left; padding-top: 5px" for="exampleInputPassword1"><?php translate('balance') ?>  : <?php echo $balance; ?> </label>
										  		<input  class="btn btn-primary"  type="submit"  value="<?php translate('transfer') ?>"  />
										  		
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
<?php $this->load->view('common/footer1') ?>
