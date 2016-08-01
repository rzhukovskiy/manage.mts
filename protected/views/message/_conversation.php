<?php
/** @var MessageController $this */
/** @var CActiveDataProvider $DataProvider */
$this->widget('booster.widgets.TbGridView', [
    'type' => 'striped bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'rowCssClassExpression' => function($row, $data) {
        if (!$data->is_read) {
            return 'request__new';
        }
    },
    'columns' => [
        [
            'header' => '№',
            'value' => '++$row',
            'htmlOptions' => array('style' => 'width: 40px;'),
        ],
        [
            'name' => 'create_date',
            'value' => 'date("d.m.Y H:i", strtotime($data->create_date))',
            'htmlOptions' => array('style' => 'width: 140px;'),
        ],
        [
            'name' => 'text',
        ],
        [
            'name' => 'from',
            'value' => '$data->author',
        ],
        [
            'name' => 'to',
            'value' => '$data->target',
            'visible' => $this->Employee->role == 'admin',
        ],
    ]
]);