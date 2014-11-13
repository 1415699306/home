<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SphinxService
 *
 * @author Administrator
 */
class SphinxService {
    
    /**
     * 可选，为每一个全文检索字段设置权重，主要根据你在sql_query中定义的字段的顺序，Sphinx系统以后会调整，可以按字段名称来设定权重
     */
    public $widget = array(100,1);
    public $mode = SPH_MATCH_ALL;
    private $_total=0;
    private $_sphinx;
    
    
    public function __construct($server='localhost',$port='9312') 
    {
        $this->_sphinx = new SphinxClient();
        $this->_sphinx->SetServer($server,$port);
        $this->_sphinx->SetMatchMode($this->mode);
    }
    
    public function setWidget()
    {
        $this->_sphinx->SetWeights($this->widget);
    }
    
    /**
     * 设定过滤条件$attribute是属性名，相当于字段名（用SPH_MATCH_EXTENDED时），$value是值，$exclude是布尔型，当为true时，相当于$attribute!=$value，默认值是false
     * @param type $attribute
     * @param type $values
     * @param type $exclude
     */
    public function setFilter($attribute, $values, $exclude)
    {
        $this->_sphinx->SetFilter($attribute, $values, $exclude);
    }
    
    /**
     * 根据分组方法，匹配的记录集被分流到不同的组，每个组都记录着组的匹配记录数以及根据当前排序方法本组中的最佳匹配记录。
     * 最后的结果集包含各组的一个最佳匹配记录，和匹配数量以及分组函数值
     * 结果集分组可以采用任意一个排序语句，包括文档的属性以及sphinx的下面几个内部属性
     * @id--匹配文档ID
     * @weight, @rank, @relevance--匹配权重
     * @group--group by 函数值
     * @count--组内记录数量
     * $groupsort的默认排序方法是@group desc，就是按分组函数值大小倒序排列
     * 
     * @param type $attribute
     * @param type $func
     * @param type $groupsort
     */
    public function setGroupBy($attribute, $func, $groupsort)
    {
        $this->_sphinx->SetGroupBy($attribute, $func, $groupsort);
    }
    
    public function setSortMode($sortby)
    {
        $this->_sphinx->SetSortMode(SPH_SORT_EXTENDED, $sortby);
    }
    
    public function setGroupDistinct($distinct)
    {
        $this->_sphinx->SetGroupDistinct(SPH_SORT_EXTENDED,$distinct);
    }
    
    public function setLimits($start,$limit=20,$max=1000)
    {
        $this->_sphinx->SetLimits($start,$limit,$max);
    }
    
    public function query($q,$index='*')
    {
        $resault =  $this->_sphinx->Query($q,$index);
        
        $this->_total = $resault["total"];
        $return = $url = array();
        $i = 0;
        if(isset($resault["matches"]) && 0 < count($resault["matches"]))
        {
            foreach($resault["matches"] as $key=>$val)
            {
                $model = $this->_getTableName($val["attrs"]["app_id"]);
                $return[$model]['id'][$i] = $key;
                ++$i;
                    
                
            }
            return $return;
        }
        else
            return $return;
    }
    
    public function getTotal()
    {
        return $this->_total;
    }
    
    private function _getTableName($key)
    {
        return BaseApp::getModel($key);
    }
}
