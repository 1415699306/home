<?php
/**
* 加密算法，用的是base64加密，分别能加密和解密。通过传入$operation = true = 加密 false = 解密
* @para string $string 要加/解密的string
* @para string $operation 方法(个人觉得用boolean比较好) 
* @para string $key 用来加密的key
* 
* @return string
*/
final class AuthCode {
    
    public static function auth($string,$operation=true)
    {
        $key = md5('bbs13Abc24a9RKSx83FBAPAPx');
        $key_length = strlen($key);

        $string = $operation == false ? base64_decode($string) : substr(md5($string.$key), 0, 8).$string;
        $string_length = strlen($string);

        $rndkey = $box = array();
        $result = '';

        for($i = 0; $i <= 255; $i++) {
                $rndkey[$i] = ord($key[$i % $key_length]);
                $box[$i] = $i;
        }

        for($j = $i = 0; $i < 256; $i++) {
                $j = ($j + $box[$i] + $rndkey[$i]) % 256;
                $tmp = $box[$i];
                $box[$i] = $box[$j];
                $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
                $a = ($a + 1) % 256;
                $j = ($j + $box[$a]) % 256;
                $tmp = $box[$a];
                $box[$a] = $box[$j];
                $box[$j] = $tmp;
                $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == false) {
                if(substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
                        return substr($result, 8);
                } else {
                        return '';
                }
        } else {
                return str_replace('=', '', base64_encode($result));
        }
    }
}
