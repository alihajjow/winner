

</div>	
		
				
		</div>
		<!-- // Content END -->
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
		
				<!-- Footer -->
		<div id="footer" class="print">
			
			<!--  Copyright Line -->
			<div class="copy">&copy; <?php echo date('Y-m-d') ?> - <a href="http://www.mosaicpro.biz">MosaicPro</a> - All Rights Reserved. <a href="http://themeforest.net/?ref=mosaicpro" target="_blank">Purchase Social Admin Template</a> - Current version: v2.0.0-rc8 / <a target="_blank" href="<?php echo base_url() ?>assets/../../CHANGELOG.txt?v=v2.0.0-rc8">changelog</a></div>
			<!--  End Copyright Line -->
	
		</div>
		<!-- // Footer END -->
		
				
	</div>
	<!-- // Main Container Fluid END -->
	

	<!-- Global -->
	<script data-id="App.Config">
		var basePath = '',
		commonPath = 'assets/',
		rootPath = '/',
		DEV = false,
		componentsPath = 'assets/components/';
	
	var primaryColor = '#25ad9f',
		dangerColor = '#b55151',
		successColor = '#609450',
		infoColor = '#4a8bc2',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	
	var themerPrimaryColor = primaryColor;

		App.Config = {
		ajaxify_menu_selectors: ['#menu'],
		ajaxify_layout_app: false	};
		</script>
	<script type="text/javascript">

window.onload = function () {
	get_res();
};
	function aaa() {
      
      $.ajax({
          url: '<?php echo base_url(); ?>read_notifications/',
          success: function(data) {
          	if (data) {
          		$("#notstar").remove();
          	};
          }
      });
    }
    
    function get_res() {
    	//alert('fsds);
    	setTimeout(function(){get_res();}, 10000);
	   //alert('vft');
	   $.ajax({
          url: '<?php echo base_url(); ?>get_notifications/',
          success: function(data) {
          	if (data) {
          		//alert(data);
          		var res = JSON.parse(data);
	            $("#notiflist").prepend(res[1]);
	            $("#noticon").prepend('<span class="fa fa-star" id="notstar"></span>');
	            
	            toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": true,
				  "positionClass": "toast-bottom-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "1000",
				  "hideDuration": "1000",
				  "timeOut": "10000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				};
				toastr["success"](res[0]);
          	};
          	
          }
      });
    }
    
    

	

</script>
		
</body>
</html>