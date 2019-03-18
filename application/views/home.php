<?php $this->load->view('common/header1'); ?>
<!-- DataTables -->
<link href="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assetss/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assetss/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assetss/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assetss/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<!--Morris Chart CSS -->
<link rel="stylesheet" href="<?php echo base_url() ?>assetss/plugins/morris/morris.css">

<link href="<?php echo base_url() ?>assetss/css/pages.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url("assetss/orgchart") ?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url("assetss/orgchart") ?>/css/jquery.orgchart.min.css">
  <link rel="stylesheet" href="<?php echo base_url("assetss/orgchart") ?>/css/style.css">
  <style type="text/css">
    #chart-container { text-align: right; }
  </style>

<div class="row">
    <div class="col-lg-4 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box">
            <h4 class="header-title m-t-0 <?php echo LANG() == 'en' ? '' : '' ?>"><?php echo LANG() == 'en' ? 'Over all tree' : 'جميع التسجيلات' ?></h4>

            <div class="widget-chart text-center">
                <div id="morris-donut-example" style="height: 245px;"></div>
            </div>
            <ul class="list-inline chart-detail-list m-b-0" style="<?php  echo LANG() == 'en' ? '' : 'text-align: right' ?>">
                <?php $sum = 0; foreach ($statics as $row) {
                    $sum += $row->all_count;
                } ?>
                <li>
                    <h5 style="color: #5b69bc;"><?php echo LANG() == 'en' ? "All Count: $sum" : "المجموع الكلي: $sum" ?></h5>
                </li>
            </ul>
        </div>
    </div><!-- end col -->

    <div class="col-lg-4 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box">

            <h4 class="header-title m-t-0 <?php echo LANG() == 'en' ? '' : '' ?>"><?php echo LANG() == 'en' ? 'Records By day' : 'التسجيلات اليومية' ?></h4>
            <div id="morris-line-example" style="height: 280px;"></div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-4 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box">
            <h4 class="header-title m-t-0 <?php echo LANG() == 'en' ? '' : '' ?>"><?php echo LANG() == 'en' ? 'Records By Month' : 'التسجيلات الشهرية' ?></h4>
            <div id="morris-bar-example" style="height: 280px;"></div>
        </div>
    </div><!-- end col -->



</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-3 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box widget-user">
            <div class="col-md-4 <?php echo LANG() == 'en' ? '' : '' ?>">
                <i class="img-responsive zmdi zmdi-balance" style="font-size: 70px; color: green"></i>
            </div>
            <div class="col-md-8 <?php echo LANG() == 'en' ? '' : '' ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
                <h3><?php echo LANG() == 'en' ? 'BALANCE' : 'الرصيد' ?></h3>
                <small class="text-custom"><b><?php echo $balance ?></b></small>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-3 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box widget-user">
            <div class="col-md-4 <?php echo LANG() == 'en' ? '' : '' ?>">
                <i class="zmdi zmdi-account-calendar" style="font-size: 70px; color: red"></i>
            </div>
            <div class="col-md-8 <?php echo LANG() == 'en' ? '' : '' ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
                <h3><?php echo LANG() == 'en' ? 'Classification' : 'المسمى' ?></h3>
                <small class="text-custom"><b><?php echo $desc ?></b></small>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-3 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box widget-user">
            <div class="col-md-4 <?php echo LANG() == 'en' ? '' : '' ?>">
                <i class="zmdi zmdi-assignment-o" style="font-size: 70px; color: blue"></i>
            </div>
            <div class="col-md-8 <?php echo LANG() == 'en' ? '' : '' ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
                <h3><?php echo LANG() == 'en' ? 'Course' : 'الكورس' ?></h3>
                <small class="text-custom"><b><?php echo $course ?></b></small>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-3 <?php echo LANG() == 'en' ? '' : '' ?>">
        <div class="card-box widget-user">
            <div class="col-md-4 <?php echo LANG() == 'en' ? '' : '' ?>">
                <i class="zmdi zmdi-device-hub" style="font-size: 70px"></i>
            </div>
            <div class="col-md-8 <?php echo LANG() == 'en' ? '' : '' ?>" <?php echo LANG() == 'en' ? '' : 'style="text-align: right"' ?>>
                <h3><?php echo LANG() == 'en' ? 'MY TREE' : 'شجرتي' ?></h3>
                <small class="text-custom">
                	<b>
                		<a href="#" onclick="tree()" data-toggle="modal" data-target="#full-width-modal">
                			<?php echo LANG() == 'en' ? 'Show' : 'عرض' ?>
                		</a>
                	</b>
                </small>
            </div>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div class="col-lg-12">
        <div class="card-box" <?php echo LANG() == 'en' ? '' : 'style="text-align: right; overflow-y: auto"' ?>>
            <h4 class="header-title m-t-0 m-b-30"><?php echo LANG() == 'en' ? 'My Network' : 'شبكتي' ?></h4>

            <div class="">
                <table id="datatable" class="table table-striped table-bordered" <?php echo LANG() == 'en' ? '' : 'style="direction: rtl"' ?>>
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;"><?php echo LANG() == 'en' ? 'Name' : 'الاسم' ?></th>
                            <th style="text-align: center;"><?php echo LANG() == 'en' ? 'Last Name' : 'الاسم الأخير' ?></th>
                            <th style="text-align: center;"><?php echo LANG() == 'en' ? 'Father' : 'اسم الأب' ?></th>
                            <th style="text-align: center;"><?php echo LANG() == 'en' ? 'Gov ID' : 'الرقم الوطني' ?></th>
                            <th style="text-align: center;"><?php echo LANG() == 'en' ? 'Email' : 'البريد الالكتروني' ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($children as $row) { ?>
                            <tr>
                                <td style="text-align: center;"><?php $i++; echo $i ?></td>
                                <td style="text-align: center;"><a href="#"><?php echo $row->f_name ?></a></td>
                                <td style="text-align: center;"><?php echo $row->l_name ?></td>
                                <td style="text-align: center;"><?php echo $row->father ?></td>
                                <td style="text-align: center;"><?php echo $row->gov_id ?></td>
                                <td style="text-align: center;"><?php echo $row->email ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->

</div>

<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel"><?php echo LANG() == 'en' ? 'Tree' : 'الشجرة' ?></h4>
            </div>
            <div class="modal-body">
                <div id="chart-container"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        <?php $this->load->view('common/footer1'); ?>
        <!--Morris Chart-->
        <script src="<?php echo base_url() ?>assetss/plugins/morris/morris.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/raphael/raphael-min.js"></script>

<!-- Datatables--><script type="text/javascript" src="<?php echo base_url("assetss/orgchart") ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assetss/orgchart") ?>/js/jquery.mockjax.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url("assetss/orgchart") ?>/js/jquery.orgchart.min.js"></script>
 
