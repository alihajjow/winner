
<?php $this->load->view('common/header1') ?>
<form onsubmit="default" action="<?php echo base_url()."edit_social" ?>" method="post" role="form"><div class="widget">	<div class="widget-head">                        	<div class="col-sm-12">                        		<div class="card-box">                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>                        			<div class="row">
			<?php foreach ($serv as $result) { ?>
			

			<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group <?php echo form_error('facebook') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('facebook') ? form_error('facebook') : translate('facebook') ?></label>
					<input name="facebook" value="<?php echo $result->facebook; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"><br><br></div>
				</div>
			
				<div class="form-group  <?php echo form_error('google') ? 'has-error' : ''; ?>">
					<label for="inputTitle1"><?php echo form_error('google') ? form_error('google') : translate('google') ?></label>
					<input name="google" value="<?php echo $result->google; ?>" type="text" id="inputTitle2" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"><br><br></div>
				</div>
				
				<div class="form-group <?php echo form_error('linkedin') ? 'has-error' : ''; ?>">
					<label for="inputTitle3"><?php echo form_error('linkedin') ? form_error('linkedin') : translate('linkedin') ?></label>
					<input name="linkedin" value="<?php echo $result->linkedin; ?>" type="text" id="inputTitle3" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"><br><br></div>
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

