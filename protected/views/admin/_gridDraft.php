<?php
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'columns' => array(
        array(
            'header' => '',
            'value' => '++$row',
            'htmlOptions' => array('style' => 'width: 40px;')
        ),
        array(
            'header' => 'Тип',
            'value' => 'Request::getTranslate($data->getRequestType())',
            'htmlOptions' => array('style' => 'width: 200px;')
        ),
        array(
            'header' => 'Город',
            'value' => '$data->address_city',
            'htmlOptions' => array('style' => 'width: 240px;')
        ),
        array(
            'header' => 'Организация',
            'value' => '$data->name',
            'htmlOptions' => array('style' => 'width: 240px;')
        ),
        array(
            'header' => 'Адрес',
            'value' => '$data->getFullAddress()'
        ),
//        array(
//            'header' => 'Пояс',
//            'value' => '$data->address_timezone',
//            'htmlOptions' => array('style' => 'width: 130px;')
//        ),
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
