<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script type="text/javascript" language="javascript">
			
			var theObj;
			var theObj1;
			
			function hilight(obj){
				if(theObj!=null){theObj.style.background = "#fff";}
				if(theObj = obj){obj.style.background = "red";}
			//obj.style.background = "red";
			}
			
			function hilight1(obj){
			//	if(theObj1!=null){theObj1.style.background = "#fff";}
			//	if(theObj1 = obj){obj.style.background = "yellow";}
			//obj.style.background = "red";
			//	var tmp = obj.cells;
			//	alert(tmp[0].innerHTML);
			  var task_id = obj.cells[0].innerHTML;
			  var url = "../../newtask.html";
			  window.location.href = url + "?id=" + task_id;
			}
			/*
			funciton dcclick(){
				var rows=document.getElementById("tasktbl").rows;
				if(rows.length>0)
				{
					for(var i=0;i<rows.length;i++)
					{
						(funciton(i)
							{
								
								var temp=rows[i].cells[0].childNodes[1].value;  
								var obj=rows[i];  
								obj.ondblclick=function(){alert(temp);};  
									
							}
								
						)(i)
					}
				}
			}
			
			window.onload=function(){ dcclick();}
			*/
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