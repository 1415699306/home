<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'MEMCACHE'
);
?>
<div class="inner">
<table>
    <tr><td>Memcache Server version:</td><td><?php echo $model["version"];?></td></tr>
    <tr><td>Process id of this server process </td><td><?php echo $model["pid"];?></td></tr>
    <tr><td>Number of seconds this server has been running </td><td><?php echo $model["uptime"];?></td></tr>
    <tr><td>Accumulated user time for this process </td><td><?php echo $model["rusage_user"];?>seconds</td></tr>
    <tr><td>Accumulated system time for this process </td><td><?php echo $model["rusage_system"];?>seconds</td></tr>
    <tr><td>Total number of items stored by this server ever since it started </td><td><?php echo $model["total_items"];?></td></tr>
    <tr><td>Number of open connections </td><td><?php echo $model["curr_connections"];?></td></tr>
    <tr><td>Total number of connections opened since the server started running </td><td><?php echo $model["total_connections"];?></td></tr>
    <tr><td>Number of connection structures allocated by the server </td><td><?php echo $model["connection_structures"];?></td></tr>
    <tr><td>Cumulative number of retrieval requests </td><td><?php echo $model["cmd_get"];?></td></tr>
    <tr><td> Cumulative number of storage requests </td><td><?php echo $model["cmd_set"];?></td></tr>
    <?php $percCacheHit=((real)$model ["get_hits"]/ (real)$model ["cmd_get"] *100)?>;
    <?php $percCacheHit=round($percCacheHit,3); ?>
    <?php $percCacheMiss=100-$percCacheHit;?>
    <tr><td>Number of keys that have been requested and found present </td><td><?php echo $model["get_hits"];?>(<?php echo $percCacheHit?>%)</td></tr>
    <tr><td>Number of items that have been requested and not found </td><td><?php echo $model["get_misses"];?>(<?php echo $percCacheMiss?>%)</td></tr>
     <?php $MBRead= (real)$model["bytes_read"]/(1024*1024); ?>
    <tr><td>Total number of bytes read by this server from network </td><td><?php echo $MBRead;?>Mega Bytes</td></tr>
     <?php $MBWrite=(real) $model["bytes_written"]/(1024*1024) ;  ?>
    <tr><td>Total number of bytes sent by this server to network </td><td><?php echo $MBWrite;?>Mega Bytes</td></tr>
    <?php $MBSize=(real) $model["limit_maxbytes"]/(1024*1024) ;  ?>
    <tr><td>Number of bytes this server is allowed to use for storage.</td><td><?php echo $MBSize;?> Mega Bytes</td></tr>
    <tr><td>Number of valid items removed from cache to free memory for new items.</td><td><?php echo $model['evictions'];?></td></tr>
</table>
</div>