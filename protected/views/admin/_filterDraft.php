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
            'filterHtmlOptions' => array('style' => 'width: 40px;')
        ),
        array(
            'header' => 'Город',
            'name' => 'address_city',
            'filterHtmlOptions' => array('style' => 'width: 240px;')
        ),
        array(
            'header' => 'Организация',
            'name' => 'name',
            'filterHtmlOptions' => array('style' => 'width: 240px;')
        ),
        array(
            'header' => 'Адрес',
            'value' => '$data->getFullAddress()'
        ),
        array(
            'header' => 'Связь',
            'value' => '$data->getNextCommunicationDate()',
            'type' => 'html',
            'filterHtmlOptions' => array('style' => 'width: 110px;'),
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