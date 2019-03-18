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
			<thead >
				<tr>
					<td style="width: 1%;" >#</th>
					<td> <?php translate('full_name') ?></th>
					<td><?php translate('username') ?></th>
					<td><?php translate('payment') ?></th>
				</tr>
			</thead>
			<tbody>								
		        <?php $i = 1; $all_count = 0; foreach ($users as $result) { ?>
					<tr>
						<td class="center uniformjs"><?php echo $i ?></td>
						<td class="center"><?php echo $result->f_name.' '.$result->l_name ?></td>
						<td class="center"><?php echo $result->username ?></td>
						<?php
						
						$r_comm = $result->right_h * 2 * $comm;
						$l_comm = $result->left_h * 2 * $comm;
						$com = $r_comm > $l_comm ? $l_comm : $r_comm;
						$com = $com > $max_pay ? $max_pay : $com;
						?>
						<?php $all_count += $com; //$result->left_h < $result->right_h ? ($result->left_h * 2 * $comm) > $max_pay ? $max_pay : ($result->left_h * 2 * $comm) : ($result->right_h * 2 * $comm) > $max_pay ? $max_pay : ($result->right_h * 2 * $comm) ?>
						<td class="center"><?php echo $com; //$result->left_h < $result->right_h ? ($result->left_h * 2 * $comm) > $max_pay ? $max_pay : ($result->left_h * 2 * $comm) : ($result->right_h * 2 * $comm) > $max_pay ? $max_pay : ($result->right_h * 2 * $comm) ?></td>
				    </tr>	
		 		<?php $i++; } ?>	
			</tbody>
		</table>
		<div class="row" style="margin-top: 10px">
			<div class="col-md-3 pull-right"><h4><?php echo trans('comm_count') ?>: <?php echo $all_count ?></h4></div>
			<div class="col-md-3 pull-right"><h4><?php echo trans('other_payments') ?>: <?php echo $users_count * $expanse ?></h4></div>
			<div class="col-md-2 pull-right"><h4><?php echo trans('in_count') ?>: <?php echo $users_count * 17500 ?></h4></div>
			<div class="col-md-2 pull-right"><h4><?php echo trans('users_count') ?>: <?php echo $users_count ?></h4></div>
			<div class="col-md-2 pull-right"><h4><?php echo trans('affairs') ?>: <?php echo ($users_count * 17500) - (($users_count * $expanse) + $all_count) ?></h4></div>
		</div>
		
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
