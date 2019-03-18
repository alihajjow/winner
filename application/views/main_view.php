
<?php $this->load->view('common/header1'); ?>
<link rel="stylesheet" href="<?php echo base_url("assetss/orgchart") ?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url("assetss/orgchart") ?>/css/jquery.orgchart.min.css">
  <link rel="stylesheet" href="<?php echo base_url("assetss/orgchart") ?>/css/style.css">
  <style type="text/css">
    #chart-container { text-align: right; }
  </style>
  
	<div class="widget">
	<div class="widget-head">
			<div class="col-sm-12">
                        <div class="card-box">
		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>     	
	<div class="col-md-12 col-lg-3 border-bottom">
		
	
  
	</div>
	<div class="row">
		<div class="col-md-12 col-md-6 ">
			<div class="col-sm-9" <?php echo LANG() == 'en' ? '' : 'style=" text-align: right"' ?>>
				<div class="widget-body text-center">
					<a href=""><img src="<?php echo $me->img ? base_url() . "uploads/profile/" . $me->img : base_url()."assets/images/people/250/22.jpg" ?>" width="120" height="120" alt="" class="img-circle"></a>
					<h2 class="strong margin-none"><?php echo "$me->f_name $me->father_name $me->l_name" ?></h2>
					<div class="innerB"></div>
					<button class="btn btn-primary waves-effect waves-light" onclick="tree()" data-toggle="modal" data-target="#full-width-modal">عرض الشجرة</button>
					<?php if($me->address){ ?>
					<a href="" class="btn btn-primary text-center btn-block"><?php echo $me->address ?><i class="fa fa-fw fa-map-marker text-muted"></i></a>
					<?php } ?>
					<div class="btn-group-vertical btn-block">
						<?php if($me->mobile){ ?>
						<a href="" class="btn btn-default"><?php echo $me->mobile ?><i class="fa fa-fw icon-phone-fill text-muted"></i></a> 
						<?php }?>
							<?php if($me->reg_date){ ?>
						<a href="" class="btn btn-default"><i></i><?php echo date('Y-m-d', $me->reg_date) ?></a>
						<?php }?>
						
					</div>
				</div>
				
				<!--<div class="media">
					<div class="media-body innerAll inner-2x padding-right-none padding-bottom-none">
						 <h4 class="media-heading"><a href="#" class="text-inverse"><?php echo "$me->f_name $me->father_name $me->l_name" ?></a></h4>
						 <p <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?>>  
						 	<i class="fa fa-fw fa-map-marker text-muted" style="margin-bottom: 10px"></i> <?php echo $me->address ?><br>
							<i class="fa fa-fw icon-phone-fill text-muted"></i> <?php echo $me->mobile ?><br>
							<i class="fa fa-fw icon-phone-fill text-muted"></i> <?php echo date('Y-m-d H:i', $me->reg_date) ?><br>
							
						 </p> 
					</div>
				</div>-->
			</div>
		<!--	<div class="col-sm-3" >
				<div class="innerAll text-right">
					<!--<div class="btn-group-vertical btn-group-sm">
						<a href="" class="btn btn-primary"><i class="fa fa-fw fa-thumbs-up"></i> Like</a>
						<a href="" class="btn btn-default" data-toggle="sidr-open" data-menu="menu-right"><i class="fa fa-fw fa-envelope-o"></i> Chat</a>
					</div>
				</div>
			</div>-->
	
	</div>
	<?php if ($right){ ?>
	<div class="col-md-12 col-lg-6 " style="float: right;">
		

					<div class="col-sm-9" <?php echo LANG() == 'en' ? '' : 'style=" text-align: right"' ?>>
					<div class="widget-body text-center">
					<a href="<?php echo base_url()."sons/$right->username" ?>">
						<img src="<?php echo $right->img ? base_url() . "uploads/profile/" . $right->img : base_url()."assets/images/people/250/22.jpg" ?>" width="120" height="120" alt="" class="img-circle">
					</a>
					<a href="<?php echo base_url()."sons/$right->username" ?>"></a><h2 class="strong margin-none"><?php echo trans('right_son') . ": $right->f_name $right->father_name $right->l_name" ?></h2></a>
					<div class="innerB"></div>
					<?php if($right->address){ ?>
					<a href="" class="btn btn-primary text-center btn-block"><?php echo $right->address ?><i class="fa fa-fw fa-map-marker text-muted"></i></a>
					<?php } ?>
					<div class="btn-group-vertical btn-block">
						<?php if($right->mobile){ ?>
						<a href="" class="btn btn-default"><?php echo $right->mobile ?><i class="fa fa-fw icon-phone-fill text-muted"></i> </a> 
						<?php }?>
							<?php if($right->reg_date){ ?>
						<a href="" class="btn btn-default"><i></i><?php echo date('Y-m-d', $right->reg_date) ?></a>
						<?php }?>
					</div>
				</div>
				

				<!--<div class="media">
					<div class="media-body innerAll inner-2x padding-right-none padding-bottom-none">
						 <h4 class="media-heading"><a href="<?php echo base_url()."sons/$right->username" ?>" class="text-inverse"><?php echo trans('right_son') . ": $right->f_name $right->father_name $right->l_name" ?></a></h4>
						 <p <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?>>  
						 	<i class="fa fa-fw fa-map-marker text-muted" style="margin-bottom: 10px"></i> <?php echo $right->address ?><br>
							<i class="fa fa-fw icon-phone-fill"></i> <?php echo $right->mobile ?><br>
							<i class="fa fa-fw icon-phone-fill text-muted"></i> <?php echo date('Y-m-d H:i', $right->reg_date) ?><br>
							
						 </p> 
					</div>
				</div>-->
			</div>
			<!--
			<div class="col-sm-3" >
				<div class="innerAll text-right">
					<!--<div class="btn-group-vertical btn-group-sm">
						<a href="" class="btn btn-primary"><i class="fa fa-fw fa-thumbs-up"></i> Like</a>
						<a href="" class="btn btn-default" data-toggle="sidr-open" data-menu="menu-right"><i class="fa fa-fw fa-envelope-o"></i> Chat</a>
					</div>
				</div>
			</div>-->
	
	</div>
	<?php } ?>
	<?php if ($left){ ?>
		<div class="col-md-12 col-lg-6 ">
		<div class="row">

			<div class="col-sm-9" <?php echo LANG() == 'en' ? '' : 'style="text-align: right;margin-left: 62px;"' ?>>
			
				<div class="widget-body text-center">
					<a href="<?php echo base_url()."sons/$left->username" ?>">
						<img src="<?php echo $left->img ? base_url() . "uploads/profile/" . $left->img : base_url()."assets/images/people/250/22.jpg" ?>" width="120" height="120" alt="" class="img-circle">
					</a>
					<a href="<?php echo base_url()."sons/$left->username" ?>"></a><h2 class="strong margin-none"><?php echo trans('left_son') . ": $left->f_name $left->father_name $left->l_name" ?></h2></a>
					<div class="innerB"></div>
					<?php if($left->address){ ?>
					<a href="" class="btn btn-primary text-center btn-block"><?php echo $left->address ?><i class="fa fa-fw fa-map-marker text-muted"></i></a>
					<?php } ?>
					<div class="btn-group-vertical btn-block">
						<?php if($left->mobile){ ?>
						<a href="" class="btn btn-default"><?php echo $left->mobile ?><i class="fa fa-fw icon-phone-fill text-muted"></i> </a> 
						<?php }?>
							<?php if($left->reg_date){ ?>
						<a href="" class="btn btn-default"><i></i><?php echo date('Y-m-d', $left->reg_date) ?></a>
						<?php }?>
					</div>
				</div>
			
			
			
				<!--<div class="media">
					<div class="media-body innerAll inner-2x padding-right-none padding-bottom-none">
						 <h4 class="media-heading"><a href="<?php echo base_url()."sons/$left->username" ?>" class="text-inverse"><?php echo trans('left_son') . ": $left->f_name $left->father_name $left->l_name" ?></a></h4>
						 <p <?php echo LANG() == 'en' ? '' : 'dir="rtl"' ?>>  
						 	<i class="fa fa-fw fa-map-marker text-muted" style="margin-bottom: 10px"></i> <?php echo $left->address ?><br>
							<i class="fa fa-fw icon-phone-fill"></i> <?php echo $left->mobile ?><br>
							<i class="fa fa-fw icon-phone-fill text-muted"></i> <?php echo date('Y-m-d H:i', $left->reg_date) ?><br>
							
						 </p> 
					</div>
				</div>-->
			</div>
	<!--		<div class="col-sm-3" >
				<div class="innerAll text-right">
					<!--<div class="btn-group-vertical btn-group-sm">
						<a href="" class="btn btn-primary"><i class="fa fa-fw fa-thumbs-up"></i> Like</a>
						<a href="" class="btn btn-default" data-toggle="sidr-open" data-menu="menu-right"><i class="fa fa-fw fa-envelope-o"></i> Chat</a>
					</div>
				</div>
	</div>-->
		</div>
	
	</div>
	<?php } ?>
