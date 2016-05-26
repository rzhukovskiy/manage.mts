<?php
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'columns' => array(
        array(
            'header' => '',
            'value' => '++$row',
            'htmlOptions' => [
                'style' => 'width: 40px; text-align: center;'
            ]
        ),
        array(
            'header' => 'Тип ТС',
            'value' => '$data->type'
        ),
        array(
            'header' => 'Снаружи',
            'value' => '$data->price_outside'
        ),
        array(
            'header' => 'Внутри',
            'value' => '$data->price_inside'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("requestDetails/deletePrice", array("id" => $data->id))',
                    'options' => array('class' => 'fa fa-trash')
                ),
            )
        ),
    )
));
