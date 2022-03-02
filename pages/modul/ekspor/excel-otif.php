<?php
error_reporting(0);
session_start();
$d=date('d');$m=date('m');$y=date('y');
include('../../../config/koneksi.php');
include('../../../config/fungsi_ribuan.php');
// // Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// // Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=ReportOTIFKOP_$y$m$d.xls");
 
// Tambahkan table
?>
<h2 align='center'>Laporan Delivery On Time In Full (OTIF)</h2>
<h3 align='center'>Periode <?php echo $_GET[begda]." s/d ".$_GET[endda]; ?></h3>
<table border='1' cellspacing="0" width="100%">
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
                <th>Status</th>
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
              where g.series in ('GID','GIL') and g.status not in ('DELETED')
                and s.CustomerCode not in ('SUB.0189','PSR.0220')
                and g.docdate between '$_GET[begda]' and '$_GET[endda]'
              group by g.docno
              order by g.docno asc;");
        while($d = mysqli_fetch_array($q)){

            $qtygi = mysqli_query($connsim, 
                                        "SELECT sum(d.qty)as gitotalqty
                                          FROM goodsissueh g
                                          left join goodsissued d on g.docno=d.docno
                                          left join salesorderh s on g.SODocNo = s.docno
                                          left join salesorderd h on h.docno = s.docno
                                          left join mastermaterial m on h.MaterialCode = M.Code
                                          left join mastercustomer c on s.CustomerCode = c.Code
                                          where g.series in ('GID','GIL') and g.status not in ('DELETED')
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
                <td>$d[sodocno]</td>
                <td>$d[materialname]</td>
                <td class='center'>$d[custname]</td>
                <td align='right'>".ribu($fix_qtygi[gitotalqty])."</td>
                <td class='center'>$cekStatus</td>
                <td class='center'>$deldate</td>
                <td class='center'>".ribu($qtyso)."</td>
                <td class='center'>$statusFinal</td>
            </tr>";
            }
            ?>
        </tbody>
    </table>