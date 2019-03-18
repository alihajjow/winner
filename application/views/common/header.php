

<?php $statics = $this->session->userdata('statics'); 

$nots = $statics['notifcs']; if ($this->session->userdata('user_id') == 1) {
	//print_r($nots); exit; 
}
$read_nots = $statics['oldnotif'];

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 paceCounter paceSocial sidebar sidebar-social footer-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 paceCounter paceSocial sidebar sidebar-social footer-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 paceCounter paceSocial sidebar sidebar-social footer-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie paceCounter paceSocial sidebar sidebar-social footer-sticky"> <![endif]-->
<!--[if !IE]><!--><html class="paceCounter paceSocial sidebar sidebar-social footer-sticky" ><!-- <![endif]-->
<head>
	<title><?php translate('abakera_title') ?></title>
		
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	<!-- 
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	<link rel="stylesheet/less" href="<?php echo base_url() ?>assets/less/admin/module.admin.stylesheet-complete.less" />
	-->

		<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo base_url() ?>assets/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
	
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin/module.admin.stylesheet-complete.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/toastr.min.css" />
	
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<script src="<?php echo base_url() ?>assets/plugins/core_ajaxify_loadscript/script.min.js?v=v2.0.0-rc8&sv=v0.0.1.2"></script>

<script>var App = {};</script>

<script data-id="App.Scripts">

