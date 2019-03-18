
<?php $this->load->view('common/header1') ?>

<link href="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="widget">
	<div class="widget-head">
			<div class="col-sm-12">
                        <div class="card-box">
		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>     	

		<!-- Table -->
<div class="widget">
				<div class="widget-body overflow-x">
		<table id="datatable" class="table table-striped table-bordered"  <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
			
				<!-- Table heading -->
				<thead class="bg-gray">
					<tr>
						<td  class="center">#</td>
						<td text-align=><?php translate('std_name') ?></td>
						<td ><?php translate('mobile') ?></td>						
						<td  ><?php translate('status') ?></td>
						<td ><?php translate('suspend') ?></td>	
						<?php if (have_access(57, TRUE)): ?>
							<td ><?php translate('pend') ?> ماليا</td>
						<?php endif ?>
						<?php if (have_access(57, TRUE)): ?>
							<td ><?php translate('pend') ?></td>
						<?php endif ?>
						<?php if (have_access(60, TRUE)): ?>
							<td >تحديد للاستيراد</td>
						<?php endif ?>
						<?php if (have_access(61, TRUE)): ?>
							<td >تحديد لارسال رسالة
								<input type="checkbox" onchange="check_all()" > 
							</td>
						<?php endif ?>
					</tr>
				</thead>
				<tbody>								
	              <?php $i = 1; foreach ($results as $result) { ?>
	              	
					<tr>
						<td ><?php echo $i; ?></td>
						<td ><a target="_blank" href="<?php echo base_url()."user_details/$result->emp_id" ?>"><?php echo $result->f_name . "  " . $result->l_name; ?></a></td>
						<td ><?php echo $result->mobile; ?></td>
	
				        <td class="center">
							
	      							<input type="checkbox"  <?php echo $result->u_active ? 'checked' : ''; ?>  onchange="activate_st(<?php echo $lev_id .','. $result->emp_id; ?>)" >
			           	 </td>
				           <td class="center">
						                
	     						   <input type="checkbox"  <?php echo $result->passchange == "1" ? 'checked': ''; ?>  onchange="pend(<?php echo $result->emp_id; ?>)" > 
						                
					            </td>
				            </div>
				           	
			            </td>
			            <?php if (have_access(57, TRUE)): ?>
							<td class="center">
								<a id="stop<?php echo $result->emp_id ?>" style="color: <?php echo $result->role_id == 3 ? 'green' : 'red' ?> " onclick="stop_student(<?php echo $result->emp_id.', '. ($result->id ? 1 : 0) ?>)">
									<i class="ti-power-off "></i>
								</a>
							</td>
						<?php endif ?>
						<?php if (have_access(57, TRUE)): ?>
							<td class="center">
								<a id="stopa<?php echo $result->emp_id ?>" style="color: <?php echo $result->role_id ? 'green' : 'red' ?> " onclick="stop_agency(<?php echo $result->emp_id.', '. ($result->id ? 1 : 0) ?>)">
									<i class="ti-power-off "></i>
								</a>
							</td>
						<?php endif ?>
						<?php if (have_access(60, TRUE)): ?>
							<td class="center">
								<input type="checkbox" value="<?php echo $result->emp_id ?>" name="export[]" />
							</td>
						<?php endif ?>
						<?php if (have_access(61, TRUE)): ?>
							<td class="center">
								<input type="checkbox" class="moobile" value="<?php echo '963'.((int)$result->mobile) ?>" name="to[]" />
							</td>
						<?php endif ?>
					</tr>	
		 			  <?php $i++;   } ?>	
					</tbody>
					 
				</table>
			
				<!-- // Table END -->
				
					<div class="form-group" <?php echo LANG() == 'en' ? 'amount' : 'style="text-align: right"' ?>>
			    		<label for="exampleInputPassword1"><?php translate('message') ?></label>
			    		<textarea class="form-control" name="msg" rows="10" placeholder="<?php translate('message') ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>></textarea>
			  		</div>
					<div class="form-group" style="margin-top: 20px">
						<?php if (have_access(61, TRUE)): ?>
							<input type="submit" class="btn btn-primary" value="إرسال رسالة">
						<?php endif ?>
						
						<?php if (have_access(62, TRUE)): ?>
							<a onclick="return confirm('هل أنت متأكد من اتمام هذه العملية؟')" href="<?php echo base_url().'pend_all_level/'.$lev_id ?>" class="btn btn-primary">تبنيد جميع الطلاب</a> 
						<?php endif ?>
				    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    		
			    
		   		 </div>
			</div>
		</div>
	</form>
</div>
<?php $this->load->view('common/footer1') ?>
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
		
		<script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>

<script type="text/javascript">
	function check_all () {
	  $('.moobile' ).prop( 'checked', true );
	}
	
	function stop_student (id, color) {
		  $.ajax({
	        url: '<?php echo base_url(); ?>stop_student/' + id + '/' + color,
	        
	        success: function(data) {
	        	if (data == 1) {
	        		if (document.getElementById("stop" + id).style.color == "green") {
	        			document.getElementById("stop" + id).style.color = "red";
	        		} else{
	        			document.getElementById("stop" + id).style.color = "green";
	        		};
	        		
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": true,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["success"]('<b><?php echo trans('success'); ?>: </b><?php echo trans('success_desc'); ?>');
	        	} else{
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": false,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["error"]('<b><?php echo trans('error'); ?>: <?php echo trans('error_desc'); ?></b>');
	        	};
	            
	        }
		});
	}
	
	function stop_agency (id, color) {
		  $.ajax({
	        url: '<?php echo base_url(); ?>stop_agency/' + id + '/' + color,
	        
	        success: function(data) {
	        	if (data == 1) {
	        		if (document.getElementById("stopa" + id).style.color == "green") {
	        			document.getElementById("stopa" + id).style.color = "red";
	        		} else{
	        			document.getElementById("stopa" + id).style.color = "green";
	        		};
	        		
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": true,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["success"]('<b><?php echo trans('success'); ?>: </b><?php echo trans('success_desc'); ?>');
	        	} else{
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": false,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["error"]('<b><?php echo trans('error'); ?>: <?php echo trans('error_desc'); ?></b>');
	        	};
	            
	        }
		});
		}
		
	function activate_st (lev_id, emp_id) {
		
	    $.ajax({
	        url: '<?php echo base_url(); ?>activate_st/' + lev_id + '/' + emp_id,
	        
	        success: function(data) {
	        	if (data == 1) {
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": true,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["success"]('<b><?php echo trans('success'); ?>: </b><?php echo trans('success_desc'); ?>');
	        	} else{
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": false,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["error"]('<b><?php echo trans('error'); ?>: <?php echo trans('error_desc'); ?></b>');
	        	};
	            
	        }
		});
			}
			function pend (emp_id) {
		//alert(emp_id);
	    $.ajax({
	        url: '<?php echo base_url(); ?>activate_role/' + emp_id ,
	        
	        success: function(data) {
	        	if (data == 1) {
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": true,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["success"]('<b><?php echo trans('success'); ?>: </b><?php echo trans('success_desc'); ?>');
	        	} else{
	        		toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": false,
						"positionClass": "toast-bottom-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "1000",
						"hideDuration": "1000",
						"timeOut": "10000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
					 	"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr["error"]('<b><?php echo trans('error'); ?>: <?php echo trans('error_desc'); ?></b>');
	        	};
	            
	        }
		});
    }
	
	
</script>
