<?php
namespace app\components;

use yii\base\Component;
use yii\base\Object;

class TtlComponent extends Object{

    public function init(){
        parent::init();
    }

    public function setTtl($data){
            if($data['time_of_death'] == '' && $data['ttl_seconds'] != ''){
                return date('Y-m-d H:i:s',time()+$data['ttl_seconds']);
            }else{
                return $data['time_of_death'];
            }

    }

}