            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'><?php
                        if($_GET[act]=='editsetting'){
                            echo "Edit Setting";
                        }else{
                            echo "Tambah Setting";
                        }
                        ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                          <?php
                            if($_GET[act]=='edit'){
                                echo "Form Edit Setting";
                            }else{
                                echo "Form Tambah Setting";
                            }
                        ?>
                        </div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-lg-12'>
                                     <?php
                                    if($_GET[act]=='editsetting'){
                                        $r = mysqli_query($conn, "SELECT *from mastersetting where idsetting='$_GET[id]'");
                                        $data = mysqli_fetch_array($r);
                                        echo"
                                            <form role='form' method='post' action='modul/aksimaster.php?act=editsetting'>
                                            <input type='hidden' name='id' value='$data[idsetting]'>
                                                <div class='form-group'>
                                                    <label>Value</label>
                                                    <input type='text' class='form-control' placeholder='Enter Variabel Setting' name='nilai' value='$data[value]'>
                                                </div>
                                                <div class='form-group'>
                                                    <label>Keterangan</label>
                                                    <input type='text' class='form-control' placeholder='Enter Keterangan' name='keterangan' value='$data[keterangan]'>
                                                </div>
                                                
                                                <button type='submit' class='btn btn-default'>Simpan</button>
                                                <button type='reset' class='btn btn-default'>Reset</button>
                                            </form>";
                                    }else{
                                        echo"        
                                            <form role='form' method='post' action='modul/aksimaster.php?act=tambahsetting'>
                                                <div class='form-group'>
                                                    <label>Value</label>
                                                    <input type='text' class='form-control' placeholder='Enter Variabel Setting' name='nilai'>
                                                </div>
                                                <div class='form-group'>
                                                    <label>Keterangan</label>
                                                    <input type='text' class='form-control' placeholder='Enter Keterangan' name='keterangan'>
                                                </div>
                                                
                                                <button type='submit' class='btn btn-default'>Simpan</button>
                                                <button type='reset' class='btn btn-default'>Reset</button>
                                            </form>";
                                        }
                                    echo"
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
            </div>";
?>
            <!-- /.row -->