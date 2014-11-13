<?php $this->pageTitle=Yii::app()->name.'_中国领先的企业家门户平台'?>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'head');?>
<?php 
$js = Yii::app()->getClientScript();
$js->registerCoreScript('jquery');
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/search.css');
?>
<body>
<div class='search'>
    <div class='searchBox'>
        <?php echo CHtml::form('/search/index','GET');?>
        <div class='search_form'>
            <label>输入关键字</label>
            <div class='select'>
                <span>网页</span>
            </div>
            <?php echo CHtml::textField('q',isset($_GET['q'])?$_GET['q']:'',array('class'=>'checkbox serach')); ?>
            <?php echo CHtml::submitButton('搜索',array('class'=>'searchbtn')); ?>
           </div>
        <div class='hotsearch'>
            <span>推荐：</span>
            <?php foreach($hot as $key):?>
            <?php echo CHtml::link($key['name'],$this->createUrl('/search/index',array('q'=>$key['name'])));?>
            <?php endforeach;?>
        </div>
    </div>
    <?php CHtml::endForm(); ?>
    <div class='Result'>
        <div class='Result_co'>
            <p>搜索<i class="sousuo"><?php echo isset($_GET['q'])?$_GET['q']:'请输入关键字';?></i>获得约 <?php echo $count;?> 条结果，以下是第 <?php echo $pages->currentPage == 0 ? '1' : $pages->currentPage+$pages->getOffset();?>-<?php echo ($pages->getLimit()* ($pages->currentPage+1));?> 条。</p>
        </div>
        <div class='container_l'>
            <ul>
                <?php if(empty($res)):?>
                    <li>暂无数据</li>
                <?php endif;?>
                <?php foreach($res as $val):?>
                <li>
                    <div class='LeftPic'></div>
                    <div class='RightCon'>
                        <h2>[<?php echo $val['category_name'];?>]<span class="LeftPic"></span><?php echo CHtml::link($val['title_replace'],$this->createUrl("/{$val['url']}/list/view",array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h2>
                        <em>来源：<?php echo CHtml::encode(empty($val['source'])?$val['source']:'暂无数据');?> 日期<?php echo Helper::time_tran($val['ctime']);?></em>
                      <p><?php echo $val['discription'];?></p>
                    </div>
                </li>
                <?php endforeach;?>
         <?php $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'header'=>false,
                )) ?>
        </div>
    </div>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'footer');?>
<script>
jQuery(function($){
    $('#q').click(function(){
        $(this).val('');
    });
});
</script>
<style>
    .news{color:red;}
    </style>