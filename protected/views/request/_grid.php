<?php
/** @var $DataProvider CActiveDataProvider */
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'bordered condensed',
    'dataProvider' => $DataProvider,
    'template' => "{items}",
    'filter' => $DataProvider->model,
    'rowCssClassExpression' => function($row, $data) {
        if ($data->new) {
            return 'request__new';
        }
    },
    'columns' => array(
        array(
            'header' => '',
            'value' => '++$row',
            'htmlOptions' => array('style' => 'width: 40px;')
        ),
        array(
            'header' => 'Город',
            'name' => 'address_city',
            'htmlOptions' => array('style' => 'width: 240px;')
        ),
        array(
            'header' => 'Организация',
            'name' => 'name',
            'htmlOptions' => array('style' => 'width: 240px;')
        ),
        array(
            'header' => 'Адрес',
            'value' => '$data->getFullAddress()',
        ),
//        array(
//            'header' => 'Пояс',
//            'value' => '$data->address_timezone',
//            'htmlOptions' => array('style' => 'width: 130px;'),
//        ),
        array(
            'header' => 'Связь',
            'value' => '$data->getNextCommunicationDate()',
            'type' => 'html',
            'htmlOptions' => array('style' => 'width: 110px;'),
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
