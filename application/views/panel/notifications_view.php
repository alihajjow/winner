<?php $this->load->view('common/header1') ?>

<div class="widget">
	<div class="widget-head">
			<div class="col-sm-12">
                        <div class="card-box">
		<h4 class="header-title m-t-0 m-b-30"  <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>><?php echo $title; ?></h4>

				<div class="row">
					<ul class="list-unstyled">
						<?php foreach ($res->result() as $not) { ?>
							<li class="border-bottom">
								<a href="<?php echo $not->link == '#' ? '#' : base_url().$not->link ?>">
									<div class="media innerAll">
										<div class="media-body">
											<div>
												<span class="strong pull-right"><?php echo $not->op_name ?></span> 
												<small class="text-italic label label-default"><?php echo date('Y-m-d H:i', $not->date) ?></small>
											</div>
											<div class="pull-right"><?php echo $not->n_text ?></div>
										</div>
									</div>
								</a>
								<hr>
							</li>
						<?php } ?>
						<li class="border-bottom" style="cursor: pointer" id="more_nots" onclick="get_more_notifs()">
							<div class="media innerAll" id="more_nots1">
								<div class="media-body" style="text-align: center">
									<div>
										<span class="strong"><?php echo trans('load_more') ?></span> 
									</div>
								</div>
							</div>
						</li>
							
					</ul>
						
				</div>
				
			</div>
		</div>
	</div>
<script type="text/javascript">
	function get_more_notifs () {
		$.ajax({
          url: '<?php echo base_url(); ?>get_more_notifs/',
          success: function(data) {
          	var res = JSON.parse(data);
          	if (res[0]) {
          		$("#more_nots").prepend(res[0]);
          	};
          	if(res[1]) {
          		$("#more_nots1").remove();
          	};
          }
		  
      });
	}
</script>
<?php $this->load->view('common/footer1') ?>