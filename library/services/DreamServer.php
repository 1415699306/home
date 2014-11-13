<?php
class DreamServer implements SplObserver{
    
    public function update(SplSubject $subject) 
    {
        if(func_num_args()===2){
            $params = func_get_arg(1);
            DreamLog::setLog($params["id"],$params["log_id"],$params["msg"]);
        }
    }
}