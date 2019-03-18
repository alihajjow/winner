
<?php $this->load->view('common/header1') ?>
<form onsubmit="default" action="<?php echo base_url()."edit_services" ?>" method="post" role="form">
<div class="widget">	<div class="widget-head">                        	<div class="col-sm-12">                        		<div class="card-box">                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>										<div class="row">
			<?php foreach ($serv as $result) { ?>
			<div class="col-md-4" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group <?php echo form_error('first_service') ? 'has-error' : ''; ?>">
					<label for="inputTitle"><?php echo form_error('first_service') ? form_error('first_service') : translate('first_service') ?></label>
					<input name="first_service" value="<?php echo $result->fe_serv; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div><br><br>
				</div>
			
				<div class="form-group  <?php echo form_error('first_service_text') ? 'has-error' : ''; ?>">
					<label for="inputTitle1"><?php echo form_error('first_service_text') ? form_error('first_service_text') : translate('first_service_text') ?></label>                    <textarea class="form-control" name="first_service_text" style="height: 100px" placeholder="<?php translate('first_service_text') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>		    		<?php echo set_value('first_service_text') ? set_value('first_service_text') : $result->fe_serv_text; ?>		    		</textarea>

					<div class="separator"></div><br><br>
				</div>
			</div>
			<div class="col-md-4" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group <?php echo form_error('sec_service') ? 'has-error' : ''; ?>">
					<label for="inputTitle3"><?php echo form_error('sec_service') ? form_error('sec_service') : translate('sec_service') ?></label>
					<input name="sec_service" value="<?php echo $result->sec_serv; ?>" type="text" id="inputTitle3" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div><br><br>
				</div>

				<div class="form-group <?php echo form_error('sec_service_text') ? 'has-error' : ''; ?>">
			    <label for="inputTitle4"><?php echo form_error('sec_service_text') ? form_error('sec_service_text') : translate('sec_service_text') ?></label>				<textarea class="form-control" name="sec_service_text" style="height: 100px" placeholder="<?php translate('sec_service_text') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>	    		<?php echo set_value('sec_service_text') ? set_value('sec_service_text') : $result->sec_serv_text ?>	    		</textarea>

						<div class="separator"></div><br><br>
				</div>
			</div>
			<div class="col-md-4" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group <?php echo form_error('thr_service') ? 'has-error' : ''; ?>">
					<label for="inputTitle5"><?php echo form_error('thr_service') ? form_error('thr_service') : translate('thr_service') ?></label>
					<input name="thr_service"  value="<?php echo $result->thr_serv; ?>" type="text" id="inputTitle5" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
					<div class="separator"></div><br><br>
				</div>
				
				<div class="form-group <?php echo form_error('thr_service_text') ? 'has-error' : ''; ?>">
				<label for="inputTitle6"><?php echo form_error('thr_service_text') ? form_error('thr_service_text') : translate('thr_service_text') ?></label>                <textarea class="form-control" name="thr_service_text" style="height: 100px" placeholder="<?php translate('thr_service_text') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>	    		<?php echo set_value('thr_service_text') ? set_value('thr_service_text') : $result->thr_serv_text ?>	    		</textarea>

					<div class="separator"></div><br><br>
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

