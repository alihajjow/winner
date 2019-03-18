<?php $this->load->view('common/header'); ?>
     	
		<!-- Table -->
		
<form onsubmit="default" action="<?php echo base_url()."statics" ?>" method="post" role="form">
<div class="widget">
	<div class="widget-head">
		<h4 class="heading" <?php echo LANG() == 'en' ? '' : 'style="float: right"' ?>><?php echo $title; ?></h4>
	</div>
	<div class="widget-body">
		<div class="row">
			
			<div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group" style="margin-bottom: 0">
					<label for="inputTitle"><?php translate('to_user') ?></label>
					
					<select style="width: 100%;" id="select2_1" name="year">
						<option value=""><?php echo trans('select_year') ?></option>
		               <?php for ($i=2016; $i <= date('Y'); $i++) { ?>
						   <option value="<?php echo $i ?>"><?php echo $i ?></option>
					   <?php } ?>
		            </select>
				</div>
			</div>
			<div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group" style="margin-bottom: 0">
					<label for="inputTitle"><?php translate('to_user') ?></label>
					
					<select style="width: 100%;" id="select2_2" name="week">
						<option><?php echo trans('select_week') ?></option>
		               <?php for ($i=1; $i <= 52; $i++) { ?>
						   <option value="<?php echo $i ?>"><?php echo $i ?></option>
					   <?php } ?>
		            </select>
				</div>
			</div>
			<div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary"><?php translate('show_res') ?></button>
			    </div>
		    </div>
		    <div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
		    	<div class="form-group" style="margin-top: 20px; font-weight: bolder">
					رصيدك الحالي هو: <?php echo $balance ?>
				</div>
		    </div>
		    <div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
		    	<div class="form-group" style="margin-top: 20px; font-weight: bolder">
					الاسبوع الحالي رقمه <?php echo $week ?>
				</div>
		    </div>
		    
		</div>
		
</div>
 </div>
 </form>
<div class="widget">
	<div class="widget-body overflow-x">
		<table class="dynamicTable fixedHeaderColReorder table" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
		
			<!-- Table heading -->
			<thead class="bg-gray">
				<tr>
					<th style="width: 1%;" class="center">#</th>
					<th class="center"><?php translate('full_name') ?></th>
					<th class="center"><?php translate('mother_name') ?></th>
					<th class="center"><?php translate('username') ?></th>
					<th class="center"><?php translate('birth_place') ?></th>
					<th class="center"><?php translate('birth_date') ?></th>
					<th class="center"><?php translate('address') ?></th>
					<th class="center"><?php translate('payment') ?></th>
				</tr>
			</thead>
			<tbody>								
		        <?php $i = 1; foreach ($users as $result) { ?>
		        	<?php if ($results[$result->emp_id] != 0) { ?>
						<tr>
							<td class="center uniformjs"><?php echo $i ?></td>
							<td class="center"><?php echo $result->f_name.' '.$result->l_name ?></td>
							<td class="center"><?php echo $result->mother_name ?></td>
							<td class="center"><?php echo $result->username ?></td>
							<td class="center"><?php echo $result->birth_place ?></td>
							<td class="center"><?php echo date('Y-m-d H:i', $result->birth_date) ?></td>
							<td class="center"><?php echo $result->address ?></td>
							<td class="center"><?php echo $results[$result->emp_id] ?></td>
					    </tr>	
					<?php $i++; } ?>
		 		<?php    } ?>	
			</tbody>
		</table>
		<div class="row" style="margin-top: 10px">
			<div class="col-md-3 pull-right"><h4><?php echo trans('comm_count') ?>: <?php echo $res ?></h4></div>
			<div class="col-md-3 pull-right"><h4><?php echo trans('other_payments') ?>: <?php echo $users_count * 5000 ?></h4></div>
			<div class="col-md-2 pull-right"><h4><?php echo trans('in_count') ?>: <?php echo $users_count * 17500 ?></h4></div>
			<div class="col-md-2 pull-right"><h4><?php echo trans('users_count') ?>: <?php echo $users_count ?></h4></div>
			<div class="col-md-2 pull-right"><h4><?php echo trans('affairs') ?>: <?php echo ($users_count * 17500) - (($users_count * 5000) + $res) ?></h4></div>
		</div>
		
	</div>

</div>

<?php $this->load->view('common/footer'); ?>