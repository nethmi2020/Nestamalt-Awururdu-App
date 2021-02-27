	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Menu CSS -->
    <link href="<?php echo SITE_URL; ?>css/sidebar-nav.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo SITE_URL; ?>css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo SITE_URL; ?>css/colors/default.css" id="theme" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/main.css">
    
    <script>
	 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	 ga('create', 'UA-100332427-1', 'auto',{ userId: <?php echo Sessions::getAdminId(); ?> });
	 ga('send', 'pageview');
	
	</script>