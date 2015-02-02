<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sifsActiveRecord
 *
 * @author .vinoe.zelur
 */
abstract class sifsActiveRecord  extends CActiveRecord {

    /** 
     * Prepares created_by and updated_by attributes before saving
     */
    protected function beforeSave()
    {
        if(null != Yii::app()->user)
            $id=Yii::app()->user->id;
        else
            $id=1;
        
        if($this->isNewRecord)
            $this->created_by=$id;
        $this->updated_by=$id;
        
        return parent::beforeSave();
    }
    
    /**
     * Attaches the timestamp behaviour to update the created_on and updated_on fields
     */
    public function behaviors()
    {
        return array(
            'CTimestampBehavior'=> array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_on',
                'updateAttribute' => 'updated_on',
                'setUpdateOnCreate' => true,
            ),
        );
    }
}

?>
