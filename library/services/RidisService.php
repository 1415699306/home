<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RidisService
 *
 * @author martin QQ 629881438
 */
class RidisService extends CComponent
{
    private $_redis;
    public $host = '127.0.0.1';
    public $port = '6379';
    
    /**
     * 构造函数,链接redis服务
     */
    public function init() 
    {
        $this->_redis = new Redis();
        $this->_redis->connect($this->host,$this->port); 
    }
    
    private function __clone(){}
    
    /**
     * 写入key 和 value（string值）
     * @param type $key
     * @param type $value
     * @return type
     */
    public function set($prefix,$app_id,$key,$value)
    {
        return $this->_redis->set($prefix.'_'.$app_id.'_'.$key,$value);
    }
    
    /**
     * 得到某个key的值（string值）
     * @param type $key
     * @return type
     */
    public function get($prefix,$app_id,$key)
    {
        return $this->_redis->get($prefix.'_'.$app_id.'_'.$key);
    }
    
    /**
     * 带生存时间的写入值
     */
    public function setex($prefix,$app_id,$key,$value,$time=3600)
    {
        return $this->_redis->setex($prefix.'_'.$app_id.'_'.$key, $time, $value);
    }
    
    /**
     * 判断是否重复的，写入值
     * @param type $key
     * @param type $value
     * @return type
     */
    public function setnx($prefix,$app_id,$key,$value)
    {
        return $this->_redis->setnx($prefix.'_'.$app_id.'_'.$key,$value);
    }
    
    /**
     * 删除指定key的值
     * 注意自行组装prefix,app_id和key的连接
     * $redis->delete('key1', 'key2');
     * $redis->delete(array('key3', 'key4', 'key5'));
     * @param strgin $name Description cache key
     * @return int 返回已经删除key的个数（长整数）
     */
    public function delete($key)
    {
        return $this->_redis->delete($key);
    }
    
    /**
     * 得到一个key的生存时间
     * @param type $key
     * @return type
     */
    public function ttl($prefix,$app_id,$key)
    {
        return $this->_redis->ttl($prefix.'_'.$app_id.'_'.$key);
    }
    
    /**
     * 移除生存时间到期的key如果key到期 true 如果不到期 false
     * @param type $key
     * @return type
     */
    public function persist($prefix,$app_id,$key)
    {
        return $this->_redis->ttl($prefix.'_'.$app_id.'_'.$key);
    }
    
    /**
     * 同时给多个key赋值
     * 注意自行组装prefix,app_id和key的连接
     * @param array $key
     */
    public function mset($key)
    {
        if(!is_array($key))
            return false;
        else
            return $this->_redis->mset($key);
    }
}
