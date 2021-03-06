<?php
include(dirname(__FILE__).DIRECTORY_SEPARATOR.'TreeBaseAction.php');
class TreeChildrenParentAction extends TreeBaseAction
{
    public function run()
    {
		$select_id=$parent_id=(int)Yii::app()->getRequest()->getParam('parent_id');
		
		$node=$this->getModel()->node($parent_id);
		
		if ($node) {
			$node=$node->getParent();
			if ($node) {
				$children=$node->getChildren();
			}
		}
		
		if ($node===null) {
			$children=$this->getModel()->roots(true);
		}
		
		
		$html="";
		if ($node) {
			$html.="<option value='$node->parent_id' id='editor_defaultParentParentId'>".Yii::t('tree','Back to parent')."[$node->name]</option>";
			$html.="<option id='editor_defaultParentId' value='$node->id'". (!$select_id || $select_id==$node->id ? ' selected' : '') .">".Yii::t('tree','Refresh')."</option>";
		} else {
			$html.="<option id='editor_defaultParentId' value='0'>".Yii::t('tree','Refresh')."</option>";
		}
		foreach ($children as $c) {
			$html.="<option value='$c->id'". ($select_id && $select_id==$c->id ? ' selected' : '') .">";
			$html.=$c->id.' - '.$c->name;
			$count	=	($c->rgt - $c->lft - 1) / 2;
  			if ($count)
  				$html.=" ({$count})";
  			$html.="</option>";
		}
		echo $html;
    }
}