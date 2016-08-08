<?php

$this->widget('booster.widgets.TbGridView', array(
    'type' => 'bordered condensed',
    'dataProvider' => $DataProvider,
    'filter' => $DataProvider->model,
    'summaryText' => '',
    'emptyText' => '',
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'header' => '',
            'value' => '++$row',
            'filterHtmlOptions' => array('style' => 'width: 40px;'),
        ),
        array(
            'header' => 'Организация',
            'value' => '$data->name',
            'name' => 'name',
            'filterHtmlOptions' => array('style' => 'width: 300px;')
        ),
        array(
            'header' => 'Адрес',
            'value' => '$data->getFullAddress()',
            'name' => 'address_city',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{info}',
            'buttons' => array(
                'info' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("request/details", array("id" => $data->id))',
                    'options' => array('class' => 'fa fa-search')
                ),
            )
        ),
    )
));