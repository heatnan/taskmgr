<?php
	header("Content-Type:text/html;charset=utf-8");
	
	
	$operate_type = $_GET['operate_type'];
	
	if($operate_type == "change_status")
	{
		ChangeTaskStatus();
	}
	
	function ChangeTaskStatus()
	{
		$to_status = $_GET['to_status'];
		$task_id = $_GET['id'];
		//echo $to_status;
		//echo $task_id;
		if($to_status&&$task_id)
		{
			require_once("connect_db.php");
			$sql = "update task set status = 30 where rec_id = $task_id;";
			$result = $mysqli->query($sql);
			echo "success";
		}
	}
	
?>