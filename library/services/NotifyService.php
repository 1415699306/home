<?php
class NotifyService implements SplSubject{
    
    private $_Observers = array();
    private $_id;
    private $_log_id;
    private $_msg;
    private $_subject;
    private $_message;
    private $_address;
    
    public function __construct($dream_id,$log_id,$msg=null) 
    {
        $this->_id = $dream_id;
        $this->_log_id = $log_id;
        $this->_msg = $msg;
    }
    
    public function attach(SplObserver $observer) 
    {       
        if(!in_array($observer, $this->_Observers))
            $this->_Observers[] = $observer;
    }
    
    public function detach(SplObserver $observer) 
    {       
        if(false != ($index = array_search($observer, $this->_Observers)))
            unset ($this->_Observers[$index]);
    }
    
    public function notify() 
    {
        $notify = array('id'=>$this->_id,'log_id'=>$this->_log_id,'msg'=>$this->_msg);
        foreach($this->_Observers as $observer)
            $observer->update($this,$notify);        
    }
    
    
    public function setMail($subject,$message,$address)
    {
        $this->_subject = $subject;
        $this->_message = $message;
        $this->_address = $address;
        $this->notify();
    }
    
    public function sendmail()
    {
        $mailer = Yii::createComponent('ext.mailer.EMailer');
        $mailer->IsSMTP();
        $mailer->Form = 'root@localhost.localdomain';
        $mailer->AddReplyTo($this->_address);
        $mailer->AddAddress($this->_address);
        $mailer->FormName = Yii::app()->name;
        $mailer->CharSet = 'UTF-8';
        $mailer->ContentType = 'text/html';
        $mailer->Subject = $this->_subject;
        $mailer->body = $this->_message;
        if($mailer->send())
            return true;
        else
            return false;
    }
    
    public function setLog()
    {
        $this->notify();
    }
}
