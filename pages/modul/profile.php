<?php
error_reporting(0);
session_start(); 

include('../../config/koneksi.php');
$m = date(m);$d = date(d);$y = date(Y);
$aksi="modul/act_user.php";
$dated = date('Y-m-d');
$sql = mysqli_query($conn,"SELECT * FROM masteruser WHERE username = '$_SESSION[username]'");
        $r = mysqli_fetch_array($sql);
			echo "
		<div class='container-fluid'>
			<div class='block-header'>
                <div class='row'>
                    <div class='col-lg-5 col-md-8 col-sm-12'>                        
                        <h2> My Profile</h2><br /><br />
                    </div>         
                </div>
            </div>
			<div class='row clearfix'>
			<div class='col-lg-8 col-md-3'>
			<div class='card'>
                        <div class='panel panel-inverse' data-sortable-id='form-validation-2'>
            <div class='body project_report'>
			<form method='POST' action='modul/aksimaster.php?p=profile&act=updateprofile' class='form-horizontal' data-parsley-validate='true' name='demo-form'>
			<input type='hidden' name='username' value='$r[username]'>
								<div class='form-group row m-b-15'>
									<label class='col-md-4 col-sm-4 col-form-label' for='fullname'>FullName*</label>
									<div class='col-md-8 col-sm-8'>
										<input class='form-control' type='text' name='fullname' data-parsley-required='true' value='$r[fullname]'/>
									</div>
								</div>
								<div class='form-group row m-b-15'>
									<label class='col-md-4 col-sm-4 col-form-label' for='website'>Username*</label>
									<div class='col-md-8 col-sm-8'>
										<input class='form-control' type='text' name='username' value='$r[username]' readonly='readonly'/>
									</div>
								</div>
								<div class='form-group row m-b-15'>
									<label class='col-md-4 col-sm-4 col-form-label' for='message'>New Password*</label>
									<div class='col-md-8 col-sm-8'>
										<input class='form-control' type='password' name='password_n' />
									</div>
								</div>
								<input class='form-control' type='hidden' name='level' value='$r[level]'/>
                            
											<div class='modal-footer'>
											<button type='submit' class='btn btn-yellow'><i class='fa fa-save'></i> Update</button>
											</div>
									</form>
									</div>
                    </div>
                    </div>
				</div>
			";
			?>
			