<!-- Datatables-->
<script src="<?php echo base_url() ?>assetss/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url() ?>assetss/plugins/datatables/dataTables.buttons.min.js"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url() ?>assetss/pages/datatables.init.js"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url() ?>assetss/pages/datatables.init.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
    } );

    !function($) {
        "use strict";

        var Dashboard1 = function() {
            this.$realData = []
        };

        //creates Bar chart
        Dashboard1.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
            Morris.Bar({
                element: element,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                labels: labels,
                hideHover: 'auto',
                resize: true, //defaulted to true
                gridLineColor: '#eeeeee',
                barSizeRatio: 0.2,
                barColors: lineColors
            });
        },

            //creates line chart
            Dashboard1.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
                Morris.Line({
                    element: element,
                    data: data,
                    xkey: xkey,
                    ykeys: ykeys,
                    labels: labels,
                    fillOpacity: opacity,
                    pointFillColors: Pfillcolor,
                    pointStrokeColors: Pstockcolor,
                    behaveLikeLine: true,
                    gridLineColor: '#eef0f2',
                    hideHover: 'auto',
                    resize: true, //defaulted to true
                    pointSize: 0,
                    lineColors: lineColors
                });
            },

            //creates Donut chart
            Dashboard1.prototype.createDonutChart = function(element, data, colors) {
                Morris.Donut({
                    element: element,
                    data: data,
                    resize: true, //defaulted to true
                    colors: colors
                });
            },


            Dashboard1.prototype.init = function() {

                //creating bar chart
                var $barData  = [
                    <?php foreach ($month_stacks as $row) { ?>
                        { y: '<?php echo $row['date'] ?>', a:<?php echo $row['dayt'] ?>},
                    <?php } ?>
                ];
                this.createBarChart('morris-bar-example', $barData, 'y', ['a'], ['<?php echo LANG() == 'en' ? 'Count' : 'المجموع' ?>'], ['#188ae2']);

                //create line chart
                var $data  = [
                    <?php foreach ($day_stacks as $row) { ?>
                        { y: '<?php echo $row['date'] ?>', a:<?php echo $row['dayt'] ?>},
                    <?php } ?>
                ];
                this.createLineChart('morris-line-example', $data, 'y', ['a'], ['<?php echo LANG() == 'en' ? 'Count' : 'المجموع' ?>'],['0.9'],['#ffffff'],['#999999'], ['#10c469','#188ae2']);

                var $donutData = [
                    <?php foreach ($statics as $row) { ?>
                    {label: '<?php echo $row->c_name ?>', value: <?php echo $row->all_count ?>},
                    <?php } ?>
                ];
                this.createDonutChart('morris-donut-example', $donutData, ['#ff8acc', '#5b69bc', "#35b8e0", '#aa8acc', '#5bffbc', "#35b8ff", '#008acc', '#5b00bc', "#3500e0"]);

            },
            //init
            $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
    }(window.jQuery),

	//initializing
	function($) {
	    "use strict";
	    $.Dashboard1.init();
	}(window.jQuery);
                
    function tree () {
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
			      'data' : '<?php echo base_url("welcome/tree"); ?>',
			      'nodeContent': 'title',
			      'direction': 'r2l'
			    });
              };

            }
        });
        
	}
</script>