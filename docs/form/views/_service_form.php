<div class="container">

<div class="page-header">
    <h1 class="text-center hidden">ЗАЯВКА ДЛЯ СЕРВИСА</h1>
    <img src="./img/top3.png" alt="заявка для сервиса"/>
</div>

<form accept-charset="UTF-8" class="wash-form" method="post" role="form">
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <div class="form-group">
                <label>Название организации</label><span class="error">Заполните поле название</span>
                <input class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Индекс</label><span class="error">Заполните поле индекс</span>
                <input class="form-control" name="index">
            </div>
            <div class="form-group">
                <label>Город</label><span class="error">Заполните поле город</span>
                <input class="form-control" name="city">
            </div>
            <div class="form-group">
                <label>Улица</label><span class="error">Заполните поле улица</span>
                <input class="form-control" name="street">
            </div>
            <div class="form-group">
                <label>Номер строения</label><span class="error">Заполните поле номер строения</span>
                <input class="form-control" name="house">
            </div>
            <div class="form-group">
                <label>Телефон</label><span class="error">Заполните поле телефон</span>
                <input class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label>Часы работы</label><span class="error">Заполните поле часы работы</span>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>От</label>
                        <input type="text" class="form-control input-one" name="time-from">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>До</label>
                        <input type="text" class="form-control input-one" name="time-to">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <p class=""><strong>Прочтите внимательно инструкцию!</strong></p>

            <p class="">Для того, чтобы мы могли начать сотрудничество в кратчайшие сроки, просим предоставить максимально полную и точную информацию:</p>

            <p class="">Укажите название Вашей организации.</p>

            <p class="">Адрес – укажите точный адрес нахождения вашего автосервиса и номер телефона (мастера-приемщика), по которому производится запись ТС</p>

            <p class="">ФИО – укажите данные руководителя и сотрудника, отвечающего за договорную работу</p>

            <p class="">E-mail – укажите адрес электронной почты для постоянной связи</p>

            <p class="">Телефон – укажите контактные номера телефонов</p>

            <p class="">Укажите нормо-часы на основные виды работ</p>

            <p class="">Укажите марки грузовых автомобилей, которые вы обслуживаете. Если вы являетесь официальными дилерами каких-либо марок ТС, просим также указать их названия через запятую</p>

            <p class="">Укажите названия и телефоны 2,3-х организаций, транспорт которых обслуживается у вас (для получения рекомендаций)</p>

            <p class="">
                Скачайте наш типовой договор
                <a href="files/service.doc" target="_blank"><button type="button" class="btn btn-primary">Скачать договор</button></a>
                Мы работаем по данному договору на всех станциях ТО, на которых получаем услуги автосервиса. При возникновении вопросов - можете составить протокол разногласий или обсудить интересующие вас пункты с нашим специалистом
            </p>

            <p class="">Отправьте заполненную анкету, и мы свяжемся с вами в ближайшее время</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <div class="form-group clearfix">
                <label><strong>Директор</strong></label>
            </div>
            <div class="form-group">
                <label>ФИО</label><span class="error">Заполните поле ФИО  директора</span>
                <input class="form-control" name="director-name">
                <input type="hidden" name="director-position" value="Директор" />
            </div>
            <div class="form-group">
                <label>Телефон</label><span class="error">Заполните поле Телефон директора</span>
                <input class="form-control" name="director-phone">
            </div>
            <div class="form-group">
                <label>E-mail</label><span class="error">Заполните поле E-mail директора</span>
                <input class="form-control" name="director-email">
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label><strong>Ответственный за договорную работу</strong></label>
            </div>
            <div class="form-group">
                <label>ФИО</label><span class="error">Заполните поле ФИОа</span>
                <input class="form-control" name="doc-name">
                <input type="hidden" name="doc-position" value="Ответственный за договор" />
            </div>
            <div class="form-group">
                <label>Телефон</label><span class="error">Заполните поле Телефон</span>
                <input class="form-control" name="doc-phone">
            </div>
            <div class="form-group">
                <label>E-mail</label><span class="error">Заполните поле E-mail</span>
                <input class="form-control" name="doc-email">
            </div>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="form-group">
                <label>Укажите марки ТС, которые вы обслуживаете как официальные дилеры и/или как неофициальные дилеры</label>
            </div>
        </div>
        <div class="col-md-offset-1 col-md-5">
            <div class="form-group">
                <label>Официальный дилер</label>
                <input class="form-control" name="official">
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label>Неофициальный дилер</label>
                <input class="form-control" name="nonofficial">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <div class="items">
                <div class="form-group row">
                    <label>Нормо-час на основные виды работ:</label>
                </div>

                <div class="form-group multiple-form-group row example" style="display: none;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Вид работ</label>
                            <input type="text" class="form-control input-one" name="Work[type][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Нормо-час</label>
                            <input type="text" class="form-control input-one" name="Work[norm][]">
                        </div>
                    </div>
                </div>

                <div class="form-group multiple-form-group row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Вид работ</label>
                            <input type="text" class="form-control input-one" name="Work[type][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Норма часа</label>
                            <input type="text" class="form-control input-one" name="Work[norm][]">
                        </div>
                    </div>
                </div>

                <div class="form-group multiple-form-group row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Вид работ</label>
                            <input type="text" class="form-control input-one" name="Work[type][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Норма часа</label>
                            <input type="text" class="form-control input-one" name="Work[norm][]">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-11">
                    <button type="button" class="btn btn-primary btn-remove" title="Убрать организацию">-</button>
                    <button type="button" class="btn btn-primary btn-add" title="Добавить организацию">+</button>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="items">
                <div class="form-group row">
                    <label>Организации, транспорт которых обслуживается у вас:</label>
                </div>

                <div class="form-group multiple-form-group row example" style="display: none;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" class="form-control input-one" name="Client[name][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="text" class="form-control input-one" name="Client[phone][]">
                        </div>
                    </div>
                </div>

                <div class="form-group multiple-form-group row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" class="form-control input-one" name="Client[name][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="text" class="form-control input-one" name="Client[phone][]">
                        </div>
                    </div>
                </div>

                <div class="form-group multiple-form-group row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" class="form-control input-one" name="Client[name][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="text" class="form-control input-one" name="Client[phone][]">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-11">
                    <button type="button" class="btn btn-primary btn-remove" title="Убрать организацию">-</button>
                    <button type="button" class="btn btn-primary btn-add" title="Добавить организацию">+</button>
                </div>
            </div>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="row">
                <div class="col-md-11">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /.modal -->

</div>
