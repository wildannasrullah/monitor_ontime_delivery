<?php
error_reporting(0);
session_start();
include('../config/koneksi.php');
?>
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>
                         <?php
                        if($_GET[act]=='edituser'){
                            echo "Edit User";
                        }else{
                            echo "Tambah User";
                        }
                        ?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                        <?php
                        if($_GET[act]=='edituser'){
                            echo "Form Edit User";
                        }else{
                            echo "Form Tambah User";
                        }
                        ?>
                        </div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <?php
                                    if($_GET[act]=='edituser'){
                                        $r = mysqli_query($conn, "SELECT *from masteruser where iduser='$_GET[id]'");
                                        $data = mysqli_fetch_array($r);
                                        echo"
                                        <form role='form' method='post' action='modul/aksimaster.php?act=edituser'>
                                        <input type='hidden' name='id' value='$data[iduser]'>
                                            <div class='form-group'>
                                                <label>Full Name</label>
                                                <input type='text' class='form-control' placeholder='Enter Full Name' name='fullname' value='$data[fullname]'>
                                            </div>
                                            <div class='form-group'>
                                                <label>Username</label>
                                                <input type='text' class='form-control' placeholder='Enter Username' name='username'  value='$data[username]'>
                                            </div>
                                            <div class='form-group'>
                                                <label>Password</label>
                                                <input type='password' class='form-control' placeholder='Enter Password' name='password'  value='$data[password]'>
                                            </div>
                                            <div class='form-group'>
                                                <label>Jabatan</label>";
                                                if($data[jabatan]=='Staff'){
                                                    echo "
                                                    <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Staff' checked>Staff
                                                    </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Chief / Head'>Chief / Head
                                                        </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Manager'>Manager
                                                        </label>
                                                    </div>";
                                                }
                                                else if($data[jabatan]=='Chief / Head'){
                                                    echo "
                                                    <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Staff'>Staff
                                                    </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Chief / Head' checked>Chief / Head
                                                        </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Manager'>Manager
                                                        </label>
                                                    </div>";
                                                }
                                                else if($data[jabatan]=='Manager'){
                                                    echo "
                                                    <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Staff'>Staff
                                                    </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Chief / Head' >Chief / Head
                                                        </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Manager' checked>Manager
                                                        </label>
                                                    </div>";
                                                }else{
                                                    echo "
                                                    <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Staff'>Staff
                                                    </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Chief / Head' >Chief / Head
                                                        </label>
                                                    </div>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='jabatan' id='jabatan' value='Manager' >Manager
                                                        </label>
                                                    </div>";
                                                }
                                            echo"    
                                            </div>
                                            <div class='form-group'>
                                                <label>Level</label>
                                                <select class='form-control' name='level'>
                                                    <option>--- Pilih Level ----</option>";
                                                    if($data[level]=='Superadmin'){
                                                        echo "
                                                        <option value='Superadmin' selected>Superadmin</option>
                                                        <option value='Admin'>Admin</option>
                                                        <option value='User'>User</option>
                                                        ";
                                                    }else if($data[level]=='Admin'){
                                                        echo "
                                                        <option value='Superadmin'>Superadmin</option>
                                                        <option value='Admin' selected>Admin</option>
                                                        <option value='User'>User</option>
                                                        ";
                                                    }else if($data[level]=='User'){
                                                        echo "
                                                        <option value='Superadmin'>Superadmin</option>
                                                        <option value='Admin'>Admin</option>
                                                        <option value='User' selected>User</option>
                                                        ";
                                                    }else{
                                                        echo "
                                                        <option value='Superadmin'>Superadmin</option>
                                                        <option value='Admin'>Admin</option>
                                                        <option value='User'>User</option>
                                                        ";
                                                    }
                                            echo"
                                                </select>
                                            </div>
                                            <button type='submit' class='btn btn-default'>Update</button>
                                            <button type='reset' class='btn btn-default'>Reset</button>
                                        </form>";

                                    }else{
                                        echo"
                                        <form role='form' method='post' action='modul/aksimaster.php?act=tambahuser'>
                                            <div class='form-group'>
                                                <label>Full Name</label>
                                                <input type='text' class='form-control' placeholder='Enter Full Name' name='fullname'>
                                            </div>
                                            <div class='form-group'>
                                                <label>Username</label>
                                                <input type='text' class='form-control' placeholder='Enter Username' name='username'>
                                            </div>
                                            <div class='form-group'>
                                                <label>Password</label>
                                                <input type='password' class='form-control' placeholder='Enter Password' name='password'>
                                            </div>
                                            <div class='form-group'>
                                                <label>Jabatan</label>
                                                <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Staff' checked>Staff
                                                    </label>
                                                </div>
                                                <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Chief / Head'>Chief / Head
                                                    </label>
                                                </div>
                                                <div class='radio'>
                                                    <label>
                                                        <input type='radio' name='jabatan' id='jabatan' value='Manager'>Manager
                                                    </label>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label>Level</label>
                                                <select class='form-control' name='level'>
                                                    <option>--- Pilih Level ----</option>
                                                    <option value='Superadmin'>Superadmin</option>
                                                    <option value='Admin'>Admin</option>
                                                    <option value='User'>User</option>
                                                </select>
                                            </div>
                                            <button type='submit' class='btn btn-default'>Simpan</button>
                                            <button type='reset' class='btn btn-default'>Reset</button>
                                        </form>";
                                    }
                                    ?>
                                </div>
                                
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->