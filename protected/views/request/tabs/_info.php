<table id="request-general-params" class='table table-bordered table-hover'>
    <tr>
        <th>Официальный адрес эл. почты</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'email',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "эл. почта"
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Адрес для почтового отправления</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'textarea',
                    'model' => $model,
                    'attribute' => 'address_mail',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Адрес"
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Банковские дни оплаты по договору</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'textarea',
                    'model' => $model,
                    'attribute' => 'payment_day',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Дни оплаты"
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Номер договора</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'agreement_number',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "№ договора"
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Дата заключения договора</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'date',
                    'model' => $model,
                    'attribute' => 'agreement_date',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Дата"
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Скан договора</th>
        <td>
            <input type="file" data-id="<?php echo $model->id; ?>" id="agreement_file" />
            <div id="request-agreement-file-block">
                <?php if ($model->agreement_file != null) { ?>
                    <i class="fa fa-file"></i>
                    <a href="#" id="request-agreement-file-link" data-request-id="<?php echo $model->id; ?>"><?php echo $model->agreement_file; ?></a>
                <?php } ?>
            </div>
        </td>
    </tr>
</table>
