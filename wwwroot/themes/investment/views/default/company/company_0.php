<div class='company' id='company'>
    <div class="company_list">
        <div class="list">
            <div class="content">
                <h3><span><?php echo CHtml::encode($model['title_backgroud']);?><em></em></span></h3>
                <p><?php echo CHtml::encode($model['description_backgroud']);?></p>
            </div>
            <div class="content">
                <h3><span><?php echo CHtml::encode($model['title_brand']);?><em></em></span></h3>
                <p><?php echo CHtml::encode($model['description_Brand']);?></p>
            </div>
        </div>
        <div class="video">
            <?php $this->widget('ext.EjwPlayer.EjwPlayer',array(
                'width' => 320,
                'height' => 240,
                'title' => 'Video',
                'controls' => 'true',
                'fallback'=>'true',
                'primary'=>'flash',
                'playlist' => array(
                    array(
                        'sources' => array(
                            array('file' =>$model['video']),
                        )
                    ),
                ),
            )); ?>
            <p>通过视频可以了解更多</p>
        </div>
        <div class="company_image">
            <div class="content">
                <h3><span>荣誉资质证书<em></em></span></h3>
                <div style='background: #fff'>
                    <?php if(!empty($model['company_imgae'])):?>
                    <?php foreach($model['company_imgae'] as $img):?>
                    <?php echo CHtml::link(CHtml::image(InvestmentMod::getImage($img),'荣誉资质证书',array('width'=>'200','height'=>'170')),InvestmentMod::getImage($img,false),array('title'=>'荣誉资质证书','class'=>'grouped_elements','rel'=>'group1','target'=>'_blank'));?>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
