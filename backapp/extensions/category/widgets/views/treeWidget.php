
<div style="width: 260px;float: left;position: relative;z-index: 50;">
    <?php echo CHtml::listBox('editor_parentId','',array(),array('size'=>25,'style'=>'width:250px;','ondblclick'=>'editor_children(this.value)'))?>
</div>
<div class='tree_table'>
    <table style="padding:5px;width:400px;">
        <tr>
            <td valign="middle" width="60" style="border:1px solid #ccc;padding:0 5px;margin:5px;">
                <p><input type="button" value="<?php echo Yii::t('tree','更新')?>" onClick="return editor_load()"></p>
                <p><input type="button" value="<?php echo Yii::t('tree','向上移动')?>" onClick="return editor_moveup()"></p>
                <p><input type="button" value="<?php echo Yii::t('tree','向下移动')?>" onClick="return editor_movedown()"></p>
                <p><?php echo CHtml::button(Yii::t('tree','添加[根]'),array('id'=>'parent_create','onclick'=>'parent_create();')); ?></p>
            </td>
            <td style="padding:5px;">
                <div class="form">
                    <div class="row">
                        <?php echo Yii::t('tree','分类名称')?>：
                        <?php echo CHtml::textField('editor_name'); ?><br/>
                        <?php echo Yii::t('tree','分类索引')?>：
                        <?php echo CHtml::textField('category_name'); ?>
                        <?php echo CHtml::hiddenField('editor_id'); ?>
                        <?php echo CHtml::hiddenField('editor_originalParentId'); ?>
                    </div>
                    <div class="row">
                        <?php echo CHtml::button(Yii::t('tree','保存'),array('id'=>'editor_create','onclick'=>'editor_create();')); ?>
                        <?php echo CHtml::button(Yii::t('tree','取消'),array('id'=>'editor_cancel','onclick'=>'editor_cancel();','style'=>'display:none;')); ?>
                        <?php echo CHtml::button(Yii::t('tree','更新'),array('id'=>'editor_update','onclick'=>'editor_update();','style'=>'display:none;')); ?>
                        <?php echo CHtml::button(Yii::t('tree','删除'),array('id'=>'editor_delete','onclick'=>'editor_delete();','style'=>'display:none;')); ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="note">
    <h3>注意事项</h3>
        <p>1.根分类为顶级分类,关联于各个系统模块,操作请谨慎,除名字外,添加和删除都涉及系统代码,非程序员不建议对根进行操作！</p>
        <p>2.根分类不能移动到二级分类！</p>
        <p>3.增加二级分类，请先选择根分类后，填写分类名称，点击创建即可！</p>
        <p>4.更新，修改，移动二级分类，请先选择左栏二级分类名称后，点击相应操作即可！</p>
    </div>
</div>

<?php
$cs=Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
?>

</style>

<script type="text/javascript">
function editor_cancel() {
	$('#editor_id').val('');
	$('#editor_name').val('');
    $('#category_name').val('');
	$('#editor_originalParentId').val('');
	$('#editor_create').show(); $('#editor_create').attr('disblaed',false);
	$('#editor_update').hide();
	$('#editor_cancel').hide();
	$('#editor_delete').hide();
}

function editor_load() {
	if ($('#editor_parentId')[0].selectedIndex <= 0) {
		alert('<?php echo Yii::t('tree','Please choose the node')?>');
		return;
	}
	
	editor_cancel();//reset buttons

	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeLoad')?>",
		data: {'id':$('#editor_parentId').val(),'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
		dataType: 'json',
		success: function(data){
			$('#editor_id').val(data.id);
			$('#editor_originalParentId').val(data.parent_id);
			$('#editor_name').val(data.name);
                        $('#category_name').val(data.category_name);
			$('#editor_create').hide();
			$('#editor_update').show();
			$('#editor_cancel').show();
			$('#editor_delete').show();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
	});
}

