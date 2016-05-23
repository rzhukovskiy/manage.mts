<?php
$this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $DataProvider,
    'summaryText' => '',
    'columns' => array(
        array(
            'header' => 'Имя пользователя',
            'name' => 'username'
        ),
        array(
            'class' => 'CButtonColumn',
            'htmlOptions' => array('style' => 'text-align: center; width: 90px;'),
            'template' => '{delete}{update}{login}',
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
                'login' => array(
                    'label' => '',
                    'imageUrl' => false,
                    'url' =>'Yii::app()->createUrl("employee/login", array("id"=>$data->id))' ,
                    'options' => array(
                        'class' => 'fa fa-user admin-grid-login'
                    )
                )
            )
        ),
    )
));
