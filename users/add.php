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
	<title>Add Users | Server Renewal</title>
	
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
                             <li><a href="<?php echo SITE_URL; ?>users/">Users</a></li>
                            <li class="active">Add Users</li>
                        </ol>
                    </div>
                </div>

				<div class="row">
					<div class="col-sm-12">
                        <div class="white-box">
							<h3 class="box-title">Add Users</h3>
							<a class="btn btn-danger pull-right" href="<?php echo SITE_URL; ?>users/"><i class="fa fa-eye fa-fw"></i> View Users</a>
							<div class="clearfix"></div>
							<div class="margin-top-10">
								<form class="form-horizontal" id="add_form">
										<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-2 control-label" for="first_name">First Name</label>  
										  <div class="col-md-10">
										  <input id="first_name" name="first_name" type="text" placeholder="Enter First Name" class="form-control input-md">
										  </div>
										</div>

										<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-2 control-label" for="last_name">Last Name</label>  
										  <div class="col-md-10">
										  <input id="last_name" name="last_name" type="text" placeholder="Enter Last Name" class="form-control input-md">
										  </div>
										</div>

										<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-2 control-label" for="email">Email</label>  
										  <div class="col-md-10">
										  <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md">
										  </div>
										</div>

										<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-2 control-label" for="username">Username</label>  
										  <div class="col-md-10">
										  <input id="username" name="username" type="text" placeholder="Enter Username" class="form-control input-md">
										  </div>
										</div>

										<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-2 control-label" for="password">Password</label>  
										  <div class="col-md-10">
										  <input id="password" name="password" type="password" placeholder="Enter Password" class="form-control input-md">
										  </div>
										</div>

										<div class="form-group">
										  <div class="col-md-12">
											<button class="btn btn-success pull-right" type="submit" id="submit_btn">Save</button>					    
										  </div>
										</div>

								</form>

							</div>
							<div class="clearfix">
							
					</div>
					<div id="form_submit_msg"></div>
				</div>
			</div>

			<footer class="footer text-center"> <?php echo date('Y'); ?> &copy; Neo@ogilvy </footer>
		</div>
	</div>

	<?php include(DOC_ROOT.'includes/footer.php'); ?>


<!-- Validate js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script> 
<script type="text/javascript">
    $(document).ready(function(){
        
        
        $("#add_form").validate({
            rules: {
                first_name: {required: true},
                last_name: {required: true},
                username: {required: true},
                password: {required: true},
                email: {required: true,email: true},
            },
            messages: {
                first_name: "<p class='text-danger'>Please enter first name</p>",
                last_name: "<p class='text-danger'>Please enter last name</p>",
                username: "<p class='text-danger'>Please enter username</p>",
                password: "<p class='text-danger'>Please enter password</p>",
                email: {
                	required: "<p class='text-danger'>Please enter a email address</p>",
                	email: "<p class='text-danger'>Please enter valid email address</p>"
                },               
                
            },
            submitHandler: function () {

              var url_data = $('#add_form').serialize();
              url_data += "&action=store"; console.log(url_data);

              $.ajax({
                 type: 'POST',
                 url: '../system/controllers/users_controller.php',
                 data: url_data,
                 success: function(res) {
                    $('#form_submit_msg').show(); console.log(res);
                    if($.trim(res)==200){
                      clearFormFieldsFront("#add_form");
                      showFrontFormMessage('#form_submit_msg','success',{message:'Successfully Added'});
                      //$('#form_submit_msg').html('<p class="alert alert-success"> Successfully Added</p>');
                    }else{
                    	showFrontFormMessage('#form_submit_msg','error',{message:'Something wrong. Please try again'});
                      //$('#form_submit_msg').html('<p class="alert alert-danger"> Something wrong. Please try again</p>');
                    }
                    //$('#form_submit_msg').hide(3000);
                 },
              });
        
            }

        });          
    });

    
    </script>

    </body>
</html>