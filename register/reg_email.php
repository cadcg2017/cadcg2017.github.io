<?php

include './class.phpmailer.php';
include './class.smtp.php';
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = 'smtp.163.com'; // SMTP servers
$mail->Port = 465;
$mail->SMTPSecure = "ssl"; // 安全协议
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = 'chinavis2015';//比如你的邮箱是test@16.com,那么这里就写test
$mail->Password ='qwqihnajajihytyk';
$mail->From = "chinavis2015@163.com"; // 发件人邮箱
$mail->FromName = "chinavis2015@163.com"; // 发件人名称
$mail->CharSet = 'UTF-8';

$mail->AddAddress('yuantianda@126.com');//收件人,你可以给自己发一封试试
$mail->IsHTML(true); // send as HTML 


$mail->Subject = 'ChinaVis-2015 Registration Confirmation';
$mail->Body = 'Dear Jian Xiao,<br><br>
This letter is to confirm your attendance to ChinaVis-2015 which will be hosted by Tianjin<br>
University from July 17th to 18th, in Tianjin xxxx hotel, Tianjin, China.<br>
Please remember to bring this letter with you to the registration counter when you arrive<br>
at the conference.<br>
<table>
	<tbody>
		<tr>
			<td colspan="2" style="border-top:1px solid #000; border-bottom:1px solid #000; height:50px; font-size:20px;">
				<b>Registration Receipt</b>
			</td>
		</tr>
		<tr style="height:15px">
		</tr>
		<tr style="height:20px">
			<td colspan="2">
				<b>Registration Information</b>
			</td>
		</tr>
		<tr style="height:15px"></tr>
		<tr style="height:25px">
			<td style="width:200px">Registration ID:</td>
			<td>15000310</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px">Registration Date:</td>
			<td>'.date('Y-m-d H:i:s').'</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px">Event:</td>
			<td>The 2nd China Visualization and Visual Analytics  on Parallel Processing</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px"></td>
			<td>(ChinaVis-2015)</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px">Name:</td>
			<td>Jian Xiao</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px">Organization:</td>
			<td>Tianjin University</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px">Phone:</td>
			<td>18502288639</td>
		</tr>
		<tr style="height:25px">
			<td style="width:200px">Email:</td>
			<td><a href="mailto:xiaojian@tju.edu.cn">xiaojian@tju.edu.cn</a></td>
		</tr>
		<tr>
			<td colspan="2" style="height:15px; border-bottom:1px solid #000"></td>
		</tr>
		<tr style="height:15px"></tr>
	</tbody>
</table><br>
Thanks and we look forward to seeing you.<br><br>
Warmest Regards,
ChinaVis-2015 Team
';


var_dump($mail->Send());


?>