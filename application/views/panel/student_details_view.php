<?php $this->load->view('common/header1'); ?>
     	<link href="<?php echo base_url() ?>assetss/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>assetss/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>assetss/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		
	<!-- table -->
		<link href="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		
		<form method="post" action="<?php echo base_url()."edit_student/$user->emp_id" ?>">
				<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>
			<div class="widget">
				<div class="widget-head">
						<div class="col-sm-12">
									<div class="card-box">
					

				<div class="row">

			<div class="col-lg-3" <?php echo LANG() == 'en' ? '' : 'style="float: right"' ?>>
				<div class="widget widget-heading-simple widget-body-black">
					<div class="widget-body innerAll inner-2x" <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?> >
						<div class="form-group <?php echo form_error('first_name') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('first_name') ? form_error('first_name') : translate('first_name') ?></label>
							<input name="first_name" value="<?php echo $user->f_name; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
					
						<div class="form-group  <?php echo form_error('last_name') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('last_name') ? form_error('last_name') : translate('last_name') ?></label>
							<input name="last_name" value="<?php echo $user->l_name; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
						<div class="form-group <?php echo form_error('father_name') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('father_name') ? form_error('father_name') : translate('father_name') ?></label>
							<input name="father_name" value="<?php echo $user->father_name; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
						<div class="form-group <?php echo form_error('mother_name') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('mother_name') ? form_error('mother_name') : translate('mother_name') ?></label>
							<input name="mother_name" value="<?php echo $user->mother_name; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-lg-3" <?php echo LANG() == 'en' ? '' : 'style="float: right"' ?>>
				<div class="widget widget-heading-simple widget-body-white">
					<div class="widget-body innerAll inner-2x" <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?> >
						<div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('password') ? form_error('password') : translate('password') ?></label>
							<input name="password" value="" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						<div class="form-group <?php echo form_error('pay_pass') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('pay_pass') ? form_error('pay_pass') : translate('pay_pass') ?></label>
							<input name="pay_pass" value="" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						<div class="form-group <?php echo form_error('gov_id') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('gov_id') ? form_error('gov_id') : translate('gov_id') ?></label>
							  <input name="gov_id" value="<?php echo $user->gov_id; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						<div class="form-group <?php echo form_error('birth_place') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('birth_place') ? form_error('birth_place') : translate('birth_place') ?></label>
							<input name="birth_place" value="<?php echo $user->birth_place; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-lg-3" <?php echo LANG() == 'en' ? '' : 'style="float: right"' ?>>
				<div class="widget widget-heading-simple widget-body-white">
					<div class="widget-body innerAll inner-2x" <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?> >
						<div class="form-group <?php echo form_error('birth_date') ? 'has-error' : ''; ?>" style="margin-bottom: 0">
							<label for="inputTitle"><?php echo form_error('birth_date') ? form_error('birth_date') : translate('birth_date') ?></label>
							<div class="input-group date" id="datepicker3">
							    <input class="form-control" type="text" id="datepicker" name="birth_date"  value="<?php echo date('Y-m-d', $user->birth_date); ?>"  >
							    <span class="input-group-addon"><i class="fa fa-th"></i></span>
							</div>
						</div>					
						<div class="form-group <?php echo form_error('civil_reg') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('civil_reg') ? form_error('civil_reg') : translate('civil_reg') ?></label>
							<input name="civil_reg" value="<?php echo $user->civil_reg; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						<div class="form-group <?php echo form_error('amaneh') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('amaneh') ? form_error('amaneh') : translate('amaneh') ?></label>
							<input name="amaneh" value="<?php echo $user->amaneh; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
						<div class="form-group <?php echo form_error('address') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('address') ? form_error('address') : translate('address') ?></label>
							<input name="address" value="<?php echo $user->address; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
						
					</div>
				</div>
			</div>
			<div class="col-lg-3" <?php echo LANG() == 'en' ? '' : 'style="float: right"' ?>>
				<div class="widget widget-heading-simple widget-body-white">
					<div class="widget-body innerAll inner-2x" <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?> >
						<div class="form-group <?php echo form_error('mobile') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('mobile') ? form_error('mobile') : translate('mobile') ?></label>
							<input name="mobile" value="<?php echo $user->mobile; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						
						<div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('email') ? form_error('email') : translate('email') ?></label>
							<input name="email" value="<?php echo $user->email; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						<div class="form-group <?php echo form_error('inheritor') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('inheritor') ? form_error('inheritor') : translate('inheritor') ?></label>
							<input name="inheritor" value="<?php echo $user->inheritor; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
						<div class="form-group <?php echo form_error('balance') ? 'has-error' : ''; ?>">
							<label for="inputTitle"><?php echo form_error('balance') ? form_error('balance') : translate('balance') ?></label>
							<input name="balance" <?php echo have_access(49, TRUE) ? '' : 'disabled' ?> value="<?php echo have_access(49, TRUE) ? $user->balance : ''; ?>" type="text" id="inputTitle" class="col-md-6 form-control"  placeholder="" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
							<div class="separator"></div>
						</div>
					</div>
				</div>
			</div>
		
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary"><?php translate('edit') ?></button>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    </div>
		    </div>
	    </form>
	</div>
