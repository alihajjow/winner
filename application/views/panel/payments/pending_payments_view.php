<?php $this->load->view('common/header1'); ?>
     	<div class="widget">
	<div class="widget-head">
			<div class="col-sm-12">
                        <div class="card-box">
		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>     	

		<!-- Table -->
<div class="widget">
				<div class="widget-body overflow-x">
		<table class="dynamicTable fixedHeaderColReorder table" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
			<!-- Table heading -->
			<thead>
				<tr>
					<td style="width: 1%;" class="center">#</th>
					<td class="center"><?php translate('full_name') ?></th>
					<td class="center"><?php translate('to_emp') ?></th>
					<td class="center"><?php translate('amount') ?></th>
					<td class="center"><?php translate('date') ?></th>
					<td class="center"><?php translate('approve') ?></th>
					<td class="center"><?php translate('cancel') ?></th>
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
				        <td class="center"><a href="<?php echo base_url()."approve_pay/$result->id" ?>" onclick="return confirm('Are you sure')"><i class="fa fa-fw icon-thumbs-up"></i></a></td>
				        <td class="center"><a href="<?php echo base_url()."cancel_pay/$result->id" ?>" onclick="return confirm('Are you sure')"><i class="fa fa-fw icon-thumbs-down"></i></td> 
					</tr>	
		 		<?php $i++;   } ?>			
			</tbody>
		</table>
	</div>

</div>

<?php $this->load->view('common/footer1'); ?>