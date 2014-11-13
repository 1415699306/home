<?php
use application\components\Controller;

class UcController extends Controller {
	private $appdir = '';  
      
    protected function beforeAction(CAction $action)  
    {  
        $this->appdir = Yii::app()->basePath . '/vendors/';  
        return parent::beforeAction($action);  
    }  
      
    public function actionTest() {  
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionDeleteuser() {  
        $uids = explode(',', str_replace("'", '', $_GET['ids']));  
        !API_DELETEUSER && exit(API_RETURN_FORBIDDEN);  
          
        $users = User::model()->findAllByPk($uids);  
        foreach($users as $user)  
        {  
            $user->delete();  
        }  
  
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionRenameuser() {  
        $uid = $_GET['uid'];  
        $usernameold = $_GET['oldusername'];  
        $usernamenew = $_GET['newusername'];  
        if(!API_RENAMEUSER) {  
            echo API_RETURN_FORBIDDEN;  
        }  
          
        $user = User::model()->findByPk($uid);  
        if($user !== null)  
        {  
            $user->username = $usernamenew;  
            if($user->save(false))  
                echo API_RETURN_SUCCEED;  
            else  
                echo API_RETURN_FAILED;  
        }  
    }  
  
    public function actionGettag() {  
        $name = $_GET['id'];  
        if(!API_GETTAG) {  
            echo API_RETURN_FORBIDDEN;  
        }  
          
        $echo = array();  
        echo $this->_serialize($return, 1);  
    }  
  
    public function actionSynlogin() {  
        $uid = (int)$_GET['uid']; 

        $username = (string)$_GET['username'];  
        $password = (string)$_GET["password"];
        $time = (int)$_GET['time'];
        if(!API_SYNLOGIN) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $identity=new UserIdentity($username,null);  
  
        if($identity->authenticate())  
        {  
            Yii::app()->user->login($identity,0);
        }  
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');  
    }  
  
    public function actionSynlogout() {  
        if(!API_SYNLOGOUT) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');  
        Yii::app()->user->logout();  
    }  
  
  
    public function actionUpdatebadwords() {  
        if(!API_UPDATEBADWORDS) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $cachefile = $this->appdir.'./uc_client/data/cache/badwords.php';  
        $fp = fopen($cachefile, 'w');  
        $data = array();  
        if(is_array($_POST)) {  
            foreach($_POST as $k => $v) {  
                $data['findpattern'][$k] = $v['findpattern'];  
                $data['replace'][$k] = $v['replacement'];  
            }  
        }  
        $s = "<?php\r\n";  
        $s .= '$_CACHE[\'badwords\'] = '.var_export($data, TRUE).";\r\n";  
        fwrite($fp, $s);  
        fclose($fp);  
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionUpdatehosts() {  
        if(!API_UPDATEHOSTS) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $cachefile = $this->appdir.'./uc_client/data/cache/hosts.php';  
        $fp = fopen($cachefile, 'w');  
        $s = "<?php\r\n";  
        $s .= '$_CACHE[\'hosts\'] = '.var_export($_POST, TRUE).";\r\n";  
        fwrite($fp, $s);  
        fclose($fp);  
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionUpdateapps() {  
        if(!API_UPDATEAPPS) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $UC_API = $_POST['UC_API'];  
        $cachefile = $this->appdir.'./uc_client/data/cache/apps.php';  
        $fp = fopen($cachefile, 'w');  
        $s = "<?php\r\n";  
        $s .= '$_CACHE[\'apps\'] = '.var_export($_POST, TRUE).";\r\n";  
        fwrite($fp, $s);  
        fclose($fp);  
        $config_file = 'Uconfig.php';  
        if(is_writeable($config_file)) {  
            $configfile = trim(file_get_contents($config_file));  
            $configfile = substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile;  
            $configfile = preg_replace("/define\('UC_API',\s*'.*?'\);/i", "define('UC_API', '$UC_API');", $configfile);  
            if($fp = @fopen($config_file, 'w')) {  
                @fwrite($fp, trim($configfile));  
                @fclose($fp);  
            }  
        }  
      
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionUpdateclient() {  
        if(!API_UPDATECLIENT) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $cachefile = $this->appdir.'./uc_client/data/cache/settings.php';  
        $fp = fopen($cachefile, 'w');  
        $s = "<?php\r\n";  
        $s .= '$_CACHE[\'settings\'] = '.var_export($_POST, TRUE).";\r\n";  
        fwrite($fp, $s);  
        fclose($fp);  
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionUpdatecredit() {  
        if(!API_UPDATECREDIT) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $credit = $_GET['credit'];  
        $amount = $_GET['amount'];  
        $uid = $_GET['uid'];  
        echo API_RETURN_SUCCEED;  
    }  
  
    public function actionGetcredit() {  
        if(!API_GETCREDIT) {  
            echo API_RETURN_FORBIDDEN;  
        }  
    }  
  
    public function actionGetcreditsettings() {  
        if(!API_GETCREDITSETTINGS) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        $credits = array();  
        echo $this->_serialize($credits);  
    }  
  
    public function actionUpdatecreditsettings() {  
        if(!API_UPDATECREDITSETTINGS) {  
            echo API_RETURN_FORBIDDEN;  
        }  
        echo API_RETURN_SUCCEED;  
    }  
      
    private function _serialize($arr, $htmlon = 0) {  
        if(!function_exists('xml_serialize')) {  
            include_once 'xml.class.php';  
        }  
        echo xml_serialize($arr, $htmlon);  
    }  
}
