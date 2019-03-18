</div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer">
                    2016 © Adminto.
                </footer>

            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <?php
            $nots = get_statics();
            $new_nots = $nots['notifcs'];
            $old_nots = $nots['oldnotif'];
            ?>
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="zmdi zmdi-close-circle-o"></i>
                </a>
                <h4 class=""><?php echo trans('notifications') ?></h4>
                <div class="notification-list nicescroll">
                    <ul class="list-group list-no-border user-list" id="nots_bar">
                    	<?php foreach ($new_nots as $not): ?>
            				<li class="list-group-item">
            	                <a href="<?php echo $not->link ?>" class="user-list-item">
            	                    <div class="icon bg-warning">
            	                        <i class="zmdi zmdi-<?php echo $not->icon ?>"></i>
            	                    </div>
            	                    <div class="user-desc">
            	                        <span class="name"><?php echo LANG() == 'en' ? $not->op_name_en : $not->op_name ?></span>
            	                        <span class="desc"><?php echo LANG() == 'en' ? $not->n_text_en : $not->n_text ?></span>
            	                        <span class="time" dir="ltr"><?php echo substr($not->date, 0, 16); ?></span>
            	                    </div>
            	                </a>
            	            </li>
            			<?php endforeach ?>
                        <?php foreach ($old_nots as $not): ?>
            				<li class="list-group-item">
            	                <a href="<?php echo $not->link ?>" class="user-list-item">
            	                    <div class="icon bg-warning">
            	                        <i class="zmdi zmdi-<?php echo $not->icon ?>"></i>
            	                    </div>
            	                    <div class="user-desc">
            	                        <span class="name"><?php echo LANG() == 'en' ? $not->op_name_en : $not->op_name ?></span>
            	                        <span class="desc"><?php echo LANG() == 'en' ? $not->n_text_en : $not->n_text ?></span>
            	                        <span class="time" dir="ltr"><?php echo substr($not->date, 0, 16); ?></span>
            	                    </div>
            	                </a>
            	            </li>
            			<?php endforeach ?>



                    </ul>
                </div>
            </div>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url() ?>assetss/js/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/detect.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/fastclick.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/waves.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url() ?>assetss/plugins/toastr/toastr.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url() ?>assetss/js/jquery.core.js"></script>
        <script src="<?php echo base_url() ?>assetss/js/jquery.app.js"></script>
        <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
          if (Notification.permission !== "granted")
              Notification.requestPermission();
        });

        function notifyMe(title, text, link) {
          if (Notification.permission !== "granted")
            Notification.requestPermission();
          else {
            var notification = new Notification(title, {
              icon: 'http://tkt.aya.sy/assets/images/aya.png',
              body: text,
            });
            notification.onclick = function () {
              window.open(link);
            };
          }
        }

        function read_nots() {

            $.ajax({
                url: '<?php echo base_url().index_page(); ?>read_notifications/',
                success: function(data) {

                  $("#noti_dot").remove();

                }
            });
          }

          window.onload = function () {
          get_not();
        };

          function get_not() {
            //alert('fsds);
            setTimeout(function(){get_not();}, 5000);
           //alert('vft');
           $.ajax({
                url: '<?php echo base_url().index_page(); ?>get_notifications/',
                success: function(data) {
                  if (data) {
                    //alert(data);
                    var res = JSON.parse(data);
                    var html = '<li class="list-group-item">' +
                              '<a href="' + res[3] + '" class="user-list-item">' +
                              '<div class="icon bg-warning">' +
            	                        '<i class="zmdi zmdi-"></i>' +
            	                    '</div>' +
                                  '<div class="user-desc">' +
                                     '<span class="name">' + res[2] + '</span>' +
                                      '<span class="desc">' + res[0] + '</span>' +
                                      '<span class="time" dir="ltr">' + res[5] + '</span>' +
                                  '</div>' +
                              '</a>' +
                          '</li>';
                    $("#nots_bar").prepend(html);
                    var newnot = '<div class="noti-dot" id="noti_dot">' +
                                        '<span class="dot"></span>' +
                                        '<span class="pulse"></span>' +
                                    '</div>';
                    $("#not_dot").append(newnot);
                    if (!document.hasFocus()) {
                  notifyMe(res[2], res[0], res[3]);
              }


              toastr["success"](res[2], res[0]);

              toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": function () { location.href=res[3]; },
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              };
                  };

                }
            });
          }
        </script>
    </body>
</html>
