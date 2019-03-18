<?php 

$this->load->view('common/header1');

?>	<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">								  	<div class="panel-body">								  		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>
		<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."edit_tutor/$tutor->tutor_id" ?>">			<div class="innerLR" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
	            <div class="form-group <?php echo form_error('tutor1') ? 'has-error' : '' ?>">
	            	<label class="control-label" for="title"><?php echo form_error('tutor1') ? form_error('tutor1') : translate('tutor_name'); ?></label>
					<input id="title" name="tutor_name" value="<?php echo $tutor->tutor_name  ?>" type="text" class="form-control borderd" style="right">
	            </div>
	            
	           <div class="form-group"  <?php echo form_error('cat_id1') ? 'has-error' : '' ?>">
		  		<label for="inputTitle"><?php translate('catigory') ?></label>
              	<select style="width: 100%;" style="text-align: right" id="select2_1" name="cat_id" class="form-control borderd" style="right" >
   				<option> </option>
		       <?php foreach ($cats->result() as $cat) { ?>
			 		  <option selected="<?php echo $tutor->cat_id ?>" value="<?php echo $cat->cat_id ?>"> <?php echo $cat->cat_name ?> </option>
			  	 <?php } ?>
		     	  </select>
	  			</div>			</div>			</div>
		  	<div class="col-md-12">		        <input type="submit"   style="margin-left: 10px; margin-right: 10px" value="<?php echo $this->lang->line('edit'); ?>" class="btn btn-primary">		        <button type="button" class="btn btn-default" onclick="goBack()"><?php echo $this->lang->line('back') ?></button>								<br><br><br><br>		    </div>	
	           
	        
	        
			    
			    </div>
		    </div>
		    
		    
		</div>
		</form>
<?php $this->load->view('common/footer1'); ?>
 