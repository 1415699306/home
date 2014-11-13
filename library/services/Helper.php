<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 * 助手类
 * @author Administrator
 */
class Helper {
    
   /**
    * 字符串截取
    * 
    * @param type $string
    * @param type $length
    * @param type $etc
    * @return type string
    */
    public static function truncate_utf8($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
            {
            if($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return trim($result);
    }
    
    /**
     * 获取当前用户IP
     * 
     * @return type 
     */
    public static function getIp() {
        if (isset ( $_SERVER )) {
            if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
                $aIps = explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] );
                foreach ( $aIps as $sIp ) {
                    $sIp = trim ( $sIp );
                    if ($sIp != 'unknown') {
                        $sRealIp = $sIp;
                        break;
                    }
                }
            } elseif (isset ( $_SERVER ['HTTP_CLIENT_IP'] )) {
                $sRealIp = $_SERVER ['HTTP_CLIENT_IP'];
            } else {
                if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
                    $sRealIp = $_SERVER ['REMOTE_ADDR'];
                } else {
                    $sRealIp = '0.0.0.0';
                }
            }
        } else {
            if (getenv ( 'HTTP_X_FORWARDED_FOR' )) {
                $sRealIp = getenv ( 'HTTP_X_FORWARDED_FOR' );
            } elseif (getenv ( 'HTTP_CLIENT_IP' )) {
                $sRealIp = getenv ( 'HTTP_CLIENT_IP' );
            } else {
                $sRealIp = getenv ( 'REMOTE_ADDR' );
            }
        }
        return $sRealIp;
    }
    
   /**
    * 显示一个简单的对话框
    *
    * @parem $title 标题
    * @parem $msg 消息
    * @parem $gourl 跳转网址（其中 javascript:; 或 空 表示不跳转）
    * @parem $limittime 跳转时间
    * @parem $type 0警告 1成功 2失败
    * @return void
    */
    public static function showMsg($title, $msg, $gourl='', $limittime=5000, $type = 0)
    {
        Yii::app()->controller->layout = false;
		Yii::app()->getClientScript()->registerCoreScript('jquery');
        if(empty($title))$title = '系统提示信息';
        $jumpmsg = $jstmp = '';
        //返回上一页
        $gourl=='-1'   && $gourl = "javascript:history.go(-1);";
        $gourl=='-url' && $gourl = empty($_SERVER["HTTP_REFERER"]) ? "javascript:history.go(-1);" : $_SERVER['HTTP_REFERER'];

        if($gourl == 'close')
        {
            $limittime = empty($limittime) ? '1500' : $limittime; //窗口关闭时间强制默认1.5s
            $jumpmsg = "<div class='ct2'><a href='{$gourl}' onclick='CloseBox()'>窗口将于".ceil($limittime / 1000)."秒后关闭, 点此立即关闭...</a></div>";
            $jstmp = "setTimeout('CloseBox()', {$limittime});";

        }
        elseif ( $gourl != '' )
        {
            $limittime === 0 && exit(header("Location: $gourl"));
            $jumpmsg = "<div class='ct2'><a href='{$gourl}'>如果你的浏览器没反应，请点击这里...</a></div>";
            $jstmp = "setTimeout('JumpUrl()', {$limittime});";
        }

        $type_arr = array('remain','success','error');
        $type = empty($type_arr[$type]) ? 'remain' : $type_arr[$type];
        Yii::app()->controller->render(THEME_PATH.'.public.showMsg',array(
            'type'=>$type,
            'title'=>$title,
            'msg'=>$msg,
            'gourl'=>$gourl,
            'jumpmsg'=>$jumpmsg,
            'jstmp'=>$jstmp,
        ));
        Yii::app()->end();
    }
    
    /**
     * 全角转半角
     * 
     * @param type $str
     * @return type 
     */
    public static function make_semiangle($str)   
    {   
         $arr = array(
             '０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',   
              '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',   
              'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',   
              'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',   
              'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',   
              'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',   
              'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',   
              'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',   
              'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',   
              'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',   
              'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',   
              'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',   
              'ｙ' => 'y', 'ｚ' => 'z',   
              '（' => '(', '）' => ')', '〔' => '[', '〕' => ']', '【' => '[',   
              '】' => ']', '〖' => '[', '〗' => ']', '“' => '[', '”' => ']',   
              '‘' => '[', '’' => ']', '｛' => '{', '｝' => '}', '《' => '<',   
              '》' => '>',   
              '％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-',   
              '：' => ':', '。' => '.', '、' => ',', '，' => ',', '、' => '.',   
              '；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|',   
              '”' => '"', '’' => '`', '‘' => '`', '｜' => '|', '〃' => '"',   
              '　' => ' ','＄'=>'$','＠'=>'@','＃'=>'#','＾'=>'^','＆'=>'&','＊'=>'*',
              '＂'=>'"'
             );
         return strtr($str, $arr);   
    }
    
    /**
     * @method计算当天剩余时间
     *
     * @return int 当天剩余时间
     */
    public static function remainingTime()
    {
        return (strtotime(date("Y-m-d 23:59:59"))-time());
    }     
    
    /**
     * 把[]的字符串替换为换行<p>标签
     * @param type $string
     * @return type
     */
    public static function stringToP($string)
    {
        return str_replace(array('[',']'),array('<p>','</p>'), $string);
    }
    
    public static function time_tran($the_time)
    {
        $now_time = strtotime(date("Y-m-d H:i:s",time()));
        $show_time = $the_time;
        $dur = $now_time - $show_time;
        if($dur < 0){       
            return date('m-d',$the_time);
        }else{
            if($dur < 60){
                return $dur.'秒前';
            }else{
                if($dur < 3600){
                    return floor($dur/60).'分钟前';
                }else{
                    if($dur < 86400){
                        return floor($dur/3600).'小时前';
                    }else{
                        if($dur < 259200){
                            return floor($dur/86400).'天前';
                        }else{
                            return date('m-d',$the_time);
                        }
                    }
                }
            }
        }
    }
    
    public static function getOrderNumber()
    {
        return (date('ymd').substr(microtime(),-5).str_pad(mt_rand(1,99999),5,'0',STR_PAD_LEFT));
    }
    
    public static function getFileDir($path)
    {
        $resault = array();
        $handle = opendir($path);
            while (false !== ($file = readdir($handle))) 
            {                    
                if ($file != "."&&$file != "..")
                {
                    $i=0;
                    $resault[] = $file;
                    ++$i;
                }                    
            }
            closedir($handle);
            return $resault;
    }
    
    public static function getCategoryParem($name)
    {
        $xml = simplexml_load_file(BACK_PATH.DIRECTORY_SEPARATOR.'xml'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'category.xml');
        if(isset($xml->$name))
            return $xml->$name;
    }
}
