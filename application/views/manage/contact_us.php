

<?php $this->load->view('common/header1') ?>
<!-- form Uploads -->
        <link href="<?php echo base_url() ?>assetss/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
<form onsubmit="default" action="<?php echo base_url()."contact_us" ?>" method="post" role="form" enctype="multipart/form-data>

<div class="widget">
	<div class="widget-head">
                        	<div class="col-sm-12">
                        		<div class="card-box">
                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>
                        			<div class="row">
			<?php foreach ($contact as $result) { ?>
			<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>

			<div class="form-group">

	                <label><?php translate('con_img') ?></label>
	                <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
				  	
				  	
					<input type="file" class="dropify" data-height="300" />
					
				  	<span class="fileupload-preview"></span>
				  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>

					</div>
	                </div>
	                
	                <div class="form-group  <?php echo form_error('h_contact_us') ? 'has-error' : ''; ?>">
					<label for="inputTitle2"><?php echo form_error('h_contact_us') ? form_error('h_contact_us') : translate('h_contact_us') ?></label>
					<input name="h_contact_us" value="<?php echo $result->h_contact_us; ?>" type="text" id="inputTitle2" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div><br><br>
                 	</div>
            		
            		<div class="form-group  <?php echo form_error('f_contact_us') ? 'has-error' : ''; ?>">
					<label for="inputTitle3"><?php echo form_error('f_contact_us') ? form_error('f_contact_us') : translate('f_contact_us') ?></label>
					<input name="f_contact_us" value="<?php echo $result->f_contact_us; ?>" type="text" id="inputTitle3" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div><br><br>
			     	</div>

			    	<div class="form-group" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
		    		<label for="contact_us_text"><?php echo form_error('contact_us_text') ? form_error('contact_us_text') : translate('contact_us_text') ?></label>
		    		<textarea class="form-control" name="contact_us_text" style="height: 100px" placeholder="<?php translate('contact_us_text') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
		    		<?php echo set_value('contact_us_text') ? set_value('contact_us_text') : $result->contact_us_text ?>
		    		</textarea>
		  		</div>
		       

			</div>

			

			

			<?php } ?>

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

<!-- file uploads js -->
        <script src="<?php echo base_url() ?>assetss/plugins/fileuploads/js/dropify.min.js"></script>
		<script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        </script>

