

<?php 

$this->load->view('common/header');

$style = LANG() == 'en' ? "" : 'style="float: right"';

?>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."edit_slider/$slider->s_id" ?>">

<div class="panel panel-white">

    <div class="panel-heading clearfix">

        <h3 class="panel-title" <?php echo $this->session->userdata('lang') == 'en' ? '' : 'style="float: right"' ?>>

        	<?php echo $this->lang->line('add_countname'); ?>

        </h3>

    </div>

    

	<div class="panel-body">

    	

	    <div class="row toastr-row">

	        <div class="col-md-12" <?php echo $style ?>>

	        	 

	            <div class="form-group <?php echo form_error('slider1') ? 'has-error' : '' ?>">

	            	<label class="control-label" for="title"><?php echo form_error('slider1') ? form_error('slider1') : translate('ar_img_title'); ?></label>

					<input id="title" name="slider1" value="<?php echo set_value('slider1') ? set_value('slider1') : $slider->title_ar; ?>" type="text" class="form-control borderd">

	            </div>

	            

	            <div class="form-group <?php echo form_error('slider1_en') ? 'has-error' : '' ?>">

	            	<label class="control-label" for="title"><?php echo form_error('slider1_en') ? form_error('slider1_en') : translate('en_img_title') ; ?></label>

					<input id="title" name="slider1_en" value="<?php echo set_value('slider1_en') ? set_value('slider1_en') : $slider->title_en; ?>" type="text" class="form-control borderd">

	            </div>

	            <div class="form-group<?php echo form_error('desc1') ? ' has-error' : '' ?>">

	                <label class="control-label" for="message"><?php echo form_error('desc1') ? form_error('desc1') : translate('ar_img_desc'); ?></label>

	                <textarea class="form-control borderd" name="desc1" id="message" rows="3"><?php echo set_value('desc1') ? set_value('desc1') : $slider->desc_ar; ?> </textarea>

	            </div>

	            

	            <div class="form-group<?php echo form_error('desc1_en') ? ' has-error' : '' ?>">

	                <label class="control-label" for="message"><?php echo form_error('desc1_en') ? form_error('desc1_en') : translate('en_img_desc'); ?></label>

	                <textarea class="form-control borderd" name="desc1_en" id="message" rows="3" ><?php echo set_value('desc1_en') ? set_value('desc1_en') : $slider->desc_en; ?> </textarea>

	            </div>

	            

	        </div>

	        

	    

	    </div>

    </div>

    <div class="modal-footer">

        <input type="submit"   style="margin-left: 10px; margin-right: 10px" value="<?php echo $this->lang->line('edit'); ?>" class="btn btn-danger">

        <button type="button" class="btn btn-default" onclick="goBack()"><?php echo $this->lang->line('back') ?></button>

    </div>

    

</div>

</form>

<?php $this->load->view('common/footer'); ?>

 