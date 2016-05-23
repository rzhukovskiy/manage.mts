<?php
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'summaryText' => '',
    'columns' => array(
        array(
            'header' => 'Название заявки',
            'name' => 'request_name',
            'value' => '$data->Request->name'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'options' => array(
                        'class' => 'fa fa-search admin-grid-view'
                    )
                )
            )
        ),
    )
));
