<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statistic".
 *
 * @property integer $idstatistic
 * @property string $сountry
 * @property string $city
 * @property string $browser
 * @property string $version
 * @property string $os
 * @property string $dt
 * @property integer $links_idlinks
 *
 * @property Links $linksIdlinks
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['сountry', 'city', 'browser', 'os', 'links_idlinks'], 'required'],
            [['dt'], 'safe'],
            [['links_idlinks'], 'integer'],
            [['сountry', 'city'], 'string', 'max' => 50],
            [['browser'], 'string', 'max' => 100],
            [['version'], 'string', 'max' => 100],
            [['os'], 'string', 'max' => 45],
            [['links_idlinks'], 'exist', 'skipOnError' => true, 'targetClass' => Links::className(), 'targetAttribute' => ['links_idlinks' => 'idlinks']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idstatistic' => 'Idstatistic',
            'сountry' => 'сountry',
            'city' => 'City',
            'browser' => 'Browser',
            'os' => 'Os',
            'dt' => 'Dt',
            'links_idlinks' => 'Links Idlinks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //public function getLinksIdlinks()
    public function getLinks()
    {
        return $this->hasOne(Links::className(), ['idlinks' => 'links_idlinks']);
    }
}
