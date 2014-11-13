<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MqqValidator
 * QQ验证
 * @author martin
 */
class MqqValidator extends CValidator
{
        /**
         * @var string the regular expression used to validate the attribute value.
         * 主要验证正则
         */
        public $pattern='/^[0-9][0-9]{4,}$/';
        
        public $allowEmpty=true;
    
        /**
         * Validates the attribute of the object.
         * If there is any error, the error message is added to the object.
         * @param CModel $object the object being validated
         * @param string $attribute the attribute being validated
         */
    
        public function validateAttribute($object, $attribute) 
        {
                $value=$object->$attribute;
                if($this->allowEmpty && $this->isEmpty($value))
                        return;
                if(($value=$this->validateValue($value))!==false)
                        $object->$attribute=$value;
                else
                {
                        $message=$this->message!==null?$this->message:Yii::t('yii','{attribute} is not a valid QQ.');
                        $this->addError($object,$attribute,$message);
                }
        }

        public function validateValue($value)
        {
                if(is_string($value) && strlen($value)<2000)  // make sure the length is limited to avoid DOS attacks
                {
                        if(preg_match($this->pattern,$value))
                                return $value;
                }
                return false;
        }
    
        public function clientValidateAttribute($object,$attribute)
        {
                $message=$this->message!==null ? $this->message : Yii::t('yii','{attribute} is not a valid QQ.');
                $message=strtr($message, array(
                        '{attribute}'=>$object->getAttributeLabel($attribute),
                ));
                $pattern=$this->pattern;

                $js="
if(!value.match($pattern)) {
        messages.push(".CJSON::encode($message).");
}
";

                if($this->allowEmpty)
                {
                        $js="
if($.trim(value)!='') {
        $js
}
";
                }

                return $js;
        }
}