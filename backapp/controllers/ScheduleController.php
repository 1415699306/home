<?php

/**
 * 预注册管理
 */
class ScheduleController extends BController
{
    /**
     * 预注册首页
     */
    public function actionIndex()
    {
        $model=new UserSchedule('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['UserSchedule']))
            $model->attributes=$_GET['UserSchedule'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    
     /**
     * 查看用户信息
     * 
     * @param PRIMARY $id
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
        ));
    }
    
    
    /**
     * 读取用户模型对象
     * 
     * @param PRIMARY $id
     * @throws CHttpException
     * @return $object
     */
    public function loadModel($id)
    {
        $model = UserSchedule::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
}

