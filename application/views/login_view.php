
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url("assetss") ?>/images/favicon.ico">

        <!-- App title -->
        <title>Winner | Login</title>

        <!-- App CSS -->
        <link href="<?php echo base_url("assetss") ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assetss") ?>/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assetss") ?>/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assetss") ?>/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assetss") ?>/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assetss") ?>/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assetss") ?>/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url("assetss") ?>/js/modernizr.min.js"></script>

    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Winner</span></a>
                <h5 class="text-muted m-t-0 font-600">Admin Dashboard</h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
                </div>
                <div class="panel-body">
									<form method="post" action="<?php echo base_url()."login"; ?>">
										<div class="form-group ">
													 <div class="col-xs-12">
															 <input class="form-control" type="text" name="username" required="" placeholder="Username">
													 </div>
											 </div>

											 <div class="form-group">
													 <div class="col-xs-12">
															 <input class="form-control" name="password" type="password" required="" placeholder="Password">
													 </div>
											 </div>


											 <div class="form-group text-center m-t-30">
													 <div class="col-xs-12">
															 <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
													 </div>
											 </div>


									</form>

                </div>
            </div>
            <!-- end card-box-->


        </div>
        <!-- end wrapper page -->



    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url("assetss") ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/detect.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/fastclick.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/waves.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/wow.min.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url("assetss") ?>/js/jquery.core.js"></script>
        <script src="<?php echo base_url("assetss") ?>/js/jquery.app.js"></script>

	</body>
</html>