</div></div></div>
<?php if (have_access(50, TRUE)) { ?>
	<form onsubmit="default" action="<?php echo base_url()."user_details/$user->emp_id" ?>" method="post" role="form">
		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo trans('date_filter'); ?></h4>
			<div class="widget">
				<div class="widget-head">
						<div class="col-sm-12">
									<div class="card-box">
			<div class="row">	
				<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
					
					<div class="form-group <?php echo form_error('from_date') ? 'has-error' : ''; ?>" style="margin-bottom: 0">
						<label for="inputTitle"><?php translate('from_date') ?></label>
						<div class="input-group date" id="datepicker1">
						    <input class="form-control" type="text" id="datepicker2" name="from_date" value="<?php echo set_value('from_date') ?>">
						    <span class="input-group-addon"><i class="fa fa-th"></i></span>
						</div>
					</div>
					
				</div>
				<div class="col-md-6" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
					
					<div class="form-group <?php echo form_error('to_date') ? 'has-error' : ''; ?>" style="margin-bottom: 0">
						<label for="inputTitle"><?php translate('to_date') ?></label>
						<div class="input-group date" id="datepicker2">
						    <input class="form-control" type="text" id="datepicker4" name="to_date" value="<?php echo set_value('to_date') ?>">
						    <span class="input-group-addon"><i class="fa fa-th"></i></span>
						</div>
					</div>
					
				</div>
				<div class="col-md-12">
					<div class="form-group" style="margin-top: 20px">
						<button type="submit" class="btn btn-primary"><?php translate('show') ?></button>
				    	<button class="btn btn-default"><?php translate('cancel') ?></button>
				    </div>
			    </div>
			  
			</div>
			
		</div>
	 </div></div></div>
	</form>
	
	<div class="widget">
				<div class="widget-head">
						<div class="col-sm-12">
									<div class="card-box">
			<div class="row">
		
			<!-- Tabs Heading -->
			<form id="commentForm" method="get" action="" class="form-horizontal">
				<div id="btnwizard" class="pull-in">
				<ul>
					<li class=""><a class="" href="#tab-1" data-toggle="tab"><i></i><?php echo trans('payments') ?></a></li>
					<li class=""><a class="" href="#tab-2" data-toggle="tab"><i></i><?php echo trans('sessions') ?></a></li>
					<li class=""><a class="" href="#tab-3" data-toggle="tab"><i></i><?php echo trans('courses') ?></a></li>
					<li class="active"><a class="" href="#tab-4" data-toggle="tab"><i></i><?php echo trans('notifications') ?></a></li>
				</ul>
			
			<!-- // Tabs Heading END -->
			
			<div class="widget-body">
				<div class="tab-content">
				
					<!-- Tab content -->
					<div class="tab-pane" id="tab-1">
						<table id="datatable" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
			
							<!-- Table heading -->
							<thead class="bg-gray">
								<tr>
									<th class="center">#</th>
									<th class="center"><?php translate('full_name') ?></th>
									<th class="center"><?php translate('to_emp') ?></th>
									<th class="center"><?php translate('credit') ?></th>
									<th class="center"><?php translate('debit') ?></th>
									<th class="center"><?php translate('date') ?></th>
								</tr>
							</thead>
							<tbody>								
					            <?php $i = 1; foreach ($payments as $result) { ?>
									<tr>
										<td class="center"><?php echo $i ?></td>
										<td class="center"><?php echo $result->full_name ?></td>
										<td class="center"><?php echo $result->username ?></td>
										<td class="center"><?php echo $result->credit ?></td>
										<td class="center"><?php echo $result->debit ?></td>
										<td class="center" dir="ltr"><?php echo date('Y-m-d H:i', $result->payment_date) ?></td>
								          
									</tr>	
						 		<?php $i++;   } ?>			
							</tbody>
						</table>
					</div>
					<!-- // Tab content END -->
					
					<!-- Tab content -->
					<div class="tab-pane" id="tab-2">
						<table id="datatable1" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
			
							<!-- Table heading -->
							<thead class="bg-gray">
								<tr>
	                                <th class="center"><?php echo $this->lang->line('ip_address') ?></th>
	                                <th class="center"><?php echo $this->lang->line('device') ?></th>
	                                <th class="center"><?php echo $this->lang->line('os') ?></th>
	                                <th class="center"><?php echo $this->lang->line('browser') ?></th>
	            					<th class="center"><?php echo $this->lang->line('date') ?></th>
								</tr>
							</thead>
							<tbody>								
					            <?php $i = 1; foreach ($sessions as $result) { ?>
									<tr>
			                            <td class="center"><?php echo $result->ip_address; ?></td>
			                            <td class="center"><?php echo $result->device; ?></td>
			                            <td class="center"><?php echo $result->os; ?></td>
			                            <td class="center"><?php echo $result->browser; ?></td>
			                            <td class="center" dir="ltr"><?php echo date('Y-m-d H:i', $result->start_time); ?></td>
								          
									</tr>	
						 		<?php  } ?>			
							</tbody>
						</table>
					</div>
					<!-- // Tab content END -->
					<div class="tab-pane" id="tab-3">
						<table id="datatable2" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
			
							<!-- Table heading -->
							<thead class="bg-gray">
								<tr>
									<th class="center">#</th>
									<th class="center"><?php translate('course_name') ?></th>
									<th class="center"><?php translate('level') ?></th>
									<th class="center"><?php translate('activity') ?></th>
									<th class="center"><?php translate('reg_date') ?></th>
									<th class="center"><?php translate('edit') ?></th>
								</tr>
							</thead>
							<tbody>								
					            <?php $i = 1; foreach ($courses as $result) { ?>
									<tr>
										<td class="center uniformjs"><?php echo $i ?></td>
										<td class="center"><?php echo $result->c_name ?></td>
										<td class="center"><?php echo $result->lev_name ?></td>
										<td class="center"><?php echo $result->u_active ?></td>
										<td class="center" dir="ltr"><?php echo date('Y-m-d H:i', $result->reg_date) ?></td>
								        <td class="center" style="width: 7%"><a href="<?php echo base_url()."user_course/$result->id" ?>"><span class="label label-primary"><i class="ti-pencil"></i></span></a></td>
									</tr>	
						 		<?php $i++;   } ?>			
							</tbody>
						</table>
					</div>
					<div class="tab-pane active" id="tab-4">
						<table id="datatable3" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
			
							<!-- Table heading -->
							<thead class="bg-gray">
								<tr>
									<th class="center">#</th>
									<th class="center"><?php translate('op_name') ?></th>
									<th class="center"><?php translate('n_text') ?></th>
									<th class="center"><?php translate('date') ?></th>
									<th class="center"><?php translate('read_date') ?></th>
								</tr>
							</thead>
							<tbody>								
					            <?php $i = 1; foreach ($notifications as $result) { ?>
									<tr>
										<td class="center uniformjs"><?php echo $i ?></td>
										<td class="center"><?php echo $result->op_name ?></td>
										<td class="center"><?php echo $result->n_text ?></td>
										<td class="center" dir="ltr"><?php echo date('Y-m-d H:i', $result->date) ?></td>
										<td class="center" dir="ltr"><?php echo date('Y-m-d H:i', $result->read_time) ?></td>
								          
									</tr>	
						 		<?php $i++;   } ?>			
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
<?php } ?>

