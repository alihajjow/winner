<?php $this->load->view('common/header1'); ?>


<form onsubmit="default" action="<?php echo base_url()."week_studs/$user_id" ?>" method="post" role="form">
	<div class="row">
	
                        	<div class="col-sm-12">
                        		<div class="card-box">
                        			<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title ?></h4>
		<div class="row">
			<div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
				<div class="form-group" style="margin-bottom: 0">
					<label for="inputTitle"><?php translate('to_user') ?></label>
					
					<select style="width: 100%;" class="form-control"  id="select2_1" name="year">
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
					
					<select style="width: 100%;" class="form-control"  id="select2_2" name="week">
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
		    <div class="col-md-2" <?php echo LANG() == 'en' ? '' : 'style="float: right; text-align: right"' ?>>
		    	<div class="form-group" style="margin-top: 20px; font-weight: bolder">
					عدد الطلاب هو: <?php echo $agent_count ?>
				</div>
		    </div>
		    


 </form>
 
<?php if ($_POST) { ?>
	<?php $i = 0; $l_count = 0; $r_count = 0; foreach ($res as $row): ?>
		<?php if ($i == 0 || $res[$i]->p_type != $res[$i-1]->p_type) { ?>
			<div class="col-md-6 widget gridalicious-item not-responsive" style="<?php echo $row->p_type == 'l' ? '' : 'float: right;' ?> text-align: right">
				<div >
					<div class="media">
						<!--<a href="" class="pull-left"><img src="../assets/images/people/50/15.jpg" width="50" class="media-object" style="width: auto; height: auto; display: block; margin-left: auto; margin-right: auto;"></a>-->
						<div >
							
							<h3 class="text-success"><b><?php echo $row->p_type == 'l' ? trans('left_arm') : trans('right_arm') ?></b></h3>
							
						</div>
			
					</div>
				</div>
		<?php } ?>
		<?php 
		$l_count += $row->p_type == 'l' ? $row->comm : 0; 
		$r_count += $row->p_type == 'r' ? $row->comm : 0; 
		?>
		
			<!-- Content -->
			<div class="innerAll">
				<span><?php echo $row->paid_date ? date('Y-m-d H:i', $row->paid_date) : 'لم تحصل على عمولة الطالب بعد' ?></span>
				<p><?php echo $row->f_name." ".$row->father_name." ".$row->l_name ?></p>
				<p style="direction: rtl"><?php echo $row->c_name.' '. $row->lev_name ?></p>
				<p><?php echo trans('comm_l') ?> <?php echo $row->comm ?></p>
			</div>
			<hr style="border:  1px solid #cccccc">
		<?php if (!isset($res[$i+1]) || $res[$i]->p_type != $res[$i+1]->p_type): ?>
				<div class="innerAll">
					<p><?php echo trans('count_all').': '.($row->p_type == 'l' ? $l_count : $r_count) ?></p>
				</div>
			</div>	
			
		<?php endif ?>
		
	<?php $i++; endforeach ?>

		
<?php } ?>
		</div>
		
</div>
	</div>
	</div>

<?php $this->load->view('common/footer1'); ?>