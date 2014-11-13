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
class SiteController extends BController{
     /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                    'backColor'=>0x2040A0, //背景颜色
                    'foreColor'=>0xFFFFFF,
                    'minLength'=>4, //最短为4�?
                    'maxLength'=>6, //是长�?�?
                    'height'=>40,
                    'width'=>80,
                    'padding'=>3,
                    'transparent'=>false, //显示为透明，当关闭该选项，才显示背景颜色 
                    'testLimit'=>999,   
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    /**
     * 后台首页
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'type=1';
        $criteria->order = 'id desc';
        $announcement = Announcement::model()->findAll($criteria);
        $this->render('index',array(
            'announcement'=>$announcement,
            ));
    }
	
    public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'error', $error);
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
        
		$model=new LoginForm('backend');
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
				$this->redirect('/site/index');
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
    
    public function actionNews()
    {
        $model=new News('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['News']))
            $model->attributes=$_GET['News'];
        $this->render('news',array(
            'model'=>$model,
        ));
    }
    
   
    public function actionCreate()
    {
        $model = new News();
        $model->aip = 1;
        $model->recommend = 0;
        if(isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            $title = $model->title;
            if($model->aip == '7'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
              $model->link = '/life/list/view/'."$tid";
            }elseif($model->aip == '8'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                if($module == 'celebrityPainted'){
                    $module = 'celebrity_painted';
                }
                $sql = "select id,title,category_id,discription from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $model->discription=$tid['0']['discription'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/celebrity/list/view/'."$tid";
            }elseif($model->aip == '9'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id,discription,professor from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];
                $model->professor = $tid['0']['professor'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/study/list/view/'."$tid";
            }elseif($model->aip == '1'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,name,category_id,discription,unit,maney,contacts,address from `$module` where name='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];$model->unit= $tid['0']['unit'];$model->maney= $tid['0']['maney'];
                $model->contacts = $tid['0']['contacts']; $model->address = $tid['0']['address'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/investment/default/'."$tid";
            }
            if($model->save())
            { 
                if(!empty($_POST['News']['thumb']))
                {                                             
                     Storage::saveByStorage(BaseApp::NEWS,$model->id,$_POST['News']['thumb'],Storage::getFileExt($_POST['News']['thumb']));

                }  
                $this->redirect($this->createUrl('/site/view',array('id'=>$model->id)));
            }else{
                    Helper::showMsg('系统消息','信息添加失败!',DIRECTORY_SEPARATOR.'./'.'site');
            }  
               
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    public function actionUpdate($id)
    {
       
        $model = $this->loadModel($id);        
        if(isset($_POST['News']))
        {
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['News'];
            $title = $model->title; 
            if($model->aip == '7'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
              $model->link = '/life/list/view/'."$tid";
            }elseif($model->aip == '8'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                if($module == 'celebrityPainted'){
                    $module = 'celebrity_painted';
                }
                $sql = "select id,title,category_id,discription from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $model->discription=$tid['0']['discription'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/celebrity/list/view/'."$tid";
            }elseif($model->aip == '9'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id,discription,professor from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];
                $model->professor = $tid['0']['professor'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/study/list/view/'."$tid";
            }elseif($model->aip == '1'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,name,category_id,discription,unit,maney,contacts,address from `$module` where name='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(empty($tid)) throw new CHttpException(404,'信息不存�?'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];$model->unit= $tid['0']['unit'];$model->maney= $tid['0']['maney'];
                $model->contacts = $tid['0']['contacts']; $model->address = $tid['0']['address'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/investment/default/'."$tid";
            }
            if($model->validate())
            {
                if($model->save())
                {  
                    if(isset($_POST['News']['thumb']))
                    {
                        if($thumb)
                        {
                            Storage::deleteImageBySize('news', $model->thumbs->track_id);
                        }                                         
                        Storage::saveByStorage(BaseApp::NEWS,$model->id,$_POST['News']['thumb'],Storage::getFileExt($_POST['News']['thumb']));
                        
                    }
                    $this->redirect($this->createUrl('/site/view',array('id'=>$model->id)));
                }
            }
            else
                 Helper::showMsg('系统消息','信息更新失败!',DIRECTORY_SEPARATOR.'./'.'site');
        }
        $this->render('update',array(
            'model'=>$model,
        ));
    }
    
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
        ));
    }
    

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','文章删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'news');
    }

    public function loadModel($id)
    {
        $model = News::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存�?');
        else
            return $model;
    }
    
}

