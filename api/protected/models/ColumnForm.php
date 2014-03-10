<?php
/**
 * 栏目类API接口表单验证
 * @authors wujch
 * @date    2014-03-07 15:24:13
 * @version $Id$
 */

class columnForm extends FormModel {
    public $id;
    public $page;
    public $size;

    /**
     *
     * @return void
     * @author
     * @see CModel::rules 
     **/
    public function  rules(){
        return array(
            array('id','required'),
            array('id','numerical','integerOnly' => true,'min'=>1,'message' => 'Invalid Id','tooSmall'=> 'Invalid Id'),
            array('page,size','required','on' => 'pagination'),
            array('page,size','numerical','integerOnly'=>true,'min' =>1,'message' => 'Invalid page or size'
                        ,'on' => 'pagination','tooSmall' => 'Invalid page or size'),
        );
    }

}