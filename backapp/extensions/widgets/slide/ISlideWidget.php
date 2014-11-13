<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ISlideWidget
 *
 * @author martin
 */
class ISlideWidget extends CWidget{
    
    public $res_id = 0;
    public $app_id = 0;
    public $type = 0;
    /*播放时间*/
    public $delayTime = 300;
    /*目录*/
    public $folder = 'slide';
    public $debug = false;
    public $width = 820;
    public $height = 400;
    private $_html;
    private $_assetsUrl;
    private $_ready = true;
    public function init()
    {
        $this->_html = $this->_getHtml();
        $model = $this->_loadModel();
        $this->_registerScript($model);       
    }
    
    private function _loadModel()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 't.res_id =:rid';
        $criteria->addCondition('t.app_id=:aid');
        $criteria->addCondition('off_time > :time');
        $criteria->addCondition('status = 0');
        $criteria->params = array(':rid'=>(int)$this->res_id,':aid'=>(int)$this->app_id,':time'=>(time()-86400));
        $criteria->order = 't.id desc';
        $model = Slide::model()->with('thumbs')->findAll($criteria);
        if(empty($model))
            $this->_ready = false;
        else
            return $model;
    }
    
    private function _registerScript($model)
    {
        $params = $min = array();
        if($this->_ready == true)
        {
            $js = Yii::app()->getClientScript();
            $assetsUrl = $this->_getAssetsUrl();
            $js->registerCssFile($assetsUrl.DIRECTORY_SEPARATOR.$this->_getCss());
            $js->registerScriptFile($assetsUrl.DIRECTORY_SEPARATOR.'slide.js',  CClientScript::POS_HEAD);
            $i = 0;
            foreach ($model as $key)
            {
                $thumb = $key->thumbs->track_id;
                $params[$i]['name'] = $key->name;
                $params[$i]['link'] = $key->link;
                $params[$i]['discription'] = $key->discription;
                $params[$i]['thumb'] = '/'.RESOURCE.'/slide/thumb/'.$thumb;
                $params[$i]['thumb_min'] = Storage::getImageBySize($thumb,$this->folder,'16_9','thumb');
                ++$i;
            }
            $json = CJSON::encode($params);
            $this->_getJavaScript($json);
            
        }
    }
        
    /**
     * big slide 
     * @param type $json
     */
    private function _bigSlide($json)
    {
        $js = Yii::app()->getClientScript();
        $js->registerScript("#{$this->id}","
            var focus_pic_list;
            var focus_smaillPic_list;
            var focus_content_list;
            var data = {$json};
            var len = data.length;
            var perse = len < 3 ? len : 3;
            for(var i=0;i<len;++i){
                focus_pic_list = '<li style=display: none;><a href='+data[i].link+' target=_blank><img src='+data[i].thumb+' /></a></li>';
                focus_smaillPic_list = '<li style=\"float: left; width: 58px;\"><a><img src='+data[i].thumb_min+' /><span class=cover></span></a><b>▲</b></li>';
                focus_content_list = '<li style=display: none;><h2><a href='+data[i].link+'>'+data[i].name+'</a></h2><div>'+data[i].discription+'</div></li>';
                $('#focus_pic_list').append(focus_pic_list);
                $('#focus_smaillPic_list').append(focus_smaillPic_list);
                $('#focus_content_list').append(focus_content_list);
            }
            jQuery('.slide').slide({ 
                titCell:'.focus_nav li',
                mainCell:'.focus_pic', 
                targetCell:'.focus_text li',
                autoPlay:true,delayTime:{$this->delayTime},
                startFun:function(i){
                    if(i==0){ 
                        jQuery('.slide .navPrev').click() 
                    } else if( i%perse==0 ){ 
                        jQuery('.slide .navNext').click()
                    }
                }
            });
            jQuery('.slide').slide({ 
                mainCell:'.focus_nav ul',
                prevCell:'.navPrev',
                nextCell:'.navNext',
                effect:'left',
                vis:perse,
                scroll:perse,
                delayTime:0,
                autoPage:true,
                pnLoop:false
            });
    ",  CClientScript::POS_END);
    }
    
    /**
     * min slide
     * @param type $json
     * @return type
     */
    private function _minSlide($json)
    {
        $js = Yii::app()->getClientScript();
        return $js->registerScript("#{$this->id}","           
            var data = {$json};
            var len = data.length;
            var number = '';
            var images = '';
            for(var i=0;i<len;++i){
                number += '<li>'+(i+1)+'</li>';
                images += '<li><a href='+data[i].link+' target=_blank><img src='+data[i].thumb+' /></a></li>';
            }
            $('.slideBox .hd ul').append(number);
            $('.slideBox .bd ul').append(images);
            $('.slideBox, .slideBox img').css({'width':'{$this->width}px','height':'{$this->height}px'});
            jQuery('.slideBox').slide({mainCell:'.bd ul',autoPlay:true});
        ",  CClientScript::POS_END);
    }

    /**
     * loading javascript
     * @param type $json
     * @return type
     */
    private function _getJavaScript($json)
    {
        switch ($this->type)
        {
            case 0 : return  $this->_bigSlide($json);
            case 1 : return  $this->_minSlide($json);
        }
    }
    
    /**
     * loading background div
     * @return string div
     */
    private function _getHtml()
    {
        switch ($this->type)
        {
            case 0 : return '<div class="slide"><ul class="focus_pic" id="focus_pic_list"></ul><div class="focus_nav"><div class="tempWrap" style="overflow:hidden; position:relative; width:340px"><ul id="focus_smaillPic_list" style="width: 698px; position: relative; overflow: hidden; padding: 0px; margin: 0px; left: -340px;"></ul></div><a href="javascript:;" title="上一个" class="navPrev">上一个</a><a href="javascript:;" title="下一个" class="navNext nextStop">下一个</a></div><div class="focus_text"><ul id="focus_content_list"></ul></div></div>';
            case 1 : return '<div id="slideBox" class="slideBox"><div class="hd"><ul></ul></div><div class="bd"><ul></ul></div></div>';           
        }
    }
    
    /**
     * loading css file
     * @return string assets css file
     */
    private function _getCss()
    {
        switch ($this->type)
        {
            case 0 : return 'big.css';
            case 1 : return 'min.css';
        }
    }
    
    /**
	* Publishes the module assets path.
	* @return string the base URL that contains all published asset files of Advisory.
	*/
	private function _getAssetsUrl()
	{
		if( $this->_assetsUrl===null )
		{
			$assetsPath = Yii::getPathOfAlias('ext.widgets.slide.assets');

			// We need to republish the assets if debug mode is enabled.
			if( $this->debug===true )
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
			else
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
		}

		return $this->_assetsUrl;
	}
    
    public function run()
    {
        if($this->_ready===true)
            echo $this->_html;
    }
}