App.Scripts = {

	/* CORE scripts always load first; */
	core: [
		'<?php echo base_url() ?>assets/library/jquery/jquery.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/library/modernizr/modernizr.js?v=v2.0.0-rc8&sv=v0.0.1.2'
	],

	/* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
	plugins_dependency: [
		'<?php echo base_url() ?>assets/library/bootstrap/js/bootstrap.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/library/jquery-ui/js/jquery-ui.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/library/jquery/jquery-migrate.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/tables_datatables/js/jquery.dataTables.min.js?v=v2.0.0-rc8&sv=v0.0.1.2'
	],

	/* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
	plugins: [
		'<?php echo base_url() ?>assets/plugins/core_nicescroll/jquery.nicescroll.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/core_breakpoints/breakpoints.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/menu_sidr/jquery.sidr.js?v=v2.0.0-rc8', 
		'<?php echo base_url() ?>assets/plugins/tables_datatables/extras/TableTools/media/js/TableTools.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/tables_datatables/extras/ColVis/media/js/ColVis.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/tables_datatables/js/DT_bootstrap.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/forms_elements_bootstrap-select/js/bootstrap-select.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/tables_datatables/extras/ColReorder/media/js/ColReorder.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/other_mixitup/jquery.mixitup.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/forms_elements_bootstrap-switch/js/bootstrap-switch.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/forms_elements_bootstrap-datepicker/js/bootstrap-datepicker.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/forms_elements_bootstrap-timepicker/js/bootstrap-timepicker.js?v=v2.0.0-rc8&sv=v0.0.1.2',
		'<?php echo base_url() ?>assets/plugins/forms_elements_select2/js/select2.js?v=v2.0.0-rc8&sv=v0.0.1.2',
		'<?php echo base_url() ?>assets/plugins/core_less-js/less.min.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/notifications_notyfy/js/jquery.notyfy.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/charts_flot/excanvas.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/core_browser/ie/ie.prototype.polyfill.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/core_jquery-ui-touch-punch/jquery.ui.touch-punch.min.js?v=v2.0.0-rc8&sv=v0.0.1.2'
	],

	/* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
	bundle: [
		'<?php echo base_url() ?>assets/components/core_ajaxify/ajaxify.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/core_preload/preload.pace.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/tables_datatables/js/datatables.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/forms_elements_fuelux-checkbox/fuelux-checkbox.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/forms_elements_bootstrap-select/bootstrap-select.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/tables/tables-classic.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/menus/sidebar.main.init.js?v=v2.0.0-rc8', 
		'<?php echo base_url() ?>assets/components/menus/sidebar.collapse.init.js?v=v2.0.0-rc8', 
		'<?php echo base_url() ?>assets/components/menus/menus.sidebar.chat.init.js?v=v2.0.0-rc8', 
		'<?php echo base_url() ?>assets/components/forms_elements_bootstrap-datepicker/bootstrap-datepicker.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/forms_elements_bootstrap-timepicker/bootstrap-timepicker.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/forms_elements_select2/select2.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/plugins/other_mixitup/mixitup.init.js?v=v2.0.0-rc8&sv=v0.0.1.2', 
		'<?php echo base_url() ?>assets/components/core/core.init.js?v=v2.0.0-rc8',
		'<?php echo base_url() ?>assets/js/toastr.min.js'
	]

};

</script>
	
<script>
$script(App.Scripts.core, 'core');

$script.ready(['core'], function(){
	$script(App.Scripts.plugins_dependency, 'plugins_dependency');
});
$script.ready(['core', 'plugins_dependency'], function(){
	$script(App.Scripts.plugins, 'plugins');
});
$script.ready(['core', 'plugins_dependency', 'plugins'], function(){
	$script(App.Scripts.bundle, 'bundle');
});

</script>
	<script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>

</head>
<body class="scripts-async menu-right-hidden">
	
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden ">

						<!-- Main Sidebar Menu -->
		<div id="menu" class="hidden-print hidden-xs sidebar-default sidebar-brand-primary">

			
			<div id="sidebar-social-wrapper">
				<div id="brandWrapper">
					<a href="<?php echo base_url() ?>"><span class="text"><?php translate('abakera_title') ?></span></a>
				</div>
				<?php  if (have_access(56, TRUE)) { ?>
					<ul class="menu list-unstyled">
						<li <?php echo isset($selected) && ($selected == 'edit_user' || $selected == 'change_password' || $selected == 'create_user' || $selected == 'edit_child_data' ) ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">
							<a href="#menu-2987fd929849c21cafec7f0ab4fdaac1" data-toggle="collapse">
								<i class="icon-user-1"></i>
								<span><?php translate('user_side') ?></span>
							</a>
							<ul <?php echo isset($selected) && ($selected == 'edit_user' || $selected == 'change_password' || $selected == 'create_user' || $selected == 'edit_child_data' ) ? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac1">
								<li <?php echo isset($selected) && $selected == 'edit_user' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>user_info">
										<i class="fa fa-fw icon-check"></i>
										<span><?php translate('user_info') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'register_course' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>reg_course">
										<i class="fa fa-fw icon-paper-documents-image"></i>
										<span><?php translate('register_course') ?></span>
									</a>
								</li>
								<?php if (have_access(40, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'week_com' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>week_comms">
											<i class="fa fa-fw icon-reciept-2"></i>
											<span><?php translate('week_com') ?></span>
										</a>
									</li>
									<li <?php echo isset($selected) && $selected == 'week_com' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>week_studs">
											<i class="fa fa-fw icon-reciept-2"></i>
											<span><?php translate('week_studs') ?></span>
										</a>
									</li>
								<?php endif ?>
								<li <?php echo isset($selected) && $selected == 'change_password' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>change_password">
										<i class="fa fa-key"></i>
										<span><?php translate('change_password') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'create_user' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>create_user">
										<i class="icon-group"></i>
										<span><?php translate('create_user') ?></span>
									</a>
								</li>
									<?php /*<li <?php echo isset($selected) && $selected == 'edit_child_data' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>edit_request">
										<?php echo $statics['edit_num'] ? "<span class='badge pull-right badge-primary'>".$statics['edit_num']."</span>" : '' ?>
										<i class="fa fa-fw icon-browser-check"></i>
										<span><?php translate('edit_child_data'); ?></span>
									</a>
								</li> */?>
							
							</ul>
						</li>
							<?php if (have_access(38, true)) { ?>
								<li <?php echo isset($selected) && ($selected == 'convert_balance' || $selected == 'transfer' || $selected == 'pending_payments'|| $selected == 'change_pay_password') ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">
	
								<a href="#menu-2987fd929849c21cafec7f0ab4fdaac3" data-toggle="collapse">
									<i class="fa fa-fw icon-cash-money"></i>
									<span><?php translate('financial_operations') ?></span>
								</a>
								<ul <?php echo isset($selected) && ($selected == 'convert_balance' || $selected == 'transfer' || $selected == 'pending_payments'|| $selected == 'change_pay_password') ? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac3">
	
								<li <?php echo isset($selected) && $selected == 'convert_balance' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>convert_balance">
										<i class="fa fa-fw icon-cash-dispenser"></i>
										<span><?php translate('convert_balance') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'transfer' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>transfer">
										<i class="fa fa-fw icon-cash-bands"></i>
										<span><?php translate('transfer') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'pending_payments' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>pending_pays">
										<?php echo $statics['pays_num'] ? "<span class='badge pull-right badge-primary'>".$statics['pays_num']."</span>" : '' ?>
										<i class="fa fa-fw icon-money"></i>
										<span><?php translate('pending_payments') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'my_pending_payments' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>my_pending_pays">
										<?php //echo $statics['pays_num'] ? "<span class='badge pull-right badge-primary'>".$statics['pays_num']."</span>" : '' ?>
										<i class="fa fa-fw icon-graph-down-1"></i>
										<span><?php translate('my_pending_payments') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'change_pay_password' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>change_pay_password">
										<i class="fa fa-fw icon-lock-fill"></i>
										<span><?php translate('change_pay_password') ?></span>
									</a>
								</li>
							</ul>
							</li>
							<?php } ?>
				  			
							
							
							 <?php if (have_access(1, TRUE) || have_access(43, TRUE) || have_access(33, TRUE) || have_access(34, TRUE) || have_access(59, TRUE) || have_access(35, TRUE) || have_access(58, TRUE)) { ?>
						<li class="category border-top">
							<span>admin</span>
							</li>
							<li <?php echo isset($selected) && ($selected == 'create_new_user' || $selected == 'admin_edit_request' || $selected == 'admin_edit_user' || $selected == 'add_tutors' || $selected == 'courses_cat' ) ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">
	
							<a href="#menu-2987fd929849c21cafec7f0ab4fdaac2" data-toggle="collapse">
								<i class="fa fa-fw icon-settings-wheel-fill"></i>
								<span><?php translate('admin_section') ?></span>
							</a>
							<ul <?php echo isset($selected) && ($selected == 'create_new_user' || $selected == 'admin_edit_request'|| $selected == 'admin_edit_user'|| $selected == 'add_tutors' || $selected ==  'courses_cat' )? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac2">
	                          <li <?php echo isset($selected) && $selected == 'create_new_user' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>create_new_user">
										<i class="fa fa-fw icon-identification"></i>
										<span><?php translate('create_user') ?></span>
									</a>
								</li>
								
								<li <?php echo isset($selected) && $selected == 'admin_edit_request' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>admin_edit_request">
										<i class="fa fa-fw icon-folder-check"></i>
										<span><?php translate('admin_edit_request') ?></span>
									</a>
								</li>
								<?php if (have_access(43, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'students_list' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>students">
											<i class="fa fa-fw icon-browser"></i>
											<span><?php translate('students_list') ?></span>
										</a>
									</li>
								<?php endif ?>
								<li <?php echo isset($selected) && $selected == 'courses_cat' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>courses_cat">
										<i class="fa fa-graduation-cap"></i>
										<span><?php translate('courses_cat') ?></span>
									</a>
								</li>	
								
								<li <?php echo isset($selected) && $selected == 'add_tutors' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>insert_tutors">
										<i class="fa fa-suitcase"></i>
										<span><?php translate('add_tutors') ?></span>
									</a>
								</li>
								<?php if (have_access(42, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'update_marqu' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>update_comm">
											<i class="fa fa-pencil-square-o"></i>
											<span><?php translate('update_marquee_comm') ?></span>
										</a>
									</li>
								<?php endif ?>
								<?php if (have_access(47, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'get_statics' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>unpaid_statics">
											<i class="fa fa-fw icon-graph-up-1"></i>
											<span><?php translate('get_statics') ?></span>
										</a>
									</li>
									<li <?php echo isset($selected) && $selected == 'get_week_statics' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>statics">
											<i class="fa fa-fw icon-graph-up-1"></i>
											<span><?php translate('get_week_statics') ?></span>
										</a>
									</li>
								<?php endif ?>
								<?php if (have_access(1, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'roles' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>roles">
											<i class="fa fa-gears"></i>
											<span><?php translate('roles') ?></span>
										</a>
									</li>
								
								<?php endif ?>
								<?php if (have_access(59, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'send_message' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>send_message">
											<i class="icon-envelope-3"></i>
											<span>ارسال رسالة</span>
										</a>
									</li>
								
								<?php endif ?>
							</li>
								</ul>
				<?php if ( have_access(39, TRUE)) { ?>
	
						<li class="category border-top">
							<span>Site admin</span>
						</li>
						<li <?php echo isset($selected) && ($selected == 'create_new_user' || $selected == 'admin_edit_request' || $selected == 'admin_edit_user' || $selected == 'add_tutors' || $selected == 'courses_cat' ) ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">
	
							<a href="#menu-2987fd929849c21cafec7f0ab4fdaac5" data-toggle="collapse">
								<i class="fa fa-fw icon-mixer"></i>
								<span><?php translate('admin_Site_section') ?></span>
							</a>
							<ul <?php echo isset($selected) && ($selected == 'sliders_list' || $selected == 'admin_edit_request'|| $selected == 'admin_edit_user'|| $selected == 'add_tutors' || $selected ==  'courses_cat' )? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac5">
	                          <li <?php echo isset($selected) && $selected == 'sliders_list' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>sliders_list">
										<i class="fa fa-fw icon-tv-star"></i>
										<span><?php translate('sliders_list') ?></span>
									</a>
								</li>
								 <li <?php echo isset($selected) && $selected == 'tutor_list' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>tutor_list">
										<i class="fa fa-wrench"></i>
										<span><?php translate('tutor_list') ?></span>
									</a>
								</li>
								
											<li <?php echo isset($selected) && $selected == 'services' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>edit_services">
										<i class="fa fa-edit"></i>
										<span><?php translate('services') ?></span>
									</a>
								</li>	
									
								<li <?php echo isset($selected) && $selected == 'social_media' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>edit_social">
										<i class="fa fa-facebook"></i>
										<span><?php translate('social_media') ?></span>
									</a>
								</li>	
								<li <?php echo isset($selected) && $selected == 'contact_us' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>contact_us">
										<i class="fa fa-phone"></i>
										<span><?php translate('contact_us') ?></span>
									</a>
								</li>	
								<li <?php echo isset($selected) && $selected == 'about_us' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>about_us">
										<i class="fa fa-gears"></i>
										<span><?php translate('about_us') ?></span>
									</a>
								</li>	
							</ul>
								</li>
								
								<?php } ?>
								
								
						<?php  } ?>
						<li>
							<a href="<?php echo base_url() ?>notifications">
								<i class="fa fa-bell"></i>
								<span><?php translate('all_notifics') ?></span>
							</a>
						</li>
					</ul>
				<?php } ?>
				
			</div>
		</div>
		<!-- // Main Sidebar Menu END -->
		
				<!-- Content START -->
		<div id="content">
			
<div class="navbar hidden-print navbar-default box main" role="navigation">

	
	<div class="user-action user-action-btn-navbar pull-left">
		<a href="#menu" class="btn btn-sm btn-navbar btn-open-left"><i class="fa fa-bars fa-2x"></i></a>
	</div>
<!---->
	<ul class="notifications pull-left hidden-xs">
		<li class="dropdown notif" id="notifparent" onclick="aaa()">
			<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" id="noticon"></i>
				<?php echo $nots ? '<span class="fa fa-star" id="notstar"></span>' : '' ?>
			</a>
			<ul class="dropdown-menu chat media-list" id="notiflist">
				<?php foreach ($nots as $not) { ?>
					<li  class="media">
						<a  href="<?php echo base_url().$not->link ?>">
							<div class="media-body">
					        	<span class="label label-default pull-right"><?php echo date('Y-m-d H:i', $not->date) ?></span>
					            <h5 class="media-heading"><?php echo $not->op_name ?></h5>
					            <p class="margin-none"  ><?php echo $not->n_text ?></p>
					        </div>
				        </a>
					</li>
				<?php } ?>
				<?php foreach ($read_nots as $not) { ?>
					<li class="media">
						<a href="<?php echo $not->link == '#' ? '#' : base_url().$not->link ?>">
							<div class="media-body">
					        	<span class="label label-default"><?php echo date('Y-m-d H:i', $not->date) ?></span>
					            <h5 class="media-heading pull-right"><?php echo $not->op_name ?></h5>
					            <p class="margin-none pull-right"><?php echo $not->n_text ?></p>
					        </div>
				        </a>
					</li>
				<?php } ?>
		      	<li class="media">
					<a href="<?php echo base_url() ?>notifications">
						<div class="media-body">
				            <h5 class="media-heading" style="text-align: center"><?php echo trans('all_notifics') ?></h5>
				        </div>
			        </a>
				</li>
	      	</ul>
		</li>
	</ul>

	<div class="user-action pull-left menu-right-hidden-xs menu-left-hidden-xs border-left">
		<div class="dropdown username pull-left">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<span class="media margin-none">
					<span class="pull-left"><img height="30" width="30" src="<?php echo $this->session->userdata('user_img') ? base_url() . "uploads/profile/" . $this->session->userdata('user_img') : base_url()."assets/images/people/250/22.jpg" ?>" alt="user" class="img-circle"></span>
					<span class="media-body"><span class="caret"></span><?php echo $this->session->userdata('user_fullname') ?></span>
				</span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="messages.html?lang=en">Messages</a></li>
				<li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
		    </ul>
		</div>
	</div>
	<div class="input-group hidden-xs pull-left">
	  	<span class="input-group-addon"><i class="icon-search"></i></span>
	  	<input type="text" class="form-control" placeholder="Search a friend"/>
	</div>
</div>
	

			<!-- <div class="layout-app">  -->
			
<div class="innerLR" style="padding-top: 20px">
<?php if ($this->session->userdata('suc_message')) { ?>
	<div class="alert alert-success" <?php echo LANG() == 'en' ? "" : 'style="text-align: right"' ?>>
		<button type="button" class="close" <?php echo LANG() == 'en' ? "" : 'style="float: left"' ?> data-dismiss="alert">×</button>
		<?php echo $this->session->userdata('suc_message'); $this->session->unset_userdata('suc_message') ?>
	</div>
<?php } elseif ($this->session->userdata('err_message')) { ?>
	<div class="alert alert-danger" <?php echo LANG() == 'en' ? "" : 'style="text-align: right"' ?>>
		<button type="button" class="close" <?php echo LANG() == 'en' ? "" : 'style="float: left"' ?> data-dismiss="alert">×</button>
		<?php echo $this->session->userdata('err_message'); $this->session->unset_userdata('err_message') ?>
	</div>
<?php } ?>
<marquee direction="right"><?php echo $statics['marquee'] ?></marquee>
<div class="widget" id="notify">
	
</div>
