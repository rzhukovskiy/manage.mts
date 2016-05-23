<div class="container">

<div class="page-header">
    <h1 class="text-center hidden">ЗАЯВКА ДЛЯ МОЙКИ</h1>
    <img src="./img/top2.png" alt="заявка для мойки"/>
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

            <p class="">Укажите название Вашей организации</p>

            <p class="">Адрес – укажите точный адрес нахождения автомойки и номер телефона (администратора), по которому производится запись</p>

            <p class="">ФИО – укажите данные руководителя и сотрудника, отвечающего за договорную работу</p>

            <p class="">E-mail – укажите адрес электронной почты для постоянной связи</p>

            <p class="">Телефон – номер телефона для записи на мойку</p>

            <p class="">Укажите названия 2,3-х организаций, транспорт которых обслуживается у вас (для получения рекомендаций)</p>

            <p class="">Просмотрите видео, которое находится внизу страницы. По представленной на видео системе мы работаем во всех странах, в которых получаем услуги автомойки</p>

            <p class="">
                Скачайте наш типовой договор
                <a href="files/wash.doc" target="_blank"><button type="button" class="btn btn-primary">Скачать договор</button></a>
                Он также единый. При возникновении вопросов - можете составить протокол разногласий или обсудить интересующие вас пункты с нашим специалистом
            </p>

            <p class="">В договоре находится приложение №1, в котором указаны вид ТС и услуги, интересующие нас. Просим также ознакомиться и заполнить его</p>

            <p class="">Отправьте заполненную анкету, и мы свяжемся с вами в ближайшее время.</p>
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

    <div class="row">
        <div class="col-md-offset-1 col-md-5">
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
            <br/>
            <div class="row">
                <div class="col-md-11">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <!-- Start EasyHtml5Video.com BODY section -->
            <style type="text/css">.easyhtml5video .eh5v_script{display:none}</style>
            <div class="easyhtml5video" style="position:relative;max-width:1280px;">
                <video controls="controls" poster="./img/video.jpg" style="width:100%" title="video">
                    <source src="files/video.m4v" type="video/mp4" />
                    <source src="files/video.webm" type="video/webm" />
                    <source src="files/video.ogv" type="video/ogg" />
                    <source src="files/video.mp4" />
                    <object type="application/x-shockwave-flash" data="eh5v.files/html5video/flashfox.swf" width="1280" height="768" style="position:relative;">
                        <param name="movie" value="files/flashfox.swf" />
                        <param name="allowFullScreen" value="true" />
                        <param name="flashVars" value="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=img/video.jpg&amp;src=video.m4v" />
                        <embed src="files/flashfox.swf" width="1280" height="768" style="position:relative;"  flashVars="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=eh5v.files/html5video/video.jpg&amp;src=video.m4v"	allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
                        <img alt="video" src="files/video.jpg" style="position:absolute;left:0;" width="100%" title="Video playback is not supported by your browser" />
                    </object>
                </video>
                <script src="./js/html5ext.js" type="text/javascript"></script>
                <!-- End EasyHtml5Video.com BODY section -->
            </div>
        </div>
    </div>
</form>
<!-- /.modal -->

</div>
