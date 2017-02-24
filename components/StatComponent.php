<?php

namespace app\components;
use Yii;
use yii\base\Object;
use rodzadra\geolocation\Geolocation;
use app\components\UserAgent;
use app\models\Statistic;
use app\models\Links;

class StatComponent extends Object
{
    private $geo;
    private $userData;
    public $arrData;

    public function init(){
        parent::init();
    }

    public function start($userData = null,$geoLocation = null){
        if($userData == null || $geoLocation == null){
            $this->userData = $userData;
            $this->geo = $geoLocation;
        }else{
            $this->userData = new UserAgent();
            $this->geo = new Geolocation();
        }
        return $this;
    }

    /**
     * Собирает данные о геолокации и браузере пользователя в массив
     * @return array
     */
    public function parsData(){
        $_SERVER['REMOTE_ADDR'] = $this->fakeIP();
        $geo = $this->geo->getInfo($_SERVER['REMOTE_ADDR']);
        $request = Yii::$app->request->absoluteUrl;
        $linksData = Links::findOne(['short_url'=>$request]);

        $this->arrData['links_idlinks'] = $linksData['idlinks'];
        $this->arrData['сountry'] = $geo['geoplugin_countryName'];
        $this->arrData['city'] = $geo['geoplugin_city'];
        $this->arrData['browser'] = $this->userData->browser;
        $this->arrData['version'] = $this->userData->browserVersion;
        $this->arrData['os'] = $this->userData->os;
        return $this;

    }

    /**
     * принимает то, что сделал  метод parsData и сохраняет в базу
     *
     * @return bool
     */
    public function rewriteStat(){
        $model = new Statistic();
        foreach($this->arrData as $key=>$value){
            $model->$key = $value;
        }
           if($model->save()){
               return true;
           }else{
               return false;
           }
    }

    /**
     * если заходим с 127.0.0.1
     * то берем IP из заранее заготовленных
     */
    private function fakeIP(){
        $arrIp = [
            '178.62.243.40',
            '178.62.243.40',
            '81.19.66.84',
            '81.19.66.9',
            '207.46.13.100'
        ];

        if($_SERVER['REMOTE_ADDR'] != '127.0.0.1'){
            return $_SERVER['REMOTE_ADDR'];
        }else{
            return $arrIp[array_rand($arrIp)];
        }

    }
}