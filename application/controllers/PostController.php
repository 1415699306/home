<?php
use application\components\Controller;

class PostController extends Controller{
    
    
   public function actions()  
    {  
        return array(  
            'help'=>array(
            'class'=>'CViewAction',
            'basePath'=>'help', 
            'defaultView'=>'default',
            'viewParam'=>'help' 
          ),  
        );  
    }  


  
}