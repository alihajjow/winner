

<?php 
$this->load->view('common/header');
$style = LANG() == 'en' ? "" : 'style="float: right"';
?>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>sliders">
<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h3 class="panel-title" <?php echo $this->session->userdata('lang') == 'en' ? '' : 'style="float: right"' ?>>
        	<?php echo $this->lang->line('add_countname'); ?>
        </h3>
    </div>
    
	<div class="panel-body">
    	
	    <div class="row toastr-row">
	        <div class="col-md-12" <?php echo $style ?>>
	        	 
	        	 
	        	 
	            <div class="form-group">
	                <label><?php translate('fs_image') ?></label>
	                <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
				  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
				  	<input type="file" id="file-0" name="fs_image1" class="margin-none" /></span>
				  	<span class="fileupload-preview"></span>
				  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
					</div>
	                  <!-- <input id="file-0" name="fs_image1" type="file"> -->
	            </div>
	            <div class="form-group <?php echo form_error('slider1') ? 'has-error' : '' ?>">
	            	<label class="control-label" for="title"><?php echo form_error('slider1') ? form_error('slider1') : translate('ar_img_title'); ?></label>
					<input id="title" name="slider1" value="<?php echo set_value('slider1') ? set_value('slider1') : ""; ?>" type="text" class="form-control borderd">
	            </div>
	            
	            <div class="form-group <?php echo form_error('slider1_en') ? 'has-error' : '' ?>">
	            	<label class="control-label" for="title"><?php echo form_error('slider1_en') ? form_error('slider1_en') : translate('en_img_title') ; ?></label>
					<input id="title" name="slider1_en" value="<?php echo set_value('slider1_en') ? set_value('slider1_en') : ""; ?>" type="text" class="form-control borderd">
	            </div>
	            <div class="form-group<?php echo form_error('desc1') ? ' has-error' : '' ?>">
	                <label class="control-label" for="message"><?php echo form_error('desc1') ? form_error('desc1') : translate('ar_img_desc'); ?></label>
	                <textarea class="form-control borderd" name="desc1" id="message" rows="3"><?php echo set_value('desc1') ? set_value('desc1') : ""; ?> </textarea>
	            </div>
	            
	            <div class="form-group<?php echo form_error('desc1_en') ? ' has-error' : '' ?>">
	                <label class="control-label" for="message"><?php echo form_error('desc1_en') ? form_error('desc1_en') : translate('en_img_desc'); ?></label>
	                <textarea class="form-control borderd" name="desc1_en" id="message" rows="3" ><?php echo set_value('desc1_en') ? set_value('desc1_en') : ""; ?> </textarea>
	            </div>
	            
	        </div>
	    </div>
    </div>
    <div class="modal-footer">
        <input type="submit"   style="margin-left: 10px; margin-right: 10px" value="<?php echo $this->lang->line('add'); ?>" class="btn btn-danger">
        <button type="button" class="btn btn-default" onclick="goBack()"><?php echo $this->lang->line('back') ?></button>
    </div>
    
</div>
</form>
<?php $this->load->view('common/footer'); ?>
 