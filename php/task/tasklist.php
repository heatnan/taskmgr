<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
		<?php
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../../css/style.css\"/>";
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../../css/tablecloth.css\"/>";
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../../js/tablecloth.js\"></script>";
		?>
		<script type="text/javascript" language="javascript">
			
			var theObj;
			var theObj1;
					
			function hilight1(obj){
			  var task_id = obj.cells[0].innerHTML;
			  var url = "../../newtask.html";
			  window.location.href = url + "?id=" + task_id;
			}
			
			function SetDoneStatus(task_id)
			{
				var xmlhttp = new XMLHttpRequest();
				var url = "taskoperate.php";
				url = url + "?id=" + task_id + "&operate_type=change_status" +"&to_status=30"; 
				xmlhttp.open("GET",url,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState==4){
						if(xmlhttp.status==200)
						{
							var taskDetail =xmlhttp.responseText;
							if(taskDetail=="success")
							{
								location.reload();
							}
						}
					
					}
				}
			}
			
		</script>
		<style>
			#tasklist{
				width:800;
				height:900;
				background-color:white;
				position:absolute;
				top:50%;
				left:50%;
				border:5px solid gray;
			}
			.th{
				width：30px;
				height:25px;
				margin-left:15px;
				margin-bottom:15:px;
			}
			.lth{
			
			}
			.bg_main {
				font-family: sans-serif;
				background-color: #323B55;
			}
			#list{
				width:800px;
				height:700px;
				margin-left:-400px;
				margin-top:-350px;
				position:absolute;
				top:50%;
				left:50%;
				background-color:white;
			}
			.header{
				margin-left:300px;
			}
			.hide
			{
				display:none;
			}
			#tasktbl{
				margin-left:50px;
				border-color:#efefef;
				border:1px;
				cellpadding:5px;
				cellspacing:0px;   
				background-color:blue;
			}
			#page_bar{
				margin-left:130px;
				margin-top:20px;
			}
		</style>
	</head>
		
	<body class="bg_main">
		<div id="list">
		<div class="header"><h1>任务列表</h1></div>
		<?php
			require_once("taskquery.php");
		?>
		</div>
	</body>
</html>