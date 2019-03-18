<?php $this->load->view('common/header1'); ?>
<div class="row">
	<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th style="width: 1%;" class="uniformjs"><input type="checkbox" /></th>
						<th class="center">No.</th>
						<th class="center">Time</th>
						<th>Client</th>
						<th class="center">Phone</th>
						<th class="center">Amount</th>
						<th class="center">Heard from</th>
						<th class="center" style="width: 150px;">Actions</th>
					</tr>
				</thead>

				<tbody>
				<?php $i = 1;
					foreach ($results as $result) { ?>

					<tr class="selectable">
						<td class="center uniformjs"><input type="checkbox" /></td>
						<td class="center"><?php echo $i; ?></td>
						<td class="center"></td>
						<td><?php echo $result->f_name; ?></td>
						<td class="center"><?php echo $result->mobile; ?></td>
						<td class="center">&euro;<?php echo $result->balance; ?> </td>
						<td class="center">Google Search</td>
						<td class="center">
							<div class="btn-group btn-group-sm">
								<a href="#" class="btn btn-default"><i class="fa fa-eye"></i></a>
								<a href="#" class="btn btn-success"><i class="fa fa-pencil"></i></a>
								<a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a>
							</div>
						</td>
					</tr>
				
										
	 <?php $i++;   } ?>		
				</tbody>
			</table>
		<!-- // Table END -->
			
			<div class="clearfix"></div>
			<!-- // Pagination END -->
			
		</div>

</div>
<!-- // END row-app -->
		<?php $this->load->view('common/footer1'); ?>