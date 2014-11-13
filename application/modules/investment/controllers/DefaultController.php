<?php
use application\modules\investment\components\Controller;
class DefaultController extends Controller
{
     public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM investment',

                )
            )
        );
    }
    
	public function actionIndex($id=null)
	{
        $params = array();
        $criteria = new CDbCriteria();
        $criteria->with = 'investmentMod';
        if($id === null)
        {
            $criteria->order = 'ctime desc';
        }
        else
        {
            $criteria->condition = 't.id = :tid';           
            $criteria->params = array(':tid'=>$id);
        }
        $criteria->addCondition('status = 0');
        $model = Investment::model()->find($criteria);
        if(empty($model))throw new CHttpException(404,'信息不存在');
            $advisory = new Advisory();
        if(isset($_POST['Advisory']))
        {
            $cookie = Yii::app()->request->getCookies();
            if(isset($cookie['investment_form']))
                Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'-1')));
            if(!Yii::app()->request->isAjaxRequest)
                throw new CHttpException(403,'非法访问!');
            $_POST['Advisory']['res_id'] = $model->id;
            $_POST['Advisory']['app_id'] = BaseApp::INVESTMENT;
            $advisory->attributes = $_POST['Advisory'];
            if($advisory->save())
            {
                $cookie = new CHttpCookie('investment_form', base64_encode(time()));
                $cookie->expire = time()+60;
                Yii::app()->request->cookies['investment_form']=$cookie;
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>1)));
            }
            else
                Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>CJSON::encode($advisory->errors))));
        }
		
        if(!empty($model->investmentMod))
        {
            foreach($model->investmentMod as $key){
                $params[] = CJSON::decode($key->mod);
            }
        }
		$this->render('index',array(
                'model'=>$model,
                'advisory'=>$advisory,
                'params'=>$params,
            ));
	}
     
    public function actionRegional()
    {
        $advisory = new Advisory();
        $return = false;
        $cookie = Yii::app()->request->getCookies();
        if(isset($cookie['investment_regional-form']))$return = true;
        if(isset($_POST['Advisory']))
        { 
            $cookie = Yii::app()->request->getCookies();
            if(isset($cookie['investment_regional-form']))
                Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'-1')));
            $_POST['Advisory']['res_id'] = 83;
            $_POST['Advisory']['app_id'] = BaseApp::INVESTMENT;
            $advisory->attributes = $_POST['Advisory'];
            if($advisory->save())
            {
                $cookie = new CHttpCookie('investment_regional-form', base64_encode(time()));
                $cookie->expire = time()+60;
                Yii::app()->request->cookies['investment_regional-form']=$cookie;
                Helper::showMsg('系统消息','提交成功!',$this->createUrl('/investment/default/regional/'));
            }  
        }
        $this->render('regional ',array('advisory'=>$advisory,'return'=>$return));
    }
    
    public function actionMap()
    {
        $this->layout = '//layouts/map';
        $this->render('map');
    }
    
    public function actionCeshi()
    {
        $this->render("ceshi");
    }
}