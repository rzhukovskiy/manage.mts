<div class="container">

    <div class="page-header">
        <h1 class="text-center hidden">ЗАЯВКА НА МОЙКУ</h1>
        <img class="small" src="./img/mts_zayavka_shapka.png" alt="заявка на мойку"/>
    </div>

    <form accept-charset="UTF-8" class="wash-form" method="post" role="form">
        <div class="row">
            <div class="col-md-offset-1 col-md-5">
                <div class="form-group">
                    <label>ФИО</label><span class="error">Заполните поле ФИО</span>
                    <input class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Компания</label><span class="error">Заполните поле Компамния</span>
                    <input class="form-control" name="firm">
                </div>
                <div class="form-group">
                    <label>E-mail</label><span class="error">Заполните поле E-mail</span>
                    <input class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Телефон</label><span class="error">Заполните поле Телефон</span>
                    <input class="form-control" name="phone">
                </div>
                <div class="form-group">
                    <label>Города</label><span class="error">Заполните поле Города</span>
                    <input class="form-control" name="city">
                </div>

                <div class="">
                    <!-- Start EasyHtml5Video.com BODY section -->
                    <style type="text/css">.easyhtml5video .eh5v_script{display:none}</style>
                    <div class="easyhtml5video" style="position:relative;max-width:1280px;">
                        <video controls="controls"  poster="img/video1.jpg" style="width:100%" title="video">
                            <source src="files/video1.m4v" type="video/mp4" />
                            <source src="files/video1.webm" type="video/webm" />
                            <source src="files/video1.ogv" type="video/ogg" />
                            <source src="files/video1.mp4" />
                            <object type="application/x-shockwave-flash" data="eh5v.files/html5video/flashfox.swf" width="1280" height="768" style="position:relative;">
                                <param name="movie" value="files/flashfox.swf" />
                                <param name="allowFullScreen" value="true" />
                                <param name="flashVars" value="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=img/video1.jpg&amp;src=video1.m4v" />
                                <embed src="files/flashfox.swf" width="1280" height="768" style="position:relative;"  flashVars="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=eh5v.files/html5video/video1.jpg&amp;src=video1.m4v"	allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
                                <img alt="video" src="files/video1.jpg" style="position:absolute;left:0;" width="100%" title="Video playback is not supported by your browser" />
                            </object>
                        </video>
                        <script src="js/html5ext.js" type="text/javascript"></script>
                        <!-- End EasyHtml5Video.com BODY section -->
                    </div>
                </div>
            </div>

            <div class="col-md-5" style="font-size: 16px">
                <p class=""><strong>Прочтите внимательно инструкцию!</strong></p>

                <p class="">Для того, чтобы мы могли сделать вам наиболее выгодное предложение, просим предоставить максимально полную и точную информацию:</p>

                <p class="">ФИО – укажите данные сотрудника, отвечающего за

                    направление транспорта</p>

                <p class="">Компания – укажите название вашей компании</p>

                <p class="">E-mail – укажите адрес электронной почты для постоянной

                    связи</p>

                <p class="">Телефон – укажите контактный телефон</p>

                <p class="">Города – укажите через запятую названия городов, в которых

                    Вам было бы интересно получить сервис для вашего

                    грузового транспорта</p>

                <p class="">Марка, Вид, Количество ТС – укажите состав вашего парка

                    грузового транспорта</p>

                <p class="">Также просим обратить внимание на видео-материал, в

                    котором подробно показана система нашей работы на

                    примере услуги “Грузовая Автомойка”.</p>

                <p class="">Отправьте заполненную заявку, и мы свяжемся с вами в ближайшее время.</p>

                <br />
            </div>
        </div>

        <br/>
        <div class="col-md-offset-1 row">
            <div class="col-md-11 items">
                <div class="form-group multiple-form-group row example" style="display: none;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Марка ТС</label>
                            <input type="text" class="form-control input-one" name="Request[model][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Вид ТС</label>

                            <div class="">
                                <div class="input-group"><input class="form-control" value="" type="text"
                                                                name="Request[type][]"><span class="input-group-btn"><button
                                            class="btn btn-default form-control btn-ts-modal btn-edit" data-toggle="modal"
                                            data-target="#ts_modal"><span class="glyphicon glyphicon-pencil"></span>
                                        </button></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Количество</label>

                            <div class="">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number btn-first" disabled="disabled"
                                            data-type="minus" data-field="Request[amount][]">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                    <input type="text" name="Request[amount][]" class="form-control input-number text-center"
                                           value="1"
                                           min="1" max="10">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number btn-last" data-type="plus"
                                            data-field="Request[amount][]">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-4">
                        <div class="form-group">
                            <label>Стоимость 1 единицы</label>

                            <div class="">
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-one" placeholder="Снаружи"
                                           name="Request[price_outside][]">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-one" placeholder="Внутри"
                                           name="Request[price_inside][]">
                                </div>
                            </div>
                        </div>
                    </div>!-->
                </div>

                <div class="form-group multiple-form-group row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Марка ТС</label>
                            <input type="text" class="form-control input-one" name="Request[model][]">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Вид ТС</label>

                            <div class="">
                                <div class="input-group"><input class="form-control" value="" type="text"
                                                                name="Request[type][]"><span class="input-group-btn"><button
                                            class="btn btn-default form-control btn-ts-modal btn-edit" data-toggle="modal"
                                            data-target="#ts_modal"><span class="glyphicon glyphicon-pencil"></span>
                                        </button></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Количество</label>

                            <div class="">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number btn-first" disabled="disabled"
                                            data-type="minus" data-field="Request[amount][]">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                    <input type="text" name="Request[amount][]" class="form-control input-number text-center"
                                           value="1"
                                           min="1" max="10000">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number btn-last" data-type="plus"
                                            data-field="Request[amount][]">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-4">
                        <div class="form-group">
                            <label>Стоимость 1 единицы</label>

                            <div class="">
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-one" placeholder="Снаружи"
                                           name="Request[price_outside][]">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-one" placeholder="Внутри"
                                           name="Request[price_inside][]">
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <button type="button" class="btn btn-primary btn-remove" title="Убрать автомобиль">-</button>
                <button type="button" class="btn btn-primary btn-add" title="Добавить автомобиль">+</button>
            </div>
        </div>
        <br>
        <br>

        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </form>

    <div class="modal fade-in" id="ts_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">x</span></button>
                    <h4 class="modal-title">Выберите вид транспортного средства</h4>
                </div>
                <div class="modal-body">

                    <button class="btn text-center btn-ts-select">
                        <img src="./img/one.png">
                        <h6>Одиночка</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/one_pr.png">
                        <h6>Тандем (одиночка + прицеп)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/fura.png">
                        <h6>Фура (европеец + полуприцеп)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/fura_am.png">
                        <h6>Фура (американец + полуприцеп)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/one_bo.png">
                        <h6>Одиночка бортовая</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/tandem.png">
                        <h6>Тандем бортовой (одиночка + прицеп)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/fura_bo.png">
                        <h6>Фура (американец + полуприцеп бортовой)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/fura_eu.png">
                        <h6>Фура (европеец + полуприцеп бортовой)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/one_boch.png">
                        <h6>Одиночка бочка</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/fura_boch.png">
                        <h6>Фура (европец + полуприцеп бочка)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/fura_am_boch.png">
                        <h6>Фура (американец + полуприцеп бочка)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/skot.png">
                        <h6>Фура (европеец + полуприцеп скотовозка)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/skotovoz_american.jpg">
                        <h6>Фура (американец + полуприцеп скотовозка)</h6>
                    </button>

                    <button class="btn text-center btn-ts-select">
                        <img src="./img/sam.png">
                        <h6>Самосвал одиночка</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/mix.png">
                        <h6>Миксер одиночка</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/cem.png">
                        <h6>Фура (европеец + полуприцеп цементовоз)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/ton.png">
                        <h6>Тонар (европеец + полуприцеп самосвал)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/ton_am.png">
                        <h6>Тонар (американец + полуприцеп самосвал)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/kr.png">
                        <h6>Кран</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/kr_b.png">
                        <h6>Кран большои</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/buch.png">
                        <h6>Бычок (подобные по размеру)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/ga.png">
                        <h6>Газель (подобные по размеру)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/pi.png">
                        <h6>Пирожок (подобные по размеру)</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/sedan.jpg">
                        <h6>Легковая</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/offroad.jpg">
                        <h6>Внедорожник</h6>
                    </button>
                    <button class="btn text-center btn-ts-select">
                        <img src="./img/miniwan.jpg">
                        <h6>Микроавтобус</h6>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
