<?php 

require_once '../system/config.php';
Sessions::adminRedirectOnNotLoggedIn();

$wishes = new Wishes();
$day01_winners = $wishes->getDayWinners();
$day02_winners = $wishes->getDay2Winners();
$day03_winners = $wishes->getDay3Winners();



// print_r($day01_winners);

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
	<title>SLT | Christmas</title>
	
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
                             <li><a href="<?php echo SITE_URL; ?>wish/">Winners</a></li>
                            <li class="active">Winners</li>
                        </ol>
                    </div>
                </div>

				<div class="row">
					<div class="col-sm-12">


						<div class="white-box">
							<h3 class="box-title">Day 01 Winners</h3>

							<?php
							if (sizeof($day01_winners) < 4) { ?>

								<a href="#" class="btn btn-success pull-right" type="button" onclick="day1winners();">Genarate Day 01 Winners</a>
								
							<?php }

							 ?>

							
							<div class="clearfix"></div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<th>#</th>
										
										<th>Facebook ID</th>

										<th>Name</th>

										<th>Wish</th>
										
                                        <th>Picture</th>
									</thead>
									<tbody>

										<?php

									foreach($day01_winners  as $value1) { ?>
										<tr>
											<td><?php echo $value1['id']; ?></td>
											<td><?php echo $value1['facebook_id']; ?></td>
											<td><?php echo $value1['first_name']; ?> <?php echo $value1['last_name']; ?></td>
											<td><?php echo $value1['wish']; ?></td>
											<td><img src="//graph.facebook.com/<?php echo $value1['facebook_id']; ?>/picture?"></td>
										</tr>
									<?php }

									 ?>

										
									</tbody>

								</table>
							</div>
							<div class="clearfix"></div>
						</div>


						<div class="white-box ">
							<h3 class="box-title">Day 02 Winners</h3>

							<?php
							if (sizeof($day02_winners) < 4) { ?>

								<a href="#" class="btn btn-success pull-right" type="button" onclick="day2winners();">Genarate Day 02 Winners</a>
								
							<?php }

							 ?>

							
							<div class="clearfix"></div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<th>#</th>
										
										<th>Facebook ID</th>

										<th>Name</th>

										<th>Wish</th>
										
                                        <th>Picture</th>
									</thead>
									<tbody>

										<?php

									foreach($day02_winners  as $value2) { ?>
										<tr>
											<td><?php echo $value2['id']; ?></td>
											<td><?php echo $value2['facebook_id']; ?></td>
											<td><?php echo $value2['first_name']; ?> <?php echo $value2['last_name']; ?></td>
											<td><?php echo $value2['wish']; ?></td>
											<td><img src="//graph.facebook.com/<?php echo $value2['facebook_id']; ?>/picture?"></td>
										</tr>
									<?php }

									 ?>

										
									</tbody>

								</table>
							</div>
							<div class="clearfix"></div>
						</div>


						<div class="white-box ">
							<h3 class="box-title">Day 03 Winners</h3>

							<?php
							if (sizeof($day03_winners) < 4) { ?>

								<a href="#" class="btn btn-success pull-right" type="button" onclick="day3winners();">Genarate Day 03 Winners</a>
								
							<?php }

							 ?>

							
							<div class="clearfix"></div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<th>#</th>
										
										<th>Facebook ID</th>

										<th>Name</th>

										<th>Wish</th>
										
                                        <th>Picture</th>
									</thead>
									<tbody>

										<?php

									foreach($day03_winners  as $value3) { ?>
										<tr>
											<td><?php echo $value3['id']; ?></td>
											<td><?php echo $value3['facebook_id']; ?></td>
											<td><?php echo $value3['first_name']; ?> <?php echo $value3['last_name']; ?></td>
											<td><?php echo $value3['wish']; ?></td>
											<td><img src="//graph.facebook.com/<?php echo $value3['facebook_id']; ?>/picture?"></td>
										</tr>
									<?php }

									 ?>

										
									</tbody>

								</table>
							</div>
							<div class="clearfix"></div>
						</div>
							
							
				</div>
			   </div>

			<footer class="footer text-center"> <?php echo date('Y'); ?> &copy; Neo@ogilvy </footer>
		</div>
	</div>

	<?php include(DOC_ROOT.'includes/footer.php'); ?>


<!-- Validate js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script> 

<script type="text/javascript">
    function day1winners(){
    	$.ajax({
	                 type: 'POST',
	                 url: '../system/controllers/wish_controller.php',
	                 data: "action=day1winners",
	                 success: function(res) {
	                    if ($.trim(res) == 200){
	                    	location.reload();
	                    }else{
	                    	alert('try again');
	                    }
	                 },
	             });
    }


    function day2winners(){
    	$.ajax({
	                 type: 'POST',
	                 url: '../system/controllers/wish_controller.php',
	                 data: "action=day2winners",
	                 success: function(res) {
	                    if ($.trim(res) == 200){
	                    	location.reload();
	                    }else{
	                    	alert('try again');
	                    }
	                 },
	             });
    }


    function day3winners(){
    	$.ajax({
	                 type: 'POST',
	                 url: '../system/controllers/wish_controller.php',
	                 data: "action=day3winners",
	                 success: function(res) {
	                    if ($.trim(res) == 200){
	                    	location.reload();
	                    }else{
	                    	alert('try again');
	                    }
	                 },
	             });
    }
    
</script>

    </body>
</html>