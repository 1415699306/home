<div class='advantage' id='advantage'>
 <div class="content topbar">
        <h3><span><i></i>项目优势<em></em></span></h3>
        <div class="content"  style='margin-left:30px;'>            
            <?php foreach($model['description'] as $key=>$val):?>
            <div class="list">
            <h1><span></span><?php echo $key+1;?></h1>
            <ul>
                <h5><?php echo CHtml::encode($model["title"][$key]);?></h5>
                <li><?php echo Helper::stringToP(CHtml::encode($val));?></li>
            </ul>
            </div>
            <?php endforeach;?>            
        </div>
    </div>
</div>