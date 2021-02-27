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
	<title>View Users | Server Renewal</title>
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
                        <h4 class="page-title">Users</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo SITE_URL; ?>">Dashboard</a></li>
                            <li class="active">Users</li>
                        </ol>
                    </div>
                </div>

            	<div class="row">
					<div class="col-sm-12">
                        <div class="white-box inner-page">
							<h3 class="box-title">Users</h3>
							<a class="btn btn-danger pull-right" href="<?php echo SITE_URL; ?>users/add.php"><i class="fa fa-plus fa-fw"></i> Add Users</a>
							<div class="clearfix"></div>
							<div id="form_submit_msg"></div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<th>#</th>
										<th>Full Name</th>
										<th>email</th>
										<th>Username</th>
										<th>Action</th>
									</thead>
									<tbody id="content">
										
									</tbody>

								</table>
							</div>
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
                 url: '../system/controllers/users_controller.php',
                 data: "&action=index&page="+page,
                 success: function(res) {
                 	var obj = jQuery.parseJSON(res);
                    $('#content').html(obj.table);
                    $('#modal_content').html(obj.modal);
                    $('#pagination').html(obj.pagination);
                 },
             });
	  }

	  function deleteUser(id){

			$.ajax({
			     type: 'POST',
			     url: '../system/controllers/users_controller.php',
			     data: "&id="+id+"&action=destroy",
			     success: function(res) { console.log(res);

			        $('#row'+id).fadeOut(1000,function(){
						showFrontFormMessage('#form_submit_msg','success',{message:"Deleted Successfully"});	
					});
			     },
			});
		}
	</script>
</body>
</html>