<?php
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'columns' => array(
        array(
            'header' => '',
            'value' => '++$row'
        ),
        array(
            'header' => 'ФИО',
            'value' => '$data->fio'
        ),
        array(
            'header' => 'Телефон',
            'value' => '$data->phone'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("requestDetails/deleteCompanyDriver", array("id" => $data->id))',
                    'options' => array('class' => 'fa fa-trash')
                ),
            )
        ),
    )
));
