
<?php $this->load->view('common/header1') ?>
		<link href="<?php echo base_url() ?>assetss/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>assetss/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>assetss/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		
<form onsubmit="default" action="<?php echo base_url()."user_info" ?>" method="post" role="form">
<div class="widget">
	<div class="widget-head">
                        	<div class="col-sm-12">
                        		<div class="card-box">
                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>

                        			<div class="row">
                        				<?php foreach ($results as $result) { ?>
			
			<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group <?php echo form_error('first_name') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('first_name') ? form_error('first_name') : translate('first_name') ?></label>
					<input name="first_name" value="<?php echo $result->f_name; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
			
				<div class="form-group  <?php echo form_error('last_name') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('last_name') ? form_error('last_name') : translate('last_name') ?></label>
					<input name="last_name" value="<?php echo $result->l_name; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('father_name') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('father_name') ? form_error('father_name') : translate('father_name') ?></label>
					<input name="father_name" value="<?php echo $result->father_name; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('mother_name') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('mother_name') ? form_error('mother_name') : translate('mother_name') ?></label>
					<input name="mother_name" value="<?php echo $result->mother_name; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('username') ? form_error('username') : translate('username') ?></label>
					<input name="username" readonly value="<?php echo $result->username; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('password') ? form_error('password') : translate('password') ?></label>
					<input name="password" readonly value="*******" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('gov_id') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('gov_id') ? form_error('gov_id') : translate('gov_id') ?></label>
					  <input name="gov_id" value="<?php echo $result->gov_id; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
			</div>
			<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group <?php echo form_error('birth_place') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('birth_place') ? form_error('birth_place') : translate('birth_place') ?></label>
					<input name="birth_place" value="<?php echo $result->birth_place; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('birth_date') ? 'has-error' : ''; ?>" style="margin-bottom: 0">
					<label for="inputTitle"><?php echo form_error('birth_date') ? form_error('birth_date') : translate('birth_date') ?></label>
					
					<div class="input-group date" id="datepicker3">
					    
						<input class="form-control borderd" type="text" id="datepicker" name="birth_date" value="<?php echo $result->birth_date ? $result->birth_date : "";  ?>">
					    <span class="input-group-addon"><i class="fa fa-th"></i></span>
					</div>
					<div class="separator"></div>
				</div>
				<br>
				<div class="form-group <?php echo form_error('civil_reg') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('civil_reg') ? form_error('civil_reg') : translate('civil_reg') ?></label>
					<input name="civil_reg" value="<?php echo $result->civil_reg; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				
				<div class="form-group <?php echo form_error('amaneh') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('amaneh') ? form_error('amaneh') : translate('amaneh') ?></label>
					<input name="amaneh" value="<?php echo $result->amaneh; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				
				
				<div class="form-group <?php echo form_error('address') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('address') ? form_error('address') : translate('address') ?></label>
					<input name="address" value="<?php echo $result->address; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('mobile') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('mobile') ? form_error('mobile') : translate('mobile') ?></label>
					<input name="mobile" value="<?php echo $result->mobile; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				
				<div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('email') ? form_error('email') : translate('email') ?></label>
					<input name="email" value="<?php echo $result->email; ?>" type="text" id="inputTitle" class="form-control borderd"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div>
				<div class="form-group">
				<label><?php translate('c_img') ?></label>
		        <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
			  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
			  	<input type="file" id="file-0" name="fs_image1" class="margin-none" /></span>
				</div>
			  ` </div>
			</div>
			
			<?php } ?>
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary"><?php translate('edit') ?></button>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    </div>
		    </div>
		
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
</div>
 </form>

<?php $this->load->view('common/footer1') ?>
 <script src="<?php echo base_url() ?>assetss/plugins/timepicker/bootstrap-timepicker.min.js"></script>
 <script src="<?php echo base_url() ?>assetss/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
 <script src="<?php echo base_url() ?>assetss/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript">
 jQuery(document).ready(function() {


          		// Date Picker
            jQuery('#datepicker').datepicker();
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            jQuery('#datepicker-inline').datepicker();
            jQuery('#datepicker-multiple-date').datepicker({
                format: "mm/dd/yyyy",
                clearBtn: true,
                multidate: true,
                multidateSeparator: ","
            });
            jQuery('#date-range').datepicker({
                toggleActive: true
            });
			});

</script>
