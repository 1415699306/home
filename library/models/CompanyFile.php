<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyFile
 *
 * @author Administrator
 */
class CompanyFile extends CFormModel{
    public $thumb;
    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('thumb','file','types'=>'jpg,jpeg,png,gif,bmp','allowEmpty'=>true),
		);
	}
}
