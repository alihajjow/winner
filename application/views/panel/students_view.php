<?php $this->load->view('common/header1'); ?>
		<link href="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
     	
		<!-- Table -->
<div class="widget">
	<div class="widget-body overflow-x">
		<form method="get" action="<?php echo base_url()."students" ?>" style="margin-bottom: 10px; margin-top: 10px">
			<div class="widget">
	<div class="widget-head">
			<div class="col-sm-12">
                        <div class="card-box">
								<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>
		  <div class="row">
			<div class="col-md-10" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<select style="width: 100%;" id="select2_1" class="col-md-6 form-control" placeholder="قائمة الطلاب" name="stud_list">
	   				<option></option>
			    	<?php foreach ($studs as $row) { ?>
						<option value="<?php echo $row->f_name.'-'.$row->l_name ?>"> <?php echo $row->f_name.' '.$row->l_name; ?></option>
					<?php } ?>
			    </select>
			</div>
			<div class="col-md-2">
				<input type="submit" value="بحث" class="btn btn-primary" />
			</div>
		</form>
		<br><br><br>
		<?php if ($_GET): ?>
		
		<table id="datatable" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>

			<!-- Table heading -->
			<thead>
				<tr>
					<td style="width: 1%;" class="center">#</td>
					<td class="center"><?php translate('full_name') ?></td>
					<td class="center"><?php translate('mother_name') ?></td>
					<td class="center"><?php translate('username') ?></td>
					<td class="center"><?php translate('address') ?></td>
					<td class="center">الكورس</td>
					<td class="center">المستوى</td>
					<td class="center"><?php translate('status') ?></td>
					<?php if (have_access(44, TRUE)): ?>
						<th class="center"><?php translate('detials') ?></td>
					<?php endif ?>
					<?php if (have_access(41, TRUE)): ?>
						<th class="center"><?php translate('week_com') ?></td>
						<th class="center"><?php translate('week_studs') ?></td>
					<?php endif ?>
					<?php if (have_access(51, TRUE)): ?>
						<th class="center"><?php translate('students_tree') ?></td>
					<?php endif ?>
					<?php if (have_access(55, TRUE)): ?>
						<th class="center"><?php translate('suspend') ?></td>
					<?php endif ?>
					<?php if (have_access(57, TRUE)): ?>
						<th class="center"><?php translate('pend') ?></td>
					<?php endif ?>
				</tr>
			</thead>
			<tbody>								
		        <?php $i = 1; $results = $res->result(); for ($j=0; $j<count($results); $j++) {
		        	if (!have_access(54, TRUE) && $results[$j]->emp_id == 1) {
						$j++;
					}
		        	$result = $results[$j];
		        	?>
		        	
					<tr>
						<td class="center uniformjs"><?php echo $i ?></td>
						<td class="center"><?php echo $result->f_name.' '.$result->l_name ?></td>
						<td class="center"><?php echo $result->mother_name ?></td>
						<td class="center"><?php echo $result->username ?></td>
						<td class="center"><?php echo $result->address ?></td>
						<td class="center"><?php echo $result->c_name ?></td>
						<td class="center"><?php echo $result->lev_name ?></td>
						<td class="center">
							<input type="checkbox"  <?php echo $result->u_active ? 'checked' : ''; ?>  onchange="activate_st(<?php echo $result->lev_id .','. $result->emp_id; ?>)" >
	           	 		</td>
						<?php if (have_access(44, TRUE)): ?>
							<td class="center" style="width: 7%"><a href="<?php echo base_url()."user_details/$result->emp_id" ?>"><i class="ti-more-alt "></i></td>
						<?php endif ?>
						<?php if (have_access(41, TRUE)): ?>
							<td class="center" style="width: 7%"><a href="<?php echo base_url()."week_comms/$result->emp_id" ?>"><span class="label label-primary"><i class="ti-receipt"></i></span></a></td>
							<td class="center" style="width: 7%"><a href="<?php echo base_url()."week_studs/$result->emp_id" ?>"><span class="label label-primary"><i class="ti-receipt"></i></span></a></td>
						<?php endif ?>
						<?php if (have_access(51, TRUE)): ?>
							<td class="center" style="width: 7%"><a href="<?php echo base_url()."sons/$result->username" ?>"><i class="zmdi zmdi-nature"></i></a></td>
						<?php endif ?>
						<?php if (have_access(55, TRUE)): ?>
							<td class="center">
					   			<input type="checkbox"  <?php echo $result->passchange == "1" ? 'checked': ''; ?>  onchange="pend(<?php echo $result->emp_id; ?>)" > 
				       		</td>
				    	<?php endif ?> 
				        <?php if (have_access(57, TRUE)): ?>
							<td class="center" style="width: 7%">
								<a id="stop<?php echo $result->emp_id ?>" style="color: <?php echo $result->role_id == 3 ? 'green' : 'red' ?> " onclick="stop_student(<?php echo $result->emp_id.', '. ($result->id ? 1 : 0) ?>)">
									<i class="ti-power-off "></i>
								</a>
							</td>
						<?php endif ?>
				    </tr>	
		 		<?php $i++;   } ?>			
			</tbody>
		</table>
		<?php endif ?>
	</div>

</div>

<?php $this->load->view('common/footer1'); ?>
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

