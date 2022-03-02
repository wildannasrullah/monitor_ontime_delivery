<?php
if ($_GET['p']=='dashboard'){
    include "modul/dashboard.php";
}
if ($_GET['p']=='masteruser'){
    include "modul/masteruser.php";
}
if ($_GET['p']=='formuser'){
    include "modul/formuser.php";
}
if ($_GET['p']=='mastersetting'){
    include "modul/mastersetting.php";
}
if ($_GET['p']=='formsetting'){
    include "modul/formsetting.php";
}
if ($_GET['p']=='monitor-otif'){
    include "modul/monitor-otif.php";
}
if ($_GET['p']=='profile'){
    include "modul/profile.php";
}
?>