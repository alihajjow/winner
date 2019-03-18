
<?php $this->load->view('common/header1') ?>		<link href="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />        <link href="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="<?php echo base_url() ?>assetss/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="<?php echo base_url() ?>assetss/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" /><div class="widget">	<div class="widget-head">			<div class="col-sm-12">                        <div class="card-box">		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>     	

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
					<td class="center"><?php translate('titl') ?></th>
					<td class="center"><?php translate('img') ?></th>
					<td class="center"><?php translate('edit_data') ?></th>
					<td class="center"><?php translate('fire') ?></th>
					<td class="center"><?php translate('active') ?></th>
					
				</tr>
			</thead>
			<tbody>								
              <?php $i = 1; foreach ($sliders->result() as $result) { ?>
				<tr>
					<td class="center uniformjs"><?php echo $i; ?></td>
					<td class="center"><?php echo $result->title_en; ?></td>
					<td class="center">
					<div class="btn-group btn-group-xs">
					<a href="<?php echo base_url()."../site/uploads/sliders/" . $result->img ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
					</div>
					</div>
					</div></td>			  
		            <td class="center"><a href="<?php echo base_url()."edit_slider/".$result->s_id;?>"><span class="label label-primary"><i class=" ti-pencil "></i></span></a></td>
					<td class="center"><div class="btn-group btn-group-xs"><a onclick="return confirm('are you sure?')" href="<?php echo base_url(). "del_slide/$result->s_id" ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></div></td>					<td><div class="checkbox>							<div class="checkbox checkbox-primary">                                        <input  type="checkbox" id="checkbox2"<?php echo $result->active == "1" ? 'checked': ''; ?>  onchange="activate(<?php echo $result->s_id; ?>)" >																	</div>			                          </div>					</td>
				 
		            </div>
		            </td>
					</tr>	
	 		 <?php $i++;   } ?>			
				</tbody>
			</table>
			<!-- // Table END -->
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<a href="<?php echo base_url(); ?>sliders" class="btn btn-primary"><?php translate('add') ?></a>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    		
			    	</div>
		   		 </div>
			</div>
		</div>
	</form>
</div>

<?php $this->load->view('common/footer1') ?>		<!-- Datatables-->        <script src="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.bootstrap.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.buttons.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/jszip.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/pdfmake.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/vfs_fonts.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/buttons.html5.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/buttons.print.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.fixedHeader.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.keyTable.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.responsive.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.js"></script>        <script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.scroller.min.js"></script>        <!-- Datatable init js -->        <script src="<?php echo base_url() ?>assetss/pages/datatables.init.js"></script>														<script type="text/javascript">            $(document).ready(function() {                $('#datatable').dataTable();                $('#datatable-keytable').DataTable( { keys: true } );                $('#datatable-responsive').DataTable();                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );            } );            TableManageButtons.init();        </script>
<script type="text/javascript">
	
	function activate (id) {
	    $.ajax({
	        url: '<?php echo base_url(); ?>active_slider/' + id,
	        
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
