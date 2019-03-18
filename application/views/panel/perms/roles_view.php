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
					<thead class="bg-gray">
						<tr>
							<td style="width: 1%;" class="">#</td>
							<td class="center"><?php translate('role_name') ?></td>
							<td class="center"><?php translate('role_desc') ?></td>
							<?php if (have_access('33', TRUE)) { ?>
								<td class="center"><?php translate('role_perms') ?></td>
							<?php } ?>
							<?php if (have_access('34', TRUE)) { ?>
								<td class="center"><?php translate('role_users') ?></td>
							<?php } ?>
							<?php if (have_access('35', TRUE)) { ?>
								<td class="center"><?php translate('edit_info') ?></td>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
	            	<?php $i = 1; foreach ($results as $result) { ?>
						<tr>
							<td class="center uniformjs"><?php echo $i; ?></td>
							<td class="center"><?php echo $result->role_name; ?></td>
							<td class="center"><?php echo $result->role_desc; ?></td>
							<?php if (have_access('33', TRUE)) { ?>
								<td class="center">
						            <a href="<?php echo base_url()."edit_pers/$result->role_id"; ?>">
						            	<span class="label label-primary"><i class="ti-pencil"></i></span>
						            </a>
						        </td>
							<?php } ?>
							<?php if (have_access('34', TRUE)) { ?>
								<td class="center">
						            <a href="<?php echo base_url()."edit_emps/$result->role_id"; ?>">
						            	<span class="label label-primary"><i class="ti-pencil"></i></span>
						            </a>
						        </td>
							<?php } ?>
							<?php if (have_access('35', TRUE)) { ?>
								<td class="center">
						            <a href="<?php echo base_url()."edit_desc/$result->role_id"; ?>">
						            	<span class="label label-primary"><i class="ti-pencil"></i></span>
						            </a>
						        </td>
							<?php } ?>
						</tr>
					
											
		 			<?php $i++;   } ?>			
				</tbody>
			</table>
			<!-- // Table END -->
			<?php if (have_access(36, TRUE)) { ?>
				<div class="col-md-12">
					<div class="form-group" style="margin-top: 20px">
						<button onclick="location.href = '<?php echo base_url()."add_role" ?>';" class="btn btn-primary"><?php translate('add') ?></button>
				    	<button class="btn btn-default"><?php translate('cancel') ?></button>
				    </div>
			    </div>
			<?php } ?>
			
		</div>
	</div>
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
