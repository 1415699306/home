<div class="advantage" id="0">
    <h3>项目优势模块</h3>
    <span><?php echo CHtml::link('添加一组','javascript:void(0);',array('id'=>'advantage_add'));?></span>
    <?php if(empty($params)):?>
    <div class="row"><label>标题:</label><input name="Advantage[title][]" type="text" size="100" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
    <div class="row"><label>优势:</label><textarea style='float:left' name="Advantage[description][]" cols="50" rows="5" class="{required:true,messages:{required:'请输入内容'}}"></textarea><span style="float: left;color:#ccc;">每一行文字用半角[]符号括起来如:<br />[1、具有独立承担民事责任的能力；]<br />[2、具有良好的商业信誉和健全的财务会计制t度；]</span></div>
    <?php else:?>
        <?php if(!empty($params['advantage']['title'])):?>
        <?php foreach($params['advantage']['title'] as $key=>$val):?>
        <div class="row"><label>标题:</label><input value="<?php echo !empty($val)?$val:'';?>" name="Advantage[title][]" type="text" size="100" maxlength="1024"></div>
        <div class="row"><label>回答:</label><textarea style='float:left' name="Advantage[description][]" cols="50" rows="5"><?php echo !empty($params['advantage']['description'][$key])?$params['advantage']['description'][$key]:'';?></textarea><span style="float: left;color:#ccc;">每一行文字用半角[]符号括起来如:<br />[1、具有独立承担民事责任的能力；]<br />[2、具有良好的商业信誉和健全的财务会计制t度；]</span></div>
        <?php endforeach;?>
    <?php endif;?>
    <?php endif;?>
    <?php echo CHtml::hiddenField('Advantage[template_id]',0);?>
    <?php echo CHtml::hiddenField('Advantage[template_name]','advantage');?>
</div>
<script>
$('#advantage_add').click(function(){
    var that = $(this).parent().parent();
    var form = '<div class="row"><label>标题:</label><input name="Advantage[title][]" type="text" size="100" maxlength="1024" class={required:true,messages:{required:\'请输入内容\'}} /></div><div class="row"><label>优势:</label><textarea style="float:left;" name="Advantage[description][]" cols="50" rows="5" class={required:true,messages:{required:\'请输入内容\'}}></textarea><span style="float: left;color:#ccc">每一行文字用半角[]符号括起来如:<br />[1、具有独立承担民事责任的能力；]<br />[2、具有良好的商业信誉和健全的财务会计制t度；]</span></div>';
    that.append(form);
});
</script>