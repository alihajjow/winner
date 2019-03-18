<?php $this->load->view('common/header'); ?>
<div class="col-separator col-unscrollable box">
	
	<table class="table table-condensed table-striped table-primary table-vertical-center checkboxs">
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
															
										<!-- Item -->
										
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
			
			<!-- With selected actions -->
			<div class="pull-left checkboxs_actions hide-2">
				<label class="strong">With selected:
				<select class="selectpicker margin-none" data-style="btn-default btn-small">
					<option>Action</option>
					<option>Action</option>
					<option>Action</option>
				</select>
				</label>
			</div>
			<!-- // With selected actions END -->
			
			<!-- Pagination -->
			<ul class="pagination pull-right margin-none">
				<li class="disabled"><a href="#">&laquo;</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
			<div class="clearfix"></div>
			<!-- // Pagination END -->
			
		</div>

</div>
<!-- // END row-app -->
		<?php $this->load->view('common/footer'); ?>