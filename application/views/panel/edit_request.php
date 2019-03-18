
<?php $this->load->view('common/header') ?>

<h3 class="innerTB" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php  ?></h3>
	<!-- Widget -->
<div class="widget">
	<form onsubmit="default" action="" method="post" role="form">
	<div class="widget-body overflow-x">
		<div class="row">
			<!-- Table -->
		<table class="dynamicTable fixedHeaderColReorder table" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
		
			<!-- Table heading -->
			<thead class="bg-gray">
				<tr>
					<th style="width: 1%;" class="center">#</th>
					<th class="center"><?php translate('emp_name') ?></th>
					<th class="center"><?php translate('status') ?></th>
				</tr>
			</thead>
			<tbody>								
		            <?php $i = 1; foreach ($results as $result) { ?>
						<tr>
							<td class="center uniformjs"><?php echo $i; ?></td>
							<td class="center"><?php echo $result->f_name; ?></td>
							<td class="center">
							<div class="btn-group btn-group-sm">
								<a href="<?php echo base_url() .'edit_request_data/' . $result->id ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
								<a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a>
							</div>
						</td>
					            </div>
				            </td>
						</tr>	
			 		<?php $i++;   } ?>			
				</tbody>
			</table>
			<!-- // Table END -->
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary"><?php translate('edit') ?></button>
			    	<button class="btn btn-default"><?php translate('cancel') ?></button>
			    		
			    	</div>
		   		 </div>
			</div>
		</div>
	</form>
</div>
<?php $this->load->view('common/footer') ?>