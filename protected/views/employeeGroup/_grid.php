<?php
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'columns' => array(
        array(
            'header' => 'Название отдела',
            'name' => 'name'
        ),
        array(
            'class' => 'CButtonColumn',
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
                )
            )
        ),
    )
));
