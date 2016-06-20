<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use giicms\post\models\Category;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">

                        <?php
                        $form = ActiveForm::begin([
                                    'layout' => 'horizontal',
                                    'fieldConfig' => [
                                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                        'horizontalCssClasses' => [
                                            'label' => 'col-sm-3',
                                            'offset' => 'col-sm-offset-3',
                                            'wrapper' => ' col-md-9 col-sm-9 col-xs-12',
                                            'error' => '',
                                            'hint' => '',
                                        ],
                                    ],
                        ]);
                        ?>  
                        <?=
                        $this->render('/backend/category/_form', [
                            'model' => $model,
                            'form' => $form
                        ])
                        ?>
                        <?php ActiveForm::end(); ?>

                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">

                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => "<p>Hiển thị {begin} đến {end} trong tổng số {count} mục</p>",
                            'layout' => "{items}\n{summary}\n{pager}",
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'title',
                                    'value' => function($data) {
                                        return $data->getIndent($data->indent) . $data->title;
                                    }
                                ],
                                'description:ntext',
                                [
                                    'attribute' => 'publish',
                                    'format' => 'raw',
                                    'value' => function($data) {
                                        if ($data['publish'] == Category::PUBLISH_ACTIVE)
                                            $check = 'checked';
                                        else
                                            $check = '';
                                        return '<input type="checkbox" name="publish" ' . $check . '>';
                                    }
                                ],
                                // 'order',
                                // 'status',
                                ['class' => 'backend\components\columns\ActionColumn'],
                            ],
                        ]);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->registerJs('$("[name=publish]").bootstrapSwitch({onText:"&nbsp;",offText:"&nbsp;",onColor:"default",offColor:"default"});') ?>
<?= $this->registerJs('
$("input[name=publish]").on("switchChange.bootstrapSwitch", function(event, state) {
    var key = $(this).parent().parent().parent().parent("tr").attr("data-key");
        $.ajax({type: "POST", url:"' . Yii::$app->urlManager->createUrl(["category/publish"]) . '", data: {id: key,state:state}, success: function (data) {
            }, });
});
') ?>