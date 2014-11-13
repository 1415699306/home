<div class='quote' id='quote'>
    <div class="content topbar">
        <h3><span><i></i>项目问答(加盟问答)<em></em></span></h3>
        <div class="content">
            <?php $i=0;?>
            <?php foreach($model['title'] as $key=>$title):?>
            <ul style="margin-left:<?php echo $i*20;?>px;width:<?php echo (1200-$i*20);?>px">
                <span>问题<?php echo $key+1;?></span>
                <li><?php echo $title;?></li>
                <p><?php echo $model['description'][$key];?></p>
            </ul>
             <?php  ++$i;?>
            <?php endforeach;?>
        </div>
    </div>
</div>