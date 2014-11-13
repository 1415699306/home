<?php
use application\components\Controller;

class HtmlController extends Controller{
    
    public function actionView($id)
    {
        $html = file_get_contents(WEB_PATH.DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.$id.'.html');
        echo $html;
    }
}