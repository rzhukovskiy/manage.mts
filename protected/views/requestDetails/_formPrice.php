<?php
/**
 * @var $this RequestController
 * @var $form CActiveForm
 * @var $Request Request
 * @var $Price RequestPrice
 */
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'action-form',
    'action' => [Yii::app()->createUrl("/requestDetails/addPrice", ['id' => $Request->id])],
    'errorMessageCssClass' => 'help-inline',
    'htmlOptions' => array('class' => 'stdform'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true),
));
$Price = new RequestPrice();
?>
<table class="items table table-bordered table-condensed">
    <tr>
        <td>
            <?=$form->dropDownList($Price, 'type', CHtml::listData(Type::model()->findAll(array('order' => 'id')), 'name', 'name'), ['class' => 'form-control']); ?>
        </td>
        <td>
            <?=$form->textField($Price, 'price_outside', ['class' => 'form-control']); ?>
        </td>
        <td>
            <?=$form->textField($Price, 'price_inside', ['class' => 'form-control']); ?>
        </td>
        <td>
            <?=CHtml::submitButton('Добавить', array('class' => 'btn btn-primary')); ?>
        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<!-- form -->
