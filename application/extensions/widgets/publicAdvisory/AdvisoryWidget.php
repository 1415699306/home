<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Advisory
 *
 * @author Administrator
 */
class AdvisoryWidget extends CWidget{
    
    public $app_id;
    public $res_id;
    public $cssFile;
    public $limit = 10;
    public $registerFile = false;
	public $debug = true;
	private $_assetsUrl;
    
    public function run() 
    {
        $this->registerScripts();
        echo $this->_setHtml();
        return parent::run();
    }
    
    private function _setHtml()
    {
        $data = $this->_getData();
        $i = 1;
        $html = '<div class="advisory_widget">';
        $html.= '<ul>';
        foreach($data as $key){
            $html.= "<li><span>问题{$i}：{$key->title}</span></li>";         
            $html.= "<p>{$key->content}</p>";
            ++$i;
        }
        $html.= '</ul>';
        $html.= '</div>';
        return $html;
    }

    private function _getData()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'app_id = :aid';
        $criteria->addCondition('res_id = :rid');
        $criteria->addCondition("content!=''");
        $criteria->params = array(':aid'=>$this->app_id,':rid'=>$this->res_id);
        $criteria->limit = $this->limit;
        return Advisory::model()->findAll($criteria);       
    }
    
    /**
	 * Registers the necessary scripts.
	 */
	public function registerScripts()
	{
		// Get the url to the module assets
		//$assetsUrl = $this->getAssetsUrl();
        
		// Register the necessary scripts
        if($this->registerFile === true)
        {
            $cs = Yii::app()->getClientScript();
            // Make sure we want to register a style sheet.

            if( $this->cssFile!==false )
            {
                $assetsUrl = $this->getAssetsUrl();
                $cs->registerScriptFile($assetsUrl.'/js/advisory.js');
                // Default style sheet is used unless one is provided.
                if( $this->cssFile===null )
                    $this->cssFile = $assetsUrl.'/css/advisory.css';
                else
                    $this->cssFile = Yii::app()->request->baseUrl.$this->cssFile;

                // Register the style sheet
                $cs->registerCssFile($this->cssFile);
            }
		}
	}
    /**
	* Publishes the module assets path.
	* @return string the base URL that contains all published asset files of Advisory.
	*/
	public function getAssetsUrl()
	{
		if( $this->_assetsUrl===null )
		{
			$assetsPath = Yii::getPathOfAlias('ext.widgets.publicAdvisory.assets');

			// We need to republish the assets if debug mode is enabled.
			if( $this->debug===true )
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
			else
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
		}

		return $this->_assetsUrl;
	}
}