<?php if (($me->emp_id == $this->session->userdata('user_id') || have_access(48, TRUE)) && have_access(56, TRUE)) { ?>
	<div class="panel panel-default col-md-3 col-md-offset-4 col-sm-6 col-sm-offset-3" style="margin-top: 100px">
		
		<div class="panel-body" style="padding-right: 34px;">
			
				<div class="innerLR">		
			  		<div class="form-group col-md-12">
			    		<font style="font-size: 20px; font-weight: bold"><i class="fa fa-fw icon-address-book" style="color: #8f11ff"></i> </font><span style="direction: rtl; text-align: right"><?php echo "$me->c_name - $me->lev_name"; ?></span> 
			    		<br />
			  		</div>
			  		<div class="form-group col-md-12">
			    		<font style="font-size: 20px; font-weight: bold"><i class="fa fa-fw icon-cash-money" style="color: #8f11ff"></i> <?php echo $balance; ?> </font>
			    		<br />
			  		</div>
			  		<div class="form-group" >
			    		 <font style="font-size: 20px; font-weight: bold"><i class="fa fa-fw icon-user-1" style="color: #8f11ff"></i> <?php echo $desc; ?>  </font>
			    		
			  		</div>
		  		</div>
		  		
		</div>
	
	</div>
<?php } elseif(!have_access(56, true) && ($me->emp_id == $this->session->userdata('user_id'))) { ?>
	<div class="panel panel-default col-md-3 col-md-offset-4 col-sm-6 col-sm-offset-3" style="margin-top: 100px">
		
		<div class="panel-body" style="padding-right: 34px;text-align: right; direction: rtl">
			
				<div class="innerLR" style="text-align: right; direction: rtl">		
			  		
			  		<div class="form-group col-md-12" style="text-align: right; direction: rtl">
			    		<font style="font-size: 20px; font-weight: bold; text-align: right; direction: rtl"><i class="fa fa-fw icon-power-on" style="color: #8f11ff"></i> عذرا، تم قفل الوكالة بسبب عدم التزامك بحضور الكورس الخاص بك .. </font>
			    		<br />
			  		</div>
		  		</div>
		  		
		</div>
	
	</div>
<?php } ?>
</div></div></div>
<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="full-width-modalLabel">Modal Heading</h4>
                            </div>
                            <div class="modal-body">
                                <h4>Text in a modal</h4>
                                <div id="chart-container"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
<?php $this->load->view('common/footer1'); ?>
<script type="text/javascript" src="<?php echo base_url("assetss/orgchart") ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assetss/orgchart") ?>/js/jquery.mockjax.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url("assetss/orgchart") ?>/js/jquery.orgchart.min.js"></script>
  <script type="text/javascript">
    
	function tree () {
		//alert(1);
	
	  $.ajax({
            url: '<?php echo base_url("welcome/tree"); ?>',
            responseTime: 1000,
        	contentType: 'text/json',
            success: function(data) {
              if (data) {
              	//alert(1);
                //alert(data); 
                //var datascource = JSON.parse(data);
                console.log(data);
                //maketree(data);
				$('#chart-container').orgchart({
			      'data' : 'welcome/tree',
			      'nodeContent': 'title',
			      'direction': 'r2l'
			    });
              };

            }
        });
        
	}
	

  </script>