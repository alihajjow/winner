

<?php 
$this->load->view('common/header');
$style = LANG() == 'en' ? "" : 'style="float: right"';
?>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>">
<div class="panel panel-white">
<div class="panel-heading clearfix">
        <h3 class="panel-title" <?php echo $this->session->userdata('lang') == 'en' ? '' : 'style="float: right"' ?>>
        	<?php echo $this->lang->line('add_countname'); ?>
        </h3>
    </div>
    
	<div class="panel-body">   	
	    <div class="row toastr-row">
	        <div class="col-md-4" <?php echo $style ?>>	 
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
	            <div class="form-group <?php echo form_error('tutor1') ? 'has-error' : '' ?>">
	            	<label class="control-label" for="title"><?php echo form_error('tutor1') ? form_error('tutor1') : translate('tutor_name'); ?></label>
					<input id="title" name="tutor1" value="<?php echo set_value('tutor1') ? set_value('tutor1') : ""; ?>" type="text" class="form-control borderd">
	            </div>
	            
	           <div class="form-group"  <?php echo form_error('cat_id1') ? 'has-error' : '' ?>">

		  		<label for="inputTitle"><?php translate('cat_name') ?></label>

              	<select style="width: 100%;" style="text-align: right" id="select2_1" name="cat_id1">
   				<option></option>
		       <?php foreach ($cats->result() as $cat) { ?>
			 		  <option value="<?php echo $cat->cat_id ?>"> <?php echo $cat->cat_name ?></option>
			  	 <?php } ?>
		     	  </select>
	  			</div>
		  		
	           
	        </div>
	        
	        
	        <div class="col-md-4" <?php echo $style ?>>
	        	<div class="form-group">
	                <label><?php translate('fs_image') ?></label>
	                <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
				  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
				  	<input type="file" id="file-0" name="fs_image2" class="margin-none" /></span>
				  	<span class="fileupload-preview"></span>
				  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
					</div>
	                
	               
	            </div>
	            <div class="form-group<?php echo form_error('tutor2') ? ' has-error' : '' ?>">
	                <label class="control-label" for="title1"><?php echo form_error('tutor2') ? form_error('tutor2') : translate('tutor_name'); ?></label>
	                <input id="title1" value="<?php echo set_value('tutor2') ? set_value('tutor2') : ""; ?>" type="text"  class="form-control borderd" name="tutor2">
	            </div>
   	           <div class="form-group" <?php echo form_error('cat_id2') ? 'has-error' : '' ?>">
 
	           <label for="inputTitle"><?php translate('cat_name') ?></label>

              	<select style="width: 100%;" style="text-align: right" id="select2_2" name="cat_id2">
   				<option></option>
		       <?php foreach ($cats->result() as $cat) { ?>
			 		  <option value="<?php echo $cat->cat_id ?>"> <?php echo $cat->cat_name ?></option>
			  	 <?php } ?>
		     	  </select>
	  			</div>
		 
	            
	        </div>
	        
	        
	        <div class="col-md-4" <?php echo $style ?>>
	        	<div class="form-group">
	                <label><?php translate('fs_image') ?></label>
	                <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
				  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
				  	<input type="file" id="file-0" name="fs_image3" class="margin-none" /></span>
				  	<span class="fileupload-preview"></span>
				  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
					</div>
	                
	                
	              
	            </div>
	            
	            <div class="form-group<?php echo form_error('tutor3') ? ' has-error' : '' ?>">
	                <label class="control-label" for="title"><?php echo form_error('tutor3') ? form_error('tutor3') : translate('tutor_name'); ?></label>
	                <input id="title" value="<?php echo set_value('tutor3') ? set_value('tutor3') : ""; ?>" type="text" class="form-control borderd" name="tutor3">
	            </div>
	            <div class="form-group" <?php echo form_error('cat_id3') ? 'has-error' : '' ?>">
 
	           <label for="inputTitle"><?php translate('cat_name') ?></label>

              	<select style="width: 100%;" style="text-align: right" id="select2_3" name="cat_id3">
   				<option></option>
		       <?php foreach ($cats->result() as $cat) { ?>
			 		  <option value="<?php echo $cat->cat_id ?>"> <?php echo $cat->cat_name ?></option>
			  	 <?php } ?>
		     	  </select>
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
 