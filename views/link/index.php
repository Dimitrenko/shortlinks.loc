<?php

use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Links */
/* @var $form ActiveForm */
?>
<div class="link-index">
    <?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'sourse_url') ?>
    <?= $form->field($model, 'checkbox')->checkbox(array('label'=>'Включить пользовательскую ссылку'))?>
    <?= $form->field($model, 'short_url')->textInput(['placeholder' => 'пример : http://yoursite.ru/your-short-link', 'disabled' => 'true']); ?>
    <div class="status hide">
        <?= $form->field($model, 'time_of_death')->widget(DateTimePicker::className(),[
            'name' => 'event_time',
            'value' => '2010-12-31 05:10:20',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]
        ]);?>
        <?= $form->field($model, 'ttl_seconds') ?>
    </div>
    <label for="установить время жизни">установить время жизни</label>
    <div>
        <button id="p" type="button" class="btn btn-primary">открыть</button>
        <button type="button" class="btn btn-success send">отправить</button>
    </div>
    <?php ActiveForm::end(); ?>
    <p class="result">Результат</p>
<p><a href="" id="result"></a></p>
</div><!-- link-index -->
