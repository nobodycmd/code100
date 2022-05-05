<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col">

                <h2>选手姓名：张荣芳</h2>

                <p>wx:howyagoing</p>

                <p>最近几天都要帮朋友帮项目，下周5才有时间沟通，如果有兴趣进一步沟通</p>

                <p>写于5月6日凌晨2点半</p>

                <div><a target="_blank">https://github.com/nobodycmd/code100</a></div>

            </div>
        </div>

        <?php



        echo \yii\helpers\Html::a('export','###',[
            'class' => 'btn btn-primary btn-export',
        ]);
        echo \yii\helpers\Html::a('0 item is choose','###',[
            'id' => 'txtDisplay'
        ]);
        echo \yii\helpers\Html::a('cancel all choose','###',[
            'id' => 'btnCanel',
            'class' => 'btn'
        ]);

        $js = <<<EOF
$('.btn-export').click(function(){
    var keys = $('#grid').yiiGridView('getSelectedRows');
    console.log(keys);
    if(keys.length == 0){
        alert('no items');
        return;
    }
    location = '/site/export?id='+keys.join(',');
});
$('.select-on-check-all').click(function(){
    setTimeout((e)=>{showInfo();},100);
});
$('#btnCanel').click(function(){
    var keys = $('#grid').yiiGridView('getSelectedRows');
    if(keys.length>0)$('.select-on-check-all').click();
});
EOF;
        $this->registerJs($js);
        echo \yii\grid\GridView::widget([
            'options' => [
                'id' => 'grid',
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
//            'name' => 'id',
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        return [
                            'value' => $model->id,
                            'onclick' => 'showInfo()',
                            'class' => 'ck'
                        ];
                    },
                ],
                'id',
                'name',
                'code',
                [
                    'attribute' => 't_status',
                    'filter' => \yii\helpers\Html::activeDropDownList($searchModel,'t_status',[
                        'ok'=>'okay',
                        'hold'=>'hold',
                    ], [
                        'prompt' => 'All',
                        'class' => 'form-control'
                    ])
                ]
            ]
        ]);
        ?>

        <script>
            function showInfo(){
                var keys = $('#grid').yiiGridView('getSelectedRows');
                $('#txtDisplay').html(keys.length + 'items had been choose');
            }
        </script>

    </div>
</div>
