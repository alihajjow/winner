<?php $this->load->view('common/header1') ?>
<div class="col-separator col-unscrollable box">

			<!-- col-table -->
			<div class="col-table">

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">

								<div class="panel panel-default col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">

							  			<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."add_courses_levels/" . $course_id; ?>">
								  			<div class="innerLR" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
								  				<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle"><?php translate('course_lev_name') ?></label>
										    		<input type="text" class="form-control" name="lev_name" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    	</div>
                          <div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle"><?php echo LANG() == 'en' ? 'English name' : 'اسم الدورة بالانكليزي'; ?></label>
										    		<input type="text" class="form-control" name="c_name_en" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
													</div>

													<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle"><?php echo LANG() == 'en' ? 'Arabic description' : 'التوصيف باللغة العربية'  ?></label>
										    		<textarea type="text" class="form-control" name="desc_ar" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
														</textarea>
													</div>
													<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle"><?php echo LANG() == 'en' ? 'English description' : 'التوصيف بالانكليزي' ?></label>
										    		<textarea type="text" class="form-control" name="desc_en" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
														</textarea>
													</div>

													<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle"><?php echo LANG() == 'en' ? 'Photo' : 'الصورة' ?></label>
										    		<input type="file" class="form-control" name="thumb" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
													</div>
										    	<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle">سعر التسجيل</label>
										    		<input type="text" class="form-control" name="lev_price" placeholder="سعر التسجيل" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    	</div>
										    	<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
											  		<label for="inputTitle">نسبة العمولة</label>
										    		<input type="text" class="form-control" name="lev_comm" placeholder="نسبة العمولة" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										    	</div>
										    	 

											  	<input  class="btn btn-primary"  type="submit"  value="<?php translate('add') ?>"  />

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
