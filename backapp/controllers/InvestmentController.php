<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvestmentController
 * 招商管理模块,模板引擎模式
 * 
 * @author martin
 */
class InvestmentController extends BController{
    
    public function actions()
    {
        return array(
            'advisory'=>array(
                'class'=>'AdvisoryManger',
                'method'=>'advisory',
            ),
            'deleteadvisory'=>array(
                'class'=>'AdvisoryManger',
                'method'=>'deleteadvisory',
                'appId'=>BaseApp::INVESTMENT,
            ),
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::INVESTMENT,
                'category'=>18,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::INVESTMENT,
                'category'=>18,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::INVESTMENT,
                'category'=>18,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::INVESTMENT,
                'category'=>18,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::INVESTMENT,
                'category'=>18,
            ),
        );
    }
    
    /**
     * 招商管理操作
     */
    public function actionIndex()
    {
        $model=new Investment('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Investment']))
            $model->attributes=$_GET['Investment'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    /**
     * 查看
     * 
     * @param type $id
     * @throws CHttpException
     */
    public function actionView($id)
    {
        $model = Investment::model()->with('investmentMod')->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        $this->render('view',array('model'=>$model));
    }
    
    /**
     * 更新
     * 
     * @param int $id
     * @throws CHttpException 404
     */
    public function actionUpdate($id)
    {
        $model = Investment::model()->with('investmentMod')->findByPk($id);
        $topbar = $this->_getTopBarImage();
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        $component = Yii::createComponent('CategoryComponent');
        $component->id = 20;
        $category = $component->getParent();
        if(isset($_POST['Investment']))
        {
            $model->attributes = $_POST['Investment'];
            if($model->save())
            {
                Storage::cutThumbsOnly($_POST,'investment','thumb');
                $moduleName = $this->_getModuleName();
                foreach($moduleName as $v)
                {             
                   if(isset($_POST[ucfirst($v)]))
                   {
                       $mod = (string)CJSON::encode(array($v=>$_POST[ucfirst($v)]));
                       $md5 = md5($v);
                       $data = InvestmentMod::model()->findByAttributes(array('investment_id'=>$id,'md5'=>$md5));
                       if(!empty($data)){
                           $data->mod = $mod;
                           $data->save();
                       }
                   }
               }
               Helper::showMsg ('系统消息','项目更新成功!','/investment');
            }
        }
        $this->render('update',array(
            'model'=>$model,
            'topbar'=>$topbar,
            'category'=>$category,
            ));
    }
    
    /**
     * 删除
     * 
     * @param type $id
     */
    public function actionDelete($id)
    {
        $model = Investment::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        else
            $model->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app()->end(CJSON::encode(array('success'=>true,'msg'=>'删除项目成功!')));
        else
            Helper::showMsg ('系统消息','删除项目成功!','/investment');
    }
    
    
    /**
     * 基本保存,如果存入ID大于1,代表非开发模板模式,保存成功后进入扩展保存操作
     * 
     * @param int $id
     */
    public function actionBeforce($id)
    {        
        $id = (int)$id;
        $this->_checkTemplate($id);
        $topbar = $this->_getTopBarImage();
        $model = new Investment();
        $model->index_recommand = $model->channel_recommand = $model->recommand = $model->message = $model->status = 0;
        $component = Yii::createComponent('CategoryComponent');
        $component->id = 20;
        $category = $component->getParent();
        
        
        if(isset($_POST['Investment']))
        {
            $_POST['Investment']['type'] = $id;
            $model->attributes = $_POST['Investment'];
            if($model->validate())
            {
                Storage::cutThumbsOnly($_POST,'investment','thumb');
                if(1 < $id)
                {
                    Yii::app()->session['beface']=CJSON::encode($_POST['Investment']);
                    $this->redirect ($this->createUrl('save',array('id'=>$id)));
                }
                else
                {
                    if($model->save())
                    {                      
                        $this->redirect ($this->createUrl('/investment/view',array('id'=>$model->id)));
                    }
                    else
                        Helper::showMsg ('系统消息','保存失败','/investment');
                }
            }
				
        }
        $this->render('beforce',array(
                'model'=>$model,
                'topbar'=>$topbar,
                'category'=>$category,
            ));
    }
    
    /**
     * 扩展保存
     * 
     * @param int $id
     */
    public function actionSave($id)
    {
        $id = (int)$id;
        $reader = $this->_checkTemplate($id);
        $module = $this->_getModuleImage();
        $json = Yii::app()->session['beface'];
        $params = CJSON::decode($json,true);
        $moduleName = $this->_getModuleName();
        if(empty($params))throw new CHttpException(403,'数据出错!请返回重新发布!');               
        foreach($moduleName as $v)
        {
            if(isset($_POST[ucfirst($v)]))
            {
                $this->_saveMod($params,$_POST,$moduleName);
                Yii::app()->session['beface'] = null;
            }
        }
        $this->render($reader,array(
                'module'=>$module,
                'moduleName'=>$moduleName,
            ));
    }  
    
    /**
     * 保存附加模块，执行事务处理
     * 
     * @param array $params 主表数据
     * @param POST $_POST
     */
    private function _saveMod($params,$_POST,$moduleName)
    {
        $connection = Yii::app()->db;
        $transaction=$connection->beginTransaction();
        if(empty($params))throw new CHttpException(403,'参数异常!');
        try 
        {
            /*保存主表数据*/
            $uid = Yii::app()->user->id;
            $time = time();
            $connection->createCommand("insert into `investment` set `category_id`=:cid, `channel_recommand`=:channel_recommand,`recommand`=:recommand,`maney`=:maney, `unit`=:unit,`website`=:website,`address`=:address,`email`=:email,`tel`=:tel,`contacts`=:contacts,`thumb`=:thumb,`name`=:name,`discription`=:disc,`deadline`=:dead,`seo_keyword`=:key,`seo_discription`=:sd,`top_bar`=:bar,`user_id`=:uid,`ctime`=:ctime,`mtime`=:mtime")
            ->bindValues(array(':cid'=>$params['category_id'],':channel_recommand'=>$params['channel_recommand'],':recommand'=>$params['recommand'],':maney'=>$params['maney'],':unit'=>$params['unit'],'website'=>$params['website'],'address'=>$params['address'],'email'=>$params['email'],'tel'=>$params['tel'],':thumb'=>isset($params['thumb'])?$params['thumb']:'','contacts'=>$params['contacts'],'name'=>$params['name'],'disc'=>$params['discription'],'dead'=>strtotime($params['deadline'],time()),'key'=>$params['seo_keyword'],'sd'=>$params['seo_discription'],':bar'=>isset($params['top_bar'])?$params['top_bar']:'','uid'=>$uid,'ctime'=>$time,'mtime'=>$time))->execute();
            /*获取返回主键*/
            $id = $connection->getLastInsertID();
            /*保存模块数据*/
            foreach($moduleName as $v)
            {              
                if(isset($_POST[ucfirst($v)]))
                {
                    $mod = (string)CJSON::encode(array($v=>$_POST[ucfirst($v)]));
                    $md5 = md5($v);
                    $connection->createCommand("insert into `investment_mod` set `investment_id` = :id, `md5`=:md5, `mod` = :mod")->bindValues(array('id'=>$id,'md5'=>$md5,'mod'=>$mod))->execute();
                }
            }
            $transaction->commit();
            Helper::showMsg('系统消息',"项目成功提交!",'/investment');
        }
        catch(Exception $e)
        {
           $transaction->rollBack();
           var_dump($e);exit;
           Yii::log($e,'error','backend');
           Helper::showMsg('系统消息',"保存失败",'/investment');
        }
    }
    
    /**
     * 模板安全检查
     * 
     * @param int $id
     * @return string route 模板路径
     * @throws CHttpException
     */
    private function _checkTemplate($id)
    {
        $id = (int)$id;
        $template = Investment::getTemplateName($id,true);       
        $path = $this->_getPath().DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.$template;
        $call_template = $path.DIRECTORY_SEPARATOR.'create.php';
        if(!is_dir($path) || !is_file($call_template))throw new CHttpException(403,'模板不存在!');
        return 'template'.DIRECTORY_SEPARATOR.$template.DIRECTORY_SEPARATOR.'create';
    }
    
    /**
     * 获取模板缩略图片
     * 
     * @return string
     */
    private function _getTemplate()
    {
        $path = $this->_getPath().DIRECTORY_SEPARATOR.'template';
        $paths = $return = array();
        $handle = opendir($path);
        if ($handle)
        {
            while (false !== ($file = readdir($handle))) 
            {
                if ($file != "."&&$file != "..")
                {
                    $return[] = $file;
                }
            }
            closedir($handle);
        }
        
        foreach($return as $key)
        {
            $path = $this->_getPath().DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.$key.DIRECTORY_SEPARATOR.'background.png';
            if(is_file($path)){
                $paths[] = $this->_getPathUrl().DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.$key.DIRECTORY_SEPARATOR.'background.png';
            }
        }
        
        return $paths;
    }
    
    /**
     * 获取顶部图片
     */
    private function _getTopBarImage()
    {
        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.'topbar';
        $return = $resault = array();
        $handle = opendir($path);
        if ($handle)
        {
            while (false !== ($file = readdir($handle))) 
            {
                if ($file != "."&&$file != "..")
                {
                    $return[] = $file;
                }
            }
            closedir($handle);
            foreach($return as $res)
            {
                $resPath = HOME_URL.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$res; 
                $file = $path.DIRECTORY_SEPARATOR.$res;
                if(is_file($file))
                {
                    $resault[] = $resPath;
                }
            }
        }
        return $resault;
    }
    
    /**
     * 设定模板路径
     * 
     * @return string route
     */
    private function _getPath()
    {
        return Yii::app()->theme->basePath.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'investment';
    }
    
    /**
     * 设定URL路径
     * 
     * @return string route
     */
    private function _getPathUrl()
    {
        return Yii::app()->theme->baseUrl.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'investment';
    }
    
    /**
     * 获取模块图片
     * 
     * @return array
     */
    public function _getModuleImage()
    {
        $path = $this->_getPath().DIRECTORY_SEPARATOR.'module';
        $resault = array();
        $return = $this->_getModuleName();
        foreach($return as $res)
        {
            $handle = opendir($path.DIRECTORY_SEPARATOR.$res.DIRECTORY_SEPARATOR.'image');
            while (false !== ($file = readdir($handle))) 
            {                    
                if ($file != "."&&$file != "..")
                {
                    $i=0;
                    $resault[$res][] = $this->_getPathUrl().DIRECTORY_SEPARATOR.'module'.DIRECTORY_SEPARATOR.$res.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$file;
                    ++$i;
                }                    
            }
            closedir($handle);
        }        
        return $resault;
    }
    
    /**
     * 扫描获取模块名称
     * 
     * @return array
     */
    private function _getModuleName()
    {        
        $path = $this->_getPath().DIRECTORY_SEPARATOR.'module';
        $return = array();
        $handle = opendir($path);
        if ($handle)
        {
            while (false !== ($file = readdir($handle))) 
            {
                if ($file != "."&&$file != "..")
                {
                    $return[] = $file;
                }
            }
            closedir($handle);
        }
        return $return;
    }
}

