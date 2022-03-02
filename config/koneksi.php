<?php
$servername = "192.168.88.14";
$username = "root";
$password = "19K23O15P";
$db = "db_otif";

$servernamesim = "192.168.88.88";
$usernamesim = "root";
$passwordsim = "19K23O15P";
$dbsim = "sim_krisanthium";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
$connsim = mysqli_connect($servernamesim, $usernamesim, $passwordsim, $dbsim);

if (!$conn || !$connsim) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