function editor_children(parentId,selectId) {
	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeChildren')?>",
		data: {'parent_id':parentId,'select_id':selectId ? selectId : 0,'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
		success: function(returned){
			$('#editor_parentId').html(returned);
		}
	});
}

function parent_create(){
        name     = $('#editor_name').val();
        parent_id = $('#editor_parentId').val();
        category_name = $('#category_name').val();
	if($.trim(name) === ''){
		alert("<?php echo Yii::t('tree',"根分类名称不能为空!")?>");
		return;
	}else{
            $.ajax({
               type: "POST",
               url: "<?php echo $this->createUrl('treeCreateParent')?>",
               data: {'name':name,'parent_id':parent_id,'category_name':category_name,'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
               success: function(msg){
                 alert( "Data Saved: " + msg );
                 editor_children();
               }
            });
        }
        
}

function editor_children_parent(parentId) {
	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeChildrenParent')?>",
		data: {'parent_id':parentId,'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
		success: function(returned){
			$('#editor_parentId').html(returned);
		}
	});
}

function editor_create() {
	if($('#editor_parentId')[0].selectedIndex < 0){
		alert('<?php echo Yii::t('tree','主分类不能为空,请选择左边栏目的主分类!')?>');
		return;
	}
	parent_id = $('#editor_parentId').val();
	name     = $('#editor_name').val();
        category_name = $('#category_name').val();
	if($.trim(name) === ''){
		alert("<?php echo Yii::t('tree',"分类名称不能为空!")?>");
		return;
	}
	$('#editor_create').attr('disblaed',true);
	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeCreate')?>",
		data: {'parent_id':parent_id,'name':name,'category_name':category_name,'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
		success: function(){
			editor_children(parent_id);
			editor_cancel();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
	});
}

function editor_update() {
	id     = $('#editor_id').val();
	parent_id = $('#editor_parentId').val();
	name     = $('#editor_name').val();
        category_name = $('#category_name').val();
	if($.trim(name) === ''){
		alert("<?php echo Yii::t('tree',"分类名称不能为空!")?>");
		return false;
	}
	if (!parent_id) {
		parent_id = $('#editor_defaultParentId').val();
	}
	if (parent_id === id || !parent_id) {
		parent_id=$('#editor_originalParentId').val();
	}
	_data={};
	_data.id=id;
	_data.name=name;
	_data.parent_id=parent_id;
    _data.category_name=category_name;
    _data.YII_CSRF_TOKEN='<?php echo Yii::app()->request->getCsrfToken();?>';
	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeUpdate')?>",
		data: _data,
		success: function(){
			editor_children(parent_id,id);
			editor_cancel();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
	});
}

function editor_delete() {
    if(!confirm('<?php echo Yii::t('tree',"Are you sure you want to delete")?>')){
        return false;
    }
    $.ajax({
        url: "<?php echo $this->createUrl('treeDelete')?>",
        type: "POST",
        data: {'id':$('#editor_id').val(),'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
        success: function(){
            editor_cancel();
            editor_children($('#editor_defaultParentId').val());
        },
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
    });
}

function editor_moveup() {
	if ($('#editor_parentId')[0].selectedIndex <= 0) {
		alert('<?php echo Yii::t('tree','Please choose the node')?>');
		return;
	}
	
	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeMoveUp')?>",
		data: {'id':$('#editor_parentId').val(),'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
		success: function(){
            editor_children_parent($('#editor_parentId').val());
        },
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
	});
}


function editor_movedown() {
	if ($('#editor_parentId')[0].selectedIndex <= 0) {
		alert('<?php echo Yii::t('tree','Please choose the node')?>');
		return;
	}
	
	$.ajax({
		type: "POST",
		url: "<?php echo $this->createUrl('treeMoveDown')?>",
		data: {'id':$('#editor_parentId').val(),'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'},
		success: function(){
            editor_children_parent($('#editor_parentId').val());
        },
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
	});
}

$(document).ready(function(){
	editor_children(0);

});
</script>