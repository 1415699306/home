<?php $this->breadcrumbs=array('名人绘');Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>
<div class="celebrity_warp"> 		
    <div class="content_left">
        <?php $this->widget('ext.widgets.slide.ISlideWidget',array('app_id'=>BaseApp::CELEBRITY,'res_id'=>54,'type'=>1,'width'=>924,'height'=>300));?> 
        <div class="content">
            <h3><span><?php echo CHtml::link('查看全部',$this->createUrl('/celebrity/list/category',array('id'=>33)),array('target'=>'_blank'));?></span><em>问策直通</em></h3>
            <div class="interview">
                <?php foreach($interview as $key):?>
                <ul>
                    <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'celebrity','16_9','thumb'),$key['title'],array('width'=>211,'height'=>120)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></li>
                    <p><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],12)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
                </ul>
                <?php endforeach;?>
            </div>
            <div class="list">
                <?php $i=0;?>                
                <?php foreach($leftList as $key):?>
                <?php echo $i==0 ? '<ul>':''?>
                    <li><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($key['title']),14),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></li>                
                <?php echo $i == 2 ? '</ul>' : '';?>
                <?php $i<2 ? ++$i : $i=0;?>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="content">
            <h3><span><?php echo CHtml::link('查看全部',$this->createUrl('/celebrity/list/category',array('id'=>49)),array('target'=>'_blank'));?></span><em>商界精英</em></h3>
            <div class="img_list">
                <?php foreach($leftElite as $key):?>
                <div class="img_list_body">
                    <h2><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'celebrity','4_3','thumb'),$key['title'],array('width'=>90,'height'=>80)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></h2>
                    <h5><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],12)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></h5>
                    <p><?php echo CHtml::decode($key['discription']);?></p>
                    <span><?php echo CHtml::link('浏览全文»',$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></span>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="content">
            <h3><span><?php echo CHtml::link('查看全部',$this->createUrl('/celebrity/list/category',array('id'=>50)),array('target'=>'_blank'));?></span><em>专家学者</em></h3>
            <div class="img_list">
                <?php foreach($leftScholar as $key):?>
                <div class="img_list_body">
                    <h2><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'celebrity','4_3','thumb'),$key['title'],array('width'=>90,'height'=>80)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></h2>
                    <h5><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],12)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></h5>
                    <p><?php echo CHtml::decode($key['discription']);?></p>
                    <span><?php echo CHtml::link('浏览全文»',$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></span>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <div class="content_right">
        <div class="content">
                <h3><span><?php echo CHtml::link('更多',$this->createUrl('/celebrity/list/category',array('id'=>55)),array('target'=>'_blank'));?></span><em>访谈预告</em></h3>
                <div class="img_list">
                    <h2><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($interviewRecommand['track_id'],'celebrity','16_9','thumb'),$interviewRecommand['title'],array('width'=>280,'height'=>160)),$this->createUrl('/celebrity/list/view',array('id'=>$interviewRecommand['aid'])),array('target'=>'_blank'));?></h2>
                    <p>时间：<?php echo date('Y-m-d H:i:s',$interviewRecommand['interview_time']);?></p>
                    <p>嘉宾：<?php echo !empty($interviewRecommand['guests'])?CHtml::encode($interviewRecommand['guests']):'暂无信息';?></p>
                    <p>简价：<?php echo CHtml::encode($interviewRecommand['discription']);?></p>
                </div>
        </div>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::CELEBRITY,'res_id'=>61,'type'=>1,'width'=>312));?>
        <?php $this->widget('ext.widgets.rightlist.ISimplelist',array('title'=>'访谈语录','model'=>'Celebrity','category_id'=>59));?>
        <?php $this->widget('ext.widgets.rightlist.ISimplelist',array('title'=>'乐荟推荐','model'=>'Celebrity','category_id'=>51));?>
        <?php $this->widget('ext.widgets.rightlist.ISimplelist',array('title'=>'人物故事','model'=>'Celebrity','category_id'=>57));?>
    </div>
</div>