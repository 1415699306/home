<?php

class avatarUpload extends CWidget{
    
    public $html;
    
    public function init(){      
        $url = Yii::app()->createUrl('/usercenter/flashUploadAvatar');
        $uid = Yii::app()->user->id;
        $old = User::model()->findByPk(Yii::app()->user->id)->userProfile->avatar;
        $this->html ='<div id="type_swf" class="object-upload">';
        $this->html.='<object id="JS_avatar_swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="450" height="340" style="visibility: visible;">';
        $this->html.='<param name="movie" value="/images/flash/avatar.swf?name=avatar&url='.$url.'&uid='.$uid.'&pic='.$old.'">';
        $this->html.='<param name="wmode" value="opaque">';
        $this->html.='<!--[if !IE]>-->';
        $this->html.='<object type="application/x-shockwave-flash" wmode="opaque" data="/images/flash/avatar.swf?name=avatar&url='.$url.'&uid='.$uid.'&pic='.$old.'" width="450" height="340">';
        $this->html.='<!--<![endif]-->';
        $this->html.='<div>';
        $this->html.='<h1>Alternative content</h1>';
        $this->html.='<p>';
        $this->html.='<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"></a>';
        $this->html.='</p>';
        $this->html.='</div>';
        $this->html.='<!--[if !IE]>-->';
        $this->html.='</object>';
        $this->html.='<!--<![endif]-->';
        $this->html.='</object>';
        $this->html.='</div>';
    }
    
    public function run(){
       echo $this->html;
    }
}