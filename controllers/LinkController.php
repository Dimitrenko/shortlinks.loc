<?php

namespace app\controllers;
use Yii;
use app\models\Links;
use rodzadra\geolocation\Geolocation;
use app\components\UserAgent;
use app\components\StatComponent;
use app\components\TtlComponent;

class LinkController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->collStat();
        $model = new Links();
        return $this->render('index',['model' => $model,]);
    }

    /**
     * Генерирует короткий url
     *
     * @param string $host
     * @param int $length
     * @return string
     */
    private function generate($host,$length = 7){
        $chars = '1234567890abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        $shortUrl = $host[0].'/'.$string;
        return $shortUrl;
    }

    /**
     * Возвращает массив с кусками URL
     *
     * @param $data
     * @return array
     */
    private function getHost($data){
        preg_match('/(https?:\/\/)?([\w\d\.]+)/',$data,$arr);
        if(!empty($arr)){
            return $arr;
        }
    }

    /**
     * Возвращает готовый короткий url
     *
     * @param object $url
     * @return string
     */
    private function getShortUrl($url){
        $arrHost  = $this->getHost($url);
        $shortUrl = $this->generate($arrHost);
        return $shortUrl;
    }

    /**
     * записывает занные в базу
     */
    public function actionSave()
    {   $model = new Links();
        $data  = Yii::$app->request->post();
        $model = $this->setData($model,$data);
        if($model->find()->where(['short_url'=>$data['short_url']])->one() !==null){
            $model->update();
            echo $model->short_url;
        }else {

            if ($model->save()) {
                echo $model->short_url;
            } else {
                echo 'Что-то пошло не так :(';
            }
        }
    }

    /**
     * Заполняет поля модели значениями
     *
     * @param object $model
     * @param array $data
     * @return object
     */
    private function setData($model,$data){
        $model->sourse_url    = $data['sourse_url'];
        if($data['short_url'] !== ''){
            $model->short_url = $data['short_url'];
        }else{
            $model->short_url = $this->getShortUrl($data['sourse_url']);
        }

        if($data['time_of_death'] != ''||$data['ttl_seconds'] != ''){
            $ttl = new TtlComponent();
            $model->time_of_death =  $ttl->setTtl($data);
        }else{
            $model->time_of_death = 0;
        }
        return $model;
    }

    /**
     * Запускает статистику
     */
    private function collStat(){
        $stat = new StatComponent();

        $stat->start(new userAgent(), new  Geolocation());
        $stat->parsData();
        $stat->rewriteStat();
    }
}
