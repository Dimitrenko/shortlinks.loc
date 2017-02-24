<?php

use app\models\Links;

class LinksTest extends \Codeception\Test\Unit
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
    }

    /**
     * валидны ли данные, самый минимум
     */
    public function testDataValid()
    {
        $model = new Links([
            'sourse_url'    =>'http://source-long-long-link.ru',
            'short_url' => '}http://source-long-long-link.ru',
        ]);
        $this->assertFalse($model->validate());

        $model = new Links([
            'sourse_url'    =>'http://source-long-long-link.ru',
            'short_url' => 'http://true.com',
        ]);
        $this->assertTrue($model->validate());
    }

    /**
     * проверка сохранения
     */
    public function testSave(){
        $model = new Links([
            'idlinks'=>2,
            'sourse_url'=>'http://source-long-long-link.ru',
            'short_url'=>'http://short.ru'
        ]);
        $model->save();
        $this->assertTrue($model->save(),'данные сохранены');
    }
}