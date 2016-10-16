﻿<?php
header("Content-Type:text/html;charset=utf-8");
	function showTaskList()
	{
		require_once("connect_db.php");

		$sql = "select `rec_id`,`name`,case `status` when 10 then '编辑中' when 20 then '执行中' when 30 then '已完成' end as status,`desc` from task";

		$result = $mysqli->query($sql);
		$num = $result->num_rows;
		
		$pagesize = 3;
		
		
		$pages = intval($num/$pagesize);
		if($num%$pagesize)
			$pages++;
		
		if(isset($_GET['page']))
		{
			$page = intval($_GET['page']);
		}
		else
			$page = 1;
		
		$offset = $pagesize*($page-1);
		
		$page_sql = "select `rec_id`,case `module_id` when 1 then '学习' when 2 then '工作' when 3 then '生活' when 4 then '运动' end as `module_id`,`name`,case `status` when 10 then '编辑中' when 20 then '执行中' when 30 then '已完成' end as status,`desc`,DATE_FORMAT(expect_finish_date,'%Y-%m-%d'),DATE_FORMAT(start_date,'%Y-%m-%d') from task order by rec_id desc limit $offset,$pagesize";
		$page_result = $mysqli->query($page_sql);
		$page_num = $page_result->num_rows;
		$colums = $page_result->field_count;
		if($page_num > 0)
		{
			 
			 echo "<table id ='tasktbl' style=' border-color: #efefef;' border='1px' cellpadding='5px' cellspacing='0px'><tr>";
			/*
			 for($i=0;$i<$colums;$i++)
			 {
				$info = $page_result->fetch_field_direct($i);
				echo "<th>$info->name</th>";
			 }
			*/
			echo "<th>编号</th><th>分类</th><th>任务</th><th>状态</th><th>详细</th><th>计划完成日期</th><th>创建日期</th><th>操作</th>";
			echo "</tr>";
			
			while($row = $page_result->fetch_row())
			{
				echo "<tr onclick=\"hilight(this)\"; ondblclick=\"hilight1(this)\"><th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th><th>$row[4]</th><th>$row[5]</th><th>$row[6]</th><th><input type = 'button' value = 'ok' onclick = \"SetDoneStatus($row[0])\"></th></tr>";
			}
		
			echo "</table>";
			
			echo "<div id='page_bar'>";
			
			if($page!=1)
			{
				$tmp_page = $page - 1;
				echo "<a href=\"tasklist.php?page=$tmp_page\"> 前一页 </a>";
			}
			
			for($i=1;$i<=$pages;$i++)
			{
				echo "<a href=\"tasklist.php?page=$i\"> $i </a>";
			}
			
			if($page<$pages)
			{
				$tmp_page = $page + 1;
				echo "<a href=\"tasklist.php?page=$tmp_page\"> 下一页 </a>";
			}
			echo "</div>";
		}
		
		
	}
	
	showTaskList();
	
	
?>