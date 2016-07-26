<?php /** @var $model Request */
?>

<table id="request-general-params" class='table table-bordered table-hover'>
    <tr>
        <th>Название</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'name',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Название",
                    'title' => 'Название',
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Адрес организации</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'address_city',
                    'title' => 'Город',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Город"
                )
            );

            echo ', ';


            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'address_street',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Улица",
                    'title' => 'Улица',
                )
            );

            echo ', ';

            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'address_house',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Дом",
                    'title' => 'Дом',
                )
            );

            echo ', ';

            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'address_index',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Индекс",
                    'title' => 'Индекс',
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <?php if ($model->RequestWash === null) { ?>
            <th>Телефон</th>
        <?php } else { ?>
            <th>Телефон для записи на мойку</th>
        <?php } ?>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'address_phone',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Телефон",
                    'title' => 'Телефон',
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Часы работы</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'time_from',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "От",
                    'title' => 'От',
                )
            );

            echo " - ";

            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'text',
                    'model' => $model,
                    'attribute' => 'time_to',
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "До",
                    'title' => 'До',
                )
            );
            ?>
        </td>
    </tr>
    <tr>
        <th>Временная зона</th>
        <td>
            <?php
            $this->widget(
                'booster.widgets.TbEditableField',
                array(
                    'type' => 'select',
                    'model' => $model,
                    'attribute' => 'address_timezone',
                    'source' => Timezone::getTimeZones(),
                    'url' => $this->createUrl('request/updateDetails'),
                    'emptytext' => "Временная зона",
                    'title' => 'Временная зона',
                )
            );
            ?>
        </td>
    </tr>
    <?php if ($model->state == Request::STATE_PROCESS || $model->state == Request::STATE_NEW) { ?>
        <tr>
            <th>Статус клиента</th>
            <td>
                <?php
                $this->widget(
                    'booster.widgets.TbEditableField',
                    array(
                        'type' => 'textarea',
                        'model' => $model,
                        'attribute' => 'status',
                        'url' => $this->createUrl('request/updateDetails'),
                        'emptytext' => "Статус клиента",
                        'title' => 'Статус клиента',
                    )
                );
                ?>
            </td>
        </tr>
        <tr>
            <th>Номер почтового отправления</th>
            <td>
                <?php
                $this->widget(
                    'booster.widgets.TbEditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'mail_number',
                        'url' => $this->createUrl('request/updateDetails'),
                        'emptytext' => "Номер отправления",
                        'title' => 'Номер отправления',
                    )
                );
                ?>
            </td>
        </tr>
        <tr>
            <th>Дата следующей связи</th>
            <td>
                <?php
                $this->widget(
                    'booster.widgets.TbDateTimePicker',
                    array(
                        'model' => $model,
                        'name' => 'next_communication_date',
                        'value' => $model->next_communication_date ? date('d.m.Y H:i', strtotime($model->next_communication_date)) : '',
                        'options' => array(
                            'language' => 'ru',
                            'showClear' => false,
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy hh:ii',
                            'todayHighlight' => true,
                        ),
                        'events' => [
                            'changeDate' => 'js: function(event, reason) {
                                    var dateAsObject = $(this).data("datetimepicker").getDate();
                                    var formatted = dateAsObject.getFullYear() + "-"
                                        + (dateAsObject.getMonth() + 1) + "-"
                                        + dateAsObject.getDate() + " "
                                        + dateAsObject.getHours() + ":"
                                        + dateAsObject.getMinutes() + ":00";
                                    $.post("' . $this->createUrl('request/updateDetails') . '", {
                                        name: "next_communication_date",
                                        value: formatted,
                                        pk: ' . $model->id . ',
                                        scenatio: "update" })
                                }'
                        ],
                    )
                );
                ?>
            </td>
        </tr>
    <?php } ?>
</table>