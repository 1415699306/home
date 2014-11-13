<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CuserManger
 * 用户角色BASE
 * 
 * @author martin
 */
class CuserManger {
   /**
	* Returns all the controllers and their actions.
	* @param array $items the controllers and actions.
	*/
	public function getControllerActions($items=null)
	{
		if( $items===null )
			$items = $this->getAllControllers();

		foreach( $items['controllers'] as $controllerName=>$controller )
		{
			$actions = array();
			$file = fopen($controller['path'], 'r');
			$lineNumber = 0;
			while( feof($file)===false )
			{
				++$lineNumber;
				$line = fgets($file);
				preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
				if( $matches!==array() )
				{
					$name = strtolower($matches[1]);
					$actions[ strtolower($name) ] = array(
						'name'=>$name,
						'line'=>$lineNumber
					);
				}
			}
            $array = BaseApp::getModuleNameByMenu($controllerName);
            if(!empty($array[ $controllerName ]))
            {
                if(array_key_exists('advertising', $array[$controllerName]['actions'])){
                    $actions['advertising'] = array('name'=>"advertising");
                    $actions['advcreate'] = array('name'=>"advcreate");
                    $actions['advertisingupdate'] = array('name'=>"advertisingupdate");
                    $actions['advertisingdelete'] = array('name'=>"advertisingdelete");
                    $actions['advertisingview'] = array('name'=>"advertisingview");
                }
                if(array_key_exists('slide', $array[$controllerName]['actions'])){
                    $actions['slide'] = array('name'=>"slide");
                    $actions['slidecreate'] = array('name'=>"slidecreate");
                    $actions['slideupdate'] = array('name'=>"slideupdate");
                    $actions['slidedelete'] = array('name'=>"slidedelete");
                    $actions['slideview'] = array('name'=>"slideview");
                }
            }
            //$actions['advertising'] = array('name'=>"advertising");
			$items['controllers'][ $controllerName ]['actions'] = $actions;
		}

		foreach( $items['modules'] as $moduleName=>$module )
			$items['modules'][ $moduleName ] = $this->getControllerActions($module);

		return $items;
	}
    
   /**
	* Returns a list of all application controllers.
	* @return array the controllers.
	*/
	protected function getAllControllers()
	{
		$basePath = Yii::app()->basePath;
		$items['controllers'] = $this->getControllersInPath($basePath.DIRECTORY_SEPARATOR.'controllers');
		$items['modules'] = $this->getControllersInModules($basePath);
		return $items;
	}
    
   /**
	* Returns all controllers under the specified path.
	* @param string $path the path.
	* @return array the controllers.
	*/
	protected function getControllersInPath($path)
	{
		$controllers = array();

		if( file_exists($path)===true )
		{
			$controllerDirectory = scandir($path);
			foreach( $controllerDirectory as $entry )
			{
				if( $entry{0}!=='.' )
				{
					$entryPath = $path.DIRECTORY_SEPARATOR.$entry;
					if( strpos(strtolower($entry), 'controller')!==false )
					{
						$name = substr($entry, 0, -14);
						$controllers[ strtolower($name) ] = array(
							'name'=>$name,
							'file'=>$entry,
							'path'=>$entryPath,
						);
					}

					if( is_dir($entryPath)===true )
						foreach( $this->getControllersInPath($entryPath) as $controllerName=>$controller )
							$controllers[ $controllerName ] = $controller;
				}
			}
		}
		return $controllers;
	}
    
   /**
	* Returns all the controllers under the specified path.
	* @param string $path the path.
	* @return array the controllers.
	*/
	protected function getControllersInModules($path)
	{
		$items = array();

		$modulePath = $path.DIRECTORY_SEPARATOR.'modules';
		if( file_exists($modulePath)===true )
		{
			$moduleDirectory = scandir($modulePath);
			foreach( $moduleDirectory as $entry )
			{
				if( substr($entry, 0, 1)!=='.')
				{
					$subModulePath = $modulePath.DIRECTORY_SEPARATOR.$entry;
					if( file_exists($subModulePath)===true )
					{
						$items[ $entry ]['controllers'] = $this->getControllersInPath($subModulePath.DIRECTORY_SEPARATOR.'controllers');
						$items[ $entry ]['modules'] = $this->getControllersInModules($subModulePath);
					}
				}
			}
		}
		return $items;
	}
    
    /**
     * 获取角色对应权限
     * 
     * @param int $id
     * @param int $type
     * @return array
     */
    public function getAuthItems($id,$type)
    {
        $params = array();
        $models = UserMangerAuthItems::model()->findAllByAttributes(array('role_id'=>$id,'type'=>$type));
        if(!empty($models))
        {
            foreach($models as $model)
            {
                $key = CJSON::decode($model->authItems,true);
                foreach($key as $val=>$res)
                {
                    $params[$val]['id'] = $model->id;
                    $params[$val]['data'] = $res;
                }
            }
        }
        return $params;
    }
    
    /**
     * 检查查角色控制器权限
     * 
     * @param string $controller
     * @return boolean
     */
    public function checkController($controller)
    {       
        $return = false;
        static $model = null;
        if($model === null)
            $model = UserMangerAssign::model()->with('authItems')->find('LOWER(user_id)=?',array(Yii::app()->user->id));
        foreach ($model->authItems as $items)
        {
            if($items->controller === md5($controller))
            {
                $return = true;
            }
        }
        return $return;
    }
    
