<?php

namespace app\models;

use Yii;
use app\components\TtlComponent;
/**
 * This is the model class for table "links".
 *
 * @property integer $idlinks
 * @property string $sourse_url
 * @property string $short_url
 * @property string $dt
 * @property string $time_of_death
 * @property integer $delete
 *
 * @property Statistic[] $statistics
 */
class Links extends \yii\db\ActiveRecord
{
    public $ttl_seconds;
    public $checkbox;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourse_url'], 'required'],
            [['delete'], 'integer'],
            [['ttl_seconds'], 'safe'],
            [['sourse_url', 'short_url'], 'string', 'max' => 255],
            ['short_url','match','pattern'=>'#^[a-zA-Z0-9\.\-\/:]+$#i']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlinks' => 'Idlinks',
            'sourse_url' => 'Sourse Url',
            'short_url' => 'Пользовательская ссылка',
            'dt' => 'Dt',
            'time_of_death' => 'Время смерти ссылки',
            'delete' => 'Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatistics()
    {
        return $this->hasMany(Statistic::className(), ['links_idlinks' => 'idlinks']);
    }
}
