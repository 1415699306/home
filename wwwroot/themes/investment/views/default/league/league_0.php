<div class='league' id='league'>
    <div class="content topbar">
        <h3><span><i></i><?php echo CHtml::encode($model['title_backgroud']);?><em></em></span></h3>
        <div class="description_train_image">
            <h3>项目服务</h3>
            <ul>
            <?php if(!empty($model['description_train_image'])):?>
            <?php foreach ($model['description_train_image'] as $train):?>
                <li><?php echo CHtml::image(InvestmentMod::getImage($train),$model['title_backgroud'],array('width'=>'177','height'=>'161'));?></li>
            <?php endforeach;?>
            <?php endif;?>
            </ul>
        </div>
        <div class="description_generalize_image">
            <h3>推广支持</h3>
            <ul>
            <?php if(!empty($model['description_generalize_image'])):?>
            <?php foreach ($model['description_generalize_image'] as $generalize):?>
                <li><?php echo CHtml::image(InvestmentMod::getImage($generalize),$model['title_backgroud'],array('width'=>'177','height'=>'161'));?></li>
            <?php endforeach;?>
            <?php endif;?>
            </ul>
        </div>
    </div>
</div>