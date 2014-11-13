<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'系统日志',
);
?>
<div class="inner">
    <table class="items">
        <thead>
            <tr>
                <th width="5%">级别</th>
                <th>类型</th>
                <th>信息</th>
                <th width="6%">记录时间</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($model as $key=>$val): ?>
        <tr class="<?php echo $key%2 ?  'even' : 'odd' ;?>"><td><?php echo $val["level"];?></td><td><?php echo $val["category"];?></td><td><?php echo $val["message"];?></td><td><?php echo date('Y-m-d',$val["logtime"]);?></td></tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php $this->widget('CLinkPager', array(
    'pages' => $pages,
    'header'=>false,
    'cssFile'=>false,
)) ?>


</div>
<style>
table.items {background: white;border-collapse: collapse;width: 100%; border: 1px #D0E3EF solid;}
table.items th {padding: 8px 0;}
table.items th {color: white;background: #2366A8;text-align: center;color: #fff;}
table.items th, table.items td {font-size: 0.9em;border: 1px white solid;padding: 0.3em;}
table.items tr.odd {background: #E5F1F4;}
table.items tr.even {background: #F8F8F8;}
</style>