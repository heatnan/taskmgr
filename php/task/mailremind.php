<?php
	error_reporting(E_ALL & ~E_NOTICE);
	require_once("connect_db.php");
	
	$sql = "select rec_id,account,nickname,email from user ";
	//echo $sql >> /tmp/mail_test.log;
	$users_msg = $mysqli->query($sql);
	
	$user_num = $users_msg->num_rows;
	
	if($user_num > 0)
	{
		while($row = $users_msg->fetch_row())
		{
			$user_id = $row[0];
			$user_account = $row[1];
			$user_nickname = $row[2];
			$user_email = $row[3];
			if($user_id&&$user_email)
			{
				$sql = "select `name`,module_id,`desc`,expect_finish_date,created from task where creator_id = $user_id and status = 10";
				//echo $sql >> /tmp/mail_test.log;
				$tasks = $mysqli->query($sql);
				$tasks_num = $tasks->num_rows;
				if($tasks_num>0)
				{
					$mail_msg = $user_nickname."有一些事情提醒下你！\n";
					while($task_row = $tasks->fetch_row())
					{
						$task_name = $task_row[0];
						$task_desc = $task_row[2];
						$task_expect_time = $task_row[3];
						$task_create = $task_row[4];
						$mail_msg.= "创建于".$task_create."预计完成于".$task_expect_time."的事务".$task_desc."还未完成，加油！\n";
						
					}
					//echo $user_email >> /tmp/mail_test.log;
					//echo $mail_msg >> /tmp/mail_test.log;
					postmail($user_email,'come on,baby',$mail_msg);
				}
			}
		}
	}
	
	
	function postmail($to,$subject = '',$body = '')
	{
		//Author:Jiucool WebSite: http://www.jiucool.com
		//$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
		//error_reporting(E_ALL);
		error_reporting(E_STRICT);
		date_default_timezone_set('Asia/Shanghai');//设定时区东八区
		require_once('class.phpmailer.php');
		include('class.smtp.php');
		$mail             = new PHPMailer(); //new一个PHPMailer对象出来
	  //  $body            = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
		$mail->CharSet ="utf-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
		$mail->IsSMTP(); // 设定使用SMTP服务
		//$mail->SMTPDebug  = 1;                     // 启用SMTP调试功能
		// 1 = errors and messages
		// 2 = messages only
		$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
		//$mail->SMTPSecure = "ssl";                 // 安全协议，可以注释掉
		$mail->Host       = 'smtp.163.com';      // SMTP 服务器
		$mail->Port       = 25;                   // SMTP服务器的端口号
		$mail->Username   = 'heat_nan@163.com';  // SMTP服务器用户名，PS：我乱打的
		$mail->Password   = 'W964465194';         // SMTP服务器密码
		$mail->SetFrom('heat_nan@163.com', 'heat_nan');
		//$mail->AddReplyTo('xxx@xxx.xxx','who');
		$mail->Subject    = $subject;
		$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test
		$mail->MsgHTML($body);
		$address = $to;
		$mail->AddAddress($address, 'wangxiangnan');
		//$mail->AddAttachment("images/phpmailer.gif");      // attachment
		//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
		if(!$mail->Send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo "success";
		}
	}


?>