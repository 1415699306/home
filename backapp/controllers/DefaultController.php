<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 * 后台首页
 * @author Administrator
 */
class DefaultController extends BController{
    /**
     * 后台首页
     */
    public function actionIndex()
    {
        $announcement = Announcement::model()->findAllByAttributes(array('type'=>1));
        $this->render('index',array(
            'announcement'=>$announcement,
            ));
    }
	
	 public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			Yii::app()->end($error['message']);
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout = '//layouts/login';
        if(0 < Yii::app()->user->id)
            $this->redirect (Yii::app()->homeUrl);
        
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}

