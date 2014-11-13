<?php if(!empty($data->avatarImage->track_id)):?>
<ul>
    <li><?php echo CHtml::image($data->avatarImage->track_id,$data->name);?></li>
    <span><?php echo CHtml::checkBox('eminent',!$model->isNewRecord ? EminentRelation::setCheckBox($data->id,BaseApp::MEET,$model->id) : '0',array('value'=>$data->id));?><em><?php echo CHtml::encode($data->name);?></em></span>
</ul>
<?php endif;?>
