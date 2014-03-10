<?php
class DeviceForm extends FormModel
{
    public $mac;
    public $os;
    public $ua;
    public $platform;
    public $version;
    public $uid;
    public $res_w;
    public $res_h;
    public $channel_id;
    
    public function rules(){
        return array(
            array('mac,os,platform,version,uid,res_w,res_h,ua,os','required'),
            array('res_w,res_h','numerical','integerOnly' => true,'min'=>0),
            array('ua,os,uid','length','max' => 16 ),
            array('version','length','max' => 64 ),
            array('mac','length','max' => 12),
            array('channel_id','safe'),
        );
    }
   	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			
		);
	}
}