<?php
class GlobalController extends BController{

    public function actions()
    {
        return array(
            'treeMoveUp'=>'ext.category.actions.TreeMoveUpAction',
            'treeMoveDown'=>'ext.category.actions.TreeMoveDownAction',
            'treeCreate'=>'ext.category.actions.TreeCreateAction',
            'treeUpdate'=>'ext.category.actions.TreeUpdateAction',
            'treeLoad'=>'ext.category.actions.TreeLoadAction',
            'treeDelete'=>'ext.category.actions.TreeDeleteAction',
            'treeChildren'=>'ext.category.actions.TreeChildrenAction',
            'treeChildrenParent'=>'ext.category.actions.TreeChildrenParentAction',
            'treeCreateParent'=>'ext.category.actions.TreeCreateParentAction',
             'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::BASE,
                 'category'=>'16',
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::BASE,
                'category'=>'16',
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::BASE,
                'category'=>'16',
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::BASE,
                'category'=>'16',
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::BASE,
                'category'=>'16',
            ),
        );
    }
   
    public function actionIndex()
    {       
        $model = Setting::model()->findAll();
        $analytics = '';
        if(file_exists(Yii::app()->request->baseUrl.'static/analytics.txt'))$analytics=file_get_contents(Yii::app()->request->baseUrl.'static/analytics.bin');
        if(isset($_POST['ConfigForm']))
        {
            foreach($_POST['ConfigForm'] as $key=>$n){
                Yii::app()->db->createCommand("UPDATE `setting` SET `value` = :value WHERE `name` = :key;")->bindValues(array(':value'=>$n,':key'=>$key))->execute();
            }
            if(!is_dir(RESOURCE_PATH.DIRECTORY_SEPARATOR.'static'))
                mkdir(RESOURCE_PATH.DIRECTORY_SEPARATOR.'static');  
            if(!is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'analytics.bin'))
                file_put_contents(RESOURCE_PATH.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'analytics.bin',$_POST['analytics']);
            if(Yii::app()->request->isAjaxRequest)
                Yii::app()->end('保存成功!');
            else
                Helper::showMsg ('系统消息','更新设置成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global'.DIRECTORY_SEPARATOR.'index');
            Yii::app()->cache->delete('global_setting'); 
        }
        $this->render('index',array(
            'model'=>$model,
            'analytics'=>$analytics,
        ));
    }
    
   
    public function actionCategory()
    {
        $this->render('category');
    }
    
   
    public function actionAnnouncement()
    {
        $model = new Announcement('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Announcement']))
            $model->attributes=$_GET['Announcement'];
        $this->render('announcement',array(
            'model'=>$model,
        ));
    }

    
    public function actionAnnouncementCreate()
    {
        $newContent = null;
        $model = new Announcement();
        $model->status = $model->type = 0;
        if(isset($_POST['Announcement']))
        {
            $model->attributes = $_POST['Announcement'];
            if(!$model->validate())
            {
                $newContent= $_POST['Announcement']['content'];
            }
            if($model->save()){
                Helper::showMsg ('系统消息','公告添加成功!','/global/announcement');
            }
        }
        $this->render('announcementCreate',array(
            'model'=>$model,
             'newContent'=>$newContent,
        ));
    }
    
    
     public function actionAnnouncementUpdate($id)
    {
        $newContent = null;
        $model = Announcement::model()->findByPk($id);
        if(isset($_POST['Announcement']))
        {
            $old = $model->content;
            $model->attributes = $_POST['Announcement'];
            if($model->validate())
            {
                ResourcesHelper::updateContentFile($model->content, $old);
            }
            if($model->save())
            {
                 Helper::showMsg ('系统消息','公告更新成功!','/global/announcement');
            }            
            else
                $newContent= $_POST['Announcement']['content'];
        }
        $this->render('announcementUpdate',array(
            'model'=>$model,
            'newContent'=>$newContent,
        ));
    }
    
   
    public function actionAnnouncementView($id)
    {
        $model = $this->loadAnnouncement($id);
        $this->render('announcementview',array(
            'model'=>$model,
        ));
    }
    
   
    public function actionAnnouncementDelete($id)
    {        
        if(Yii::app()->request->isAjaxRequest)
        {      
            if($this->loadAnnouncement($id)->delete())
                Yii::app()->end(CJSON::encode(array('success'=>true)));
        }
        else
            throw new CHttpException(403,'非法访问!');
    }
    
    public function actionLog()
    {
        $count = Yii::app()->logSQL->createCommand('select count(*) from Yiilog')->queryRow();
        $pages=new CPagination($count["count(*)"]);
        $pages->pageSize=15;
        $limit = (int)$pages->getLimit();
        $offset = (int)$pages->getOffset();
        $model = Yii::app()->logSQL->createCommand("select * from Yiilog order by id desc limit {$offset},{$limit}")->queryAll();
        $this->render('log',array(
            'model'=>$model,
            'pages'=>$pages,
        ));
    }


    protected function loadAnnouncement($id)
    {
        $model = Announcement::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'公告不存在!');
        else
            return $model;
    }
    
    
    public function actionApc()
    {
        if(get_extension_funcs('apc') === null)throw new CHttpException(403,'APC扩展不可用!');
        $model = apc_cache_info();
        $this->render('apc',array('model'=>$model));
    }
    
    
    public function actionMemcache()
    {
        if(get_extension_funcs('memcache') === null)throw new CHttpException(403,'MEMCACHE扩展不可用!');
        $memcache = Yii::app()->cache->getMemCache();
        $model = $memcache->getExtendedStats();
        $key = array_keys($model);
        $this->render('memcache',array('model'=>$model[$key[0]]));
    }
    
    public function actionCache()
    {
        if(isset($_GET['delete']))
        {
            if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'request is error');
        var_dump(Yii::app()->cache->flush());
            if(Yii::app()->cache->flush())
                Yii::app()->end('清除完成!');
            else
                Yii::app()->end('清除失败!');
        }
        $this->render('cache');
    }
    
    public function actionChannel()
    {
        $data = simplexml_load_file(ROOT_PATH.'/backapp/xml/system/category.xml');
        $criteria = new CDbCriteria();
        $criteria->condition = 'parent_id = 0';
        $criteria->addCondition ('system = 1');
        $category = Category::model()->findAll($criteria);
        if(isset($_POST['ChannelForm'])){
            $doc=new DOMDocument("1.0","UTF-8");
            $doc->formatOutput=true; 
            $root=$doc->createElement("category");
            $doc->appendChild($root);
            foreach ($_POST['ChannelForm'] as $val){
                    $dkey = $doc->createElement($val['key']);
                    $channel = $root->appendChild($dkey); 
                    $id =  $doc->createElement('id');
                    $channel->appendChild($id); 
                    $id->appendChild($doc->createTextNode($val['id']));
                    $link = $doc->createElement('link');
                    $channel->appendChild($link); 
                    $link->appendChild($doc->createTextNode($val['link']));
                    $title = $doc->createElement('title');
                    $channel->appendChild($title); 
                    $title->appendChild($doc->createTextNode($val['title']));
                    $keyword = $doc->createElement('keyword');
                    $channel->appendChild($keyword); 
                    $keyword->appendChild($doc->createTextNode($val['keyword']));
                    $discription = $doc->createElement('discription');
                    $channel->appendChild($discription); 
                    $discription->appendChild($doc->createTextNode($val['discription']));
            }
            $return = $doc->save(ROOT_PATH.DIRECTORY_SEPARATOR.'backapp'.DIRECTORY_SEPARATOR.'xml'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'category.xml');
            if($return)
                Helper::showMsg ('系统消息','修改成功!',$this->createUrl('/global/channel'));
    
        }
        $this->render('channel',array(
            'data'=>$data,
            'category'=>$category,
        ));
    }
	
	 public function actionClear()
    {
        if(Yii::app()->cache->flush()){
             Yii::app()->end('清除完成!');
        }  else {
             Yii::app()->end('清除失败!');
        }
        
    }
}