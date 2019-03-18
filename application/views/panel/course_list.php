
<?php $this->load->view('common/header1') ?>
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

		<table class="dynamicTable fixedHeaderColReorder table"  <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
		
			<!-- Table heading -->
			<thead class="bg-gray">
				<tr>
					<td style="width: 1%;" class="center">#</th>
					<td class="center"><?php translate('course_name') ?></td>
					<td class="center"><?php translate('cs') ?></td>
					<td class="center"><?php translate('edit') ?></td>
					<td class="center"><?php translate('status') ?></td>
					
				</tr>
			</thead>
			<tbody>								
              <?php $i = 1; foreach ($results as $result) { ?>
				<tr>
					<td class="center uniformjs"><?php echo $i; ?></td> 
					<td class="center"><?php echo $result->c_name; ?></td>
			        <td class="center"><a href="<?php echo base_url() .'courses_levels/' . $result->c_id ?>"> <span class="label label-primary"> <i class="ti-pencil-alt"></i></span></a></td>  
			        <td class="center"><a href="<?php echo base_url() .'courses_levels/' . $result->c_id ?>"> <span class="label label-primary"> <i class=" ti-pencil ">  </i></span></a></td>  
			        <td>
                                        <input type="checkbox" id="checkbox2" <?php echo $result->active == "1" ? 'checked': ''; ?>  onchange="activate_co(<?php echo $result->c_id; ?>)" >
										
		            </td>
				</tr>	
	 		 		<?php $i++;   } ?>	
				</tbody>
				
		</table>
		
			<!-- // Table END -->
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<a href="<?php echo base_url() .'add_course/' . $cat ?>" class="btn btn-primary"><?php translate('new_course') ?></a>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    		
			    	</div>
		   		 </div>
			</div>
		</div>
	</form>
</div>
<?php $this->load->view('common/footer1') ?>
<script type="text/javascript">
	
	function activate_co (id) {
	    $.ajax({
	        url: '<?php echo base_url(); ?>activate_co/' + id,
	        
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
