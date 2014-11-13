<?php
class YNote extends CWidget{   
    public $type;
    public $html;
    public $text;
    public function init()
    {
        $note =  $this->setType($this->type);
        $this->html = CHtml::Tag('blockquote',array('class'=>$this->type));
        $this->html .="<p><strong>{$note}:</strong>{$this->text}</p>";
        $this->html .= CHtml::closeTag('blockquote');
    }
    
    protected function setType($type)
    {
        switch($type){
            case 'tip' : return '提示';
            case 'note' : return '注意';
            case 'info' : return '信息';
        }
    }


    public function run()
    {
        Yii::app()->getClientScript()->registerCss('ynote',"
            blockquote.tip, blockquote.info, blockquote.note{
                    border-top:1px solid #0cf;
                    border-bottom:1px solid #0cf;
                    padding:0em 1em 0em 55px;
                    margin: 1em 0em;
                    border-color: #E4DFB8;
                    background-color: #FFFAE6;
                    background-repeat: no-repeat;
                    background-position: 10px 50%;
                    background-image: url(/images/note/tip.gif);
            }
            blockquote.note{
                    background-color:#FFE6E6;
                    border-color:#D9C3C3;
                    background-image: url(/images/note/note.gif);
            }

            blockquote.info{
                    border-color: #B4DAA5;
                    background-color: #EBFFCE;
                    background-image: url(/images/note/info.gif);
            }
            blockquote{font-style: normal;}
            blockquote p{margin: 0.8em 0 1.5em 0;}    
        ",CClientScript::POS_HEAD);
        echo  $this->html;
    }
}