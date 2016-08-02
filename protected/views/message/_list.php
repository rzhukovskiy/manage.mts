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
            'value' => '$data->short',
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
        [
            'class' => 'CButtonColumn',
            'htmlOptions' => array('style' => 'text-align: center; width: 90px;'),
            'template' => $this->Employee->role == 'admin' ? '{delete}{view}' : '{view}',
            'buttons' => array(
                'view' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("message/read", array("id" => $data->id))',
                    'options' => array(
                        'class' => 'fa fa-search admin-grid-search'
                    )
                ),
                'delete' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'options' => array(
                        'class' => 'fa fa-remove admin-grid-remove'
                    )
                ),
            ),
        ],
    ]
]);