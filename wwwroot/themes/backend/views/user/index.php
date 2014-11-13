<?php
$this->breadcrumbs=array(
	'用户管理'
);
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    if($('#User_username').val()==''){
        $('#User_username').next('span.error').show();
        $('#User_username').next('span.error').text('用户名称不能为空!');
        return false;
    }else{
        $('#User_username').next('span.error').hide();
    }
    $('#user-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
");
?>
<div class="inner"> 
    <?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
    <div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array('model'=>$model,)); ?>
    </div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->Search(),
        'id'=>'user-grid',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'username',
            'email',
            'status'=>array(
                'name'=>'status',
                'value'=>'$data->status == "0" ? "审核中" : $data->status == "-1" ? "黑名单" : "正常"'
            ),
            'register_time'=>array(
                'name'=>'register_time',
                'value'=>'date("Y-m-d",$data->register_time)',
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
                'template'=>'{view}{pass}{filter}{relieve}',
                'buttons'=>array(
                    'pass'=>array(
                        'label'=>'审核用户',
                        'url'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/user/audit",array("id"=>$data->id,"type"=>1))',
                        'imageUrl'=>'/themes/backend/images/admincp/save.png',
                        'visible'=>'$data->id > "1" && $data->status == "0"',
                        'click'=>'js:function(){if(confirm("确定要通过审核吗?")){
                            var link = $(this).attr("href");
                            $.ajax({
                                type: "GET",
                                url: link,
                                dataType: "json",
                                success:function(data){
                                    if(data.code =="1"){
                                        $("#user-grid").yiiGridView("update", {
                                            data: $(this).serialize()
                                        });
                                    }else{
                                        alert(code.msg);
                                    }
                                }
                              });
                        }return false;}',
                    ),
                    'filter'=>array(
                        'label'=>'黑名单',
                        'url'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/user/audit",array("id"=>$data->id,"type"=>"-1"))',
                        'imageUrl'=>'/themes/backend/images/admincp/delete.png',
                        'visible'=>'$data->id > "1"  && $data->status == "1"',
                        'click'=>'js:function(){if(confirm("确定要将用户拉入黑名吗?")){
                           var link = $(this).attr("href");
                            $.ajax({
                                type: "GET",
                                url: link,
                                dataType: "json",
                                success:function(data){
                                    if(data.code =="1"){
                                        $("#user-grid").yiiGridView("update", {
                                            data: $(this).serialize()
                                        });
                                    }else{
                                        alert(code.msg);
                                    }
                                }
                              });
                            }return false;}'
                    ),
                    'relieve'=>array(
                        'label'=>'解除黑单',
                        'url'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/user/audit",array("id"=>$data->id,"type"=>"1"))',
                        'imageUrl'=>'/themes/backend/images/admincp/newwin.gif',
                        'visible'=>'$data->id > "1"  && $data->status == "-1"',
                        'click'=>'js:function(){if(confirm("确定要将用户解除黑名吗?")){
                           var link = $(this).attr("href");
                            $.ajax({
                                type: "GET",
                                url: link,
                                dataType: "json",
                                success:function(data){
                                    if(data.code =="1"){
                                        $("#user-grid").yiiGridView("update", {
                                            data: $(this).serialize()
                                        });
                                    }else{
                                        alert(code.msg);
                                    }
                                }
                              });
                            }return false;}'
                    ),
                ),
            ),
        ),
    ));
    ?>      
</div>