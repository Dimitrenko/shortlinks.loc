<?php

namespace app\controllers;
use app\models\Statistic;
use app\models\Links;
class StatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $arrData= [];
        $result = Statistic::find()->joinWith(['links l'])->where('l.idlinks =links_idlinks')->all();

        foreach($result as $g => $item){
            $arrData[] = [$item->dt,
                            $item->links->short_url,
                            $item->сountry,
                            $item->city,
                            $item->browser,
                            $item->version,
                            $item->os];
        }

        return $this->render('index',['data' => $arrData]);
    }

}
