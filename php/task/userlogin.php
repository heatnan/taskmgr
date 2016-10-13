<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$username = $_GET['username'];
$password = $_GET['password'];
if( (!isset($username)) || (!isset($password)))
{
	echo "novalue";
	return;
}

require_once("connect_db.php");
 

$sql="SELECT `rec_id`,`account`,`password`,`nickname` FROM `user` where `account` = '".$username."'  and  deleted = '0' ";

//echo $sql;

$result = $mysqli->query($sql);
$num_results = $result->num_rows;

if($num_results == 0)
{
	echo "wrong";
}
else if($num_results == 1)
{
	$row = $result->fetch_assoc();
	//echo $row['password'];
	if($row['password']==$password)
	{
		$_SESSION['username']=$row['account'];
		$_SESSION['password']=$row['password'];
		$_SESSION['user_id'] = $row['rec_id'];
		echo "success";
		
	}
}

$mysqli->close();
?>