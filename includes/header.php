<!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="<?php echo SITE_URL; ?>">
                        
                        <img class="img-responsive" src="<?php echo SITE_URL; ?>images/logo.jpg" alt="home" />
                       
                    </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                 
                    <li>
                        <a class="profile-pic" href="#"><?php echo Sessions::getAdminFullName(); ?></a>
                    </li>
                    <li> <a href="javascript:;" onclick="doLogout();"> <i class="fa fa-power-off fa-lg"></i></a></li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>