    /**
     * 检查用户角色权限
     * 
     * @param object $controller
     * @param object $action
     * @return boolean
     */
    public function checkRole($controller, $action)
    {
        $models = $this->loadRoleModel();
        if(!empty($models))
        {
            foreach ($models as $assigns)
            {
                foreach($assigns->roles as $role)
                {
                    foreach($role->authItemsBackend as $authItem)
                    {
                        $params = CJSON::decode($authItem->authItems,true);                     
                        if(array_key_exists($controller->id, $params))
                        {
                            if(0 < array_key_exists($action->id,array_flip($params[$controller->id])))
                            {
                                return true;
                            }
                        }
                    }
                    return false;
                }
            }
        }
        else
            return false;
    }
    
    /**
     * 检查角色权限 for array
     * 
     * @param string $controller
     * @param array $data
     * @return maxid null|array
     * @throws CHttpException
     */
    public function checkRoleByArray($controller,$data,$type=1)
    {
        $return = null;
        $models = $this->loadRoleModel();
        $items = $type == 1 ? 'authItemsBackend' : 'authItemsSite';
        if(!empty($models))
        {
            foreach ($models as $assigns)
            {
                foreach($assigns->roles as $role)
                {
                    foreach($role->{$items} as $authItem)
                    {
                        $params = CJSON::decode($authItem->authItems,true);   
                        foreach ($params as $key=>$v)
                        {
                           if(array_key_exists($controller, $params))
                           {
                               return array_flip(array_intersect(array_keys($data),$params[$key]));       
                               break;
                           }
                        }
                    }
                }
            }
        }
        if(empty($return))
            throw new CHttpException(403,'您的当前置在保存前已被管理员修改,请重新设置!');
    }
    
    /**
     * 更新儿子权限
     * 
     * @param int $id is parent_id
     * @param string $controller
     * @param array $data
     */
    public function updateSon($id,$controller,$data)
    {
        $models = UserMangerRole::model()->with('authItem')->findAllByAttributes(array('parent_id'=>$id));
        foreach($models as $key)
        {
            if(!empty($key->authItem))
            {
                $params = CJSON::decode($key->authItem->authItems,true);
                if(array_key_exists($controller, $params))
                {
                    $new = array_flip(array_intersect(array_keys($data), $params[$controller]));
                    if(!empty($new))
                    {
                        $key->authItem->authItems =  CJSON::encode(array($controller =>array_keys($new)));
                        $key->authItem->save(); 
                    }
                    else
                    {
                        $key->authItem->delete();
                    }
                    $this->updateSon($key->authItem->role_id, $controller, $data);
                }
            }
        }
    }
    
    /**
     * 更新全部角色关系设置,清除旧角色已被取消的更新
     * 
     * @param int $uid 用户ID
     * @param int $rid 新角色ID
     * @return boolean 执行更新结果
     */
    public function updateAuthItem($uid,$rid)
    {
        /*检查被设置的新角色是否有设置角色*/
        $role = UserMangerRole::model()->find('LOWER(user_id)=?',array($uid));
        if($role===null)return true;        
        $newAuthItems = UserMangerAuthItems::model()->findAllByAttributes(array('role_id'=>$rid));
        foreach($newAuthItems as $newAuthItem)
        {
            $authItem = CJSON::decode($newAuthItem->authItems,true);
            $old = UserMangerAuthItems::model()->findByAttributes(array('controller'=>$newAuthItem->controller,'type'=>$newAuthItem->type));
            if(!empty($old))
            {
                $oldAhthItem = CJSON::decode($old->authItems,true);
                $oldKey = array_keys($oldAhthItem);
                $array = array_intersect($authItem,$oldAhthItem);
                if(!empty($array))
                {
                    $key = array_keys($array);
                    $data = CJSON::encode(array($key[0]=>$array[$key[0]]));
                    $old->authItems = $data;
                    if($old->save())
                        $this->updateSon ($role->id, $key[0], $array[$key[0]]);
                }
                else
                {
                    $old->delete();
                    $this->deleteAuthItemsByControllerName($old->id,$oldKey);
                }
            }
        }
        return true;
    }
    
    /**
     * 递归删除所有儿子acion
     * 
     * @param int $role 角色ID
     * @param string $name controller
     */
    public function deleteAuthItemsByControllerName($role,$name)
    {    
        $role = UserMangerRole::model()->findAllByAttributes(array('parent_id'=>$role));
        foreach ($role as $key)
        {
            $AuthItems = UserMangerAuthItems::model()->findAllByAttributes(array('role_id'=>$key->id,'controller'=>md5($name)));
            foreach ($AuthItems as $val)
            {
                $this->deleteAuthItemsByControllerName($val->role_id, $name);
                $val->delete();
            }
        }
    }

    /**
     * 读取用户所有角色
     * 
     * @return object
     */
    protected function loadRoleModel()
    {
        static $cache = null;
        if($cache === null)
        {
            $criteria = new CDbCriteria();
            $criteria->with = array('roles','roles.authItemsBackend');
            $criteria->condition = 't.user_id = :uid';
            $criteria->params = array(':uid'=>Yii::app()->user->id);
            $cache = UserMangerAssign::model()->findAll($criteria);
        }
        return $cache;
    }
    
    /**
     * 检测用户是否存在角色
     * 
     * @return boolean
     */
    public function testAssign()
    {
        $count = UserMangerAssign::model()->countByAttributes(array('user_id'=>Yii::app()->user->id));
        if($count == 0)
            return false;
        else
            return true;
    }
    
    
}
