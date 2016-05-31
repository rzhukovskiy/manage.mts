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
            'header' => 'Марка ТС',
            'value' => '$data->model'
        ),
        array(
            'header' => 'Тип ТС',
            'value' => '$data->type'
        ),
        array(
            'header' => 'Госномер',
            'value' => '$data->state_number'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}{update}',
            'buttons' => array(
                'delete' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("requestDetails/deleteCar", array("id" => $data->id))',
                    'options' => array(
                        'class' => 'fa fa-remove admin-grid-remove'
                    )
                ),
                'update' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("requestDetails/updateCar", array("id" => $data->id))',
                    'options' => array(
                        'class' => 'fa fa-edit admin-grid-edit'
                    )
                ),
            )
        ),
    )
));
