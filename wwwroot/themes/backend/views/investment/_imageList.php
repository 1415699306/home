<?php 
$js = Yii::app()->getClientScript();
$js->registerCss('#image','.img_warp{clear:both;padding:5px;}.img_warp h6{margin-bottom:5px;border-bottom:1px dotted #ccc;}.listImg{width:120px;float:left;text-align: center;}.listImg img{width:100px; height:60px;border:1px solid #ccc;padding:1px;}span.delete{cursor: pointer;}');
?>
<?php if(!empty($params)):?>
    <?php $keys = array_keys($params);?>
    <?php foreach(Investment::getImageProperty($keys['0']) as $key=>$list):?>
        <?php if(isset($params[$keys['0']][$list])):?>
            <div class="img_warp">
            <h6>过往文件</h6>
            <?php foreach($params[$keys['0']][$list] as $v):?>
            <?php if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.$v)):?>
            <div class="listImg test_<?php echo $key;?>">           
                <?php echo CHtml::image(InvestmentMod::getImage($v),$keys['0']);?>
                <?php if(!empty($params[$keys[0]][$list.'_name'][$key])):?>
                <?php echo CHtml::textField(ucfirst($keys['0']).'['.$list.'_name][]',$params[$keys[0]][$list.'_name'][$key]);?>
                <?php endif;?>
                <span class="delete" url="<?php echo DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.$v;?>">删除</span>
                <input type="hidden" name="<?php echo ucfirst($keys['0']);?>[<?php echo $list;?>][]" value='<?php echo $v;?>' />
            </div>
            <?php endif;?>
            <?php endforeach;?>   
            </div>
        <?php endif;?>
    <?php endforeach;?>
<?php endif;?>