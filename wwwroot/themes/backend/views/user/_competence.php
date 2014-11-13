<div class="list">
    <h3>
        <span>
            <em style="color:#ccc;">关联用户:[<?php echo $data->assignCount;?>]名,创建:[<?php echo $data->user->username;?>]</em>
            <?php echo CHtml::link('删除',$this->createUrl('/backend/user/deleterole',array('id'=>$data->id)),array('id'=>'delete'));?>
            <?php echo CHtml::link(($data->user->id === Yii::app()->user->id ? '修改' : '查看'),$this->createUrl('/backend/user/authitem',array('id'=>$data->id)));?>
        </span>
            <?php echo CHtml::encode($data->name);?>
    </h3>
</div>

