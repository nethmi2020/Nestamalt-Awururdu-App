<?php 
require_once 'system/config.php';
Sessions::adminRedirectOnNotLoggedIn();

$wish = new Wishes();
$all_count_domains = $wish->getAllCount();

$aproved = $wish->selectAll();

$rejected = $wish->getRejected();

$pending = $wish->getPending();

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

		<!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4> </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                   
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info"><a href="<?php echo SITE_URL; ?>wish/">
                            <h3 class="box-title">Total Approved </h3>
                            <ul class="list-inline two-part">
                                
                                <li>
                                    <div id="sparklinedash"><i class="fa fa-link fa-fw" aria-hidden="true"></i></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success" id="total_server_count"> </span></li>
                            </ul></a>
                            <?php echo sizeof($aproved); ?>
                         </div>
                    </div>
					<div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info"><a href="<?php echo SITE_URL; ?>wish/">
                            <h3 class="box-title">Pending Entries </h3>
                            <ul class="list-inline two-part">
                                
                                <li>
                                    <div id="sparklinedash"><i class="fa fa-link fa-fw" aria-hidden="true"></i></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success" id="total_server_count"> </span></li>
                            </ul></a>
                            <?php echo sizeof($pending); ?>
                         </div>
                    </div>
					<div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info"><a href="<?php echo SITE_URL; ?>wish/">
                            <h3 class="box-title">Rejected Entries </h3>
                            <ul class="list-inline two-part">
                                
                                <li>
                                    <div id="sparklinedash"><i class="fa fa-link fa-fw" aria-hidden="true"></i></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success" id="total_server_count"> </span></li>
                            </ul></a>
                            <?php echo sizeof($rejected); ?>
                         </div>
                    </div>
                   
                </div>
                <!--/.row -->

            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> <?php echo date('Y'); ?> &copy; Neo@ogilvy </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
	</div>

	<?php include(DOC_ROOT.'includes/footer.php'); ?>

    <script type="text/javascript">

        window.onload = function(){
            loadDashboardFunctions();
        }
    </script>

</body>
</html>