<?php $this->load->view('common/header1') ?>
			
			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>  		
			<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  <h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>  		
										<form method="post" action="<?php echo base_url()."pay_login"; ?>">
								  			<div class="innerLR">		
										  		<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php translate('password') ?></label>
										    		<input type="password" class="form-control" name="password" placeholder="<?php translate('password') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										  		<input  class="btn btn-primary"  type="submit"  value="<?php translate('login') ?>"  />
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
					</div>
				
<?php $this->load->view('common/footer1') ?>
