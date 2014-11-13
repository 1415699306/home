<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailService
 *
 * @author Administrator
 */
class MailService implements SplObserver
{

    public function update(SplSubject $subject) 
    {
        $subject->sendMail();
    }
}
