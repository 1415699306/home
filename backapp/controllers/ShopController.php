<?php
class ShopController extends BController{

    public function actions() 
    {
        return array(
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::SHOP,
                'category'=>161,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::SHOP,
                'category'=>161,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::SHOP,
                'category'=>161,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::SHOP,
                'category'=>161,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::SHOP,
                'category'=>161,
            ),
            
            'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::SHOP,
                 'category'=>162,
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::SHOP,
                'category'=>162,
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::SHOP,
                 'category'=>162,
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::SHOP,
                 'category'=>162,
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::SHOP,
                 'category'=>162,
            ),
        );
    }
   
    public function actionIndex()
    {
        
        $model = new Shop('search');
         $model->unsetAttributes();  
        if(isset($_GET['Shop']))
            $model->attributes=$_GET['Shop'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionCreate()
    {  
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 138;
        $category = $component->getPar();
        $category  = $component->getCatTree($category,$component->id);
        $model = new Shop();
        $model->recommend  = $model->status  = $model->channel_recommand = $model->index_recommand = 0;
        $model->shopContent = new ShopContent();
        if(isset($_POST['Shop'],$_POST['ShopContent']))
        {                              
            $model->attributes = $_POST['Shop'];
            $model->shopContent->attributes = $_POST['ShopContent'];
            if($model->validate() &&  $model->shopContent->validate() && $model->save(false))
            {  
                $_POST['ShopContent']['shop_id'] = $model->id;
                $model->shopContent->attributes = $_POST['ShopContent'];
                if($model->shopContent->save())
                {
                     Tags::saveByTags($model->tags, BaseApp::SHOP, $model->id);
                   
                    if(isset($_POST['Shop']['thumb']))
                    {                                             
                        Storage::saveByStorage(BaseApp::SHOP, $model->id ,$_POST['Shop']['thumb'],Storage::getFileExt($_POST['Shop']['thumb']));  
                    }
                    $this->redirect($this->createUrl('/shop/view',array('id'=>$model->id)));
                }
                else
                {
                    Shop::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','添加失败!','/shop/index');
                }
            }
        }
        $this->render('create',array(
            'model'=>$model,
            'category'=>$category,
        ));
    }
    
   
    public function actionUpdate($id)
    {
        $model = Shop::model()->findByPk($id);
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 138;
        $category = $component->getPar();
        $category  = $component->getCatTree($category,$component->id);
         if(isset($_POST['Shop'],$_POST['ShopContent']))
        {
            $old = $model->shopContent->content;
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Shop'];
            $model->shopContent->attributes = $_POST['ShopContent'];
            if($model->validate() && $model->shopContent->validate())
            {
                ResourcesHelper::updateContentFile($model->shopContent->content, $old); 
                if($model->save() && $model->shopContent->save())
                {  
                    if(isset($_POST['Shop']['thumb']))
                    {
                        if($thumb)
                        {
                            Storage::deleteImageBySize('shop', $model->thumbs->track_id);
                        }
                        Storage::saveByStorage(BaseApp::SHOP,$model->id,$_POST['Shop']['thumb'],Storage::getFileExt($_POST['Shop']['thumb']));
                        
                    }
                    $this->redirect($this->createUrl('/shop/view',array('id'=>$model->id)));
                }
            }
        }
        $this->render('update',array(
            'model'=>$model,
             'category'=>$category,
        ));
    }

   
    public function actionView($id)
    {
        $model = Shop::model()->findByPk($id);
        if($model === null) throw new CHttpException(404,'信息不存在!');
            $this->render('view',
            array(
                'model'=>$model,
            ));
    }
    
  
    public function actionDelete($id)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问!');             
        $model = Shop::model()->findByPk($id);
        if(!empty($model)){
            if($model->delete())
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1')));
        }
        else
            throw new CHttpException(404,'数据不存在!');
            
    }
    
    
    
}
