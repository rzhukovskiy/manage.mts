<div class="container">

<div class="page-header">
    <h1 class="text-center hidden">ЗАЯВКА ДЛЯ ШИНОМОНТАЖА</h1>
    <img src="./img/top4.png" alt="заявка для шиномонтажа"/>
</div>

<form accept-charset="UTF-8" class="wash-form" method="post" role="form">
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <div class="form-group">
                <label><strong>Название организации</strong></label><span class="error">Заполните поле название</span>
                <input class="form-control" name="name">
            </div>
            <div class="form-group">
                <label><strong>Индекс</strong></label><span class="error">Заполните поле индекс</span>
                <input class="form-control" name="index">
            </div>
            <div class="form-group">
                <label><strong>Город</strong></label><span class="error">Заполните поле город</span>
                <input class="form-control" name="city">
            </div>
            <div class="form-group">
                <label><strong>Улица</strong></label><span class="error">Заполните поле улица</span>
                <input class="form-control" name="street">
            </div>
            <div class="form-group">
                <label><strong>Номер строения</strong></label><span class="error">Заполните поле номер строения</span>
                <input class="form-control" name="house">
            </div>
            <div class="form-group">
                <label><strong>Телефон</strong></label><span class="error">Заполните поле телефон</span>
                <input class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label><strong>Часы работы</strong></label><span class="error">Заполните поле часы работы</span>
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

        <div class="col-md-5 tires">
            <p class=""><strong>Прочтите внимательно инструкцию!</strong></p>

            <p class="">Для того, чтобы мы могли начать сотрудничество в кратчайшие сроки, просим предоставить максимально полную и точную информацию:</p>

            <p class="">Укажите название Вашей организации.</p>

            <p class="">Адрес – укажите точный адрес нахождения вашего шиномонтажа и номер телефона (администратора), по которому производится запись ТС.</p>

            <p class="">ФИО – укажите данные руководителя и сотрудника, отвечающего за договорную работу.</p>

            <p class="">E-mail – укажите адрес электронной почты для постоянной связи.</p>

            <p class="">Телефон – укажите контактные номера телефонов.</p>

            <p class="">Укажите услуги, которые вы оказываете (нужно поставить галочку в белом квадратике).</p>

            <p class="">Укажите для какого вида ТС вы производите шиномонтаж (нужно поставить галочку в белом квадратике)</p>

            <p class="">Укажите для какого вида ТС у вас имеются шины и диски в продаже.</p>

            <p class="">Укажите названия и телефоны 2,3-х организаций, транспорт которых обслуживается у вас (для получения рекомендаций)</p>

            <p class="">
                Скачайте наш типовой договор
                <a href="files/tires.doc" target="_blank"><button type="button" class="btn btn-primary">Скачать договор</button></a>
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
                <label>ФИО</label><span class="error">Заполните поле ФИО</span>
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
        <div class="col-md-offset-1 col-md-5">
            <div class="items">
                <div class="form-group row">
                    <label><strong>Услуги, которые Вы оказываете:</strong></label>
                </div>
                <div>
                    <div class="checkbox size2">
                        <input name="tire" type="checkbox" id="tire">
                        <label for="tire">
                            Шиномонтаж
                        </label>
                        <input name="sell-tires" type="checkbox" id="sell-tires">
                        <label for="sell-tires">
                            Продажа шин
                        </label>
                        <input name="sell-discs" type="checkbox" id="sell-discs">
                        <label for="sell-discs">
                            Продажа дисков
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="items">
                <div class="form-group row">
                    <label><strong>Для какого вида ТС Вы производите шиномонтаж:</strong></label>
                </div>
                <div>
                    <div class="checkbox size2">
                        <input name="tires-car" type="checkbox" id="tires-car">
                        <label for="tires-car">
                            Легковой
                        </label>
                        <input name="tires-truck" type="checkbox" id="tires-truck">
                        <label for="tires-truck">
                            Грузовой
                        </label>
                        <input name="tires-tech" type="checkbox" id="tires-tech">
                        <label for="tires-tech">
                            Спецтехника
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <div class="items">
                <div class="form-group row">
                    <label><strong>Организации, которые обслуживаются у вас:</strong></label>
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

                <div class="form-group multiple-form-group row" style="margin-top: -10px;">
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

        <div class="col-md-5">
            <div class="items">
                <div class="form-group row">
                    <label><strong>Для какого вида ТС у Вас имеются шины и диски:</strong></label>
                </div>
                <div>
                    <div class="checkbox size2">
                        <input name="disc-car" type="checkbox" id="disc-car">
                        <label for="disc-car">
                            Легковой
                        </label>
                        <input name="disc-truck" type="checkbox" id="disc-truck">
                        <label for="disc-truck">
                            Грузовой
                        </label>
                        <input name="disc-tech" type="checkbox" id="disc-tech">
                        <label for="disc-tech">
                            Спецтехника
                        </label>
                    </div>
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
