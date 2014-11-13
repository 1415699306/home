<div class='introduction' id='introduction'>
    <div class="content topbar">
        <h3><span><i></i><?php echo CHtml::encode($model['title_qualification']);?><em></em></span></h3>
        <div class="description">
            <h3></h3>
            <div class="content">                
                <?php echo Helper::stringToP(CHtml::encode($model['description_qualification']));?>
            </div>
        </div>
        <div class="image">
            <ul>
                <?php if(!empty($model['introduction_image'])):?>
                <?php static $i=0;?>
                <?php foreach($model['introduction_image'] as $img):?>
                    <li <?php echo $i < 3 ? 'style="padding-right:39px!important;padding-right:37px;"': ''?>>
                        <?php echo CHtml::image(InvestmentMod::getImage($img),$model['title_qualification'],array('width'=>'290','height'=>'190'));?>
                        <?php echo $i < 3 ? '<em></em>': '';?>
                    </li>
                    <?php $i < 3 ? ++$i : $i=-1;?>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
    </div>
</div>