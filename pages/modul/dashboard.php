<?php
    error_reporting(0);
    session_start();
    include('../config/koneksi.php');
    $bulanlalu = date('m', strtotime('-1 month'));
    //echo "<h1>".date('m', strtotime('-1 month'))."</h1>";

    if($_POST['begda'] == NULL || $_POST['endda'] == NULL){
        if(date('m')==01){
            $begda = date('Y');
            $begda = ($begda-1).'-'.$bulanlalu.'-22';    
        }else{
            $begda = date('Y').'-'.$bulanlalu.'-22';
        }
        $endda = date('Y-m-d');
    }else{
        $begda = $_POST['begda'];
        $endda = $_POST['endda'];
    }

    $resultA = mysqli_query($connsim, "SELECT count(gidocno)otif FROM(
       SELECT g.docno as gidocno, g.docdate as gidocdate, g.sodocno, m.Name as materialname, c.Name as custname,
                    s.deliverydate, h.qty as soqty, k.gitotalqty, s.CustomerCode,
                    CASE
                      WHEN s.CustomerCode = 'JKT.0021' THEN 'OTIF'
                      WHEN k.gitotalqty >= h.qty THEN
                           CASE
                              WHEN g.docdate <= s.deliverydate THEN 'OTIF'
                              ELSE 'TIDAK'
                           END
                      ELSE 'TIDAK'
                    END AS `status`
                FROM goodsissueh g
                   left join goodsissued d on g.docno=d.docno
                   left join salesorderh s on g.SODocNo = s.docno
                   left join salesorderd h on h.docno = s.docno
                   left join mastermaterial m on h.MaterialCode = M.Code
                   left join mastercustomer c on s.CustomerCode = c.Code
                   join (SELECT sum(d.qty)as gitotalqty, s.docno
                          FROM goodsissueh g
                           left join goodsissued d on g.docno=d.docno
                           left join salesorderh s on g.SODocNo = s.docno
                           left join salesorderd h on h.docno = s.docno
                           left join mastermaterial m on h.MaterialCode = M.Code
                           left join mastercustomer c on s.CustomerCode = c.Code
                         where g.series in ('GID','GIL','GIR') and g.status not in ('DELETED')
                            and s.CustomerCode not in ('SUB.0189','PSR.0220')
                         group by s.docno)k on k.docno = g.sodocno
                where g.series in ('GID','GIL','GIR') and g.status not in ('DELETED')
                      and s.CustomerCode not in ('SUB.0189','PSR.0220')
                      and (g.docdate between '$begda' and '$endda')
                      group by g.docno)m where `status` = 'OTIF';");

$resultB = mysqli_query($connsim, "SELECT count(gidocno) tdkotif FROM(
       SELECT g.docno as gidocno, g.docdate as gidocdate, g.sodocno, m.Name as materialname, c.Name as custname,
                    s.deliverydate, h.qty as soqty, k.gitotalqty, s.CustomerCode,
                    CASE
                      WHEN s.CustomerCode = 'JKT.0021' THEN 'OTIF'
                      WHEN k.gitotalqty >= h.qty THEN
                           CASE
                              WHEN g.docdate <= s.deliverydate THEN 'OTIF'
                              ELSE 'TIDAK'
                           END
                      ELSE 'TIDAK'
                    END AS `status`
                FROM goodsissueh g
                   left join goodsissued d on g.docno=d.docno
                   left join salesorderh s on g.SODocNo = s.docno
                   left join salesorderd h on h.docno = s.docno
                   left join mastermaterial m on h.MaterialCode = M.Code
                   left join mastercustomer c on s.CustomerCode = c.Code
                   join (SELECT sum(d.qty)as gitotalqty, s.docno
                          FROM goodsissueh g
                           left join goodsissued d on g.docno=d.docno
                           left join salesorderh s on g.SODocNo = s.docno
                           left join salesorderd h on h.docno = s.docno
                           left join mastermaterial m on h.MaterialCode = M.Code
                           left join mastercustomer c on s.CustomerCode = c.Code
                         where g.series in ('GID','GIL','GIR') and g.status not in ('DELETED')
                            and s.CustomerCode not in ('SUB.0189','PSR.0220')
                         group by s.docno)k on k.docno = g.sodocno
                where g.series in ('GID','GIL','GIR') and g.status not in ('DELETED')
                      and s.CustomerCode not in ('SUB.0189','PSR.0220')
                      and (g.docdate between '$begda' and '$endda')
                      group by g.docno)m where `status` = 'TIDAK';");

$row = mysqli_fetch_array($resultA);
   $data[] = $row['otif'];

$rowb = mysqli_fetch_array($resultB);
    $dat[] = $rowb['tdkotif'];

    switch($_GET[act]){
    default:
?>
    <br /><br />
            <div class='row'>
                 <div class='col-lg-6 col-md-6'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <div class='row'>
                                <div class='col-xs-3'>
                                    <img src='modul/ontime.png' width='100%' />
                                </div>
                                <div class='col-xs-9 text-right'>
                                    <div class='huge'><?php echo round((($data[0])/($data[0] + $dat[0]))*100, 2); ?> %</div>
                                    <div>ON TIME IN FULL</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6 col-md-6'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <div class='row'>
                                <div class='col-xs-3'>
                                    <img src='modul/delay.png' width='100%' />
                                </div>
                                <div class='col-xs-9 text-right'>
                                    <div class='huge'><?php echo round((($dat[0])/($data[0] + $dat[0]))*100, 2); ?> %</div>
                                    <div>LATE DELIVERY</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Grafik Delivery Otif
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
                                
                                     echo "<p align='right'><font color='red'><b>Tanggal Goods Issue dari $begda s/d $endda</b></font></p>";
                            ?>
                            <hr />
                            
                            <!-- GRAFIK -->
                            <script src="https://code.highcharts.com/highcharts.js"></script>
                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                            <script src="https://code.highcharts.com/modules/export-data.js"></script>

                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


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

<script type="text/javascript">
    Highcharts.chart('container', {

  chart: {
    type: 'column'
  },

  title: {
    text: 'Delivery On Time In Full'
  },

  xAxis: {
    categories: ['OTIF','TIDAK OTIF']
  },

  yAxis: {
    allowDecimals: false,
    min: 0,
    title: {
      text: 'Number of fruits'
    }
  },

  tooltip: {
    formatter: function () {
      return '<b>' + this.x + '</b><br/>' +
        this.series.name + ': ' + this.y + '<br/>' +
        'Total: ' + this.point.stackTotal;
    }
  },
  colors: ['#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce',
        '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a'],
  plotOptions: {
    column: {
      stacking: 'normal'
    }
  },

  series: [{
    name: ['Status'],
    data: [<?php echo $data[0]; ?>, <?php echo $dat[0]; ?>]
  }]
}); 
</script>