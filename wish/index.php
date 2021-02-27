<?php 
require_once '../system/config.php';
Sessions::adminRedirectOnNotLoggedIn();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<title>Nestomalt</title>
	<?php include(DOC_ROOT.'includes/head.php'); ?>
	
</head>
<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">

		<?php include(DOC_ROOT.'includes/header.php') ?>

		<?php include(DOC_ROOT.'includes/sidebar.php') ?>

		<div id="page-wrapper">
            <div class="container-fluid">
            	<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Nestomalt</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo SITE_URL; ?>">Dashboard</a></li>
                            <li class="active">Nestomalt</li>
                        </ol>
                    </div>
                </div>

            	<div class="row">
					<div class="col-sm-12">
                        <div class="white-box inner-page">
							<h3 class="box-title">Approved Wishes</h3>
							
							<div class="clearfix"></div>
							<div id="form_submit_msg"></div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<th width="10%">#</th>
										
										<th width="10%">Facebook ID</th>

										<th width="20%">Name</th>

										<th width="10%">District</th>

										<th width="30%">Wish</th>
										
                                        <th width="10%">Picture</th>
										<th class="text-center" width="10%">Action</th>
									</thead>
									<tbody id="content">
										
									</tbody>

								</table>
							</div>
							<div class="clearfix"></div>
							<div class="pull-right" id="pagination"></div>
						</div>
						<div id="modal_content"></div>
					</div>
				</div>
			</div>

			<footer class="footer text-center"> <?php echo date('Y'); ?> &copy; Neo@ogilvy </footer>
		</div>
	</div>
	<?php include(DOC_ROOT.'includes/footer.php'); ?>
	<script>
	  $( function() {
	  	<?php 
	  	$get = htmlentities($_GET['page']);
	  	if(isset($get)){
	  		$page = htmlentities($_GET['page']);
	  	}else{
	  		$page = 1;
	  	}

	  	 ?>
	    	loadData(<?php echo $page; ?>);
	  } );

	  function loadData(page){
	  		$.ajax({
                 type: 'POST',
                 url: '../system/controllers/wish_controller.php',
                 data: "&action=index&page="+page,
                 success: function(res) { console.log(res);
                 	var obj = jQuery.parseJSON(res);
                    $('#content').html(obj.table);
                    $('#modal_content').html(obj.modal);
                    $('#pagination').html(obj.pagination);
                 },
             });
	  }

	  function deleteDomain(id){

			$.ajax({
			     type: 'POST',
			     url: '../system/controllers/domain_controller.php',
			     data: "&id="+id+"&action=destroy",
			     success: function(res) { console.log(res);

			        $('#row'+id).fadeOut(1000,function(){
						showFrontFormMessage('#form_submit_msg','success',{message:"Deleted Successfully"});	
					});
			     },
			});
		}


		function setstatus(id,status){

	       
	         $.ajax({
	                 type: 'POST',
	                 url: '../system/controllers/wish_controller.php',
	                 data: "&action=setstatus&id="+id+"&status="+status,
	                 success: function(res) {
	                  var obj = jQuery.parseJSON(res);

	                  console.log(res);
	                 
	                   $("#"+res+"status_msg").fadeTo(500, 1, function() { $(this).html("status updated..!").fadeTo(7000, 0, function() { $(this).hide() } ); })
	                 },
	             });
  
         
    }
	</script>
</body>
</html>