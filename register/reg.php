<?php
    // post: phone
	//注册和根据手机号返回user
	//用户如果不存在，插入；如果存在就select
	
	function postmail($name,$mobile,$address,$email,$ecode,$danwei){
		include './class.phpmailer.php';
		include './class.smtp.php';
		$mail = new PHPMailer();
		$mail->IsSMTP(); // send via SMTP
		$mail->Host = 'smtp.126.com'; // SMTP servers
		
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = 'cadcg2017';//比如你的邮箱是test@16.com,那么这里就写test
		$mail->Password ='cadcg2017';
		$mail->From = "cadcg2017@126.com"; // 发件人邮箱
		$mail->FromName = "cadcg2017@126.com"; // 发件人名称
		$mail->CharSet = 'UTF-8';

		$mail->AddAddress($email);//收件人,你可以给自己发一封试试
		$mail->IsHTML(true); // send as HTML 


		$mail->Subject = 'CAD&CG-2017 注册信息回执';
		$mail->Body = '您好 '.$name.',<br><br>
		CAD&CG-2017将在天津于2017年10月12-14日举办，届时欢迎您参加! <br>
		<strong style="color:#f00">注册成功后请及时缴纳注册费，并填写注册凭据表，并以“论文编号_注册号”命名（如1023_241.docx格式），<br>以邮件的形式发送到cadcg2017@tju.edu.cn</strong><br><br><br>
		<strong style="color:#f00">参会签到时，请出示该注册信息!<br></strong><br>
		
		
		<table>
			<tbody>
				<tr>
					<td colspan="2" style="border-top:1px solid #000; border-bottom:1px solid #000; height:50px; font-size:20px;">
						<b>恭喜您，注册成功!</b>
					</td>
				</tr>
				<tr style="height:15px">
				</tr>
				<tr style="height:20px">
					<td colspan="2">
						<b>注册信息</b>
					</td>
				</tr>
				<tr style="height:15px"></tr>
				<tr style="height:25px">
					<td style="width:200px">注册号:</td>
					<td>'.$ecode.'</td>
				</tr>
				<tr style="height:25px">
					<td style="width:200px">注册时间:</td>
					<td>'.date('Y-m-d H:i:s').'</td>
				</tr>
				<tr style="height:25px">
					<td style="width:200px">会议信息:</td>
					<td>2017 China CAD&CG</td>
				</tr>

				<tr style="height:25px">
					<td style="width:200px">姓名:</td>
					<td>'.$name.'</td>
				</tr>
				<tr style="height:25px">
					<td style="width:200px">单位:</td>
					<td>'.$danwei.'</td>
				</tr>
				<tr style="height:25px">
					<td style="width:200px">电话:</td>
					<td>'.$mobile.'</td>
				</tr>
				<tr style="height:25px">
					<td style="width:200px">邮箱:</td>
					<td><a href="mailto:'.$email.'">'.$email.'</a></td>
				</tr>
				<tr>
					<td colspan="2" style="height:15px; border-bottom:1px solid #000"></td>
				</tr>
				<tr style="height:15px"></tr>
			</tbody>
		</table><br>
		热烈欢迎您的参会.<br><br>
		祝好,
		2017 China CAD&CG
		';
		$mail->Send();
	}
	
   header("Content-Type: text/html;charset=utf-8");

   if (!get_magic_quotes_gpc()) {
		$name = addslashes($_POST[name]);
	   $sex = addslashes($_POST[sex]);
	   $num = addslashes($_POST[numwm]);
	   $danwei = addslashes($_POST[danwei]);
	   $email = addslashes($_POST[email]);
	   $mobile = addslashes($_POST[mobile]);
	   $zhiwu = addslashes($_POST[zhiwu]);
	   $piao = addslashes($_POST[piao]);
	   $taitou = addslashes($_POST[taitou]);
	   $address = addslashes($_POST[address]);
	   $jiaona = addslashes($_POST[jiaona]);
	   $address = addslashes($_POST[address]);
	   $shuihao = addslashes($_POST[shuihao]);
	   $shou = addslashes($_POST[shou]);
	   $shoumobile = addslashes($_POST[shoumobile]);
	} else {
		$name = $_POST[name];
	   $sex = $_POST[sex];
	   $num = $_POST[numwm];
	   $danwei = $_POST[danwei];
	   $email = $_POST[email];
	   $mobile = $_POST[mobile];
	   $zhiwu = $_POST[zhiwu];
	   $piao = $_POST[piao];
	   $taitou = $_POST[taitou];
	   $address = $_POST[address];
	   $jiaona = addslashes($_POST[jiaona]);
	}

 //------------------------------------数据库--------------------------------------------------
   $host = '127.0.0.1:3306'; 
   $db = 'cadcg2017'; 
   $uid = 'root'; 
   $pwd = '';
 	
   // Connect to the database server   
   $link = mysql_connect($host, $uid, $pwd) or die("Could not connect");
   mysql_query("SET NAMES 'utf8'"); 
   //select the json database
   mysql_select_db($db) or die("Could not select database");

   //------------------------------------数据库--------------------------------------------------
   
   //验证插入的手机号是否存在
    $sqlphone='select count(*) as t from user where mobile=\''.$mobile.'\'';
    $rs3 = mysql_query($sqlphone);
	$login="";
	while($obj = mysql_fetch_object($rs3)) {
		$login=$obj->t;
    }
    
	//如果存在，返回false；如果不存在，插入数据库，返回succeed 
    if($login=="0"){
		$ecode = "";
		date_default_timezone_set('PRC');//设置为中华人民共和国d
		$time = date('ymdGis',time());
		if($zhiwu=='0'){
			$ecode = "T";
		}
		if($zhiwu=='1'){
			$ecode = "S";
		}
		$ecode = $ecode.$time;
   
	    $sql = "INSERT INTO user (name,sex,num,danwei,email,mobile,zhiwu,piao,taitou,address,ecode,jiaona,shuihao,shou,shoumobile) VALUES ('".$name."','".$sex."','".$num."','".$danwei."','".$email."','".$mobile."','".$zhiwu."','".$piao."','".$taitou."','".$address."','".$ecode."','".$jiaona."','".$shuihao."','".$shou."','".$shoumobile."')";

		if(mysql_query($sql)){
			//sendmails($email,'欢迎光临想学网','想学网测试服务器，请登入邮箱认证');

			postmail($name,$mobile,$address,$email,$ecode,$danwei);

		}
		mysql_close($link);
		
		
		header("Location: http://cadcg.tju.edu.cn/register/success.php?ecode=".$ecode); 
	}
	else{
		header("Location: http://cadcg.tju.edu.cn/register/false.html"); 
	}
	  
?>