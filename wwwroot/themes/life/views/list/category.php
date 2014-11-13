<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile('/js/kit/css.css');
$js->registerScriptFile('/js/kit/action/life.js',CClientScript::POS_END);
?>
<script type="text/javascript" src="/js/kit/kit.js"></script>
<!--[if IE]>
    <script src="/js/kit/ieFix.js"></script>
<![endif]-->
<script type="text/javascript" src="/js/kit/io.js"></script>
<script type="text/javascript" src="/js/kit/admin.js"></script>
<script type="text/javascript" src="/js/kit/waterfall.js"></script>
<script type="text/javascript" src="/js/kit/semitransparentloading.js"></script>
<div class="kitjs-waterfall-container" style="margin-top:10px;"></div>
<style>
.bg { background:url(/images/bg.jpg)}
</style>
<?php echo CHtml::hiddenField('cid',$id);?>