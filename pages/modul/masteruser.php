    <?php
    error_reporting(0);
    session_start();
    include('../config/koneksi.php');
    ?>
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">	
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Master User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href='?p=formuser'><button type="button" class="btn btn-primary btn-block">Tambah User</button></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Full Name</th>
                                            <th>Password</th>
                                            <th>Jabatan</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sh = mysqli_query($conn, "SELECT *FROM masteruser ORDER BY iduser DESC");
                                        while($s = mysqli_fetch_array($sh)){    
                                         echo " <tr class='odd gradeX'>
                                                    <td>$s[username]</td>
                                                    <td>$s[fullname]</td>
                                                    <td class='center'>******</td>
                                                    <td class='center'>$s[jabatan]</td>
                                                    <td class='center'>$s[level]</td>
                                                    <td class='center'>
                                                        <a href='?p=formuser&act=edituser&id=$s[iduser]'><button type='button' class='btn btn-default btn-sm'>Edit</button></a>
                                                        <a href='modul/aksimaster.php?act=deluser&id=$s[iduser]'><button type='button' class='btn btn-default btn-sm'>Delete</button>    
                                                    </td>
                                            </tr>";
                                    }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
     <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>	
<script type="text/javascript">
$(function(){
	$('#dataTables-example').DataTable({
		responsive: true
	});
});
</script>	