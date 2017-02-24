<?php

use app\models\Statistic;
use app\models\Links;
class StatisticTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public $id = 1;
    protected function _before()
    {
        $models = new Links([
            'idlinks'=>$this->id,
            'sourse_url'=>'http://source-long-long-link.ru',
            'short_url'=>'http://short.ru'
        ]);
        $models->save();
    }

    protected function _after()
    {
        Links::deleteAll();
        Statistic::deleteAll();
    }

    /**
     *все данные  валидны
     */
    public function testDataValid()
    {
        $model = new Statistic([
            'сountry'=>'Netherlands',
            'city'=>'Amsterdam',
            'browser'=>'chrome',
            'version'=>'49.0.2623.112',
            'os'=>'linux',
            'links_idlinks'=>$this->id
        ]);
        $this->assertTrue($model->validate(),'данные валидны');
    }

    /**
     * если одно из обязятельных полей пустойе
     */
    public function testDataEmptyValid()
    {
        $model = new Statistic([
            'сountry'=>'',
            'city'=>'Amsterdam',
            'browser'=>'chrome',
            'version'=>'49.0.2623.112',
            'os'=>'linux',
            'links_idlinks'=>$this->id
        ]);
        $this->assertFalse($model->validate(),'данные не валидны');
    }

    /**
     *все данные  валидны
     * не стал проверять вообщевсе
     */
    public function testDataMaxSizeValid()
    {
        $longStr = 'test test test test test test test test test test test test test test test test test test test test
                    test test test test test test test test test test test test test test test test test test test test
                    test test test test test test test test test test test test test test test test test test test test';
        $model = new Statistic([
            'сountry'=>'Netherlands',
            'city'=>'Amsterdam',
            'browser'=>$longStr,
            'version'=>'49.0.2623.112',
            'os'=>'linux',
            'links_idlinks'=>$this->id
        ]);
        $this->assertFalse($model->validate(),'очень длинная строка сountry');

        $model = new Statistic([
            'сountry'=>'Netherlands',
            'city'=>$longStr,
            'browser'=>'chrome',
            'version'=>'49.0.2623.112',
            'os'=>'linux',
            'links_idlinks'=>$this->id
        ]);
        $this->assertFalse($model->validate(),'очень длинная строка city');

        $model = new Statistic([
            'сountry'=>$longStr,
            'city'=>'Amsterdam',
            'browser'=>'chrome',
            'version'=>'49.0.2623.112',
            'os'=>'linux',
            'links_idlinks'=>$this->id
        ]);
        $this->assertFalse($model->validate(),'очень длинная строка сountry');
    }

    /**
     * проверка сохранения
     */
    public function testSave(){
        $models = new Links([
            'idlinks'=>2,
            'sourse_url'=>'http://source-long-long-link.ru',
            'short_url'=>'http://short.ru'
        ]);
        $models->save();

        $model = new Statistic([
            'сountry'=>'Netherlands',
            'city'=>'Amsterdam',
            'browser'=>'chrome',
            'version'=>'49.0.2623.112',
            'os'=>'linux',
            'links_idlinks'=>2
        ]);
        $this->assertTrue($model->save(),'данные сохранены');
    }

    /**
     * проверка ссылки сслки на несуществующую запись
     */
    public function testRelationModels(){

    }
}