<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of quote
 *
 * @author martin
 */
class IPbulicCommant extends CWidget{
    
        public $id;
        public $app_id=0;
        
        public function init()
        {              
            if($this->app_id === 0 || $this->id ===0)return;
            $this->_registerCss();
            $this->_registerScript();
        }

        public function run()
        {
            echo '<div id="commant_body">';
            echo $this->_getCategory(0);
            echo '</div>';
            echo $this->_registerQuote();
        }
        
        private function _registerCss()
        {
            Yii::app()->getClientScript()->registerCss("#Commant","
                #PublicComment h3{margin-top: 10px;width:105px;height:105px;float:left;}
                #commant {border: 1px solid #ccc;padding: 5px;margin-bottom: 10px;border-radius: 5px;width: 96%;margin: 5px auto;}
                #commant .top_tow{background: #fff;}#commant .top_one{background: none repeat scroll 0 0 #FAFAFA;}#commant p{margin: 0;}
                #commant a{float: right;font-size: 12px;}#commant p em{font-size: 12px;color: #B2B2B2;float: left;text-indent: 0em;}
                #commant .quote_user{width: 25px;float: left;border: 1px solid #ccc;padding: 2px;margin: 3px 5px 5px 0;}#commant table img{float: left;border: 1px solid #ccc;padding: 2px;margin-right: 5px;margin-bottom: 5px;}
                .commant_quote{width: 97%;margin: 0 auto;float: left;margin-left: 12px;clear: both;overflow: hidden;display: block;padding: 5px;}          
                .commant_quote textarea {margin:10px 0 10px 0;padding:5px;font-size:14px;overflow: hidden;border: 1px solid #2C2C2C;width: 86.2%;height: 100px;border-radius: 5px;float: left;border: 1px solid #ccc;border: 2px solid #d4d9dd;-webkit-box-shadow: inset 0 3px 3px #ebebeb;box-shadow: inset 0 3px 3px #ebebeb;}
                .commant_quote .commant_btn {float: right;background:url('/images/view_icon.png') no-repeat;background-position:0 -331px;cursor: pointer;width: 100px;vertical-align: middle;display: inline-block;height: 28px;line-height: 19px;border-radius: 2px;text-align: center;-moz-user-select: none;-webkit-user-select: none;margin: 5px;}
            ");
        }
        
        private function _registerQuote()
        {
            $uid = Yii::app()->user->id;
            $action = '/api/public/commant';
            $html = CHtml::tag('div',array('class'=>'commant_quote'));
            $html .= CHtml::form($action,'POST',array('id'=>'PublicComment'));
            $html .= CHtml::tag('h3').CHtml::image("http://quanzi.lfeel.com/uc_server/avatar.php?uid={$uid}&amp;size=big",null,array('width'=>100,'height'=>100)).CHtml::closeTag('h3');
            $html .= CHtml::textArea('PublicComment[content]');
            $html .= CHtml::tag('div',array('class'=>'commant_smile')).CHtml::submitButton('',array('class'=>'commant_btn')).CHtml::closeTag('div');
            $html .= CHtml::endForm();
            $html .= CHtml::closeTag('div');
            return $html;
        }
        
        private function _registerScript()
        {
            $uid = Yii::app()->user->id;
            $token = Yii::app()->request->getCsrfToken();
            $js = Yii::app()->getClientScript();
            $js->registerScriptFile('/js/common.js');
            $js->registerScriptFile('/js/showMsg.js');
            $js->registerScript("#commant","               
                $('#PublicComment').submit(function(){
                    var content = $('#PublicComment_content').val();
                    var token = '{$token}';
                    var app = '{$this->app_id}';
                    var t = '{$this->id}';
                    var uid = '{$uid}';
                    var p = new showMsg.Person('showMsg','系统消息','350','100');
                    var login = new showMsg.Person('showMsg','登录','540','200','{$token}');
                    if(uid === ''){
                        login.beforce('loginForm','请先登录!');
                        return false;
                    }
                    if(content === ''){
                        p.beforce('confrimMsg','评论内容不能为空!');
                        return false;
                    }
                    $.ajax({
                       type: 'POST',
                       url: this.action,
                       dataType:'json',
                       data: 'content='+content+'&YII_CSRF_TOKEN='+token+'&t='+t+'&app='+app,
                       success: function(msg){
                             if(msg.code === '1'){
                                $('#PublicComment_content').val('');
                                p.beforce('confrimMsg','评论提交成功!审核后显示!');                         
                             }else if(msg.code === '-1'){
                                p.beforce('confrimMsg','提交失败');
                            }else if(msg.code === '-2'){
                                p.beforce('confrimMsg',msg.msg);
                            }
                       }
                    });
                    return false;
                });
                $('#commant_post').live('click',function(){
                    var p = new showMsg.Person('showMsg','回复评论','520','150','{$token}');
                    p.setId({$this->id});
                    p.setAppId({$this->app_id});
                    p.setParentId($(this).attr('pid'));
                    p.setUserAvatar('http://quanzi.lfeel.com/uc_server/avatar.php?uid={$uid}&amp;size=small');
                    p.beforce('commantPost','回复评论!');
                });
            ",  CClientScript::POS_READY);
        }

        private function _getCategory($key,$level=null)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'res_id=:res_id';
            $criteria->addCondition("parent_id=:pid");
            $criteria->addCondition('status=:status');
            $criteria->addCondition('app_id=:app_id');
            $criteria->params = array(':res_id'=>$this->id,'status'=>'1','pid'=>$key,'app_id'=>$this->app_id);
            $criteria->order = 't.id desc';
            $count=PublicComment::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=10;
            $pages->applyLimit($criteria);
            $row = PublicComment::model()->findAll($criteria);        

            $res = '';
            static $i = 0;
            $color_z = '';
            $zhiz = $i%2;
            ($zhiz == '1') ? $color_z ="class='top_one'": $color_z = "class='top_tow'";
             foreach($row as $keys)
             {
                 $res .='<div id="commant" '.$color_z.'>';
                 if($keys->parent_id ==0){
                    $res .= '<table width="100%" ><tbody><tr><td>'
                    .CHtml::tag('p').CHtml::tag('span').$this->_checkUser($keys->id)
                    .CHtml::closeTag('span')
                    .CHtml::image("http://quanzi.lfeel.com/uc_server/avatar.php?uid={$keys->user_id}&amp;size=small",$keys->username,array('class'=>'quote_user'))
                    .CHtml::tag('em').'<b>'.$keys->username.'</b>:'.date('Y-m-d',$keys->ctime).CHtml::closeTag('em').'<br />'
                    .$this->_faceicon($keys->content).CHtml::closeTag('p'); 
                    ++$i;
                 }else{
                    $res .= '<table width="100%" ><tbody><tr><td>'
                    .CHtml::tag('p').CHtml::tag('span').$this->_checkUser($keys->id)
                    .CHtml::closeTag('span')
                    .CHtml::image("http://quanzi.lfeel.com/uc_server/avatar.php?uid={$keys->user_id}&amp;size=small",$keys->username,array('class'=>'quote_user'))
                    .CHtml::tag('em').'<b>'.$keys->username.'</b>:'.date('Y-m-d',$keys->ctime).CHtml::closeTag('em').'<br />'
                    .$keys->content.CHtml::closeTag('p'); 
                    ++$i;
                 }
                $res .='</td></tr></tbody></table>';
                $res .= $this->_getCategory($keys->id,$level+1);  
                $res .='</div>';                                            
             }
              ++$i;
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                     'header'=>false,
                    'id'=>'commant_page',                   
                ));
             return $res;
        }
        
        
        private function _checkUser($id)
        {
            if(Yii::app()->user->isGuest)
                return CHtml::link('登录','javascript:void(0);',array('class'=>'login','id'=>'login'));
            else
                return CHtml::link('回复','javascript:void(0);',array('id'=>'commant_post','pid'=>$id));
        }
        
        private function _faceicon($string)
        {
            $str = preg_replace('/(\[smile\:(\d+)=?\])/i', '<img src = "/images/faceicon/$2.gif" />', $string);
            return preg_replace('/\[img\:[\"\']?([%+\*\w\/:\._-]+(?:jpg|gif|bmp|jpeg|png))\]/ism', '<img src="$1" />', $str);
        }
    
}
