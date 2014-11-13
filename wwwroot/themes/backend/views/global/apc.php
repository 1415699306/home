<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'APC管理',
);
?>
<div class="inner">
    <table>
        <thead>
            <tr>
                <th width="10%">类型</th>
                <th width="60%">文件</th>
                <th width="10%">命中率</th>
                <th width="10%">写入时间</th>
                <th width="10%">内存占用</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($model['cache_list'] as $key):?>
        <tr>
            <td><?php echo $key['type'];?></td>
            <td><?php echo $key['filename'];?></td>
            <td><?php echo $key['num_hits'];?></td>
            <td><?php echo $key['mtime'];?></td>
            <td><?php echo ceil($key['mem_size']/1024);?>kb</td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>