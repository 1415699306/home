<?php
$this->breadcrumbs=array(
    '用户管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'user',
    '用户权限管理'
);
?>
<div class="inner" style="position:relative;"> 
    <?php if(Yii::app()->user->hasFlash('competence')):?>  
    <?php $this->renderPartial('ext.toastMessage.views.toastView',array('message'=>Yii::app()->user->getFlash('competence'),'type'=>'success', 'options'=>array('sticky'=>false, 'position'=>'top-right', 'stayTime'=>2000)),false,false);?>
 <?php endif;?>
    <h2>
        角色名称:<?php echo CHtml::encode($role->name);?>
        <?php echo UserMangerAuthItems::getParents($role->parent_id);?>
    </h2>
    <?php echo CHtml::form('','POST',array('id'=>'UserManger'));?>
    <div class="controller">
        <h3>前端权限(暂未启用)</h3>
        <div class="warp">
        <?php foreach($controllers["controllers"] as $controller):?>        
            <h5><?php echo UserMangerAuthItems::getControllerName($controller['name']);?></h5>
            <ul>
            <?php foreach($controller["actions"] as $action):?>               
                <li><?php echo UserMangerAuthItems::getControllerName($controller['name'],$action['name']);?></li>
            <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
        </div>
    </div>   
    <div class="controller">
        <h3>后端权限</h3>
        <div class="warp">
            <?php foreach($controllers["modules"]['backend']["controllers"] as $controller):?>  
                <?php $controllerName = strtolower($controller['name']);?>
                <h5><?php echo UserMangerAuthItems::getModuleName($controller['name']);?></h5>
                <ul>
                <?php foreach($controller["actions"] as $action):?>
                    <li>
                        <label><?php echo UserMangerAuthItems::getModuleName($controller['name'],$action['name']);?></label>
                        <?php if(UserMangerRole::checkAdmin()):?>
                        <?php echo CHtml::checkBox("{$controllerName}[{$action['name']}]",UserMangerAuthItems::checkBox($action,$AuthItems,$controller));?>
                        <?php else:?>
                            <?php echo CHtml::checkBox("{$controllerName}[{$action['name']}]",UserMangerAuthItems::checkBox($action,$AuthItems,$controller),array('disabled'=>UserMangerAuthItems::checkAction($controller['name'],$action['name'])));?>
                        <?php endif;?>
                    </li>
                <?php endforeach; ?>
                </ul>              
                <?php echo !empty($AuthItems['backend'][$controllerName]) ? CHtml::hiddenField("{$controllerName}[id]",$AuthItems['backend'][$controllerName]['id']) :'';?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php echo CHtml::submitButton('提交');?>
    <?php echo CHtml::form();?>
</div>
<style>
.inner .controller .warp{border: 1px solid #09C;padding: 5px;clear: both;overflow: hidden;margin-bottom: 5px;border-radius: 5px;}
.inner h2{border: 1px solid #09C;padding: 2px;margin-bottom: 8px;background: #DEEFFA;border-radius: 5px;}
.inner .controller h3{width: 100%;height: 18px;line-height: 18px;margin-bottom: 5px;clear: both;border-left:3px solid #c22417;padding:0 5px; color:#333333;font-weight: bold;text-shadow: 0px 1px 0px #e7e7e7;}
.inner .controller h5{width: 100%;height: 20px;line-height: 20px;font-size: 14px;clear: both;margin: 5px 0;font-weight: bold;margin-right: 5px;background: url(/themes/backend/images/admincp/icons-13x13.png) no-repeat;background-position: 0 -274px;text-indent: 1.4em;}
.inner .controller ul{width: 100%;border: 1px solid #ccc;clear: both;display: block;overflow: hidden;border-radius: 5px;}
.inner .controller ul li{float: left;margin: 0 5px;padding:5px;}
</style>