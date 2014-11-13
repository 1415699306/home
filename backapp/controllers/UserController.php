<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 * 用户管理
 * @author martin
 */
class UserController extends BController{
    
    /**
     * 用户管理首页
     */
    public function actionIndex()
    {
        $model = new User('search');
        $model->unsetAttributes();
        if(isset($_GET['User']))
            $model->attributes = $_GET['User'];
        $this->render('index',array('model'=>$model));
    }
    
    /**
     * 审核用户
     */
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
    
    /**
     * 查看用户
     * 
     * @param int $id
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $model->with('userProfile');
        $this->render('view',array('model'=>$model));
    }
    
    /**
     * 角色设置
     * 
     * @param int $id 角色ID
     * @throws CHttpException
     */
    public function actionCompetence()
    {
        $uid = Yii::app()->user->id;
        /*设置Clist*/
        $dataProvider=new CActiveDataProvider('UserMangerRole',array(
            'sort'=>array(
                    'defaultOrder'=>'ctime desc',
                ),
            'pagination'=>array(
                    'pagesize'=>'5',
                ),
        ));
        $criteria = new CDbCriteria();
        $criteria->with = array('assignCount');
        $criteria->compare('name',isset($_GET['UserMangerRole']) ? $_GET['UserMangerRole']['name'] : null ,true);
        if(Yii::app()->user->name != Yii::app()->params['adminName'])
        {
            $criteria->condition='user_id=:uid';
            $criteria->params = array(':uid'=>Yii::app()->user->id);
        }
        $dataProvider->setCriteria($criteria);
        $model = new UserMangerRole();
        $this->performAjaxRoleValidation($model);
        /*保存角色*/
        if(isset($_POST['UserMangerRole']))
        {
            $assign = UserMangerAssign::model()->with('role')->find('LOWER(t.user_id)=?',array($uid));
            if(!empty($assign->role))
                $_POST['UserMangerRole']['parent_id'] = $assign->role->id;
            
            $model->attributes = $_POST['UserMangerRole'];
            if($model->save())
                Helper::showMsg ('系统消息','保存成功!现在跳转至权限设置',$this->createUrl('/user/authitem',array('id'=>$model->id)));           
        }
        $this->render('competence',array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
        ));
    }
    
    protected function performAjaxRoleValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='role-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    /**
     * 删除用户角色
     * 
     * @param int $id
     * @throws CHttpException
     */
    public function actionDeleteRole($id)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问');
        UserMangerRole::deleteRole($id);
        Yii::app()->end(CJSON::encode(array('success'=>true,'msg'=>'删除成功!','code'=>'1')));      
    }

    /**
     * 角色权限设置
     * 
     * @param int $id 角色ID
     * @throws CHttpException
     */
    public function actionAuthItem($id)
    {
        $id = (int)$id;
        $uid = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 'id = :id';
        if(Yii::app()->user->name !=Yii::app()->params['adminName'])
            $criteria->addCondition("user_id = '{$uid}'");
        $criteria->params = array(':id'=>$id);
        $role = UserMangerRole::model()->find($criteria);
        if(empty($role))
            throw new CHttpException(404,'用户角色不存在,请先创建角色!');
        $manger = new CuserManger;
        $controllers = $manger->getControllerActions();   

        $issetModuleKey = array_keys($controllers["controllers"]);      
        if(isset($_POST) && !empty($issetModuleKey))
        {               
            foreach ($issetModuleKey as $post)
            {      
                if(isset($_POST[$post]))
                {                  
                    $data = $_POST[$post];                  
                    if(isset($data['id'])){
                        $model = UserMangerAuthItems::model()->findByPk($data['id']);
                        unset($data['id']);
                    }else{
                        $model = new UserMangerAuthItems();
                    }
                    /*检查权限是否有越权*/
                    if(Yii::app()->user->name !=Yii::app()->params['adminName']){
                        $data = $manger->checkRoleByArray($post,$data);
                    }
                    if(!empty($data))
                    {                  
                        $model->role_id = $id;
                        $model->type = 1;
                        $model->controller =md5($post);
                        $model->authItems = CJSON::encode(array(($post)=>array_keys($data)));
                        if($model->save())
                        {
                            /*更新下级全部权限*/
                            $manger->updateSon($id,$post,$data);
                            Yii::app()->user->setFlash('competence','操作完成!');
                        }
                    }
                    else
                    {
                        $model->delete();
                        $manger->deleteAuthItemsByControllerName($id,$post);
                    }
                }
            }
            Yii::log($uid.'对id:'.$id.'的角色进行了操作','info','system.backend.user');
        }
        $AuthItems['backend'] = $manger->getAuthItems($id,'1');
        $this->render('authitem',array(
            'controllers'=>$controllers,
            'AuthItems'=>$AuthItems,
            'role'=>$role,
        ));
    }  
    
    /**
     * 用户授权
     */
    public function actionUserAuthItem()
    {
        $models = $listData = array();
        $model = new User();
        $model->unsetAttributes();
        if(isset($_GET['User']))
        {
            $name = (string)$_GET['User']['username'];
            $criteria = new CDbCriteria();
            $criteria->with = array('assign','assign.role');
            $criteria->condition = 't.id > 1';
            $criteria->addCondition("username='{$name}'");
            $models=User::model()->find($criteria);
            if(!empty($models))
                $listData = UserMangerRole::getListData($models->id);
            if(!empty($models) && !empty($models->assign))
                $listData = array_merge(array('0'=>array('id'=>'0','name'=>'删除角色')),$listData);
        }
                 
        if(isset($_POST['UserAuthItem']))
        {
            $uid = (int)$_POST['UserAuthItem']['id'];
            $rid = (int)$_POST['UserAuthItem']['role_id'];
            $manger = UserMangerAssign::model()->find('LOWER(user_id)=?',array($uid));
            $return = false;
            /*保存新角色*/
            if(empty($manger) && 0 < $rid)
            {
                $manger = new UserMangerAssign();
                $manger->user_id = $uid;
                $manger->role_id = $rid;
                if($manger->save())
                    $return = true;
            }
            /*更新角色*/
            elseif(!empty($manger) && 0 < $rid)
            {
                $userManger = new CuserManger();
                if($userManger->updateAuthItem($uid,$rid))
                {
                    $manger->role_id = $rid;
                    if($manger->save())
                    {
                        UserMangerRole::deleteRoleAll($uid);
                        $return = true;
                    }
                }
            }
            /*删除角色*/
            elseif(!empty($manger) && $rid == 0)
            {
                if($manger->delete())
                {
                    UserMangerRole::deleteRoleAll($uid);                
                    $return = true;
                }
            }
            if($return === true)
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1')));
            else
                Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'-1')));
        }
        $this->render('userauthitem',
                array(
                    'model'=>$model,
                    'models'=>$models,
                    'listData'=>$listData,
                ));
    }
          
    /**
     * 读取用户model
     * 
     * @param int $id
     * @return object
     * @throws CHttpException
     */ 
    protected function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(403,'用户信息不存在!');
        else
            return $model;
    }
    
    
    /**
     * 添加用户
     */
    public function actionCreate()
    {
       $model = new User();
       if(isset($_POST['User']))
        {
            $model->attributes =$_POST['User'];
            //表单js安全处理
            if(!$model->validate())
            {
                Helper::showMsg('系统消息','提交失败!',$this->createUrl('/user/index'));
                return;
            }
            $params = $_POST['User']; 
            $password = $model->hashPassword($params['password']);
            $connection = Yii::app()->db;
            $transaction=$connection->beginTransaction();  
            try
            {
               //保存主表(user)数据
               $sqlUser = "insert into `user` set `email` = :email, `username`=:username,`password`=:password, `register_time`= :register_time,`group_id`= :group_id,`status`=:status,`mtime`=:register_time";
               $connection->createCommand($sqlUser)->bindValues(array(':email'=>$params['email'],':username'=>$params['username'],':password'=>$password,':register_time'=>time(),':group_id'=>User::DEFAULT_GROUP,':status'=>1))->execute();
              
               $id = $connection->getLastInsertID();
               //保存附表(user_profile)数据
               $sqlProfile = "insert into `user_profile` set `user_id` = :user_id";
               $connection->createCommand($sqlProfile)
                       ->bindValues(array(':user_id'=>$id))->execute();

               $transaction->commit();
              //保存数据成功信息
               Helper::showMsg('系统消息','用户添加成功!等待系统审核!',$this->createUrl('/user/index'));
            }
            catch(Exception $e)
            {
               //异常写入日志
               Yii::log($e,'error','site.create');
               $transaction->rollBack();
               //保存数据失败信息
               Helper::showMsg('系统消息','提交失败!',$this->createUrl('/user/index'));
            }
        }
       $this->render('create',array('model'=>$model));
    }
    
    
    
}

