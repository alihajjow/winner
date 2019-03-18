
<?php $this->load->view('common/header1') ?>
<link href="<?php echo base_url() ?>assetss/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>assetss/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>assetss/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<form onsubmit="default" action="<?php echo base_url()."trans_comm_op" ?>" method="post" role="form">
<div class="widget">
	<div class="widget">
	<div class="widget-head">
                        	<div class="col-sm-12">
                        		<div class="card-box">
                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>

                        			<div class="row">			
			<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group" style="margin-bottom: 0">
					<label for="inputTitle"><?php translate('to_user') ?></label>
							<select id="select2_1" class="form-control" name="to_user">
		               <?php foreach ($users as $user) { ?>
						   <option value="<?php echo $user->emp_id ?>"> <?php echo $user->f_name.' '.$user->l_name ?></option>
					   <?php } ?>
							</select>
				    </div>
					<div class="separator"></div>
				</div>
			
			
				<div class="form-group<?php echo form_error('from_date') ? 'has-error' : ''; ?>" style="text-align: right " >
					<label for="inputTitle"><?php translate('from_date') ?></label>
					<div class="input-group date" id="datepicker3">
					    <input class="form-control" type="text" id="datepicker" name="from_date" value="<?php echo set_value('from_date') ?>">
					    <span class="input-group-addon"><i class="fa fa-th"></i></span>
					</div>
				
				<div class="separator"></div>
				</div>
				
				
				<div class="form-group <?php echo form_error('to_date') ? 'has-error' : ''; ?>" style="float: left; text-align: right; width: 519px">
					<label for="inputTitle"><?php translate('to_date') ?></label>
					<div class="input-group date" id="datepicker2">
					    <input class="form-control" type="text" id="datepicker1" name="to_date" value="<?php echo set_value('to_date') ?>">
					    <span class="input-group-addon"><i class="fa fa-th"></i></span>
					</div>
					<div class="separator"></div>
				</div>
				
			
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary"><?php translate('show') ?></button>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    </div>
		    </div>
		
                        			</div><!-- end row -->
									</div>
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
 <script type="text/javascript">
 jQuery(document).ready(function() {


          		// Date Picker
            jQuery('#datepicker1').datepicker();
            jQuery('#datepicker-autoclose1').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            jQuery('#datepicker-inline1').datepicker();
            jQuery('#datepicker-multiple-date1').datepicker({
                format: "mm/dd/yyyy",
                clearBtn: true,
                multidate: true,
                multidateSeparator: ","
            });
            jQuery('#date-range1').datepicker({
                toggleActive: true
            });
			});

</script>

