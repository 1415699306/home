<?php
/**
 * 系统发送邮件类
 * 
 * @author martin
 * @method 配合EMailer扩展包使用
 * 
 *示例
 *$message = '
	<html>
		<bodey>
			<table>
				<tr>
				<td><b><a href="http://www.yiibase.com">欢迎注册YiiBase中文网</a></b></td>
				</tr>
				<tr>
				<td>此邮件由系统自动发出,请勿直接回复!</td>
				</tr>
			</table>
		</body>
	</html>';
	$mail = new sendMail;
	$mail->send('欢迎注册YiiBase中文网',$message,'gzmartin@vip.qq.com');
	*/
class sendMail{
	public function send($subject,$message,$address)
	{
		$mailer = Yii::createComponent('ext.mailer.EMailer');
		$mailer->IsSMTP();
		$mailer->From = Yii::app()->params['adminEmail'];
		$mailer->AddReplyTo($address);
		$mailer->AddAddress($address);
		$mailer->FromName =	Yii::app()->name;
		$mailer->CharSet = 'UTF-8';
		$mailer->ContentType = 'text/html';
		$mailer->Subject = $subject;
		$mailer->Body = $message;
		if($mailer->Send())
			return true;
		else
			return false;
	}
}