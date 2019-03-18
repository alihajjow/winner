<?php $this->load->view('common/header1') ?>		<!-- form Uploads -->        <link href="<?php echo base_url() ?>assetss/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
<form onsubmit="default" enctype="multipart/form-data" action="<?php echo base_url()."" ?>about_us" method="post" role="form"><div class="widget">	<div class="widget-head">                        	<div class="col-sm-12">                        		<div class="card-box">                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>										<div class="row">									<table  cellpadding="15"  width="100%" dir="rtl"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>			<?php foreach ($serv as $result) { ?>			<div class="innerLR" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>								<tr>						<td><div class="form-group <?php echo form_error('about_us') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('about_us') ? form_error('about_us') : translate('about_us') ?></label>
					<input name="about_us" value="<?php echo $result->about_us ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div><br><br></td></tr>
			
				<tr><td><div class="form-group  <?php echo form_error('about_us_text') ? 'has-error' : ''; ?>">
					<label for="inputTitle1"><?php echo form_error('about_us_text') ? form_error('about_us_text') : translate('about_us_text') ?></label>					<textarea class="form-control" name="about_us_text" style="height: 100px" placeholder="<?php translate('about_us_text') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>		    		<?php echo set_value('about_us_text') ? set_value('contact_us_text') : $result->about_text ?>		    		</textarea>

					<div class="separator"></div>
				</div><br><br></td></tr>
				
				<tr><td><div class="form-group <?php echo form_error('f_skill') ? 'has-error' : ''; ?>">
					<label for="inputTitle3"><?php echo form_error('f_skill') ? form_error('f_skill') : translate('f_skill') ?></label>
					<input name="f_skill" value="<?php echo $result->f_skill; ?>" type="text" id="inputTitle3" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div><br><br></td></tr>				<tr><td><div class="form-group <?php echo form_error('skill_f') ? 'has-error' : ''; ?>">					<label for="inputTitle6"><?php echo form_error('skill_f') ? form_error('skill_f') : translate('skill_f') ?></label>					<input name="skill_f" value="<?php echo $result->skill_f ?>" type="text" id="inputTitle6" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>					<div class="separator"></div>				</div><br><br></td></tr>								<tr><td><div class="form-group <?php echo form_error('skill_f_a') ? 'has-error' : ''; ?>">			    <label for="inputTitle9"><?php echo form_error('skill_f_a') ? form_error('skill_f_a') : translate('skill_f_a') ?></label>				<textarea class="form-control" name="skill_f_a" style="height: 100px" placeholder="<?php translate('skill_f_a') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>		    		<?php echo set_value('skill_f_a') ? set_value('skill_f_a') : $result->skill_f_a ?>		    		</textarea>						<div class="separator"></div>				</div><br><br></td></tr>
			</div>
			
			<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>										<tr><td>	<div class="form-group <?php echo form_error('s_skill') ? 'has-error' : ''; ?>">			    <label for="inputTitle4"><?php echo form_error('s_skill') ? form_error('s_skill') : translate('s_skill') ?></label>		        <input name="s_skill" value="<?php echo $result->s_skill; ?>" type="text" id="inputTitle4" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>						<div class="separator"></div>				</div><br><br></td></tr>								<tr><td><div class="form-group  <?php echo form_error('skill_s') ? 'has-error' : ''; ?>">					<label for="inputTitle7"><?php echo form_error('skill_s') ? form_error('skill_s') : translate('skill_s') ?></label>					<input name="skill_s" value="<?php echo $result->skill_s ?>" type="text" id="inputTitle7" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>					<div class="separator"></div>				</div><br><br></td></tr>								<tr><td><div class="form-group <?php echo form_error('skill_s_a') ? 'has-error' : ''; ?>">					<label for="inputTitle10"><?php echo form_error('skill_s_a') ? form_error('skill_s_a') : translate('skill_s_a') ?></label>					<textarea class="form-control" name="skill_s_a" style="height: 70px" placeholder="<?php translate('skill_s_a') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>		    		<?php echo set_value('skill_s_a') ? set_value('skill_s_a') : $result->skill_s_a ?>		    		</textarea>					<div class="separator"></div>				</div><br><br></td></tr>												<tr><td><div class="form-group <?php echo form_error('t_skill') ? 'has-error' : ''; ?>">					<label for="inputTitle5"><?php echo form_error('t_skill') ? form_error('t_skill') : translate('t_skill') ?></label>					<input name="t_skill"  value="<?php echo $result->t_skill; ?>" type="text" id="inputTitle5" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>					<div class="separator"></div>				</div><br><br></td></tr>
				<tr><td><div class="form-group <?php echo form_error('skill_t') ? 'has-error' : ''; ?>">
					<label for="inputTitle8"><?php echo form_error('skill_t') ? form_error('skill_t') : translate('skill_t') ?></label>
					<input name="skill_t" value="<?php echo $result->skill_t; ?>" type="text" id="inputTitle8" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div>
				</div><br><br></td></tr>
				<tr><td><div class="form-group <?php echo form_error('skill_t_a') ? 'has-error' : ''; ?>">
					<label for="inputTitle10"><?php echo form_error('skill_t_a') ? form_error('skill_t_a') : translate('skill_t_a') ?></label>
					<textarea class="form-control" name="skill_t_a" style="height: 70px" placeholder="<?php translate('skill_t_a') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>		    		<?php echo set_value('skill_t_a') ? set_value('skill_t_a') : $result->skill_t_a ?>		    		</textarea>
					<div class="separator"></div>
				</div><br><br></td></tr>
								
				<tr><td><div class="form-group">	                <label><?php translate('fs_image') ?></label>	                				  	<input type="file" class="dropify" data-height="300" name="fs_image1"  /></span>									  	<span class="fileupload-preview"></span>				  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>					</div><br><br></td></tr>	                  <!-- <input id="file-0" name="fs_image1" type="file"> -->	            </div>
				
				
			</div>
			
			<?php } ?>			</table>
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary"><?php translate('edit') ?></button>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    </div>
		    </div>
		
		</div>
		
	</div>
</div>
 </form>
<?php $this->load->view('common/footer1') ?>
<!-- file uploads js -->        <script src="<?php echo base_url() ?>assetss/plugins/fileuploads/js/dropify.min.js"></script>		<script type="text/javascript">            $('.dropify').dropify({                messages: {                    'default': 'Drag and drop a file here or click',                    'replace': 'Drag and drop or click to replace',                    'remove': 'Remove',                    'error': 'Ooops, something wrong appended.'                },                error: {                    'fileSize': 'The file size is too big (1M max).'                }            });        </script>
