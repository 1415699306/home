<?php
use application\components\Controller;
class SiteController extends Controller
{
    const CLOSEREGISTER = 1;
    const REGISTER = 0;


	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                    'backColor'=>0x2040A0, //背景颜色
                    'foreColor'=>0xFFFFFF,
                    'minLength'=>4, //最短为4位
                    'maxLength'=>6, //是长为4位
                    'height'=>40,
                    'width'=>80,
                    'padding'=>3,
                    'transparent'=>false, //显示为透明，当关闭该选项，才显示背景颜色
			),
		
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'error', $error);
		}
	}
       
    public function actionIndex()
    {   
      
        $comunity = $industrial = $agricultural = $tourism = $estate = $park = $other = $business = $news = $ariticle = $watch = $story = $newswire = $interview = $gover = $course = $cour = $people = $jewelry = $beauty = $fashion = $bag = $sories = $food = array();
        $comunity = $this->getCommunity('74','0','12');
        $industrial = $this->getGover('21','0','6');
        $agricultural = $this->getGover('22','0','6');
        $tourism = $this->getGover('23','0','6'); 
        $estate = $this->getGover('24','0','6');
        $park = $this->getGover('25','0','6');
        $other = $this->getGover('26','0','6');
        $business = $this->getBusiness('64','1','0','8'); 
        $news = $this->getNew('40','4','8');
        $ariticle = $this->getAri('2','0','4'); 
        $watch = $this->getAri('3','0','8');
        $story = $this->getCele('57','0','8');
        $newswire = $this->getBusiness('65','1','0','12'); 
        $interview = $this->getNew('59','0','4');
        $gover = $this->getGove('1','0','4');
        $course = $this->getNew('87','0','1');
        $cour = $this->getNew('87','1','3');
        $people = $this->getCele('57','0','3');
        $category = $this->getGory('27','0','1','7');
        $jewelry = $this->getNew('28','0','4'); 
        $beauty= $this->getNew('43','0','3');    
        $auoth = new AuthCode();
        $token = urlencode($auoth->auth(constant("UC_KEY")));
       
        $requesturl=sprintf("http://shop.lfeel.com/api/goods/show.php?token=%s",$token);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requesturl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $res=curl_exec($ch);
        curl_close($ch);
        //var_dump($res);exit();
        if($res != false){
            $info = json_decode($res,true);
            $fashion = array_slice($info['goods']['31'],0,6,true);
            $bag = array_slice($info['goods']['31'],0,6,true);
            $sories = array_slice($info['goods']['34'],0,6,true);
            $food = array_slice($info['goods']['32'],0,6,true);
        }
       
        $this->render('index',array(
            'comunity'=>$comunity,
            'industrial'=>$industrial, 
            'agricultural'=>$agricultural,
            'tourism'=>$tourism,
            'estate'=>$estate,
            'park'=>$park,
            'other'=>$other,
            'business'=>$business,
            'news'=>$news,
            'ariticle'=>$ariticle,
            'watch'=>$watch,
            'story'=>$story,
            'newswire'=>$newswire,
            'interview'=>$interview,
            'gover'=>$gover,
            'course'=>$course,
            'cour'=>$cour,
            'people'=>$people,
            'category'=>$category,
            'jewelry'=>$jewelry,
            'beauty'=>$beauty, 
            'fashion'=>$fashion,
            'bag'=>$bag,
            'sories'=>$sories,
            'food'=>$food,
        ));
        exit();
    }
   
  
    private function _getInvestmentSlide()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'recommand = 1';
        $criteria->order = 'id desc';
        $criteria->limit = 3;
        return Investment::model()->findAll($criteria);
    }
    
    
    private function _getInvestmentRight()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'recommand = 0';
        $criteria->order = 'id desc';
        $criteria->limit = 4;
        return Investment::model()->findAll($criteria);
    }
	
	
	public function actionLogin()
	{
        $this->layout = '//layouts/login';
        if(0 < Yii::app()->user->id)$this->redirect (Yii::app()->homeUrl);
        if(!Yii::app()->request->isAjaxRequest)$this->redirect ('http://quanzi.lfeel.com');
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
            {
				Yii::import('application.vendors.*');
				require_once 'ucenter.php';
				Yii::app ()->end (CJSON::encode(array('success'=>true,'code'=>'1','callback'=>uc_user_synlogin(Yii::app()->user->id).'<script type="text/javascript">window.location="'.Yii::app()->homeUrl.'";</script>')));
            }
            else
            {
                if(Yii::app()->request->isAjaxRequest)
                    Yii::app ()->end (CJSON::encode(array('success'=>true,'code'=>'-1')));
				else
					Helper::showMsg('系统消息','登录失败!',Yii::app()->returnUrl);
            }
				
		}
	}
	
	public function actionLogout()
	{
		Yii::import('application.vendors.*');
        require_once 'ucenter.php';
        Yii::app()->user->logout();
        echo uc_user_synlogout().'<script type="text/javascript">window.location="'.Yii::app()->homeUrl.'";</script>';
	}
    
    private function _sendRegisterMail($username,$address)
    {
         $message = '
            <html>
                <bodey>
                    <table>
                        <tr>
                        <td><b><a href="'.HOME_URL.'">欢迎注册"'.Yii::app()->name.'"</a></b></td>
                        </tr>
                        <tr>
                        <td>您在我们网站注册的用户名:'.$username.'</td>
                        <td>此邮件由系统自动发出,请勿直接回复!</td>
                        </tr>
                    </table>
                </body>
            </html>';
            $mail = new sendMail;
            $mail->send('欢迎注册'.Yii::app()->name,$message,$address);
    }
    
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
   
     public function getAri($cid,$offset=0,$limit=1)
    {
			$sql = "select a.subtitle,a.professor,a.money,a.project,a.cooperation,a.address,a.recommend,a.discription,a.title,a.ctime,a.mtime,a.id,b.track_id from `article` as a,`storage` as b where a.category_id=:cid and a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend=1 order by id desc limit {$offset},{$limit}";
			$model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::ARTICLE))->queryAll();
            return $model;
    }
    
    public function getCommunity($cid,$offset=0,$limit=1)
    {
        $sql = "select a.title,a.id,a.discription,b.track_id from `community` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand=1  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::COMMUNITY))->queryAll();
        return $model;
    }
    
    
   
    public function getCourse($cid,$offset=0,$limit=1)
    {
        $sql = "select a.title,a.id,a.professor,a.discription,a.vidty,a.video,b.track_id from `study` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand='1'  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::STUDY))->queryAll();
        return $model;
    }
    
    
    public function getGover($cid,$offset=0,$limit=1)
    {
        $sql = "select title,unit,maney,discription,address,id,thumb,category_id,channel_recommand,index_recommand from `investment`  where category_id=:cid and  index_recommand='1'  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid))->queryAll();
        return $model;
    }
    
   
    public function getBusiness($cid,$type,$offset=0,$limit=1)
    {
        $sql = "select channel_recommand,title,type,id,min_thumb,big_thumb,category_id,recommand from `trade`  where category_id=:cid and type=:type and  channel_recommand='1'  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':type'=>(int)$type))->queryAll();
        return $model;
    }
    
 
    
    public function getCele($cid,$offset=0,$limit=1)
    {
        $sql = "select a.guests,a.index_recommand,a.channel_recommand,a.discription,a.title,a.id,b.track_id from `celebrity` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand = '1' order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::CELEBRITY))->queryAll();
        return $model;
    }
    
  
    public function getGant($cid,$offset=0,$limit=1)
    {
        $sql = "select a.index_recommand,a.title,a.id,b.track_id from `life` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand = '1' order by id desc  limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::LIFE))->queryAll();
        return $model;
    }
    
    
    
    public function getLife($cid,$offset=0,$limit=1)
    {
        $sql = "select a.channel_recommand,a.title,a.id,b.track_id from `life` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.channel_recommand = '1' order by id desc  limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::LIFE))->queryAll();
        return $model;
    }
    
    
    
    public function getGory($cid,$sid,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.parent_id,a.name,a.system from `category` as a where a.parent_id=:cid and a.system=:sid order by id asc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':sid'=>(int)$sid))->queryAll();
        return $model;
    }
    
   
    public function getNew($cid,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.link,a.maney,a.contacts,a.address,a.professor,a.discription,a.recommend,a.title,a.category_id,a.res_id,b.track_id  from `news` as a,`storage` as b  where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend = '1'order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::NEWS))->queryAll(); 
        return $model;
    }
    
    public function getGove($aip,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.link,a.maney,a.contacts,a.address,a.professor,a.discription,a.recommend,a.title,a.aip,a.res_id,b.track_id  from `news` as a,`storage` as b  where a.aip=:aip and a.id=b.res_id and b.app_id=:app_id and a.recommend = '1'order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aip'=>(int)$aip,':app_id'=>BaseApp::NEWS))->queryAll(); 
        return $model;
    }
    
    public function actionWblogin()
    {
        if(isset($_REQUEST['state'])==Yii::app()->session['sina_state']){
            if(isset($_REQUEST['code'])){
                Yii::import('ext.oauth.sina.sinaWeibo',true);
                $keys = array();
                $keys['code'] = $_REQUEST['code'];
                $keys['redirect_uri'] = WB_CALLBACK_URL;
                try {
                    $weibo = new SaeTOAuthV2(WB_AKEY,WB_SKEY);
                    $sinaToken = $weibo->getAccessToken('code',$keys);
                } catch (CHttpException $e) {

                }
                //获取认证
                 if (isset($sinaToken)) {
                    Yii::app()->session->add('sinaToken',$sinaToken);
                    //查询微博的账号信息
                    $c = new SaeTClientV2( WB_AKEY , WB_SKEY ,Yii::app()->session['sinaToken']['access_token']);
                    $userShow  = $c->getUserShow(Yii::app()->session['sinaToken']); // done
                    //查询是否有绑定账号   
                    $user = UserBinding::model()->with('user')->find('user_bind_type = :bind_type AND user_access_token = :access_token AND user_openid=:openid',array(':bind_type' =>'sina',':access_token' =>Yii::app()->session['sinaToken']['access_token'],':openid' =>Yii::app()->session['sinaToken']['uid']));
                    //如果没有存在则创建账号及绑定
                    if (!isset($user)){
                        $userBingding = array();
                        $userBingding['access_token'] = Yii::app()->session['sinaToken']['access_token'];
                        $userBingding['openid'] = Yii::app()->session['sinaToken']['uid'];
                        $userBingding['username'] = $userShow['screen_name'];
                        $userBingding['bind_type'] = 'sina';
                        $userBingding['avatar'] = $userShow['profile_image_url']; 
                        $userBind = UserBinding::addBinding($userBingding, $_REQUEST['state']);
                    }else{
                        Yii::app()->user->id = $user->user_id;
                        Yii::app()->user->name = $user->user->username;
                    }
                        
                    $this->redirect(Yii::app()->session['back_url']);
                 }  else {
                     echo '认证失败';
                 }
            }
        }
    }
    
    public function actionQqlogin()
    {
        if(isset($_REQUEST['state'])==Yii::app()->session['qq_state']){
          if(isset($_REQUEST['code'])){
                Yii::import('ext.oauth.qq.qqConnect',true);
                $keys = array();
                $keys['code'] = $_REQUEST['code'];
                $keys['state'] = Yii::app()->session['qq_state'];
                $keys['redirect_uri'] = QQ_CALLBACK_URL;
                try {
                    $qqConnect = new qqConnectAuthV2(QQ_APPID,QQ_APPKEY);
                    $qqToken = $qqConnect->getAccessToken('code',$keys);
                } catch (CHttpException $e) {

                }
                
                if (isset($qqToken)) {
                    Yii::app()->session->add('qqToken',$qqToken);
                    Yii::import('ext.oauth.qq.qqConnect',true);
                    $c = new qqConnectAuthV2(QQ_APPID,QQ_APPKEY);
                    $userInfo = $c->getUserInfo(Yii::app()->session['qqToken']);
                    $userShow= array();
                    $userShow['screen_name'] = $userInfo['nickname'];
                    $userShow['profile_image_url'] = $userInfo['figureurl_2'];
                    //查询是否有绑定账号   
                    $user = UserBinding::model()->with('user')->find('user_bind_type = :bind_type and user_openid=:openid',array(':bind_type' =>'qq',':openid' =>Yii::app()->session['qqToken']['openid']));
                    
                    //如果没有存在则创建账号及绑定
                    if (!isset($user)){
                        $userBingding = array();
                        $userBingding['access_token'] = Yii::app()->session['qqToken']['access_token'];
                        $userBingding['openid'] = Yii::app()->session['qqToken']['openid'];
                        $userBingding['username'] = $userShow['screen_name'];
                        $userBingding['bind_type'] = 'qq';
                        $userBingding['avatar'] = $userShow['profile_image_url']; 
                        $userBind = UserBinding::addBinding($userBingding, $_REQUEST['state']);
                    }else{
                        Yii::app()->user->id = $user->user_id;
                        Yii::app()->user->name = $user->user->username;
                    }
                    $this->redirect(Yii::app()->session['back_url']);
                }  else {
                    echo '认证失败';
                }
          }
       }
    }
    
   
    
}