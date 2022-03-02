<?php
error_reporting(0);
session_start();
include('../../config/koneksi.php');

$p	=$_GET[act];

if ($p=='tambahuser'){
	mysqli_query($conn, "INSERT INTO masteruser (iduser, fullname, username, password, jabatan, level) 
						VALUES(NULL,'$_POST[fullname]','$_POST[username]','$_POST[password]','$_POST[jabatan]','$_POST[level]')");
	$link = "<script>alert('Save Success.');
	window.location='../otif.php?p=masteruser';</script>";
	echo $link;
}
if ($p=='edituser'){
	mysqli_query($conn, "UPDATE masteruser SET fullname = '$_POST[fullname]', password = '$_POST[password]', jabatan = '$_POST[jabatan]', level = '$_POST[level]'
				WHERE iduser  = '$_POST[id]'");
	$link = "<script>alert('Update Success.');
	window.location='../otif.php?p=masteruser';</script>";
	echo $link;
}
if ($p=='deluser'){
	mysqli_query($conn, "DELETE FROM masteruser WHERE iduser = '$_GET[id]'");
	$link = "<script>alert('Delete Success.');
	window.location='../otif.php?p=masteruser';</script>";
	echo $link;
}

//MASTER SETTING
if ($p=='tambahsetting'){
	mysqli_query($conn, "INSERT INTO mastersetting (idsetting, value, keterangan) 
						VALUES(NULL,'$_POST[nilai]','$_POST[keterangan]')");
	$link = "<script>alert('Save Success.');
	window.location='../otif.php?p=mastersetting';</script>";
	echo $link;
}
if ($p=='editsetting'){
	mysqli_query($conn, "UPDATE mastersetting SET value = '$_POST[nilai]', keterangan = '$_POST[keterangan]'
				WHERE idsetting  = '$_POST[id]'");
	$link = "<script>alert('Update Success.');
	window.location='../otif.php?p=mastersetting';</script>";
	echo $link;
}
if ($p=='delsetting'){
	mysqli_query($conn, "DELETE FROM mastersetting WHERE idsetting = '$_GET[id]'");
	$link = "<script>alert('Delete Success.');
	window.location='../otif.php?p=mastersetting';</script>";
	echo $link;
}
if ($p=='updateprofile'){
	mysqli_query($conn, "UPDATE masteruser SET fullname = '$_POST[fullname]', password = '$_POST[password]'
				WHERE username  = '$_POST[username]'");
	$link = "<script>alert('Update Profile Success.');
	window.location='../otif.php?p=profile';</script>";
	echo $link;
}
?>