<?php echo CHtml::form();?>
<?php if(!empty($model['image'])):?>
<h3>图片类型</h3>
<table width="100%">
    <thead>
        <th width="25%">ID</th>
        <th width="25%">排名</th>
        <th width="25%">类型</th>
        <th width="25%">标题</th>
    </thead>
    <tbody>
        <?php foreach ($model['image'] as $key):?>
        <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo CHtml::textField("Trade[index][{$key['id']}]",$key['index']);?></td>
            <td><?php echo $key['type'] == '0' ? '文字' : '图片';?></td>
            <td><?php echo CHtml::encode($key['title']);?></td>
        </tr>
        <?php endforeach; ?>  

    </tbody>
</table>
<?php endif;?>
<?php if(!empty($model['text'])):?>
<h3>文字类型</h3>
<table width="100%">
    <thead>
        <th width="25%">ID</th>
        <th width="25%">排名</th>
        <th width="25%">类型</th>
        <th width="25%">标题</th>
    </thead>
    <tbody>
        <?php foreach ($model['text'] as $key):?>
        <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo CHtml::textField("Trade[text_index][{$key['id']}]",$key['text_index']);?></td>
            <td><?php echo $key['type'] == '0' ? '文字' : '图片';?></td>
            <td><?php echo CHtml::encode($key['title']);?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif;?>
<?php echo CHtml::submitButton('更新');?>
<?php echo CHtml::endForm();?>
