
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

	<!-- Widget -->

<div class="widget">

	<form onsubmit="default" action="" method="post" role="form">

	<div class="widget-body overflow-x">

		<div class="row">

			<!-- Table -->

		    <table id="datatable" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
		
			<!-- Table heading -->
			<thead class="bg-gray">
				<tr>
					<td style="width: 1%;" class="center">#</th>
					<td class="center"><?php translate('course_lev') ?></td>
					<td class="center"><?php translate('student_list') ?></td>
					<td class="center"><?php translate('edit') ?></td>
					<td class="center"><?php translate('status') ?></td>
					
				</tr>
			</thead>
			<tbody>								
              <?php $i = 1; foreach ($results as $result) { ?>
				<tr>
					<td class="center uniformjs"><?php echo $i; ?></td>
					<td class="center"><?php echo $result->lev_name; ?></td>
			        <td class="center"><a href="<?php echo base_url() .'get_std_lev/'. $result->lev_id; ?>"> <span class="label label-primary"><i class="ti-pencil-alt"></i></a></td>  
			        <td class="center"><a href="<?php echo base_url() .'edit_level/'. $result->lev_id."/$course_id"; ?>"><span class="label label-primary"><i class=" ti-pencil "></span></a></td>  
			        <td>
						
                                        <input  type="checkbox" id="checkbox2" <?php echo $result->active == "1" ? 'checked': ''; ?>  onchange="activate_lev(<?php echo $result->lev_id; ?>)" >
										
									
		            </td>
				</tr>	
	 		 
				</tbody>
				<?php $i++;   } ?>			
			</table>
			<!-- // Table END -->
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<a href="<?php echo base_url() .'add_courses_levels/'. $c; ?>" class="btn btn-primary"><?php translate('add_course_lev') ?></a>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    		
			    	</div>
		   		 </div>
			</div>
		</div>
	</form>
</div>
<?php $this->load->view('common/footer1') ?>

		
		
		

		

		<script type="text/javascript">
            
        function activate_lev (id) {
        	// alert(id);
	    $.ajax({
	        url: '<?php echo base_url(); ?>activate_lev/' + id,
	        
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
