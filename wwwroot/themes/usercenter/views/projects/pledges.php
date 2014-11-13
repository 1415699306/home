<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/pledges.css');
?>
<div class='RightDiv'>
    <div class='MainDiv' style="width:987px;">
        <div class='bigDiv borline'>
            <span class='Preview'><?php echo CHtml::link('预览',$this->createUrl('/dream/projects/view',array('id'=>$dream->id)),array('target'=>'_blank'));?></span>
            <div class='subtitle'><?php echo CHtml::encode($dream->title);?> / 项目管理</div>
            <h3>回报设置</h3>
            <h3>小提示</h3>
            <p>【3个以上的回报】多些选择能提高项目的支持率。</p>
            <p>【几十、几百、上千元的支持档位】3个不同的档次的回报，能让你的项目更快成功。</p>
            <p>【回报必须低于市价】给第一批支持者最好最优惠的回报，感谢他们的支持。</p>
            <p>【回报最好是项目的衍生品】，与项目内容有关的回报更能吸引大家的支持。</p>              
        </div>    
        <?php if(!empty($order)):?>
        <div class='BottomEnd'>
            <h5>回报项将会按照金额由低至高排列</h5>
            <div id="pledge_list" class="returnlist">
                <?php foreach($order as $key=>$val):?>               
                <?php if($val->id !=Yii::app()->request->getParam('pid',0)):?>    
                <ul class="<?php echo $key%2 ? '' : 'returnlistnormal';?>">
                    <li style="width:149px;font-weight:bold;font-size:14px;">&yen;<?php echo $val->money;?></li>
                    <li style="width:162px;"><?php echo 0 < $val->places ? "限额{$val->places}名" : '无';?></li>
                    <li style="width:342px;float:left; overflow:hidden;"><div class='tabText' style="padding:0 5px;"><?php echo CHtml::encode($val->discription);?></div></li>
                    <li style="width:200px;"><div class='tabText'>将提示支持者填写收货信息</div></li>
                    <li style="width:125px;border-right:none;"><?php echo CHtml::link('编辑',$this->createUrl('/usercenter/projects/pledges',array('id'=>$_GET['id'],'pid'=>$val->id,'#'=>'pledge_list')));?><a href="javascript:void(0);" id='deleteByOrder' pid='<?php echo $val->id;?>'>移除</a></li>
                </ul>
                <?php else:?>
                    <?php if(!$model->isNewRecord):?>
                        <div class='bigDiv' id="<?php echo $model->id;?>">
                        <?php  $this->renderPartial('webroot.themes.usercenter.views.projects._form._pledgesForm',array('model'=>$model));?>
                        </div>
                    <?php endif;?>
                <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <?php endif;?>
        <?php if($model->isNewRecord):?>
        <div class='bigDiv'>
            <div class='buttom Topbuttom'>
                <?php echo Chtml::link('上一页',$this->createUrl('/usercenter/projects/update',array('id'=>Yii::app()->request->getParam('id',0))),array('class'=>'pre'));?>
                <input type="submit"  value="添加新的回报" class="new" id="create"/>
                <?php echo Chtml::link('下一页',$this->createUrl('/usercenter/projects/submit',array('id'=>Yii::app()->request->getParam('id',0))),array('class'=>'fornext'));?>
            </div>
            <div class="form" style="display:none;">
                <?php  $this->renderPartial('webroot.themes.usercenter.views.projects._form._pledgesForm',array('model'=>$model));?>            
            </div>
        </div>
        <?php endif;?>
    </div>
</div>