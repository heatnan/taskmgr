<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if($_SERVER['REQUEST_METHOD']=="POST")
{
	$task_id = $_GET['id'];
	InsertOrUpdateTask($task_id);
}
else if($_SERVER['REQUEST_METHOD']=="GET")
{
	$task_id = $_GET['id'];
	GetTask($task_id);
}
else
{
	echo "ajax";
}

function  InsertOrUpdateTask($task_id)
{
	
	$module_id = $_GET['module_id'];
	$title = $_GET['title'];
	$expect_finish_date = $_GET['expect_finish_date'];
	$task_desc = $_GET['desc'];
	$account = $_SESSION['username'];
	$creator_id = $_SESSION['user_id'];

/*
echo $module_id;
echo $title;

echo $task_desc;
echo "  username:".$_SESSION['username']."  lala";
*/


	require_once("connect_db.php");
	$sql_insert = "insert into task(`name`,creator_id,module_id,`desc`,start_date,expect_finish_date,remark,created) values('$title',$creator_id,$module_id,'$task_desc',now(),'$expect_finish_date','',now());";
	//echo $sql_insert;
	
	$sql_update = "update task set `name` = '$title',creator_id = $creator_id,module_id = $module_id,`desc` = '$task_desc',expect_finish_date='$expect_finish_date' where rec_id = $task_id;";
	//echo $sql_update;
	
	if($task_id)
	{
		$result = $mysqli->query($sql_update);
		echo '修改成功';
	}
	else
	{
		$result = $mysqli->query($sql_insert);
		echo '事务新建成功';
	}
}
function GetTask($task_id)
{
	require_once("connect_db.php");
	$sql = "select rec_id,`name`,module_id,`desc`,expect_finish_date from task where rec_id =".$task_id.";";
	//echo $sql;
	
	$result = $mysqli->query($sql);
	$num_rows = $result->num_rows;
	if($num_rows>0)
	{
		$row = $result->fetch_row();
		//echo $row;
		
		$list = array("name"=>$row[1],"module_id"=>$row[2],"desc"=>$row[3],"expect_finish_date"=>substr($row[4],0,10));
		//echo substr($row[4],0,12);
		echo json_encode($list);
		
	}
	else
	{
		echo 'ajax传递过来的值为'.$task_id;
	}
}




?>