<?php
use application\modules\meet\components\Controller;

class DefaultController extends Controller
{
    public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM meet',

                )
            )
        );
    }
    
	public function actionIndex()
	{ 
        $time = time();
        $notice = $this->_getMeetRecommand('5');
        $count= Yii::app()->db->createCommand("select count(a.id) from `meet` as a,`storage` as b where a.id = b.res_id and a.index_recommand='1'  and b.app_id = :aid  and a.status = '0' and a.off_time>:time order by a.id desc")->bindValues(array(':aid'=>BaseApp::MEET,':time'=>$time))->queryRow();
        $pages=new CPagination($count["count(a.id)"]);
        $pages->pageSize=5;
        $sql1 = "select a.title,a.id,a.status,a.off_time,a.mode,a.theme_name,a.index_recommand,a.trailer_time,a.province,a.city,a.organizer,a.start_time,a.off_time,a.locale,a.fee,b.res_id,b.app_id,b.track_id from `meet` as a,`storage` as b where a.index_recommand='1' and a.id = b.res_id  and b.app_id = :aid  and a.status = '0'  and a.off_time>:time order by a.id desc limit :offset,:limit";
        $model = Yii::app()->db->createCommand($sql1)->bindValues(array(':aid'=> BaseApp::MEET,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit(),':time'=>$time))->queryAll();
        $full = $this->_getMeet('5'); 
        $old = $this->_getMeetHis('136');
        $res = array();
        $i = 0;
        $sql = 'SELECT *,a.id AS aid,COUNT(DISTINCT(md5)) FROM `tags_relations` AS a,`tags` AS b WHERE a.app_id = :aid AND a.tag_id = b.id GROUP BY b.md5 ORDER BY RAND() LIMIT 10';
        $tag = Yii::app()->db->createCommand($sql)->bindValue(':aid',BaseApp::MEET)->queryAll();
        foreach($tag as $val){
                $res[$i]['name']=$val['name'];
                $res[$i]['url']='/tag/list.html?tag='.$val['name'].'&aid='.$val['app_id'].'&act='.lcfirst(BaseApp::getModelName($val['app_id']));
                ++$i;
        } 
		$this->render("index",array(
            "notice"=>$notice,
            "full"=>$full,
            "old"=>$old,
            "res"=>$res,
            'model'=>$model,
            'pages'=>$pages,
        ));
	}
    
    public function actionCreate()
    {
        $model = new Meet();
        $fee = 0;
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 4;
        $model->status = 0;
        $model->start_time='开始时间';
        $model->off_time='结束时间';
        $category = $component->getParent();  
        if(isset($_POST['Meet']))
         {     
            $model->attributes = $_POST['Meet'];
            if($model->validate())
            {      
                    if(is_array($_POST['Meet']['type'])){
                            $model->type=implode(',',$_POST['Meet']['type']);
                    }
                    if(is_array($_POST['Meet']['state'])){
                         $model->state=implode(',',$_POST['Meet']['state']);
                    }
                    foreach ($_POST['Meet']['fee'] as $key => $val ){
                        $fee += $val;
                    }
                    $model->fee = $fee;
                    $model->theme_name = $_POST['Meet']['title'];
                if($model->save(false))
                {
                     if(!empty($_POST['Meet']['thumb']))
                    {                                             
                         Storage::saveByStorage(BaseApp::MEET,$model->id,$_POST['Meet']['thumb'],Storage::getFileExt($_POST['Meet']['thumb']));    
                    }  
                    Helper::showMsg('系统消息','提交成功,等待审核!','./');
                }
                else
                {
                    Helper::showMsg('系统消息','文章添加失败!','./meet/default/create');
                }
            }
        }
        $this->render("create",array('category'=>$category,'model'=>$model));
    }
    
    public function actionEmail()
    {
        $message = "你好聪明";
        $mailer = Yii::createComponent("application.extensions.mailer.EMailer");
        $mailer->Host = "smtp.qq.com";
        $mailer->IsSMTP();
        $mailer->SMTPAuth = true;
        $mailer->From = "1415699306@qq.com";        
        $mailer->AddReplyTo("459977741@qq.com");
        $mailer->AddAddress("459977741@qq.com"); 
        $mailer->FromName = "1415699306";  
        $mailer->Username = "1415699306@qq.com";    
        $mailer->Password = "4209821991pursue";    
        $mailer->SMTPDebug = true;   
        $mailer->CharSet = "UTF-8";
        $mailer->Subject = Yii::t("demo", "Yii rulez!"); 
        $mailer->Body = $message;
        $mailer->Send();
    }
    
    
   
    
    public function loadModel($id)
    {
        $model = Meet::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    private function _getMeetRecommand($cid)
    {
        $sql = "select a.id,a.theme_name,a.province,a.city,a.locale,a.discription,a.title,a.start_time,a.off_time,a.channel_recommand,b.track_id from `meet` as a,`storage` as b where  a.id=b.res_id and a.category_id=:cid and b.app_id=:app_id and a.index_recommand ='1'order by a.id desc limit 1";
        $model = Meet::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::MEET))->queryRow();
        return $model;
    }
    
    private function _getMeet($cid)
    {
        $sql = "select a.id,a.category_id,a.province,a.top_bar,a.city,a.discription,a.title,a.start_time,a.off_time,a.channel_recommand,b.track_id from `meet` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.channel_recommand ='1'order by a.id desc limit 0,3";
        $model = Meet::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::MEET))->queryAll();
        if($model === null)
            return array();
        else
            return $model;
    }
    
    private function _getMeetHis($cid)
    {
        $time = time();
        $sql = "select a.id,a.category_id,a.province,a.top_bar,a.mode,a.city,a.discription,a.title,a.channel_recommand,a.start_time,a.off_time,a.channel_recommand,b.track_id from `meet` as a,`storage` as b where a.off_time < :time  and a.category_id!=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand ='1'order by a.id desc limit 0,8";
        $model = Meet::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::MEET,':time'=>$time))->queryAll();
       if($model === null)
            return array();
        else
            return $model;
    }
     
    public function actionNCreate()
    {
        $models = new Article();
        $models->recommend = 0;
        $models->status = $models->settings['status'];
        $models->articleContent = new ArticleContent();
        if(isset($_POST['Article'],$_POST['ArticleContent']))
        {
            $models->attributes = $_POST['Article'];
            $models->articleContent->attributes = $_POST['ArticleContent'];
            if($models->validate() && $models->articleContent->validate() && $models->save(false))
            {
                $models->articleContent->article_id = $models->id;
                if($models->articleContent->save())
                    Helper::showMsg('系统消息','文章添加成功!','/'.BACKEND_URL.'/article/index');
            }
        }
        $this->render('create',array('models'=>$models));
    }
     
}