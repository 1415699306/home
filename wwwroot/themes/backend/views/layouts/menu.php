<div id="cpmap_menu" class="custom" style="display: none">
  <div class="cside">
    <h3><span class="ctitle1">后台地图</span><a href="javascript:void(0);" onClick="$('#cpmap_menu').hide();" class="cadmin">关闭</a></h3>
    <ul class="cslist" id="custommenu">
        <h3>基本设置</h3>
        <li><?php echo CHtml::link('基本设置首页',$this->createUrl('/backend/global/index'));?></li>
        <li><?php echo CHtml::link('系统公告',$this->createUrl('/backend/global/announcement'));?></li>
        <li><?php echo CHtml::link('添加系统公告',$this->createUrl('/backend/global/announcementcreate'));?></li>
        <li><?php echo CHtml::link('系统分类管理',$this->createUrl('/backend/global/category'));?></li>
    </ul>
    <ul class="cslist" id="custommenu">
        <h3>文章管理</h3>
        <li><?php echo CHtml::link('文章管理首页',$this->createUrl('/backend/article/index'));?></li>
        <li><?php echo CHtml::link('添加文章',$this->createUrl('/backend/article/create'));?></li>
    </ul>
    <ul class="cslist" id="custommenu">
        <h3>用户管理</h3>
        <li><?php echo CHtml::link('用户管理首页',$this->createUrl('/backend/user/index'));?></li>
        <li><?php echo CHtml::link('角色权限管理',$this->createUrl('/backend/user/competence'));?></li>
    </ul>
    <ul class="cslist" id="custommenu">
        <h3>政企通管理</h3>
        <li><?php echo CHtml::link('政企通管理首页',$this->createUrl('/backend/investment/index'));?></li>
        <li><?php echo CHtml::link('添加/开发模式',$this->createUrl('/backend/investment/beforce',array('id'=>1)));?></li>
        <li><?php echo CHtml::link('添加/模板模式',$this->createUrl('/backend/investment/beforce',array('id'=>2)));?></li>
        <li><?php echo CHtml::link('政企通留言管理',$this->createUrl('/backend/investment/advisory'));?></li>
    </ul>
  </div>
  <div class="cmain" id="cmain">Powered By Martin</div>
  <div class="cfixbd"></div>
</div>