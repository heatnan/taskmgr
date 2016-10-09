<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
		<?php
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\"/>";
		?>
		<script type="text/javascript" language="javascript">
			
			var theObj;
			var theObj1;
			
			function hilight(obj){
				if(theObj!=null){theObj.style.background = "#fff";}
				if(theObj = obj){obj.style.background = "red";}
			
			}
			
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
		</style>
	</head>
		
	<body class="bg_main">
		<h1>任务列表</h1>
		<div>
		<?php
			require_once("taskquery.php");
		?>
		</div>
	</body>
</html>