<?php
/**
 * jquery plugin toastmessage
 * inEffectDuration:  600,   // in effect duration in miliseconds
 * stayTime:         3000,   // time in miliseconds before the item has to disappear
 * sticky:          false,   // should the toast item sticky or not?
 * type:         'notice',   // notice, warning, error, success
 * position:  'top-right',   // top-left, top-center, top-right, middle-left, middle-center, middle-right Position of the toast container holding different toast.Position can be set only once at the very first call,changing the position after the first call does nothing
 * closeText:         '',    // text which will be shown as close button,set to '' when you want to introduce an image via css
 * close:            null    // callback function when the toastmessage is closed
 */
  
class toastMessageWidget extends CWidget
{            
      public $options = array();
      /**
       * @var string message to display
       */
      public $message; 
           
      /**
       * @var type of notification notice, success, error, warning
       */
      public $type='Success'; 
      
      protected $assets; 
     
            
      public function run()
	  {
            $js = Yii::app()->getClientScript();
            $assetsPath = Yii::getPathOfAlias('ext.toastMessage.assets');
            $this->assets = Yii::app()->getAssetManager()->publish($assetsPath);     
            $js->registerScriptFile($this->assets.'/jquery.toastmessage.js'); 
            $js->registerCssFile($this->assets.'/css/toastmessage.css');
            $this->type =ucfirst(CHtml::encode($this->type)); 
            //encode message 
            $this->message = CHtml::encode($this->message); 
            $this->options = json_encode($this->options);
            $js->registerScript("toast-message","
                     $().toastmessage(".$this->options.");
                     $().toastmessage('show".$this->type."Toast', '$this->message');
                ");  
        }
  }