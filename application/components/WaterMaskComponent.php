<?php

class WaterMaskComponent extends CComponent
{

    public $waterType = 0;   
    public $pos = 0;     
    public $transparent = 90; 
    public $waterStr = 'www.lfeel.com';     
    public $fontSize = 16;  
    public $fontColor = array(255,0,255);
    public $fontFile = '/fonts/AHGBold.ttf'; 
    public $waterImg = 'WaterMask.png'; 
    private $srcImg; 
    private $im; 
    private $water_im; 
    private $srcImg_info; 
    private $waterImg_info; 
    private $x; 
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

