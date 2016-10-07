<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
if(!$username || !$password)
{
	echo 'Wrong username or password,please try again';
	exit;
}
/*
$mysqli = new mysqli("localhost","tasktest","test123","taskmgr");
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
*/
require_once("connect_db.php");
 
//echo 'Success... ' . $mysqli->host_info . "\n";

$sql="SELECT `rec_id`,`account`,`password`,`nickname` FROM `user` where `account` = '".$username."'  and  deleted = '0' ";

//echo $sql;

$result = $mysqli->query($sql);
$num_results = $result->num_rows;
$is_user = false;
if($num_results == 0)
{
	echo "无效的用户名";
	exit;
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
		$is_user = true;
		
	}
}
else
{
	echo "存在多个用户，无法登陆";
	readfile('../../login.html');
	exit;
}
//echo $is_user;

if($is_user)
{
	$home_url = 'mainpage.php';
    header('Location: '.$home_url);
	//require('mainpage.php');
	exit;
}
else
{
	readfile('../../login.html');
	exit;
}



echo "<p> we found ".$num_results." item record </p>";
 /*        
while($obj=$result->fetch_object()){
	printf("%d\n ",$obj->userID);
	printf("%s\n ",$obj->userName);
}
*/
//$result->close();

$mysqli->close();
?>