<div class="quote" id="0">
    <h3>问答模块</h3>
    <div class="quote_add">
        <span><?php echo CHtml::link('添加一组','javascript:void(0);',array('id'=>'quote_add'));?></span>
        <?php if(empty($params)):?>
        <div class="row"><label>问题:</label><input name="Quote[title][]" type="text" size="100" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
        <div class="row"><label>回答:</label><textarea name="Quote[description][]" cols="50" rows="5" class="{required:true,messages:{required:'请输入内容'}}"></textarea></div>
        <?php else:?>
            <?php if(!empty($params['quote']['title'])):?>
            <?php foreach($params['quote']['title'] as $key=>$val):?>
                <div class="row"><label>问题:</label><input value="<?php echo !empty($val)?$val:'';?>" name="Quote[title][]" type="text" size="100" maxlength="1024"></div>
                <div class="row"><label>回答:</label><textarea name="Quote[description][]" cols="50" rows="5"><?php echo !empty($params['quote']['description'][$key])?$params['quote']['description'][$key]:'';?></textarea></div>
            <?php endforeach;?>
            <?php endif;?>
        <?php endif;?>
    </div>
    <?php echo CHtml::hiddenField('Quote[template_id]',0);?>
    <?php echo CHtml::hiddenField('Quote[template_name]','quote');?>
</div>
<script>
$('#quote_add').click(function(){
    var that = $(this).parent().parent();
    var form = '<div class="row"><label>问题:</label><input name="Quote[title][]" type="text" size="100" maxlength="1024"></div><div class="row"><label>回答:</label><textarea name="Quote[description][]" cols="50" rows="5"></textarea></div>';
    that.after(form);
});
</script>