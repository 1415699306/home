<?php $data = $_GET;?>
<div class="main">
    <div class="content">
        <div class="row">
            <label>订单号:</label><?php echo $data['out_trade_no'];?>
        </div>
        <div class="row">
           <label>产品:</label><?php echo $data['subject'];?>
        </div>
        <div class="row">
            <label>支付金额:</label><?php echo $data['total_fee'];?>元
        </div>
        <div class="row">
            <label>产品描述:</label><?php echo $data['body'];?>
        </div>
        <div class="row">
            <label>支付时间:</label><?php echo $data['notify_time'];?>
        </div>
        <div class="row">
            <?php if($data['trade_status'] == 'TRADE_FINISHED'||$data['trade_status']=='TRADE_SUCCESS'):?>
            <label>支付状态:</label>成功!
            <?php else:?>
            <label>支付状态:</label>失败!
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
.main .content{background: #fff;margin-top: 10px;padding: 10px;font-size: 14px;}
.main .content .row{margin-bottom: 5px;}
.main .content .row label{width: 80px; float: left; font-weight: bold;text-align: right;margin-right: 5px;}
</style>