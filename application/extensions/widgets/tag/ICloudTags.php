<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ICloudTags
 *
 * @author martin
 */
class ICloudTags extends CWidget{   
    public $app_id;
    public $title;
    public $html;
    public function run()
    {
        //$data = Yii::app()->redis->get(__CLASS__,$this->app_id,$this->app_id);
        $color = array('0'=>'#e82323','1'=>'#fea0a0','2'=>'#63acff','3'=>'#1aac4d','4'=>'#cf13c4','5'=>'#07c5ba','6'=>'#d57415','7'=>'#f1c017','8'=>"#967a1a",'9'=>'#09a171');
//        if($data === false)
//        {
        $sql = 'SELECT *,a.id AS aid,COUNT(DISTINCT(md5)) FROM `tags_relations` AS a,`tags` AS b WHERE a.app_id = :aid AND a.tag_id = b.id GROUP BY b.md5 ORDER BY RAND() LIMIT 30';
        $data = Yii::app()->db->createCommand($sql)->bindValue(':aid',$this->app_id)->queryAll(true);	
//            Yii::app()->redis->setex(__CLASS__,$this->app_id,$this->app_id,CJSON::encode($data),86400);
//        }
//        else
//        {
//            $data = CJSON::decode($data,true);
//        }
		$minfont = '11';    //最小字体
		$maxfont = '18';    //最大字体
		$this->html .=CHtml::tag('div',array('class'=>'content news'));
		$this->html .=CHtml::tag('h3').CHtml::tag('em').$this->title.CHtml::closeTag('em').CHtml::closeTag('h3');	
		$this->html .=CHtml::tag('div',array('class'=>'content suf-widget','id'=>'cloud_tag'));
		foreach ($data as $row){ //获得留言数最高的id，然后求平均值。最少留言自然是用最小字体。		
			$num_arr[] = $row['count'];
		}
		$max = max($num_arr);
		$min = min($num_arr);		
		$for_count = count($data);//获取循环总数			
		$everyfont = ceil($maxfont / $for_count);//从数组中获得不同的count数量，并找到+1的font-size
        $this->html .=CHtml::tag('ul');
		for ($i = 0; $i < $for_count; $i++){
			if ($data[$i]['count'] == $max){
				$randfontsize = $maxfont;
			}elseif ($data[$i]['count'] <= $min){
				$randfontsize = $minfont;
			} else {					
				//$randfontsize = ($maxfont - $everyfont - $i) <= $minfont ? $minfont : ($maxfont - $everyfont - $i);//根据概率自加
                $randfontsize = rand($minfont, $maxfont);
			}							
			$this->html .= CHtml::link($data[$i]['name'],Yii::app()->createUrl('/tag/list/',array('tag'=>$data[$i]['name'],'aid'=>$this->app_id,'act'=>$this->getOwner()->module->id)),array('target'=>'_blank','title'=>$data[$i]['name'],'style'=>$randfontsize > 11 ? 'font-size:'.$randfontsize.'pt;color:'.$color[rand(0,9)].';':'font-size:'.$randfontsize.'pt;'))."\n";
		}
                $this->html .=CHtml::closeTag('ul');
		$this->html .=CHtml::closeTag('div');
		$this->html .=CHtml::closeTag('div');    
        echo $this->html;
    }
}

