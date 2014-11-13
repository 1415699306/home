<?php
/** 
* 加水印类，支持文字图片水印的透明度设置、水印图片背景透明。 
* 使用： 
$obj = new WaterMask($imgFileName); //实例化对象 
$waterMask = Yii::createComponent('WaterMaskComponent','123');
$waterMask->waterType = 1; //类型：0为文字水印、1为图片水印 
$waterMask->transparent = 45; //水印透明度 
$waterMask->waterStr = 'www.lefeel.com'; //水印文字 
$waterMask->fontSize = 16; //文字字体大小 
$waterMask->fontColor = array(255,0255); //水印文字颜色（RGB） 
$waterMask->fontFile = 'AHGBold.ttf'; //字体文件 
$waterMask->output(); //输出水印图片文件覆盖到输入的图片文件 
*/ 

/**
 * Description of WaterMaskComponent
 *
 * @author martin
 */
class WaterMaskComponent extends CComponent
{
    /**
     * 水印类型：0为文字水印、1为图片水印 
     * @var int
     */   
    public $waterType = 0;   
    /**
     * 水印位置
     * @var  int
     */
    public $pos = 0;     
    /**
     * 水印透明度 
     * @var int
     */
    public $transparent = 45; 
    /**
     * 水印文字
     * @var string
     */
    public $waterStr = 'www.lfeel.com';     
    /**
     * 文字字体大小
     */
    public $fontSize = 16;  
     /**
      * 水印文字颜色（RGB） 
      */
    public $fontColor = array(255,0,255);
    /**
     * 字体文件 
     */
    public $fontFile = '/fonts/AHGBold.ttf'; 
    /**
     * 水印图片 
     */
    public $waterImg = 'WaterMask.png'; 
    /**
     * 需要添加水印的图片 
     */
    private $srcImg; 
    /**
     * 图片句柄 
     */
    private $im; 
    /**
     * 水印图片句柄 
     */
    private $water_im; 
    /**
     * 图片信息 
     */
    private $srcImg_info; 
    /**
     * 水印图片信息 
     */
    private $waterImg_info; 
    /**
     * 水印X坐标 
     */
    private $x; 
    /**
     * 水印y坐标 
     */
    private $y;
    
    private $_ready = true;
    
    public function __construct($img) 
    {
        $this->fontFile = WEB_PATH.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.$this->fontFile;
        if(!is_file($img))
            $this->_ready = false;
        else
            $this->srcImg = $img;
    } 
    
    /**
     * 获取需要添加水印的图片的信息，并载入图片。 
     */
    private function _imginfo() 
    { 
        $this->srcImg_info = getimagesize($this->srcImg); 
        switch ($this->srcImg_info[2]) 
        { 
        case 3: 
            $this->im = imagecreatefrompng($this->srcImg); 
            break 1; 
        case 2: 
            $this->im = imagecreatefromjpeg($this->srcImg); 
            break 1; 
        case 1: 
            $this->im = imagecreatefromgif($this->srcImg); 
            break 1; 
        default: return '原图片（'.$this->srcImg.'）格式不对，只支持PNG、JPEG、GIF!'; 
        } 
    } 
    
