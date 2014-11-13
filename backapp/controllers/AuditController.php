<?php
class AuditController extends BController
{
    public function actionIndex()
    {
        $model = new Article('search'); 
        $model->unsetAttributes();
        if(isset($_GET['Article']))
            $model->attributes = $_GET['Article'];
        $this->render('index',array('model'=>$model));
    }

    public function actionInvestment()
    {
        $model = new Investment('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Investment']))
            $model->attributes=$_GET['Investment'];
        $this->render('investment',array(
            'model'=>$model,
        ));
        
    }
    
    public function actionMeet()
    {
        $model = new Meet('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Meet']))
            $model->attributes=$_GET['Meet'];
        $this->render('meet',array(
            'model'=>$model,
        ));
    }
    
    public function actionLife()
    {
        $model = new Life('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Life']))
            $model->attributes=$_GET['Life'];
        $this->render('life',array(
            'model'=>$model,
        ));
    }
    
    public function actionCelebrity()
    {
      
       $model = new Celebrity('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Celebrity']))
            $model->attributes=$_GET['Celebrity'];
        $this->render('celebrity',array(
            'model'=>$model,
        ));  

    }
    
    public function actionTrade()
    {
        $model = new Trade('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Trade']))
            $model->attributes=$_GET['Trade'];
        $this->render('trade',array(
            'model'=>$model,
        ));
    }
    
    public function actionCommunity()
    {
        $model = new Community('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Community']))
            $model->attributes=$_GET['Community'];
        $this->render('community',array(
            'model'=>$model,
        ));
    }
    
    public function actionStudy()
    {
        $model = new Study('search');
             $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Study']))
            $model->attributes=$_GET['Study'];
        $this->render('study',array(
            'model'=>$model,
        ));
    }

    public function actionAudit($id,$type)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问');
        $source = (string)Yii::app()->request->getParam('source',null);
        $model = $this->_loadModel($id,$source);
        $model->status = $type;
        if(!$model->save(false))
            throw new CHttpException(403,'保存失败!');
    }
    
    public function actionAll($source)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        $model = $this->_loadAllFactory($source, $_POST['id']);
        foreach ($model as $key){
            $key->status = $key->status === '0' ? '1' : '0';
            $key->save(false);
        }
         if(Yii::app()->request->isAjaxRequest)
            echo CJSON::encode(array('success' => true,'code'=>'1'));
         else
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        
    }
    
    private function _loadAllFactory($source,$data)
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $data);
        switch ($source){
            case 'article' :
                $model = Article::model()->findAll($criteria);
                break;
            case 'investment' :
                $model = Investment::model()->findAll($criteria);
                break;
            case 'meet' :
                $model = Meet::model()->findAll($criteria);
                break;
            case 'life' :
                $model = Life::model()->findAll($criteria);
                break;
            case 'celebrity' :
                $model = Celebrity::model()->findAll($criteria);
                break;
            case 'trade' :
                $model = Trade::model()->findAll($criteria);
                break;
            case 'community' :
                $model = Community::model()->findAll($criteria);
                break;
            case 'study' :
                $model = Study::model()->findAll($criteria);
                break;
            
        }
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
    
    private function _loadModel($id,$source)
    {       
        switch ($source){
            case 'article':
                $model = Article::model()->findByPk($id);
                break;
            case 'investment':
                $model = Investment::model()->findByPk($id);
                break;
            case 'meet':
                $model = Meet::model()->findByPk($id);
                break;
            case 'celebrity':
                $model = Celebrity::model()->findByPk($id);
                break;
            case 'life':
                $model = Life::model()->findByPk($id);
                break;
             case 'trade':
                $model = Trade::model()->findByPk($id);
                break;
             case 'community':
                $model = Community::model()->findByPk($id);
                break;
            case 'study':
                $model = Study::model()->findByPk($id);
                break;
        }
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
}
