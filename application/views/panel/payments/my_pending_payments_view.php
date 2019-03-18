<?php $this->load->view('common/header1'); ?>
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
		<table id="datatable" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
		
			<!-- Table heading -->
			<thead class="bg-gray">
				<tr>
					<th style="width: 1%;" class="center">#</th>
					<th class="center"><?php translate('full_name') ?></th>
					<th class="center"><?php translate('to_emp') ?></th>
					<th class="center"><?php translate('amount') ?></th>
					<th class="center"><?php translate('date') ?></th>
					<th class="center"><?php translate('cancel') ?></th>
				</tr>
			</thead>
			<tbody>								
		        <?php $i = 1; foreach ($results->result() as $result) { ?>
					<tr>
						<td class="center uniformjs"><?php echo $i ?></td>
						<td class="center"><?php echo $result->f_name.' '.$result->l_name ?></td>
						<td class="center"><?php echo $result->to_emp ?></td>
						<td class="center"><?php echo $result->amount ?></td>
						<td class="center"><?php echo date('Y-m-d H:i', $result->date) ?></td>
				        <td class="center"><a href="<?php echo base_url()."cancel_pay/$result->id" ?>" onclick="return confirm('Are you sure')"><i class="fa fa-fw icon-thumbs-down"></i></td> 
					</tr>	
		 		<?php $i++;   } ?>			
			</tbody>
		</table>
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
