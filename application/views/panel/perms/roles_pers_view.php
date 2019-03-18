<?php $this->load->view('common/header') ?>

<h3 class="innerTB" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h3>
	<!-- Widget -->
<div class="widget">
	<form onsubmit="default" action="<?php echo base_url()."edit_pers/$role_id" ?>" method="post" role="form">
	<div class="widget-body overflow-x">
		<div class="row">
			<!-- Table -->
		<table class=" fixedHeaderColReorder table" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
		
			<!-- Table heading -->
			<thead class="bg-gray">
				<tr>
					<th style="width: 1%;" class="">#</th>
					<th class="center"><?php translate('perm_name') ?></th>
					<th class="center"><?php translate('status') ?></th>
				</tr>
			</thead>
			<tbody>								
		            <?php $i = 1; foreach ($results as $result) { ?>
						<tr>
							<td class="center uniformjs"><?php echo $i; ?></td>
							<td class="center"><?php echo $result->description; ?></td>
							<td class="center">
								<div class="">
					                <label class="">
					                    <input type="checkbox"  name="per_ids[]" value="<?php echo $result->per_id; ?>" <?php echo $result->id ? 'checked' : ''; ?>> 
					                </label>
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