<?php

class DeviceController extends Controller{
    public function actionIndex(){
        echo $this->jsonError(404,'action not found');
    }
    
    public function actionActive(){
        $form = new DeviceForm();
        $form->loadAttributesFromRequest();
        if(!$form->validate()){
            return $this->jsonError(401,$form->getFirstError());
        }
        $device = Device::model();
        if($device->findByUid($form->uid)){
            return $this->jsonSuccess(201,'Deivce already active');
        }
        $device->attributes = $form->attributes;
        //var_dump($device->attributes);exit;
        $device->add_time = time();
        $device->modify_time = time();
        $device->isNewRecord = true;
        if(!$device->save(false)){
            return $this->jsonError(402,'Active device fail');
        }
        return $this->jsonSuccess(200,'Active device success');
    }
    
    public function actionStartPage(){
        $platform = Yii::app()->request->getParam('platform',0);
        $width = Yii::app()->request->getParam('width',0);
        $height = Yii::app()->request->getParam('height',0);
        $stratPage = StartPage::model();
        $enableStartPage = $stratPage->getEnableStartPage($platform,$width,$height);
        if(!$enableStartPage){
            return $this->jsonError(400,'no start page');
        }
        $data = array(
            'pic' => $enableStartPage->pic_url,
            'deadTime' => $enableStartPage->dead_time,
        );
        return $this->jsonSuccess(200,'success',$data);
    }
    
}