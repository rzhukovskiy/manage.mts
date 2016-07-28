<?php
/** @var MessageController $this */
/** @var CActiveDataProvider $DataProvider */
$this->widget('booster.widgets.TbGridView', [
    'type' => 'striped bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'columns' => [
        [
            'name' => 'create_date',
            'value' => 'date("d.m.Y H:i", strtotime($data->create_date))',
        ],
        [
            'name' => 'text',
        ],
        [
            'name' => 'from',
            'value' => '$data->author',
        ],
        [
            'class' => 'CButtonColumn',
            'htmlOptions' => array('style' => 'text-align: center; width: 90px;'),
            'template' => '{delete}{update}',
            'buttons' => array(
                'update' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'options' => array(
                        'class' => 'fa fa-edit admin-grid-edit'
                    )
                ),
                'delete' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'options' => array(
                        'class' => 'fa fa-remove admin-grid-remove'
                    )
                ),
            )
        ],
    ]
]);