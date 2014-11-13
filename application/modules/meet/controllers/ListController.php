<?php
use application\modules\meet\components\Controller;

class ListController extends Controller{
    
    public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                    'backColor'=>0x2040A0,
                    'foreColor'=>0xFFFFFF,
                    'minLength'=>4,
                    'maxLength'=>6,
                    'height'=>40,
                    'width'=>80,
                    'padding'=>3,
                    'transparent'=>false,
			),
		);
	}
    
      public function filters() {
        return array (
            array (
                'COutputCache + category',
                'duration' => 3600,
                'varyByParam' => array('id','page'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM meet',

                )
            )
        );
    }
    
    public function actionCategory($id)
    {
        $category = (int)Yii::app()->request->getParam('category_id',$id);
        $time = time();
        if($category == '136'){
            $count= Yii::app()->db->createCommand("select count(a.id) from `meet` as a,`storage` as b where a.id = b.res_id and a.category_id!=:cid and b.app_id = :aid and a.recommand='1' and a.status = '0' and a.off_time<:time  order by a.id desc")->bindValues(array(':aid'=> BaseApp::MEET,':time'=>$time,':cid'=>(int)$id))->queryRow();
            $pages=new CPagination($count["count(a.id)"]);
            $pages->pageSize=5;
            $sql = "select a.title,a.id,a.status,a.off_time,a.mode,a.theme_name,a.recommand,a.trailer_time,a.province,a.city,a.organizer,a.start_time,a.off_time,a.locale,a.fee,b.res_id,b.app_id,b.track_id from `meet` as a,`storage` as b where a.recommand='1' and a.id = b.res_id and a.category_id!=:cid and b.app_id = :aid  and a.status = '0' and a.off_time<:time order by a.id desc limit :offset,:limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::MEET,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit(),':time'=>$time,':cid'=>(int)$id))->queryAll();
        }else{
            $count= Yii::app()->db->createCommand("select count(a.id) from `meet` as a,`storage` as b where a.id = b.res_id and a.category_id =:cid and b.app_id = :aid and a.recommand='1' and a.status = '0' and a.off_time>:time order by a.id desc")->bindValues(array(':aid'=> BaseApp::MEET,':cid'=>(int)$id,':time'=>$time))->queryRow();
            $pages=new CPagination($count["count(a.id)"]);
            $pages->pageSize=5;
            $sql = "select a.title,a.id,a.status,a.mode,a.theme_name,a.recommand,a.trailer_time,a.province,a.city,a.organizer,a.start_time,a.off_time,a.locale,a.fee,b.res_id,b.app_id,b.track_id from `meet` as a,`storage` as b where a.recommand='1' and a.id = b.res_id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' and a.off_time>:time order by a.id desc limit :offset,:limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::MEET,':cid'=>(int)$id,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit(),':time'=>$time))->queryAll();
        }  
        $full = $this->_getMeet('5');
        $old = $this->_getMeetHis('136');
		$this->render("category",array(
            "full"=>$full,
            "old"=>$old,
            'model'=>$model,
            'pages'=>$pages,
        ));
    }
    
    public function actionSign($id)
    {
        $model = $this->loadModel($id);
        $sign = new MeetSign('create');
        $return = false;
        $cookie = Yii::app()->request->getCookies();
        if(isset($cookie['meet_sign_form']))$return = true;
        if(isset($_POST['MeetSign']) && $model->off_time > time())
        {         
            $_POST['MeetSign']['meet_id'] = $id;
            $sign->attributes = $_POST['MeetSign'];
            if($sign->save()){
                $cookie = new CHttpCookie('meet_sign_form',Yii::app()->session->sessionID);
                $cookie->expire = time()+360;
                Yii::app()->request->cookies['meet_sign_form']=$cookie;
                Helper::showMsg('系统消息','提交成功!',$this->createUrl('/meet/list/sign',array('id'=>$id)));
            }
        }
        $this->render('sign',array(
            'model'=>$model,
            'sign'=>$sign,
            'return'=>$return,
        ));
    }
    
    public function loadModel($id)
    {
        $model = Meet::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    private function _getMeet($cid)
    {
        $sql = "select a.id,a.province,a.city,a.top_bar,a.discription,a.organizer,a.fee,a.title,a.start_time,a.off_time,a.channel_recommand,b.track_id from `meet` as a,`storage` as b where  a.id=b.res_id and a.category_id=:cid and b.app_id=:app_id and a.channel_recommand ='1'order by a.id desc limit 1,3";
        $model = Meet::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::MEET))->queryAll();
        return $model;
    }
    
    private function _getMeetHis($cid)
    {
        $time = time();
        $sql = "select a.id,a.province,a.city,a.top_bar,a.mode,a.trailer_time,a.discription,a.title,a.channel_recommand,a.start_time,a.organizer,a.fee,a.off_time,a.channel_recommand,b.track_id from `meet` as a,`storage` as b where  a.id=b.res_id and a.category_id!=:cid and a.off_time<:time and b.app_id=:app_id and a.channel_recommand ='1'order by a.id desc limit 1,8";
        $model = Meet::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::MEET,':time'=>$time))->queryAll();
        return $model;
    }
    
     public function actionEmail()
    { 
        $email = $_REQUEST['email'];
        $sql="insert into email (email) values (:email);";
        $command=  Email::model()->dbConnection->createCommand($sql);
        $command->bindParam(":email", $_REQUEST['email'],PDO::PARAM_STR);
        $rowchange = $command->execute();       
        if($rowchange){
            echo "1";
        }else{
            echo "0";
        }
    }
    
}
