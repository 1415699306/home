<?php
class DreamCommand extends CConsoleCommand {
    
    public $Action = 'index';
    const LASTIME = 15;
    const CARDINAL = 0.015;
    const DEVOTED = 100;

    public function actionIndex()
    {
        $this->_setOnline();
    }
    
    private function _setOnline()
    {        
        $nowTime = time();
        $model = $this->_loadModel();
        foreach($model as $key)
        {
            $statusTime = date("Y-m-d H:i:s",$key['status_time']);//项目上线时间
            if($key['status'] == '2')
            {
                $lastTime = $this->_setLastTime($statusTime,self::LASTIME);
                if($lastTime < $nowTime)
                {
                    $target = floor($key['money']*self::CARDINAL);
                    $count = $this->_getCount($key['id']);
                    if($count < $target){
                        $this->_offLine($key['id']);
                        $this->_createLog($key['id'],'-3',$key['user_id']);
                    }
                    else{
                        $this->_onLine($key['id']);
                        $this->_createLog($key['id'],'3',$key['user_id']);
                    }
                    
                }
            }
            elseif($key['status']=='3')
            {
                $lastTime = $this->_setLastTime($statusTime,$key['day']);
                $target = round(($key['bmoney']/$key['money'])*self::DEVOTED,2);    
                if($lastTime < $nowTime)
                {
                    if($target < self::DEVOTED){
                        $this->_offLine($key['id']);
                        $this->_createLog($key['id'],'-3',$key['user_id']);
                    }else{
                        $this->_pass($key['id']);
                        $this->_createLog($key['id'],'4',$key['user_id']);
                    }
                }
            }
        }
    }
    
    private function _loadModel()
    {
        return Yii::app()->db->createCommand('select a.*,b.count,b.money as bmoney from `dream` as a, `dream_count` as b where a.status > 1 and a.status < 4 and a.id = b.dream_id')->queryAll();
    }
    
    private function _getCount($id)
    {
        $count = Yii::app()->db->createCommand('select count(id) from `public_attention` where app_id=13 and res_id=:rid')->bindValue(':rid',$id)->queryRow();
        if(0 < $count['count(id)'])
            return $count['count(id)'];
        else
            return 0;
    }
    
    private function _setLastTime($statusTime,$day)
    {
        return strtotime(date('Y-m-d H:i:s',strtotime($statusTime.'+'.$day.' day')));
    }


    private function _offLine($id)
    {
        Yii::app()->db->createCommand("update `dream` set `status` = '-3' where id = :id")->bindValue(':id',$id)->execute();
    }
    
    private function _onLine($id)
    {
        Yii::app()->db->createCommand("update `dream` set `status` = '3' where id = :id")->bindValue(':id',$id)->execute();
    }
    
    private function _pass($id)
    {
        Yii::app()->db->createCommand("update `dream` set `status` = '4' where id = :id")->bindValue(':id',$id)->execute();
    }
    
    private function _createLog($id,$log_id,$uid,$reason='')
    {
        Yii::app()->db->createCommand("insert into  `dream_log` set `dream_id`=:did,`log_id`=:lid,`user_id`=:uid,`reason`=:re")->bindValues(array(':did'=>$id,':lid'=>$log_id,':uid'=>$uid,':re'=>$reason))->execute();
    }
}