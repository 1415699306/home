<?php
use application\modules\investment\components\Controller;

class LiveroomController extends Controller{
    
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionView()
    {
        $this->render('view');
    }
    
    public function actionShow()
    {
        $this->render('show');
    }
}
