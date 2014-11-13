<?php

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