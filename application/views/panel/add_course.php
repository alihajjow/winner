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

								<div class="panel panel-default col-md-12 col-sm-6 ">

								  	<div class="panel-body">

							  			<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."add_course/" . $cat; ?>">
								  			<div class="innerLR" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
													<div class="col-md-6 <?php echo LANG() == 'en' ? '' : 'pull-right' ?>" >
														<div class="form-group">
											        <label><?php echo LANG() == 'en' ? 'Course image' : 'صورة الكورس' ?></label>
												  		<input type="file" id="file-0" name="fs_image1"  class="form-control" /></span>
														</div>
														<div class="form-group">
												  		<label for="inputTitle"><?php translate('course_name') ?></label>
											    		<input type="text" class="form-control" name="c_name" placeholder="<?php translate('') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
														</div>

														<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
												  		<label for="inputTitle"><?php echo LANG() == 'en' ? 'English name' : 'اسم الكورس بالانكليزي'; ?></label>
											    		<input type="text" class="form-control" name="c_name_en" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
														</div>

														<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
												  		<label for="inputTitle"><?php echo LANG() == 'en' ? 'Arabic description' : 'التوصيف باللغة العربية'  ?></label>
											    		<textarea type="text" class="form-control" name="desc_ar" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
															</textarea>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
												  		<label for="inputTitle"><?php translate('tutors_name') ?></label>
						                  	<select style="width: 100%;" style="text-align: right" class="form-control" id="select2_1" name="tutor_id">
				                   				<option></option>
			        							       <?php foreach ($tutors->result() as $tut) { ?>
																 		  <option value="<?php echo $tut->tutor_id ?>"> <?php echo $tut->tutor_name ?></option>
															  	 <?php } ?>
	     								     	  </select>
									  			</div>
										  		<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php translate('course_price') ?></label>
										    		<input type="text" class="form-control" name="price" placeholder="<?php translate('course_price') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
										        <div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
										    		<label for="exampleInputPassword1"><?php translate('course_duration') ?></label>
										    		<input type="text" class="form-control" name="duration" placeholder="<?php translate('course_duration') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
										  		</div>
													<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
														<label for="inputTitle"><?php echo LANG() == 'en' ? 'English description' : 'التوصيف بالانكليزي' ?></label>
														<textarea type="text" class="form-control" name="desc_en" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
														</textarea>
													</div>
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