<?php $this->load->view('common/footer1'); ?>
	<script src="<?php echo base_url() ?>assetss/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo base_url() ?>assetss/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?php echo base_url() ?>assetss/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	
	

	<!-- Datatables-->
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?php echo base_url() ?>assetss/pages/datatables.init.js"></script>
		
		<!-- Form wizard -->
        <script src="<?php echo base_url() ?>assetss/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		
		        <script type="text/javascript">
            $(document).ready(function() {
                $('#basicwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted'});

                $('#progressbarwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                    $('#progressbarwizard').find('.bar').css({width:$percent+'%'});
                },
                'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted'});

                $('#btnwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted','nextSelector': '.button-next', 'previousSelector': '.button-previous', 'firstSelector': '.button-first', 'lastSelector': '.button-last'});

                var $validator = $("#commentForm").validate({
                    rules: {
                        emailfield: {
                            required: true,
                            email: true,
                            minlength: 3
                        },
                        namefield: {
                            required: true,
                            minlength: 3
                        },
                        urlfield: {
                            required: true,
                            minlength: 3,
                            url: true
                        }
                    }
                });

                $('#rootwizard').bootstrapWizard({
                    'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted',
                    'onNext': function (tab, navigation, index) {
                        var $valid = $("#commentForm").valid();
                        if (!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    }
                });
            });

        </script>




		<script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
				
				
                $('#datatable1').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
			
			
            TableManageButtons.init();
			

        </script>
		
		<script type="text/javascript">
            $(document).ready(function() {
                $('#datatable2').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
				
				
                $('#datatable3').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
			
			
            TableManageButtons.init();
			

        </script>

	
	
	
	
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
			// Date Picker2
            jQuery('#datepicker2').datepicker();
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
			// Date Picker4
            jQuery('#datepicker4').datepicker();
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
	<!-- Form wizard -->
        <script src="<?php echo base_url() ?>assetss/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
