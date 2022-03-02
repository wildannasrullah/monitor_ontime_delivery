<?php
    error_reporting(0);
    session_start();
    include('../config/koneksi.php');
    $bulanlalu = date('m', strtotime('-1 month'));
    //echo "<h1>".date('m', strtotime('-1 month'))."</h1>";

    switch($_GET[act]){
    default:
?>
    
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>Monitoring Otif</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Monitorting Delivery Otif
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <table border='0' width='100%'>
                            <form method="POST" action="">
                                <tr>
                                    <td width='10%'>
                                        Tanggal Mulai :    
                                    </td>
                                    <td>
                                        <input type='date' name='begda' class='form-control'>    
                                    </td>
                                    <td width='20%' align='right'>
                                        Sampai :&nbsp;&nbsp;    
                                    </td>
                                    <td>
                                        <input type='date' name='endda' class='form-control'>    
                                    </td>
                                    <td align='left'>
                                        &nbsp;<input type='submit' class='btn btn-primary btn-sm' value='Show'>    
                                    </td>
                                </tr>
                            </form>
                            </table><br />
                            <?php
                                if($_POST['begda'] == NULL || $_POST['endda'] == NULL){
                                        $begda = date('Y').'-'.$bulanlalu.'-22';
                                        $endda = date('Y-m-d');
                                    }else{
                                        $begda = $_POST['begda'];
                                        $endda = $_POST['endda'];
                                    }
                                     echo "<p align='right'><font color='red'><b>Tanggal Goods Issue dari $begda s/d $endda</b></font></p>";
                            ?>
                            <a href='modul/ekspor/excel-otif.php?begda=<?php echo $begda."&endda=".$endda; ?>'><button class="btn btn-success" type="button"><b> Excel</b></button></a>
                            <hr />
                            <div class='dataTable_wrapper'>
                                <table class='table table-striped table-bordered table-hover js-exportable' id='dataTables-example'>
                                    <thead>
                                        <tr>
                                            <th>GI Doc No</th>
                                            <th>GI Doc Date</th>
                                            <th>SO Doc No</th>
                                            <th>Material Name</th>
                                            <th>Customer Name</th>
                                            <th>Total Qty Kirim</th>
                                            <th>Cek ULi</th>
                                            <th>Delivery Date</th>
                                            <th>Qty SO</th>
                                            <th>Status Otif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $q = mysqli_query($connsim, 
                                        "SELECT g.docno as gidocno, g.docdate as gidocdate, g.sodocno, m.Name as materialname, c.Name as custname, sum(d.qty)as gitotalqty,
                                          s.deliverydate, h.qty as soqty, s.CustomerCode
                                          FROM goodsissueh g
                                          left join goodsissued d on g.docno=d.docno
                                          left join salesorderh s on g.SODocNo = s.docno
                                          left join salesorderd h on h.docno = s.docno
                                          left join mastermaterial m on h.MaterialCode = M.Code
                                          left join mastercustomer c on s.CustomerCode = c.Code
                                          where g.series in ('GID','GIL','GIR') and g.status not in ('DELETED')
                                            and s.CustomerCode not in ('SUB.0189','PSR.0220')
                                            and g.docdate between '$begda' and '$endda'
                                          group by g.docno
                                          order by g.docno asc;");
                                    while($d = mysqli_fetch_array($q)){
                                        
                                        //HITUNG QTY GOODS ISSUE Berdasarkan SO, walaupun di periode lalu

                                        $qtygi = mysqli_query($connsim, 
                                        "SELECT sum(d.qty)as gitotalqty
                                          FROM goodsissueh g
                                          left join goodsissued d on g.docno=d.docno
                                          left join salesorderh s on g.SODocNo = s.docno
                                          left join salesorderd h on h.docno = s.docno
                                          left join mastermaterial m on h.MaterialCode = M.Code
                                          left join mastercustomer c on s.CustomerCode = c.Code
                                          where g.series in ('GID','GIL','GIR') and g.status not in ('DELETED')
                                            and s.docno = '$d[sodocno]'
                                            and s.CustomerCode not in ('SUB.0189','PSR.0220')
                                          group by s.docno
                                          order by g.docno asc;");

                                        $fix_qtygi = mysqli_fetch_array($qtygi);

                                        if($d[CustomerCode]=='JKT.0021'){
                                            $cekStatus = "OTIF";
                                            $deldate = "-";
                                            $qtyso = 0;
                                        }else{ 
                                            $cekStatus = "CEK";
                                            $deldate = $d[deliverydate];
                                            $qtyso = $d[soqty];
                                        }

                                        if($cekStatus == "OTIF"){
                                            $statusFinal = "OTIF";
                                        }else{
                                            if($fix_qtygi[gitotalqty] >= $qtyso){
                                                if($d[gidocdate] <= $deldate){
                                                    $statusFinal = "OTIF";
                                                }else{
                                                    $statusFinal = "TIDAK";
                                                }
                                            }else{
                                                $statusFinal = "TIDAK";
                                            }
                                        }

                                        echo "<tr class='odd gradeX'>
                                            <td>$d[gidocno]</td>
                                            <td class='center'>$d[gidocdate]</td>
                                            <td><a href='?p=monitor-otif&act=detail-otif&so=$d[sodocno]'>$d[sodocno]</a></td>
                                            <td>$d[materialname]</td>
                                            <td class='center'>$d[custname]</td>
                                            <td align='right'>".ribu($fix_qtygi[gitotalqty])."</td>
                                            <td class='center'>$cekStatus</td>
                                            <td class='center'>$deldate</td>
                                            <td align='right'>".ribu($qtyso)."</td>
                                            <td class='center'>$statusFinal</td>
                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            </div>
            <!-- /.row -->
<?php
break;
case "detail-otif":
?>
    <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>Detail Otif</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Detail Delivery Otif
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
                            <div class='dataTable_wrapper'>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>GI Doc No</th>
                                            <th>GI Doc Date</th>
                                            <th>SO Doc No</th>
                                            <th>Material Name</th>
                                            <th>Qty SO</th>
                                            <th>Qty Kirim</th>
                                            <th>Status Doc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $q = mysqli_query($connsim, 
                                        "SELECT h.docno, h.docdate, h.sodocno, m.name as materialname, sum(d.qty) as qtygi, h.status, s.qty as qtyso FROM goodsissueh h left join goodsissued d on h.docno=d.docno
                                         left join salesorderd s on s.docno = h.sodocno
                                         left join mastermaterial m on m.code = s.materialcode
                                          where h.sodocno = '$_GET[so]'
                                          group by h.docno
                                          order by h.docno asc;");
                                    while($d = mysqli_fetch_array($q)){

                                        echo "<tr class='odd gradeX'>
                                            <td>$d[docno]</td>
                                            <td class='center'>$d[docdate]</td>
                                            <td>$d[sodocno]</td>
                                            <td>$d[materialname]</td>
                                            <td align='right'>".ribu($d[qtyso])."</td>
                                            <td align='right'>".ribu($d[qtygi])."</td>
                                            <td class='center'>$d[status]</td>
                                        </tr>";
                                        $subqty +=$d[qtygi];
                                        }
                                        $grandtot = $subqty;
                                        echo "
                                            <tr class='odd gradeX'>
                                            <td align='right' colspan='5'><b>GRAND TOTAL</b></td>
                                            <td align='right'>".ribu($grandtot)."</td>
                                            <td align='right'>&nbsp;</td>
                                        </tr>
                                        ";
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            </div>
            <!-- /.row -->
<?php 
break;
}
?>