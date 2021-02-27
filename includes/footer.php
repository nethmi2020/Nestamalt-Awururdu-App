	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="<?php echo SITE_URL; ?>js/functions.js"></script>	

	<script type="text/javascript">
		
	function doLogout(){
		$.ajax({
	         type: 'POST',
	         url: 'system/controllers/users_controller.php',
	         data: "&action=logout",
	         success: function(res) {
	            if($.trim(res)==200){
	              window.location.href= '<?php echo SITE_URL ?>';
	            }else{
	            }
	         },
	    });
	}	

	</script>

	<!-- Menu Plugin JavaScript -->
   <!--  <script src="<?php echo SITE_URL; ?>js/sidebar-nav.min.js"></script>
    <script src="<?php echo SITE_URL; ?>js/custom.js"></script> -->