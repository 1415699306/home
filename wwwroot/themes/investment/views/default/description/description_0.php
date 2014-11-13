<div class='description' id='description'>
    <div class="content topbar">
    <h3><span><i></i><?php echo CHtml::encode($model['title_backgroud']);?><em></em></span></h3>
    <?php if(!empty($model['description_image'])):?>
        <?php foreach($model['description_image'] as $key=>$img):?>
        <ul>
            <li><?php echo CHtml::link(CHtml::image(InvestmentMod::getImage($img),$model['title_backgroud'],array('width'=>'226','height'=>'204')),InvestmentMod::getImage($img,false),array('title'=>!empty($model['description_image_name'][$key])?$model['description_image_name'][$key]:'','class'=>'grouped_elements','rel'=>'group2','target'=>'_blank'));?></li>
            <span><?php echo !empty($model['description_image_name'][$key])?$model['description_image_name'][$key]:'';?></span>
        </ul>
        <?php endforeach;?>
    <?php endif;?>
    </div>
</div>