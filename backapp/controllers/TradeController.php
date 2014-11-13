<?php
class TradeController extends BController{
    
    public $text = 50;
    public $image = 50;
    
    public function actions() 
    {
        return array(
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::TRADE,
                'category'=>66,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::TRADE,
                'category'=>66,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::TRADE,
                'category'=>66,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::TRADE,
                'category'=>66,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::TRADE,
                'category'=>66,
            ),
        );
    }
    public function actionIndex()
    {
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 62;
        $category = $component->getPar();
        $category  = $component->getCatTree($category,$component->id);
        $model=new Trade('search');
        $model->unsetAttributes();  
        if(isset($_GET['Trade']))
            $model->attributes=$_GET['Trade'];
        $this->render('index',array(
            'model'=>$model,
            'category'=>$category,
        ));
    }
    
  
    public function actionCreate()
    {
        /*$count = Trade::model()->countByAttributes(array('category_id'=>$id,'type'=>$type));
        switch ($type)
        {
            case '0' :
                $count >= $this->text ? Helper::showMsg('系统消息','此分类文字发布已达到系统最大值,不能再添加!','/trade') : '';
                break;
            case '1' :
                $count >= $this->image ? Helper::showMsg('系统消息','此分类文字发布已达到系统最大值,不能再添加!','/trade') : '';
                break;
        }*/
        $model = new Trade(); 
        $model->recommand = $model->channel_recommand = $model->index_recommand = 0;
        
        $model->status = 0;
        $model->type = 1;
        $model->tradeContent = new TradeContent();
        /*$component = Yii::createComponent('CategoryComponent');        
        $component->id = 62;
        $category = $component->getPar();
        $category  = $component->getCatTree($category,$component->id);
        $style = TradeStyle::model()->findAll();    */
        //print_r($_POST['Trade']);exit;        
        if(isset($_POST['Trade'],$_POST['TradeContent']))
        {
             //标签处理
            $tags = TradeArea::getArea($_POST['Trade']['area']).','.TradeSprice::getSprice($_POST['Trade']['sprice']).','.TradeSpace::getSpace($_POST['Trade']['space']).','.TradeStyle::getStyle($_POST['Trade']['style']);
	    $model->type = $_POST['Trade']['type'];
            $model->population = $_POST['Trade']['population'];
            $model->min_img=CUploadedFile::getInstance($model,'min_img');
            $model->big_img=CUploadedFile::getInstance($model,'big_img');
            if(!empty($model->min_img->tempName))
            {
                 $file = Yii::createComponent('FileComponent');
                 $file->route = 'trade';
                 $file->tempName = $model->min_img->tempName;
                 $file->fileName = $model->min_img->name;
                 $file->extName  = $model->min_img->extensionName;
                 $path = $file->upload('min');
                 unset($file);
                 $_POST['Trade']['min_thumb'] = ($path['file_path'].$path['file_name']);
            }
            if(!empty($model->big_img->tempName))
            {                
                 $file = Yii::createComponent('FileComponent');
                 $file->route = 'trade';
                 $file->tempName = $model->big_img->tempName;
                 $file->fileName = $model->big_img->name;
                 $file->extName  = $model->big_img->extensionName;
                 $path = $file->upload('big');
                 unset($file);
                 $_POST['Trade']['big_thumb'] = ($path['file_path'].$path['file_name']);
            }
            $model->attributes = $_POST['Trade'];
            $model->tradeContent->attributes = $_POST['TradeContent'];
            $model->start_time = strtotime($_POST['Trade']['start_time']);
            $model->stop_time = strtotime($_POST['Trade']['stop_time']);
            if($model->validate() && $model->tradeContent->validate() && $model->save(false))
            {
                $_POST['TradeContent']['trade_id'] = $model->id;
                $model->tradeContent->attributes = $_POST['TradeContent'];
                if($model->tradeContent->save())
                {
                    Tags::saveByTags($tags, BaseApp::TRADE, $model->id);
                    $this->redirect($this->createUrl('/trade/view',array('id'=>$model->id)));
                }
                else
                {
                    Trade::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','文章添加失败!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'trade');
                }
            }
        }
        
        $this->render('create',array(
            'model'=>$model,
            //'category'=>$category,
            //'style'=>$style
        ));
    }
    
 
    public function actionUpdate($id)
    {
        //$newContent = null;
        $model = $this->loadModel($id);       
        /*$component = Yii::createComponent('CategoryComponent');
        $component->id = 62;
        $category = $component->getPar();
        $category  = $component->getCatTree($category,$component->id);*/
        if(isset($_POST['Trade'],$_POST['TradeContent']))
        {
            $model->population = $_POST['Trade']['population'];
            //标签管理
            $tags = TradeArea::getArea($_POST['Trade']['area']).','.TradeSprice::getSprice($_POST['Trade']['sprice']).','.TradeSpace::getSpace($_POST['Trade']['space']).','.TradeStyle::getStyle($_POST['Trade']['style']);
            $old = $model->tradeContent->content;
            $min_thumb = !empty($model->min_thumb) ? true : false;
            $big_thumb = !empty($model->big_thumb) ? true : false;
            $model->min_img=CUploadedFile::getInstance($model,'min_img');
            $model->big_img=CUploadedFile::getInstance($model,'big_img');
            if(!empty($model->min_img->tempName))
            {
                 if($min_thumb)Trade::deleteFile($model->min_thumb);
                 $file = Yii::createComponent('FileComponent');
                 $file->route = 'trade';
                 $file->tempName = $model->min_img->tempName;
                 $file->fileName = $model->min_img->name;
                 $file->extName  = $model->min_img->extensionName;
                 $path = $file->upload('min');
                 unset($file);
                 $_POST['Trade']['min_thumb'] = ($path['file_path'].$path['file_name']);
            }
            if(!empty($model->big_img->tempName))
            {                
                if($big_thumb)Trade::deleteFile($model->big_thumb);
                 $file = Yii::createComponent('FileComponent');
                 $file->route = 'trade';        
                 $file->tempName = $model->big_img->tempName;
                 $file->fileName = $model->big_img->name;
                 $file->extName  = $model->big_img->extensionName;
                 $path = $file->upload('big');
                 unset($file);
                 $_POST['Trade']['big_thumb'] = ($path['file_path'].$path['file_name']);
            }
            $model->attributes = $_POST['Trade'];
            $model->tradeContent->attributes = $_POST['TradeContent'];  
            if(2>1)  //修改
            {
                /*处理文章被删除的图片*/
                ResourcesHelper::updateContentFile($model->tradeContent->content, $old);   
                $model->start_time = strtotime($_POST['Trade']['start_time']);
                $model->stop_time = strtotime($_POST['Trade']['stop_time']);
                if($model->save(false) && $model->tradeContent->save(false))
                {
                    Tags::updateByTags($tags, BaseApp::TRADE, $model->id);
                    Helper::showMsg('系统消息','内容修改成功!','/trade');
                }
            }
            /*else
                $newContent= $_POST['TradeContent']['content'];*/
        }
        $this->render('update',array(
            'model'=>$model,
            //'category'=>$category,
            //'newContent'=>$newContent,
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
            Helper::showMsg('系统消息','内容删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'trade');
    }
    
   
    public function loadModel($id)
    {
        $model = Trade::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    public function actionList()
    {
        $model = null;
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 62;
        $category = $component->getParent();
        if(isset($_POST['category']))
        {
            $cid = (int)$_POST['category'];
            $models = Trade::model()->findAll("category_id = '{$cid}'");
            if(!empty($models))
            {
                foreach($models as $key=>$val)
                {
                    if($val->type == 0)
                        $model['text'][$key] = $val->attributes;
                    else
                        $model['image'][$key] = $val->attributes;
                }
            }
            else
            {
                $model = false;
            }
        }
        if(isset($_POST['Trade']))
        {
            $img = isset($_POST['Trade']['index'])?$_POST['Trade']['index']:array();
            $text = isset($_POST['Trade']['text_index'])?$_POST['Trade']['text_index']:array();
            foreach($img as $key=>$val)
            {
               Trade::model()->getDbConnection()->createCommand("update `trade` set `index` = :index where id = :id")->bindValues(array('index'=>$val,':id'=>$key))->execute();
            }
            foreach($text as $key=>$val)
            {
               Trade::model()->getDbConnection()->createCommand("update `trade` set `text_index` = :index where id = :id")->bindValues(array('index'=>$val,':id'=>$key))->execute();
            }
            Yii::app()->user->setFlash('trade_list','修改成功!');
            $this->redirect($this->createUrl('/trade/list'));
        }
        $this->render('list',
            array(
                'model'=>$model,
                'category'=>$category,
        ));
    }
    
 
    public function actionAudit($id,$type)
    {
         if(!Yii::app()->request->isAjaxRequest)
            throw new CHttpException(403,'非法访问');
        $id = (int)$id;
        $type = (int)$type;
        $msg = $type == 0 ? '审核' : '黑名单';
        $model = $this->loadModel($id);
        $model->status = $type;
        if($model->save())
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>"用户{$msg}操作成功!")));
        else
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'0','msg'=>"用户{$msg}失败!")));   
    }
    
    //面积管理
    public function actionArea()
        {
            $models = TradeArea::model()->findAll();
            if(isset($_POST['TradeArea']) || isset($_POST['TradeAreaSave']))
            {
                if(isset($_POST['TradeArea']))
                {
                    foreach($_POST['TradeArea'] as $key){
                        Yii::app()->db->createCommand("UPDATE `trade_area` SET `name`=:name where `id`=:id")->bindValues(array(':name'=>$key['name'],':id'=>$key['id']))->execute();
                    }   
                }
                if(isset($_POST['TradeAreaSave']) && !empty($_POST['TradeAreaSave']['name']))
                {
                    Yii::app()->db->createCommand("insert into `trade_area` SET `name`=:name")->bindValues(array(':name'=>$_POST['TradeAreaSave']['name']))->execute();
                }
                Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect('area');
            }
                $this->render('area',array('models'=>$models));
        }
        
        public function actionAreaDelete($id)
        {
            if(null === $model = TradeArea::model()->findByPk($id))
                throw new CHttpException(404,'信息不存在!');
            else
            {
                if($model->delete())
                    Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect($this->createUrl('/trade/area'));
            }
        }
        
    //风格管理
        public function actionStyle()
        {
            $models = TradeStyle::model()->findAll();
            if(isset($_POST['TradeStyle']) || isset($_POST['TradeStyleSave']))
            {
                if(isset($_POST['TradeStyle']))
                {
                    foreach($_POST['TradeStyle'] as $key){
                        Yii::app()->db->createCommand("UPDATE `trade_style` SET `name`=:name where `id`=:id")->bindValues(array(':name'=>$key['name'],':id'=>$key['id']))->execute();
                    }   
                }
                if(isset($_POST['TradeStyleSave']) && !empty($_POST['TradeStyleSave']['name']))
                {
                    Yii::app()->db->createCommand("insert into `trade_style` SET `name`=:name")->bindValues(array(':name'=>$_POST['TradeStyleSave']['name']))->execute();
                }
                Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect('style');
            }
                $this->render('style',array('models'=>$models));
        }
        
        public function actionStyleDelete($id)
        {
            if(null === $model = TradeStyle::model()->findByPk($id))
                throw new CHttpException(404,'信息不存在!');
            else
            {
                if($model->delete())
                    Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect($this->createUrl('/trade/style'));
            }
        }
        
        //空间管理
        public function actionSpace()
        {
            $models = TradeSpace::model()->findAll();
            if(isset($_POST['TradeSpace']) || isset($_POST['TradeSpaceSave']))
            {
                if(isset($_POST['TradeSpace']))
                {
                    foreach($_POST['TradeSpace'] as $key){
                        Yii::app()->db->createCommand("UPDATE `trade_space` SET `name`=:name where `id`=:id")->bindValues(array(':name'=>$key['name'],':id'=>$key['id']))->execute();
                    }   
                }
                if(isset($_POST['TradeSpaceSave']) && !empty($_POST['TradeSpaceSave']['name']))
                {
                    Yii::app()->db->createCommand("insert into `trade_space` SET `name`=:name")->bindValues(array(':name'=>$_POST['TradeSpaceSave']['name']))->execute();
                }
                Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect('space');
            }
                $this->render('space',array('models'=>$models));
        }
        
        public function actionSpaceDelete($id)
        {
            if(null === $model = TradeSpace::model()->findByPk($id))
                throw new CHttpException(404,'信息不存在!');
            else
            {
                if($model->delete())
                    Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect($this->createUrl('/trade/space'));
            }
        }
        
        
        
        //家电定制
        public function actionAppliance()
        {
            $models = TradeAppliance::model()->findAll();
            if(isset($_POST['TradeAppliance']) || isset($_POST['TradeApplianceSave']))
            {
                if(isset($_POST['TradeAppliance']))
                {
                    foreach($_POST['TradeAppliance'] as $key){
                        Yii::app()->db->createCommand("UPDATE `trade_appliance` SET `name`=:name where `id`=:id")->bindValues(array(':name'=>$key['name'],':id'=>$key['id']))->execute();
                    }   
                }
                if(isset($_POST['TradeApplianceSave']) && !empty($_POST['TradeApplianceSave']['name']))
                {
                    Yii::app()->db->createCommand("insert into `trade_appliance` SET `name`=:name")->bindValues(array(':name'=>$_POST['TradeApplianceSave']['name']))->execute();
                }
                Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect('appliance');
            }
                $this->render('appliance',array('models'=>$models));
        }
        
        public function actionApplianceDelete($id)
        {
            if(null === $model = TradeAppliance::model()->findByPk($id))
                throw new CHttpException(404,'信息不存在!');
            else
            {
                if($model->delete())
                    Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect($this->createUrl('/trade/appliance'));
            }
        }
        
        
        
        //生活定制
        
        public function actionLife()
        {
            $models = TradeLife::model()->findAll();
            if(isset($_POST['TradeLife']) || isset($_POST['TradeLifeSave']))
            {
                if(isset($_POST['TradeLife']))
                {
                    foreach($_POST['TradeLife'] as $key){
                        Yii::app()->db->createCommand("UPDATE `trade_life` SET `name`=:name where `id`=:id")->bindValues(array(':name'=>$key['name'],':id'=>$key['id']))->execute();
                    }   
                }
                if(isset($_POST['TradeLifeSave']) && !empty($_POST['TradeLifeSave']['name']))
                {
                    Yii::app()->db->createCommand("insert into `trade_life` SET `name`=:name")->bindValues(array(':name'=>$_POST['TradeLifeSave']['name']))->execute();
                }
                Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect('life');
            }
                $this->render('life',array('models'=>$models));
        }
        
        public function actionLifeDelete($id)
        {
            if(null === $model = TradeLife::model()->findByPk($id))
                throw new CHttpException(404,'信息不存在!');
            else
            {
                if($model->delete())
                    Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect($this->createUrl('/trade/life'));
            }
        }
        
        
        //价格管理
        public function actionPrice()
        {
            $models = TradeSprice::model()->findAll();
            if(isset($_POST['TradeSprice']) || isset($_POST['TradeSpriceSave']))
            {
                if(isset($_POST['TradeSprice']))
                {
                    foreach($_POST['TradeSprice'] as $key){
                        Yii::app()->db->createCommand("UPDATE `trade_sprice` SET `name`=:name where `id`=:id")->bindValues(array(':name'=>$key['name'],':id'=>$key['id']))->execute();
                    }   
                }
                if(isset($_POST['TradeSpriceSave']) && !empty($_POST['TradeSpriceSave']['name']))
                {
                    Yii::app()->db->createCommand("insert into `trade_sprice` SET `name`=:name")->bindValues(array(':name'=>$_POST['TradeSpriceSave']['name']))->execute();
                }
                Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect('price');
            }
                $this->render('price',array('models'=>$models));
        }
        
        public function actionPriceDelete($id)
        {
            if(null === $model = TradeSprice::model()->findByPk($id))
                throw new CHttpException(404,'信息不存在!');
            else
            {
                if($model->delete())
                    Yii::app()->user->setFlash('adminMessage','保存成功!');
                $this->redirect($this->createUrl('/trade/price'));
            }
        }
        
        
}