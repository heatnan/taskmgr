<?php
header("Content-Type:text/html;charset=utf-8");
	function showTaskList()
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
		$creator_id = $_SESSION['user_id'];
		require_once("connect_db.php");
		
		$sql = "select `rec_id`,`name`,case `status` when 10 then '编辑中' when 20 then '执行中' when 30 then '已完成' end as status,`desc` from task where creator_id = $creator_id";

		$result = $mysqli->query($sql);
		$num = $result->num_rows;
		
		$pagesize = 6;
		
		
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
		
		$page_sql = "select `rec_id`,case `module_id` when 1 then '学习' when 2 then '工作' when 3 then '生活' when 4 then '运动' end as `module_id`,`name`,case `status` when 10 then '编辑中' when 20 then '执行中' when 30 then '已完成' end as status,`desc`,DATE_FORMAT(expect_finish_date,'%Y-%m-%d'),DATE_FORMAT(start_date,'%Y-%m-%d') from task where creator_id = $creator_id order by rec_id desc limit $offset,$pagesize";
		$page_result = $mysqli->query($page_sql);
		$page_num = $page_result->num_rows;
		$colums = $page_result->field_count;
		if($page_num > 0)
		{
			 
			echo "<table cellspacing=\"0\" cellpadding=\"0\"><tr>";

			echo "<th class='hide'>id</th><th>编号</th><th>分类</th><th>任务</th><th>状态</th><th>详细</th><th>计划完成日期</th><th>创建日期</th><th>操作</th>";
			echo "</tr>";
			$item_no = $pagesize*($page-1)+1;
			while($row = $page_result->fetch_row())
			{
				echo "<tr ondblclick=\"hilight1(this)\"><td class='hide'>$row[0]</td><td>$item_no</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td><input type = 'button' value = 'ok' onclick = \"SetDoneStatus($row[0])\"></td></tr>";
				$item_no = $item_no + 1;
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