<?php $this->load->view('common/header') ?>

<form onsubmit="default" action="<?php echo base_url()."edit_desc/$role_id"; ?>" method="post" role="form">
<div class="widget">
	<div class="widget-head">
		<h4 class="heading" <?php echo LANG() == 'en' ? '' : 'style="float: right"' ?>><?php echo $title; ?></h4>
	</div>
	<div class="widget-body">
		<div class="row" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>	
			<div class="form-group <?php echo form_error('role_name') ? 'has-error' : ''; ?>">
				<label for="inputTitle"><?php echo form_error('role_name') ? form_error('role_name') : translate('role_name') ?></label>
				<input name="role_name" value="<?php echo set_value('role_name') ? set_value('role_name') : $role->role_name; ?>" type="text" id="inputTitle" class="col-md-6 form-control" placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
				<div class="separator"></div>
			</div>
			
			<div class="form-group <?php echo form_error('role_desc') ? 'has-error' : ''; ?>">
				<label for="inputTitle"><?php echo form_error('role_desc') ? form_error('role_desc') : translate('role_desc') ?></label>
				<input name="role_desc" value="<?php echo set_value('role_desc') ? set_value('role_desc') : $role->role_desc; ?>" type="text" id="inputTitle" class="col-md-6 form-control" placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
				<div class="separator"></div>
			</div>
			
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

<?php $this->load->view('common/footer') ?>