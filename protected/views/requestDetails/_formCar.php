<?php
/**
 * @var $this RequestController
 * @var $form CActiveForm
 * @var $Request Request
 * @var $Car RequestCompanyListAuto
 */
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'action-form',
    'action' => [Yii::app()->createUrl("/requestDetails/addCar", ['id' => $Request->id])],
    'errorMessageCssClass' => 'help-inline',
    'htmlOptions' => array('class' => 'stdform'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true),
));
$Car = new RequestCompanyListAuto();
?>
<table class="items table table-bordered table-condensed">
    <tr>
        <td>
            <?=$form->dropDownList($Car, 'type', CHtml::listData(Type::model()->findAll(array('order' => 'id')), 'name', 'name'), ['class' => 'form-control']); ?>
        </td>
        <td>
            <?=$form->dropDownList($Car, 'model', CHtml::listData(Mark::model()->findAll(array('order' => 'id')), 'name', 'name'), ['class' => 'form-control']); ?>
        </td>
        <td>
            <?=$form->textField($Car, 'state_number', ['class' => 'form-control']); ?>
        </td>
        <td>
            <?=CHtml::submitButton('Добавить', array('class' => 'btn btn-primary')); ?>
        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<!-- form -->
