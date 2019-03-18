<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
  3      <link rel="shortcut icon" href="<?php echo base_url() ?>assetss/images/favicon.ico">

        <!-- App title -->
        <title>ADMIN PANEL</title>

        <!-- App CSS -->
        <link href="<?php echo base_url() ?>assetss/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assetss/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url() ?>assetss/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo"><span>Admin<span>Panel</span></span><i class="zmdi zmdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title"><?php echo $title ?></h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline m-b-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                            <li class="hidden-xs">
                                <form role="search" class="app-search">
                                    <input type="text" placeholder="Search..."
                                           class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            <img src="assetss/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                        </div>
                        <h5><a href="#"><?php echo $this->session->userdata('user_fullname') ?></a> </h5>
                        <ul class="list-inline">
                            <li>
                                <a href="#" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url("logout") ?>" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <?php  if (have_access(56, TRUE)) { ?>
					<ul class="menu list-unstyled">
						<li <?php echo isset($selected) && ($selected == 'edit_user' || $selected == 'change_password' || $selected == 'create_user' || $selected == 'edit_child_data' ) ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">
							<a href="#menu-2987fd929849c21cafec7f0ab4fdaac1" data-toggle="collapse">
								<i class="fa fa-user"></i>
								<span><?php translate('user_side') ?></span>
							</a>
							<ul <?php echo isset($selected) && ($selected == 'edit_user' || $selected == 'change_password' || $selected == 'create_user' || $selected == 'edit_child_data' ) ? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac1">

								<li <?php echo isset($selected) && $selected == 'register_course' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>reg_course">
										<i class="fa fa-calendar-minus-o"></i>
										<span><?php translate('register_course') ?></span>
									</a>
								</li>
								<?php if (have_access(40, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'week_com' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>week_comms">
											<i class="fa fa-cart-plus"></i>
											<span><?php translate('week_com') ?></span>
										</a>
									</li>
									<li <?php echo isset($selected) && $selected == 'week_com' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>week_studs">
											<i class="fa fa-users"></i>
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
										<i class="fa fa-user-plus"></i>
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
									<i class="fa fa-dollar"></i>
									<span><?php translate('financial_operations') ?></span>
								</a>
								<ul <?php echo isset($selected) && ($selected == 'convert_balance' || $selected == 'transfer' || $selected == 'pending_payments'|| $selected == 'change_pay_password') ? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac3">

								<li <?php echo isset($selected) && $selected == 'convert_balance' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>convert_balance">
										<i class="fa fa-bank"></i>
										<span><?php translate('convert_balance') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'transfer' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>transfer">
										<i class="fa fa-send-o"></i>
										<span><?php translate('transfer') ?></span>
									</a>
								</li>
								<li <?php echo isset($selected) && $selected == 'pending_payments' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>pending_pays">
										<?php echo $statics['pays_num'] ? "<span class='badge pull-right badge-primary'>".$statics['pays_num']."</span>" : '' ?>
										<i class="fa y fa-cc-discover"></i>
										<span><?php translate('pending_payments') ?></span>
									</a>
								</li>
								
								<li <?php echo isset($selected) && $selected == 'change_pay_password' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>change_pay_password">
										<i class="fa fa-key"></i>
										<span><?php translate('change_pay_password') ?></span>
									</a>
								</li>
							</ul>
							</li>
							<?php } ?>



							 <?php if (have_access(1, TRUE) || have_access(43, TRUE) || have_access(33, TRUE) || have_access(34, TRUE) || have_access(59, TRUE) || have_access(35, TRUE) || have_access(58, TRUE)) { ?>
						<li class="category border-top">
							</li>
							<li <?php echo isset($selected) && ($selected == 'create_new_user' || $selected == 'admin_edit_request' || $selected == 'admin_edit_user' || $selected == 'add_tutors' || $selected == 'courses_cat' ) ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">

							<a href="#menu-2987fd929849c21cafec7f0ab4fdaac2" data-toggle="collapse">
								<i class="fa fa-dashboard"></i>
								<span><?php translate('admin_section') ?></span>
							</a>
							<ul <?php echo isset($selected) && ($selected == 'create_new_user' || $selected == 'admin_edit_request'|| $selected == 'admin_edit_user'|| $selected == 'add_tutors' || $selected ==  'courses_cat' )? 'class="collapse in"' : 'class="collapse"'; ?>" id="menu-2987fd929849c21cafec7f0ab4fdaac2">
	                          

								<li <?php echo isset($selected) && $selected == 'admin_edit_request' ? 'class="active"' : ''; ?>>
									<a href="<?php echo base_url(); ?>admin_edit_request">
										<i class="fa fa-thumbs-up"></i>
										<span><?php translate('admin_edit_request') ?></span>
									</a>
								</li>
								<?php if (have_access(43, TRUE)): ?>
									<li <?php echo isset($selected) && $selected == 'students_list' ? 'class="active"' : ''; ?>>
										<a href="<?php echo base_url(); ?>students">
											<i class="fa fa-list-alt"></i>
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

						<li <?php echo isset($selected) && ($selected == 'create_new_user' || $selected == 'admin_edit_request' || $selected == 'admin_edit_user' || $selected == 'add_tutors' || $selected == 'courses_cat' ) ? ' class="hasSubmenu active"' : ' class="hasSubmenu"'; ?>">

							<a href="#menu-2987fd929849c21cafec7f0ab4fdaac5" data-toggle="collapse">
								<i class="fa fa-book"></i>
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
				<div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container" >

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
