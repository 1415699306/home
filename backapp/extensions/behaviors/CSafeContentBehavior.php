<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CSafeContentBehavior
 *
 * @author martin
 */
class CSafeContentBehavior extends CActiveRecordBehavior{
    public $attributes =array();
    protected $purifier;
  
    function __construct(){
        $this->purifier = new CHtmlPurifier;
    }
  
    public function beforeSave($event)
    {
        foreach($this->attributes as $attribute){
            $this->getOwner()->{$attribute} = $this->purifier->purify($this->getOwner()->{$attribute});
        }
    }
}

?>
