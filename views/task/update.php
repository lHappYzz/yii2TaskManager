<?php
$this->title = 'Edit task';

use app\models\Status;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$statusArray = ArrayHelper::map(Status::find()->orderBy('id')->asArray()->all(), 'id', 'title');
?>

<h1>Edit task - <?= $task->title ?></h1>

<?php $form = ActiveForm::begin(['id' => 'updateTask']) ?>
<?= $form->field($task, 'title') ?>
<?= $form->field($task, 'status_id')
    ->dropDownList($statusArray) ?>

<?= $form->field($task, 'start_date', ['inputOptions' => ['autocomplete' => 'off']])->widget(DateTimePicker::class, [
    'options' => ['placeholder' => 'Select start date ...'],
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'autoclose' => true,
        'minuteStep' => 5,
    ]
]) ?>

<?= $form->field($task, 'end_date', ['inputOptions' => ['autocomplete' => 'off']])->widget(DateTimePicker::class, [
    'options' => ['placeholder' => 'Select end date ...'],
    'pluginOptions' => [
        'todayHighlight' => true,
        'autoclose' => true,
        'todayBtn' => true,
        'minuteStep' => 5,
    ]
]) ?>

<?= $form->field($task, 'description')->textarea(['rows' => '6']) ?>

<?= Html::submitButton('Save', [
    'class' => 'btn btn-primary'
]) ?>

<?php $form = ActiveForm::end();
?>