    /**
     * 获取水印图片的信息，并载入图片。 
     */
    private function _waterimginfo() 
    { 
        $file = WEB_PATH.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->waterImg;
        if(is_file($file))
        {
              $this->waterImg_info = getimagesize($file); 
              switch ($this->waterImg_info[2]) 
              { 
                  case 3: 
                      $this->water_im = imagecreatefrompng($file); 
                      break 1; 
                  case 2: 
                      $this->water_im = imagecreatefromjpeg($file); 
                      break 1; 
                  case 1: 
                      $this->water_im = imagecreatefromgif($file); 
                      break 1; 
                  default: return '水印图片（'.$this->srcImg.'）格式不对，只支持PNG、JPEG、GIF!'; 
              } 
              return true;
        }
        else
             return false;
    }     
    /**
     * 水印位置算法 
     */
    private function _waterpos() 
    { 
        switch ($this->pos) 
        { 
            case 0: //随机位置 
                $this->x = rand(0,$this->srcImg_info[0]-$this->waterImg_info[0]); 
                $this->y = rand(0,$this->srcImg_info[1]-$this->waterImg_info[1]); 
                break 1; 
            case 1: //上左 
                $this->x = 0; 
                $this->y = 0; 
                break 1; 
            case 2: //上中 
                $this->x = ($this->srcImg_info[0]-$this->waterImg_info[0])/2; 
                $this->y = 0; 
                break 1; 
            case 3: //上右 
                $this->x = $this->srcImg_info[0]-$this->waterImg_info[0]; 
                $this->y = 0; 
                break 1; 
            case 4: //中左 
                $this->x = 0; 
                $this->y = ($this->srcImg_info[1]-$this->waterImg_info[1])/2; 
                break 1; 
            case 5: //中中 
                $this->x = ($this->srcImg_info[0]-$this->waterImg_info[0])/2; 
                $this->y = ($this->srcImg_info[1]-$this->waterImg_info[1])/2; 
                break 1; 
            case 6: //中右 
                $this->x = $this->srcImg_info[0]-$this->waterImg_info[0]; 
                $this->y = ($this->srcImg_info[1]-$this->waterImg_info[1])/2; 
                break 1; 
            case 7: //下左 
                $this->x = 0; 
                $this->y = $this->srcImg_info[1]-$this->waterImg_info[1]; 
                break 1; 
            case 8: //下中 
                $this->x = ($this->srcImg_info[0]-$this->waterImg_info[0])/2; 
                $this->y = $this->srcImg_info[1]-$this->waterImg_info[1]; 
                break 1; 
            default: //下右 
                $this->x = $this->srcImg_info[0]-$this->waterImg_info[0]; 
                $this->y = $this->srcImg_info[1]-$this->waterImg_info[1]; 
                break 1; 
        } 
    }
    
    private function _waterimg() 
    { 
        if ($this->srcImg_info[0] <= $this->waterImg_info[0] || $this->srcImg_info[1] <= $this->waterImg_info[1])return '水印比原图大!';        
        $this->_waterpos(); 
        $cut = imagecreatetruecolor($this->waterImg_info[0],$this->waterImg_info[1]); 
        imagecopy($cut,$this->im,0,0,$this->x,$this->y,$this->waterImg_info[0],$this->waterImg_info[1]); 
        $pct = $this->transparent; 
        imagecopy($cut,$this->water_im,0,0,0,0,$this->waterImg_info[0],$this->waterImg_info[1]); 
        imagecopymerge($this->im,$cut,$this->x,$this->y,0,0,$this->waterImg_info[0],$this->waterImg_info[1],$pct); 
    } 
    
    private function waterstr() 
    { 
        $rect = imagettfbbox($this->fontSize,0,$this->fontFile,$this->waterStr); 
        $w = abs($rect[2]-$rect[6]); 
        $h = abs($rect[3]-$rect[7]); 
        $this->water_im = imagecreatetruecolor($w, $h); 
        imagealphablending($this->water_im,false); 
        imagesavealpha($this->water_im,true); 
        $white_alpha = imagecolorallocatealpha($this->water_im,255,255,255,127); 
        imagefill($this->water_im,0,0,$white_alpha); 
        $color = imagecolorallocate($this->water_im,$this->fontColor[0],$this->fontColor[1],$this->fontColor[1]); 
        imagettftext($this->water_im,$this->fontSize,0,0,$this->fontSize,$color,$this->fontFile,$this->waterStr); 
        $this->waterImg_info = array(0=>$w,1=>$h); 
        $this->_waterimg(); 
    } 
    
    function output() 
    { 
        if(!$this->_ready)return '文件不存在!';
        $this->_imginfo(); 
        if ($this->waterType == 0) 
        { 
            $this->waterstr(); 
        }
        else 
        { 
            if($this->_waterimginfo()) 
                $this->_waterimg(); 
            else
                return '水印图片加载失败!';
        } 
        switch ($this->srcImg_info[2]) 
        { 
            case 3: 
                imagepng($this->im,$this->srcImg); 
                break 1; 
            case 2: 
                imagejpeg($this->im,$this->srcImg); 
                break 1; 
            case 1: 
                imagegif($this->im,$this->srcImg); 
                break 1; 
            default: 
                return '添加水印失败！'; 
                break; 
        } 
        imagedestroy($this->im); 
        imagedestroy($this->water_im);
    } 
}

