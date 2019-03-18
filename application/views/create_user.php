
<?php $this->load->view('common/header'); ?>
<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<h4 class="innerAll margin-none border-bottom text-center bg-primary"><i class="fa fa-pencil"></i> Create a new Account</h4>

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
								  		
								  			<form method="post" action="<?php echo base_url()."create_user"; ?>">
								  			<div class="innerLR">		
									  		<div class="form-group">
									  		
									    		<label for="">First Name</label>
									    		<input type="text" class="form-control" name="first_name" placeholder="Your first name">
									  		</div>
									  		<div class="form-group">
									    		<label for="">Last Name</label>
									    		<input type="text" class="form-control" name="last_name" placeholder="Your last name">
									    		<div class="form-group">
									    		<label for="">User Name</label>
									    		<input type="text" class="form-control" name="username" placeholder="Your user name">
									  		</div>
									  		</div>
								  	  		<div class="form-group">
									    		<label for="exampleInputEmail1">Email address</label>
									    		<input type="email" class="form-control" name="email" placeholder="Enter email">
									  		</div>
									  		<div class="form-group">
									    		<label for="exampleInputPassword1">Password</label>
									    		<input type="password" class="form-control" name="password" placeholder="Password">
									  		</div>
								    		<div class="form-group">
									    		<label for="exampleInputPassword1">Confirm Password</label>
									    		<input type="password" class="form-control" name="password" placeholder="Retype Password">
									  		</div>
									  		<div class="form-group">
									    		<label for="exampleInputPassword1">father ID</label>
									    		<input type="password" class="form-control" name="" placeholder="">
									  		</div>
									  		</div>
									  		<input  class="btn btn-primary"  type="submit"  value="create user"  />
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


</div>
<!-- // END row-app -->
		<?php $this->load->view('common/footer'); ?>