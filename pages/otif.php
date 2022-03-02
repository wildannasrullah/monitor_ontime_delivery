<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
error_reporting(1);
session_start(); 
include('../config/koneksi.php');
include('../config/fungsi_indotgl.php');
include('../config/fungsi_ribuan.php');

//cek apakah user sudah login 
    if(!isset($_SESSION['username'])){ 
    ?><script language='javascript'>alert('You are not logged in. Please login first!');
    document.location='index.php'</script><?php
        //jika belum login jangan lanjut.. 
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delivery On Time In Full - OTIF</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	
    <!-- DataTables CSS -->
    <link href='../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css' rel='stylesheet'>

    <!-- DataTables Responsive CSS -->
    <link href='../bower_components/datatables-responsive/css/dataTables.responsive.css' rel='stylesheet'>  


    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><b>Delivery On Time In Full</b> - PT. Krisanthium Offset Printing</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                        <?php 
                        $u = mysqli_fetch_array(mysqli_query($conn, "SELECT *FROM masteruser where username='$_SESSION[username]'"));?>
                    </a>
                   <li><a href="?p=profile"><i class="fa fa-user fa-fw"></i> <?php echo $u[fullname]; ?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
                     </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="?p=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                       <li>
                            <a href="?p=monitor-otif"><i class="fa fa-bar-chart-o fa-fw"></i> Monitor Otif</a>
                        </li>
                        <?php
                        if($_SESSION[level]=='Superadmin'){
                        ?>
                        <li>
                            <a href=""><i class="fa fa-sitemap fa-fw"></i> Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=masteruser">User</a>
                                </li>
                                <li>
                                    <a href="?p=mastersetting">Setting</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                         }
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php 
                include('content.php');
            ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<script src="../bower_components/sammy/lib/min/sammy-latest.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	
      <!-- DataTables JavaScript -->
    <script src='../bower_components/datatables/media/js/jquery.dataTables.min.js'></script>
    <script src='../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'></script>  
    <script type='text/javascript'>
    $(function(){
                    $('#dataTables-example').DataTable({
                            responsive: true
                    });
    });
    </script>   
</body>

</html>
