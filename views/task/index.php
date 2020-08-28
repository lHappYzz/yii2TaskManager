<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Task manager';
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/loadEditTaskModalWindow.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/deleteTaskAjax.js', ['depends' => [\yii\web\JqueryAsset::class]]);

Modal::begin([
    'header' => 'Edit task',
    'id' => 'editModal',
]);
echo "<div id='editModalContent'></div>";
Modal::end();

?>
<?php Pjax::begin(['id' => 'my_pjax']); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        [
            'attribute' => 'status_id',
            'value' => 'status.title'
        ],
        'start_date',
        'end_date',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}&nbsp{update}&nbsp{delete}',
            'header' => 'Actions',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('View', $url, [
                        'class' => 'btn btn-primary',
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::button('Edit', [
                        'class' => 'btn btn-primary editButton',
                        'value' => $url,
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::button('Delete', [
                        'class' => 'btn btn-danger deleteButton',
                        'data-url' => $url,
                        'data-id' => $model->id,
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                return Url::to(['task/'.$action, 'id' => $model->id]);
            }
        ]
    ]
]) ?>
<?php Pjax::end(); ?>
