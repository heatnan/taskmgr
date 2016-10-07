<?php
header("Content-Type:text/html;charset=utf-8");
	function showTaskList()
	{
		require_once("connect_db.php");
		
		
		
	
		
		
		$sql = "select `rec_id`,`name`,`status`,`desc` from task";
	//	echo $sql;

		$result = $mysqli->query($sql);
		$num = $result->num_rows;
		
		
		
		//
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
		
		$page_sql = "select `rec_id`,`name`,`status`,`desc` from task order by rec_id limit $offset,$pagesize";
		$page_result = $mysqli->query($page_sql);
		$page_num = $page_result->num_rows;
		$colums = $page_result->field_count;
		if($page_num > 0)
		{
			 
			 echo "<table id ='tasktbl' style='border-color: #efefef;' border='1px' cellpadding='5px' cellspacing='0px'><tr>";
			 for($i=0;$i<$colums;$i++)
			 {
				$info = $page_result->fetch_field_direct($i);
				echo "<th>$info->name</th>";
			 }
			echo "</tr>";
			
			while($row = $page_result->fetch_row())
			{
				echo "<tr onclick=\"hilight(this)\"; ondblclick=\"hilight1(this)\"  ><th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th></tr>";
			}
		/*
        while($row=mysql_fetch_row($res)){
            echo "<tr>";
            for($i=0; $i<$colums; $i++){
                echo "<td>$row[$i]</td>";
            }
            echo "</tr>";
        }
		*/
			echo "</table>";
			
			echo "<div style = 'margin-top:20px;margin-left:30px' >";
			
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