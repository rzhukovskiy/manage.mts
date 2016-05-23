-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 20 2016 г., 09:36
-- Версия сервера: 5.6.23-1~dotdeb.1
-- Версия PHP: 5.6.17-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blog`
--

--
-- Дамп данных таблицы `mts_employee`
--

INSERT INTO `mts_employee` (`id`, `employee_group_id`, `username`, `password`, `salt`, `create_date`, `role`) VALUES
(7, 1, '1234', '558d133b6f563b7fa54a1e6f5298390e', 'z6hu2', '2016-04-10 07:17:07', 'admin'),
(12, 6, 'Евгения', '2341', '', '2016-04-10 16:54:56', 'employee'),
(16, 1, 'Арам', 'a907827024f797c8b144da4d753a63bf', 'ysdv6', '2016-04-12 19:56:41', 'employee'),
(17, 4, 'Григорий', 'ba6ea2a7dd028c3947004f56fd2808f0', 'qaxis', '2016-04-12 20:59:04', 'employee');

--
-- Дамп данных таблицы `mts_employee_group`
--

INSERT INTO `mts_employee_group` (`id`, `name`, `manage`) VALUES
(1, 'Мойка', 0),
(2, 'Сервис', 0),
(3, 'Шиномонтаж', 0),
(4, 'Региональный Директор', 1),
(6, 'Юрист', 0);

--
-- Дамп данных таблицы `mts_employee_group_archive_request_type`
--

INSERT INTO `mts_employee_group_archive_request_type` (`id`, `employee_group_id`, `service`, `tires`, `wash`, `company`) VALUES
(1, 1, 0, 0, 1, 1),
(2, 2, 1, 0, 0, 1),
(3, 6, 0, 0, 0, 0),
(4, 4, 1, 1, 1, 1),
(5, 3, 0, 1, 0, 1),
(6, 5, 0, 0, 0, 0);

--
-- Дамп данных таблицы `mts_employee_group_request_type`
--

INSERT INTO `mts_employee_group_request_type` (`id`, `employee_group_id`, `service`, `tires`, `wash`, `company`) VALUES
(1, 1, 0, 0, 1, 1),
(2, 2, 1, 0, 0, 0),
(3, 6, 1, 0, 0, 0),
(4, 4, 1, 1, 1, 1),
(5, 3, 0, 1, 0, 0),
(6, 5, 0, 0, 0, 1);

--
-- Дамп данных таблицы `mts_request`
--

INSERT INTO `mts_request` (`id`, `new`, `name`, `address_timezone`, `address_index`, `address_city`, `address_street`, `address_house`, `address_phone`, `address_mail`, `time_from`, `time_to`, `director_name`, `director_email`, `director_phone`, `doc_name`, `doc_email`, `doc_phone`, `next_communication_date`, `payment_day`, `email`, `agreement_number`, `agreement_date`, `agreement_file`, `status`) VALUES
(30, 0, 'test', '0', 'dfg', 'sdf', 'asfd', 'dfg', 'dhg', NULL, '00:00:34', '00:00:22', 'wer', 'yht', 'ert', 'fgh', 'khj', 'jhg', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 0, '12', 'Asia/Chita', '356482', '2', '3', '4', '5', NULL, '00:00:43', '00:00:08', '7', '8', '6', '12', '14', '13', '2016-05-02', NULL, NULL, NULL, NULL, 'main.js', NULL),
(32, 0, 'ghjhg', '3', 'ghjh', 'fgjh', 'hgj', 'ghj', 'ghgfh', NULL, '00:00:00', '00:00:00', 'ghj', 'ghj', 'hgj', 'hgj', 'hgj', 'hj', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 0, 'jhgj', '+3:00', 'fghg', 'dfgf', 'dfgf', 'h', 'fghgfh', NULL, '00:00:34', '00:02:34', 'wer', 'ert', 'wet', 'ert', 'ert', 'ert', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 0, 'Название организации', 'Europe/Moscow', 'Индекс', 'Город', 'Улица', 'Номер строения', 'Телефон', NULL, '09:00:00', '17:00:00', 'Директор ФИО', 'Директор E-mail', 'Директор Телефон', 'Ответственный за договорную работу ФИО', 'Ответственный за договорную рабо', 'Ответственный за', '2016-05-05', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 0, 'ООО "Петров"', 'Europe/Moscow', '394040', 'г. Воронеж', ' ул. Лесная', ' д. 36', '8 920 443 22 22', 'ул. Дорожная 15', '12:00', '22:00', 'Кирил', 'mtransservice@mail.ru', '8 920 221 08 55', 'Ольга Николаевна', 'mts@mail.ru', '222 36 36', '2016-05-26', '15', 'dsr@mail.ru', 'K15', '2016-05-25', 'Снимок экрана 2016-04-26 в 17.19.56.png', 'Сказал перезвонить 15 мая'),
(37, 0, 'Организация', 'Europe/Samara', 'индекс 345325', 'Воронеж', 'ул. Белая', 'дом 33', '2-56-89-44', 'trt rtgreg rfgf dgfdg f', '9 утра', '18 вечера', 'fghff', 'dfg', 'fghff', '111', 'fgh', 'dhdsfdfhjhj', '2016-05-03', 'fghgfhgfhgf', 'dsfdsf', '54543543', '2016-05-03', 'Правила клановых войн.odt', 'fgfgd'),
(38, 0, 'fdgf', 'Asia/Srednekolymsk', 'sdf', 'asd', 'gf', 'dgh', 'fgh', NULL, '00:00:00', '00:00:00', 'sdfg', 'asd', 'sdf', 'gfds', 'dh', 'dfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 0, 'fghgf', 'Europe/Moscow', 'hjghj', 'hjkljh', 'ghjkj', 'gfhgh', 'fghgfh', NULL, '00:00:00', '00:00:00', 'fgh', 'ghj', 'hgj', 'jhk', 'ghjk', 'kl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 0, 'ИП Енин', NULL, '394040', 'Воронеж', 'Острагожская', '73а', '39 20 20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 0, 'Новая компания', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 0, 'Новая компания', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 0, 'ИП Махмудов А.К.', NULL, '394063', 'Архангельск', 'Окружное шоссе', '11', '88182490909', NULL, 'Круглосуточно', NULL, 'Александр', 'flagman1976@yandex.ru', '88142474373', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 0, 'ИП Авалиани М.М.', NULL, NULL, 'Архангельск', 'Окружное шоссе ', '13', '88182441441', NULL, '09:00', '20:00', 'Цотне Альбертович', NULL, NULL, 'Олег', NULL, '89115544805', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 0, 'ВолгоТехСнаб', NULL, NULL, 'Астрахань', 'Фунтовское шоссе ', '9б', '88512213000', NULL, '08:00', '21:00', 'Ежов Игорь Владимирович', NULL, NULL, 'Кирил', 'kirill83@list.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 0, 'ИП Немцева Александра Павловна', NULL, NULL, 'Белгород', 'Переулок 5й Заводской ', '42в', NULL, NULL, NULL, NULL, 'Немцева Александра Павловна', NULL, NULL, 'Немцев Андрей Николаевич', ' a.nemcev@bk.ru', ' 8 910 322 15 00', NULL, NULL, NULL, NULL, NULL, 'Претензия0005.jpg', NULL),
(53, 0, 'МОЙКА ТИР', NULL, NULL, 'Брянск', 'Трасса "Брянск - Орел"д. Масловка пер. Первомайский 14 (200 м. от трассы)', NULL, ' 8953-277-5520', NULL, 'Круглосуточно', NULL, 'Стаценко Артем Игоревич  ', NULL, NULL, 'Роман', '777gufimtsru@mail.ru', '89208318504', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 0, 'Агат', NULL, NULL, 'Волгоград', 'ул.Домостроителей', '13', '88442264626', NULL, '08:00', '22:00', 'Вегера Игорь', 'i.vegera@agatgroup.com', '89616657722', 'Ольга', NULL, '89954063312', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 0, 'ИП Погорелов А.', NULL, NULL, 'Волгоград', 'ул. Гремячинская ', '78', '8 844 250 22 34', NULL, '08:00', '22:00', 'Погорелов Андрей Генадьевич', NULL, NULL, 'Керим Шакунова Юлия', 'yul79303067@yandex.ru', '89272589698', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 0, 'Вологда трак сервис', NULL, NULL, 'Вологда', 'Окружное ш-се', ' 9б', NULL, NULL, '08:00', '21:00', NULL, NULL, NULL, 'Андрей', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 0, 'автоком вологда', NULL, NULL, 'Вологда', 'Московское ш-се', 'д 6', NULL, NULL, '09:00', '21:00', NULL, NULL, NULL, 'Валерий', 'srv@vologda-avto.com', '89315080546', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 0, 'ИП Коршунов Д.В.', NULL, '', 'Долгопрудный', 'мкр. Хлебниково Госпитальная ', '1б', '8 926 184 58 20', NULL, 'Круглосуточно', NULL, 'Коршунов Дмитрий Викторович', 'dim222nt@yandex.ru', '8 925 383 79 86', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 0, 'ИП Еремеев', NULL, NULL, 'Екатеринбург', 'ул. Монтажников ', '22а', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 0, 'ООО"ЛИДЕР"', NULL, NULL, 'Екатеринбург', 'п.АРАМИЛЬ,пер.РЕЧНОЙ ', '2б', '89222096019', NULL, NULL, NULL, 'ИСАЕВ А.Ю.', NULL, NULL, 'Людмила Сидорова', 'luk.444@mail.ru', '89221317305', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 0, 'Новая компания', NULL, NULL, 'Иркутск', NULL, NULL, '8(902) 566-76-91', NULL, NULL, NULL, 'Татаринов Алексей Анатольевич ', 'rus_38@rambler.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 0, 'ИП Малофеева', NULL, NULL, 'Калуга', 'ул. Московская ', '292', '89005801943', NULL, '08:00', '22:00', 'Виктория', '89533105601@yandex.ru', '89533105601', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 0, 'ИП Мильков', NULL, NULL, 'Киров', 'Автотранспортный переулок ', '4', '883327084', NULL, '08:00', '20:00', 'Мильков Владимир Сергеевич ', NULL, NULL, 'Владимир', 'vova8383@bk.ru', '89195132004', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 0, 'ИП Богова', NULL, NULL, 'Кстово', 'с.Шолокша  ,Нефтезавод Лукойл', NULL, '89051910100', NULL, NULL, NULL, 'Валерий', 'nefteprodukt999@mail.ru', '89051910100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 0, 'Гостинечный комплекс Россия', NULL, NULL, 'Кузнецк', 'По Московскому шоссе', NULL, NULL, NULL, 'Круглосуточно', NULL, 'Татьяна', NULL, NULL, 'Наталья', 'Russiam5@mail.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 0, 'ООО”Радиал-Сервис” ', NULL, NULL, 'Курск', 'ул.Энгельса 142б карла маркса 73 на выезд на москву,по обьездной километр назад ул светлая', NULL, '84712532388', NULL, '09:00', '18:00', 'Владимир Михайлович', NULL, NULL, '  Шелухин Александр Николаевич ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 0, 'ИП Захаров', NULL, NULL, 'Курск', 'Чайковского ', '27а', NULL, NULL, 'Круглосуточно', NULL, 'ЗАХАРОВ СЕРГЕЙ НИКОЛАЕВИЧ', 'stozaharov@rambler.ru', '89107300333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 0, 'ООО "ТопМастерКазань"', NULL, NULL, 'Казань', 'Лаишевский р-н, с. Столбище ,Аэропортовская  ', '1а', '8843210-11-32', NULL, '08:30', '17:00', 'Потранин Николай Иванович', NULL, NULL, 'Гатауллина Айслу Наилевна', NULL, '89033149706', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0, 'ооо аквалайф', NULL, NULL, 'Казань', 'ул.Курчатова д.4,кв 13.ул.Аделя Кутуя ', '163а', '88432407888', NULL, 'Круглосуточно', NULL, 'Радик', 'ooo_akva_layv@mail.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 0, ' ООО "Атлика Сервис" ', NULL, NULL, 'Липецк', ' ул. Ферросплавная', '26', NULL, NULL, '08:00', '19:00', 'Ерохин Игорь Алексеевич', NULL, NULL, 'Эвелина Шипулина', 'Evship.avto@mail.ru', '8 906 683 24 67', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 0, '"На Лесной"', NULL, NULL, 'Липецк', 'ул.Лесная ', '2а', NULL, NULL, 'Круглосуточно', NULL, 'Шония Майа Бениевна', 'lesnaiy22@mail.ru', '8920-243-78-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0, 'ИП Семенчук АВ ', NULL, NULL, 'Ярославль', 'ул. Полушкина Роща', '5', '8 485 295 49 90', NULL, 'Круглосуточно', NULL, 'Семенчук А.В. ', NULL, NULL, 'Андрей', '954990@mail.ru', '8 910 975 32 36', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 0, 'ООО "АвтоРемЗапчасть"', NULL, NULL, 'Энгельс', 'пос.Пробуждения 4 (район ЗМК ООО "АвтоРемЗапчасть")', NULL, '89626198617', NULL, NULL, NULL, 'Максим Николаевич', NULL, NULL, 'Карпиков Николай Александрович', 'avtoremkm@mail.ru', '89658843579', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 0, '"КОМПЛЕКСНЫЕ РЕШЕНИЯ" ', NULL, NULL, 'Челябинск', 'ул. Копейское  шоссе ', 'д.58 б\\2', '8951-7777-122', NULL, '09:00', '21:00', 'Становов Сергей Анатольевич', 'K.R.74@BK.RU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 0, 'ООО "Авто Трак Сервис"', NULL, NULL, 'Чебоксары', 'Канашское шоссе ', 'д5', '88352325501', NULL, '08:00', '20:00', 'Яковлев Андрей Владимирович', NULL, NULL, 'Столяров Андрей', 'cam.21@mail.ru', '89033588459', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 0, 'ООО "Ари-Групп"', NULL, NULL, 'Уфа', 'Маршала Жукова', '14', '8 961 349 54 65', NULL, 'Круглосуточно', NULL, 'ОЛЕГ РЕЗЕДА', 'mihailov-oi@mail.ru', '8917-75-59-221', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 0, 'ООО «ТРАК-ЦЕНТР»', NULL, NULL, 'Уфа', '1492-ой км федеральной трассы М5 «Урал», возле д. Шакша (Иглинский район', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 0, 'ИП Погосян Андраник Арагацович', NULL, NULL, 'Ульяновск', 'трасса Сызрань-Цивильск (Нефтеразведка) ', NULL, '89176031328', NULL, NULL, NULL, 'Погосян Андраник Арагацович', NULL, NULL, 'Андрей', 'gdlyan@gmail.com', '89603722510', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 0, 'ИП Белокоз О.М.', NULL, '493080', 'Ульяновск', NULL, NULL, NULL, NULL, '08:00', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 0, 'ИП Артемова Татьяна Юрьевна', NULL, NULL, 'Тула', 'Новомосковское ш-се', 'д. 54', '8 4872 71 75 11', NULL, 'круглосуточно', NULL, 'Татьяна Юрьевна', 'info@profxim.ru', '89065324000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0, 'ООО "Универсалспецтех"', NULL, '625053', 'Тюмень', 'Варшавская', '22', NULL, NULL, 'круглосуточно', NULL, 'Минаев Александр Сергеевич', NULL, NULL, 'Богданов Станислав Викторович', 'oooust72@mail.ru', '89088736900', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 0, 'ИП Самохина Т.Ю.', NULL, NULL, 'Тула', 'ул.Сызранская', 'д.5', '7 4872 71 75 11', NULL, 'круглосуточно', NULL, 'Самохина Татьяна', 'info@profxim.ru', '89065324000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 0, 'ИП Сенников Александр Александрович', NULL, '634033', 'Томск', 'ул. Шевченко ', '49 б', NULL, NULL, 'круглосуточно', NULL, 'Сенников Александр Александрович', ' sennik82@mail.ru', '8-913-811-15-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 0, 'ООО "Авто-Тур"', NULL, ' 445017', 'Тольятти', 'Комсомольская ', '90', '79649700599', NULL, '08:00', '22:00', 'Куликов Вячеслав Олегович', NULL, '79631194174', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 0, 'ИП ЖЕЛТОВ М.Н.', NULL, NULL, 'Тверь', 'ул. Коминтерна', '71', ' 8 4822 76 07 24', NULL, 'круглосуточно', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 0, 'Бензингер', NULL, '70540', 'Тверь', 'Тверская обл., Калининский р-н, дер. Андрейково,162 километр трассы Москва - С.-Петербург', NULL, NULL, NULL, '08:00', '21:00', NULL, NULL, NULL, 'Олег трофимович', NULL, '8910-936-22-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 0, 'ООО "КАМАЗТЕХОБСЛУЖИВАНИЕ"', NULL, NULL, 'Тамбов', 'ул. Авиационная', 'д. 143 а', NULL, NULL, '08:00', '17:00 пн-пт', 'Юрий Викторович', NULL, NULL, 'Ирина Васнева', '           vasneva@tkamaz.ru', '8 4752 44 38 24', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 0, 'ООО "Дизель"', NULL, NULL, 'Тамбов', 'Трасса Москва -Волгоград 449 км', NULL, '9 910 757 01 11', NULL, 'Круглосуточно', NULL, 'Бакунин Павел Михайлович', 'bakunin.pavel@mail.ru', '9 915 872 72 00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 0, 'ООО "Дизель"', NULL, NULL, 'Тамбов', 'ул. Киквидзе', 'д. 69', '8 910 757 01 11', NULL, NULL, NULL, 'Бакунин Павел Михайлович', 'bakunin.pavel@mail.ru', '8 915 872 72 00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 0, ' ИП Скляр М. ', NULL, NULL, 'Ставрополь', '1-й Юго-Западный проезд, д.4', NULL, '8 8652 63 48 63', NULL, NULL, NULL, 'Скляр Мурад Григорьевич', 'moika26@bk.ru', '8 918 888 88 05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 0, 'ООО"Фламинго"', NULL, NULL, 'Саратов', NULL, NULL, NULL, NULL, 'круглосуточно', NULL, 'Александр', NULL, '89063150335', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 0, 'ИП НЕРЕДЬКО', NULL, NULL, 'Смоленск', 'ул. Шишкова', '91-а', NULL, NULL, 'круглосуточно', NULL, 'Сергей', NULL, NULL, 'СУЗДАЛЬЦЕВА МАРИНА', 'syzdal.marina@rambler.ru', '89109313891', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 0, 'ООО «Самарский Центр Грузовых Автомобилей»', NULL, NULL, 'Самара', 'ул. Олимпийская', '153', NULL, NULL, NULL, NULL, 'Белов С.А', 'info@cga.su', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 0, 'ООО БУМЕР', NULL, NULL, 'Самара', 'ул.Авроры д.150;      пр. Кирова 36;ул. Утёвская 20а (116км).', NULL, NULL, NULL, 'круглосуточно', NULL, 'Сырцов Владимир Владимирович', NULL, '89649771601', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 0, 'Фантом, тюнинг-центр', NULL, NULL, 'Самара', 'Новокуйбышевск, Молодогвардейская', '10а', NULL, NULL, 'Пн.-Пт. 09:00-18:01', NULL, 'Галина', 'tcfantom@mail.ru', '8-937-201-00-97', 'Константин', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 0, 'ООО "РУС АВТО"', NULL, '390006', 'Рязань', 'ул. Фирсова ', '29', NULL, NULL, NULL, NULL, 'Наталья', 'truck.service@ai.ryazan.ru', ' 8(930)888-95-33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 0, 'Новая компания', NULL, NULL, 'Ростов-на-Дону', NULL, NULL, NULL, NULL, NULL, NULL, 'Ольга', 'oliga_2904@mail.ru', '89281354442', 'Александр', 'a.denisova@mb-grifon.ru', '8-8633-03-05-65', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 0, ' ИП Беспалова Наталья Николаевна', NULL, NULL, 'Ростов-на-Дону', ' ул. Вавилова', '58', NULL, NULL, '08:00', '19:00', ' Беспалова Наталья Николаевна', NULL, NULL, 'Беспалов Сергей Васильевич', 'gruzmoyka@mail.ru', '89282792827', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 0, 'ООО "ДЭУ-М"', NULL, NULL, 'Петрозаводск', 'ул.Путейская', '5', '88142632726', NULL, 'круглосуточно', NULL, 'Сергей', NULL, NULL, 'Праневич Валерьян Александрович', 'csv70@mail.ru', '79062075555', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 0, 'Автомойка "Гейзер"', NULL, NULL, 'Петрозаводск', 'Шуйсское шоссе 8б,ст 6', NULL, '89217025847', NULL, '08:30', '20:00', 'Василий', NULL, NULL, 'Григорьев Михаил Юрьевич', 'fgeizer@mail.ru', '8921 727 31 56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 0, 'Автомойка 57', NULL, NULL, 'Орел', 'ул. Михалицына', 'д. 10', '8 4862 54 16 86', NULL, '08:00', '23:00', 'Закурдаева Ольга Вячеславовна', 'Moyka57@mail.ru', '8 919 207 23 26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 0, '"Элистрой"', NULL, NULL, 'Орел', ' ул. 5 Августа, д. 64а Литер Г Г1', NULL, '89807690352', NULL, 'круглосуточно', NULL, 'Артур', ' elit-stroi@yandex.ru', '89102000002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 0, '"ИП Юдина Галина Алексеевна "', NULL, NULL, 'Орел', 'пгт. Знаменка  379 км. +512 м. автодороги М2 «Крым» строение 1', NULL, NULL, NULL, '08:00', '22:00', 'Юдина Галина алексеевна', NULL, NULL, 'Попов Александр', ' irasvi@mail.ru', '8-953-818-75-35', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 0, 'АВТОМОЙКА СИБИРЬ', NULL, NULL, 'Омск', 'СОЛНЕЧНАЯ', '44', '8-908-106-62-53', NULL, 'круглосуточно', NULL, 'АЛЕКСАНДР ', 'oxo1111@yandex.ru', '89039279562', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 0, 'КУРИЛО ТРАНС АВТО, ИП Курило Александр Степанович', NULL, NULL, 'Омск', 'Омская область, Любинский район, п. Красный Яр', NULL, '8-913-656-3333', NULL, '09:00', '22:00', 'Болот Сергей Владимирович', 'kta-shop@mail.ru', '8-913-656-3333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 0, 'ООО «Имэджин Лаб»', NULL, NULL, 'Ногинск', ' ул.Гаражная 4 авто хим ', NULL, '89629790009', NULL, 'Круглосуточно', NULL, 'Уколов Роман Михайлович', NULL, NULL, 'Ирина', 'gruzovaya_moika@mail.ru', '89269683024', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 0, 'ООО "Мойка+"', NULL, NULL, 'Ногинск', 'г.Ногинск, ул.Шоссе Энтузиастов', 'д.64Б', NULL, NULL, NULL, NULL, 'Мунилов Андрей Константинович  ', '20aladar@rambler.ru', '89015232250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 0, 'ИП  Колесников Дмитрий Николаевич', NULL, '350002 ', 'Краснодар', 'Промышленная', '27', '8-928-038-50-50', NULL, '08:00', '22:00', 'Колесников Дмитрий Николаевич ', 'ji10@rambler.ru', '8-918-120-08-06', 'Бакин Игорь Игоревич', 'amkfortuna@yandex.ru', '8-918-120-08-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 0, 'ИП Марусидзе Давид Гурамович ', NULL, '354055 ', 'Сочи', 'ул.Джапаридзе ', '115', '8-988-237-33-31', NULL, 'Круглосуточно', NULL, 'Марусидзе Давид Гурамович ', NULL, '8-988-237-33-31', 'КАХА', NULL, '8-918-402-32-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 0, 'ООО «Сервис Групп»', NULL, NULL, 'Санкт-Петербург', 'ул.Софийская ', '78', NULL, NULL, 'круглосуточно', NULL, 'Армен', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 0, 'ИП Калинин ООО"МАКС"', NULL, NULL, 'Санкт-Петербург', 'Октябрьская наб. ', '110', '8-921-905-04-54', NULL, 'Круглосуточно', NULL, 'Калинин Антон Сергеевич', NULL, NULL, 'Калинина Елена Павловна', ' avtomoikaMAKC@bk.ru', '8-905-287-62-65 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 0, 'ООО «Корса-Трейд»', NULL, NULL, 'Санкт-Петербург', 'ул.Московское шоссе ', 'д.162', NULL, NULL, NULL, NULL, 'Леонид', NULL, NULL, 'Кравченко Андрей Анатольевич', '9444011@mail.ru', '8 921 944-40-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 0, 'ИП Лижевская', NULL, '196262', 'Санкт-Петербург', 'п. Шушары, ул. Ленина, д. 1, лит. А (промзона Шушары)', NULL, '7(812)987-12-73 ', NULL, 'круглосуточно', NULL, 'Ольга', 'olga_lizhevskaya@mail.ru', '89500373070', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 0, 'Автомойка "Енот"', NULL, NULL, 'Санкт-Петербург', 'Екатерининский проезд 1', NULL, '88129844244', NULL, 'круглосуточно', NULL, 'Пензовский С.И.', NULL, NULL, 'Ольга', 'moikaenot1@mail.ru', '89312515257', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 0, 'Петромастер', NULL, NULL, 'Санкт-Петербург', 'Московское ш-се', '231', NULL, NULL, NULL, NULL, 'Гасилин Виктор Александрович', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 0, 'ООО "Эко-Модуль"', NULL, NULL, 'Санкт-Петербург', 'п.Мисоедовский Московское шоссе уч 28', NULL, '8 931 250 33 75', NULL, 'круглосуточно', NULL, 'Влад ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 0, 'ИП Веревкин Владислав Николаевич', NULL, NULL, 'Пермь', 'ул.Ижевская', '30', '83422479004', NULL, 'круглосуточно', NULL, 'Наталья ', NULL, NULL, '  Шилков  Данил Олегович', 'snab.perm@mail.ru', '89097275923', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 0, 'ИП «Куликов»', NULL, NULL, 'Пермь', 'ул. Васильева ', '17', '8902-47-54-344', NULL, 'круглосуточно', NULL, 'Куликов Иван Петрович', NULL, NULL, 'Пушкарев Сергей Александрович', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 0, 'ООО «Авто Флот»', NULL, NULL, 'Пермь', 'ул. Воронежская', '41', ' 83422501696.', NULL, NULL, NULL, 'Дмитрий Александрович', NULL, NULL, 'ЕЛЕНА ИЛИ СВЕТЛАНА', 'SDA@MAN59.ru', '8-3422501698', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 0, '"Автомойка Бегемот "  ООО «ДЕЗЦЕНТР Эффект»', NULL, NULL, 'Пермь', 'ул.Светлогорская ,8ул. Автозаводская 21А(Дезе центр)', NULL, '83422576202', NULL, 'круглосуточно', NULL, 'Игорь Русланович владелец', NULL, NULL, 'Алексей Администратор', 'begemot_30@mail.ru', '89223113857', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 0, '  ИП Руков М.Л.', NULL, NULL, 'Пермь', 'ул.Космонавта Леонова ', '41', '83422907306', NULL, 'круглосуточно', NULL, 'Дмитрий', NULL, NULL, 'Максим Леонидович', 'dimson163@yandex.ru', '89519397937', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 0, 'ИП Сосунова', NULL, NULL, 'Пермь', 'ул.Гальперина', '19', '8342768769', NULL, 'круглосуточно', NULL, 'Сосунова Анжелика', 'wash-car@yandex.ru', '89024747260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 0, 'ИП Тарасенко Алексей Викторович', NULL, NULL, 'Пермь', 'ул.Куйбышева ', '115 б', NULL, NULL, '09:00', '22:00', 'Алексей Викторович', NULL, NULL, 'Шутова Ольга Анатольевна', 'moika@avtsport.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 0, 'ИП Богомолов Н.Н.  Орион', NULL, NULL, 'Нижний Новгород', 'ул.Алма-Атинская', NULL, NULL, NULL, 'круглосуточно', NULL, 'Богомолов Николай Николаевич', 'orion-2@bk.ru', '89519036566', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 0, 'ООО "Интеравтоцентр"', NULL, NULL, 'Нижний Новгород', 'ул. Ореховская ', 'д.80', '89307157777', NULL, 'круглосуточно', NULL, 'Потанин Эдуард Вячеславович', 'sto@interautonn.ru', '89307157777', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 0, 'Трак-центр', NULL, NULL, 'Нижний Новгород', NULL, NULL, '8 800 700 16 16', NULL, NULL, NULL, 'Голованов Артем Львович', NULL, NULL, 'ИГОРЬ КАМЕШКОВ', 'GOLOVANOV@NNOV.TRUCK-center.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 0, 'ИП Добряков', NULL, NULL, 'Нижний Новгород', NULL, NULL, NULL, NULL, NULL, NULL, 'Даша Добрякова', NULL, '89106633932', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 0, 'МЕГАПОЛИС М', NULL, NULL, 'Москва', 'дмитровское ш ,3-ИЙ НИЖЕЛИХОБОРСКИЙ 1, СТР1,2-ая мойка Рябиновая 28а', NULL, '8 903 259-81-38', NULL, NULL, NULL, 'Евгений', NULL, '89032598138 ', 'ЛЮДМИЛА', 'info@megapolis-moika.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 0, 'ООО "ФУРА" ', NULL, NULL, 'Москва', 'г. Москва пос. станции Крекшино ул. Станционная ', 'д. 21 ', NULL, NULL, NULL, NULL, 'Константин Боровик', 'ooofura@yandex.ru', '8 915 225 97 91', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 0, 'ООО СФС Групп', NULL, NULL, 'Москва', 'Московская область, Люберецкий р-н, Малаховка пгт, микрорайон Овражки, ул. Лесопитомник, ', NULL, NULL, NULL, 'Круглосуточно', NULL, 'Элизаров Вадим Павлович', '89268808005@mail.ru', '8 926 880 80 05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 0, 'ООО "Виват-Авто"', NULL, NULL, 'Москва', 'ст. метро Ново Гиреево ул. Кетчерская', '13', '8 495 782 71 79', NULL, 'круглосуточно', NULL, ' Фарафонов Денис Владимирович', 'kolomenskoe1@bk.ru', '8 926 354 06 58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 0, 'ООО \\"МоторМикс\\"', NULL, NULL, 'Москва', '"Ленинский район Строение: деревня Мильково база ЗАО \\""Совхоз имени ленина\\""РАЗВЯЗКА мкад село Беседа"', NULL, '84957909622', NULL, 'Круглосуточно', NULL, 'Целыковский Владимир Владимирович ', NULL, '89037909522', 'Насонов Руслан Витальевич', 'motormix@mail.ru', '89055579100', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 0, 'Автомоечного комплекса АвтоЁЖ', NULL, NULL, 'Москва', 'Химки, Вашутинское шоссе 4а', NULL, '89257711820', NULL, 'Круглосуточно', NULL, 'Черешнев Сергей ', ' 7725398@mail.ru', '8925-772-53-98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 0, 'ИП Овсянникова', NULL, NULL, 'Воронеж', 'М4 Дон', NULL, NULL, NULL, 'Круглосуточно', NULL, 'Галина Николавена', 'Vl_ovsyannikov@mail.ru', '89155845448', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 0, ' ИП Суханов Е.В.', NULL, NULL, 'Воронеж', ' с. Бабяково, ул. Дорожная 18', NULL, NULL, NULL, '08:00', '20:00', 'Владимир Николаевич', 'joe89@yandex.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 0, 'МКП МТК "ВОРОНЕЖПАССАЖИРТРАНС"', NULL, NULL, 'Воронеж', 'Сирафимовича ', '35', '8-908-133-3001', NULL, 'круглосуточно', NULL, 'Трофимов ', NULL, NULL, 'МАКСИМ ', NULL, '89081476563', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 0, 'ООО АВТОГАРАНТ', NULL, NULL, 'Воронеж', 'АНТОНОВО-ОВСИЕНКО ', '7б', '89081309540', NULL, 'круглосуточно', NULL, 'МАМАЕВА', NULL, NULL, 'АЛЕКСАНДР', 'gaidukov.sanek@mail.ru', '89081448336', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 0, 'Дикая дивизия', NULL, NULL, 'Воронеж', 'КРАСНО ДОСНКАЯ ', '31', '8-4732-29-11-09', NULL, 'круглосуточно', NULL, 'КРАВЦОВ ВАСИЛИЙ КОНДРАТИЧ', NULL, NULL, 'Любовь Вассильевна', 'patp8@list.ru', '8-4732-799610', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 0, 'ИП Енин', NULL, NULL, 'Воронеж ', 'ОСТРОГОЖСКАЯ 73А', NULL, '89204660885', NULL, 'круглосуточно', NULL, 'Енин Виктор', 'moikabigboss@mail.ru', NULL, 'Иван', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 0, 'ООО" Титан"', NULL, NULL, 'Воронеж ', 'Героев Сибиряков  ', '35б', NULL, NULL, 'круглосуточно', NULL, 'Попов Роман Владимирович', NULL, NULL, 'Линькова Надежда Егоровна', 'titan-vrn@mail.ru', '2398374', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 0, 'ООО «ГрузАвто Сервис – 36»', NULL, NULL, 'Воронеж ', '', NULL, NULL, NULL, 'круглосуточно', NULL, 'Сухарев Кирилл Владимирович', NULL, NULL, 'Валера Агапов ', 'suh.89@mail.ru , skv@gas36.com', '89202264697', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 0, 'ИП Очнев', NULL, NULL, 'Воронеж', 'Острагожская', '73', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 1, 'sdf', 'UTC', 'sdf', 'sdf', 'Sdf', 'Sfd', 'sfd', NULL, 'sf', 'sfd', 'sf', 'sdf', 'sfd', 'sdf', 'sfd', 'sdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 0, 'Для теста', 'UTC', '00000', 'Мичуринск', 'Мичуринцев', '1', '1-000-000', NULL, '3', '10', 'ыпа', 'вапав', 'авпав', 'пароап', 'апрпа', 'апр', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 0, 'ИП КЛИМОВ', NULL, NULL, 'Новосибирск', 'Автомобилистов проезд', '1', '89139112293', NULL, '09:00', '24:00', 'КЛИМОВ.А.В', 'lelya.klimov.2014@mail.ru', '8-913-911-22-93', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 0, 'ИП Миронова Е.В.', NULL, '153000', 'Иваново', 'Станкостроителей ', '26', '890651112609', NULL, 'Круглосуточно', NULL, 'Миронова Елена Владимировна ', NULL, '89158282835', 'Труняев Александр Николаевич', 'business_alex@bk.ru', '89092474114', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 0, 'ИП Алешин', NULL, NULL, 'Калуга', 'ул. Паралельная', NULL, '84842793000', NULL, '09:00', '21:00', 'Игорь Юрьевич', '89105113000@mail.ru', '89105113000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 0, 'ООО Квадрат Групп', NULL, NULL, 'Киров', 'ул. Советская ', '174', '31-94-24', NULL, NULL, NULL, 'Владислава Васильевича', '88332319491  ', NULL, 'Алексей', 'indigo.kirov@mail.ru', '89068299690', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 0, 'ООО "Модекс"', NULL, NULL, 'Воронеж', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Дамп данных таблицы `mts_request_comments`
--

INSERT INTO `mts_request_comments` (`id`, `request_id`, `employee_id`, `text`) VALUES
(1, 37, 2, 'ertrtret'),
(2, 37, 2, 'ertrtretretretre'),
(3, 37, 2, 'ertrtretretretrewererewr'),
(4, 37, 2, 'fdggfgfgfdg'),
(5, 37, 2, '2222'),
(6, 37, 2, 'wererewre'),
(7, 37, 2, 'fdsf'),
(8, 31, 2, 'dfgfdg'),
(9, 83, 7, 'У них 4 мойки.'),
(10, 100, 7, 'Сеть автомоек H2O'),
(11, 104, 7, 'У них 2 мойки.'),
(12, 114, 7, 'ТОЛЬКО ПО КАРТЕ СБЕРА РАБОТАЕМ  ');

--
-- Дамп данных таблицы `mts_request_company`
--

INSERT INTO `mts_request_company` (`request_ptr_id`, `contact_name`, `phone`, `email`, `city`) VALUES
(30, 'tgr', 'dhg', 'rtret', ''),
(31, 'fdgfff', 'jh', 'fg', ''),
(0, 'hgjh', 'jkj', 'ghjhg', ''),
(32, 'jkj', 'ghgfh', 'hgjh', ''),
(33, 'dfgf', 'fghgfh', 'hgfh', ''),
(36, 'вап', 'ваып', 'пр', ''),
(161, '', '', '', '');

--
-- Дамп данных таблицы `mts_request_company_autopark`
--

INSERT INTO `mts_request_company_autopark` (`id`, `request_ptr_id`, `model`, `type`, `amount`, `price_outside`, `price_inside`) VALUES
(3, 32, '', '0', 1, '', ''),
(6, 36, 'ыва', '0', 1, 'выа', 'ыва'),
(22, 30, 'fdsf', 'Кран', 3, '2', '234434'),
(23, 30, 'sdfdsf', 'Кран', 1, '3', '45'),
(28, 31, 'fdsfd', 'Тандем бортовой (одиночка + прицеп)', 2, '234', '2343'),
(29, 31, 'fdgfdg', 'Одиночка', 1, '4', '678');

--
-- Дамп данных таблицы `mts_request_company_driver`
--

INSERT INTO `mts_request_company_driver` (`id`, `request_ptr_id`, `model`, `type`, `fio`, `phone`) VALUES
(4, 31, 'tret', 'Миксер одиночка', 'ret retre ret', '43243432'),
(8, 64, 'Вольво', 'Одиночка', 'Минаев Е.Л.', '5345234'),
(9, 64, '', '', '', '');

--
-- Дамп данных таблицы `mts_request_done`
--

INSERT INTO `mts_request_done` (`id`, `request_id`, `created`) VALUES
(4, 42, '2016-05-11 21:07:04'),
(6, 44, '2016-05-11 21:10:08'),
(7, 45, '2016-05-11 21:10:13'),
(11, 49, '2016-05-13 19:13:37'),
(12, 50, '2016-05-13 19:19:15'),
(13, 51, '2016-05-13 19:23:50'),
(14, 52, '2016-05-13 22:18:11'),
(15, 53, '2016-05-13 22:22:28'),
(17, 55, '2016-05-13 22:51:15'),
(18, 56, '2016-05-13 22:58:08'),
(19, 57, '2016-05-13 23:07:50'),
(20, 58, '2016-05-13 23:12:20'),
(22, 60, '2016-05-13 23:20:10'),
(23, 61, '2016-05-13 23:28:31'),
(24, 62, '2016-05-13 23:29:44'),
(28, 66, '2016-05-14 19:32:44'),
(29, 67, '2016-05-14 19:39:07'),
(30, 68, '2016-05-14 19:42:09'),
(31, 69, '2016-05-14 19:44:36'),
(33, 71, '2016-05-14 19:49:33'),
(36, 74, '2016-05-14 19:55:15'),
(37, 75, '2016-05-14 19:59:58'),
(39, 77, '2016-05-15 09:37:10'),
(40, 78, '2016-05-15 09:39:57'),
(41, 79, '2016-05-15 09:41:44'),
(42, 80, '2016-05-15 09:45:05'),
(43, 81, '2016-05-15 09:48:08'),
(44, 82, '2016-05-15 09:52:27'),
(45, 83, '2016-05-15 09:54:05'),
(46, 84, '2016-05-15 09:56:46'),
(47, 85, '2016-05-15 09:58:56'),
(48, 86, '2016-05-15 10:01:42'),
(49, 87, '2016-05-15 10:03:20'),
(50, 88, '2016-05-15 10:05:00'),
(51, 89, '2016-05-15 10:07:55'),
(52, 90, '2016-05-15 10:09:40'),
(53, 91, '2016-05-15 10:11:16'),
(54, 92, '2016-05-15 10:12:49'),
(56, 94, '2016-05-15 10:14:48'),
(57, 95, '2016-05-15 10:16:35'),
(58, 96, '2016-05-15 10:18:21'),
(59, 97, '2016-05-15 10:22:28'),
(60, 98, '2016-05-15 10:28:04'),
(61, 99, '2016-05-15 10:29:13'),
(62, 100, '2016-05-15 10:31:49'),
(63, 101, '2016-05-15 10:34:52'),
(64, 102, '2016-05-15 10:35:48'),
(65, 103, '2016-05-16 10:38:28'),
(66, 104, '2016-05-16 10:45:54'),
(67, 105, '2016-05-16 10:49:18'),
(68, 106, '2016-05-16 10:51:39'),
(69, 107, '2016-05-16 10:55:26'),
(70, 108, '2016-05-16 10:58:16'),
(71, 109, '2016-05-16 11:00:09'),
(72, 110, '2016-05-16 11:02:00'),
(73, 111, '2016-05-16 11:03:52'),
(74, 112, '2016-05-16 11:05:34'),
(75, 113, '2016-05-16 11:06:54'),
(76, 114, '2016-05-16 11:08:18'),
(77, 115, '2016-05-16 11:15:09'),
(79, 117, '2016-05-16 11:33:50'),
(80, 118, '2016-05-16 11:35:57'),
(81, 119, '2016-05-16 11:37:57'),
(82, 120, '2016-05-16 11:40:46'),
(83, 121, '2016-05-16 11:44:08'),
(84, 122, '2016-05-16 11:46:26'),
(85, 123, '2016-05-16 11:47:50'),
(86, 124, '2016-05-16 11:51:09'),
(87, 125, '2016-05-16 11:52:28'),
(88, 126, '2016-05-16 11:54:20'),
(89, 127, '2016-05-16 11:56:02'),
(90, 128, '2016-05-16 11:58:02'),
(91, 129, '2016-05-16 11:59:37'),
(92, 130, '2016-05-16 12:01:05'),
(93, 131, '2016-05-16 12:02:15'),
(94, 132, '2016-05-16 12:03:27'),
(95, 133, '2016-05-16 12:05:13'),
(96, 134, '2016-05-16 12:08:00'),
(97, 135, '2016-05-16 12:09:49'),
(98, 136, '2016-05-16 12:11:44'),
(99, 137, '2016-05-16 12:13:11'),
(100, 138, '2016-05-16 12:14:07'),
(101, 139, '2016-05-16 12:17:26'),
(102, 140, '2016-05-16 12:19:27'),
(103, 141, '2016-05-16 12:22:48'),
(104, 142, '2016-05-16 12:26:07'),
(105, 143, '2016-05-16 12:27:42'),
(106, 144, '2016-05-16 12:29:11'),
(107, 145, '2016-05-16 12:30:56'),
(108, 146, '2016-05-16 12:32:17'),
(109, 147, '2016-05-16 12:34:20'),
(110, 148, '2016-05-16 12:35:58'),
(111, 149, '2016-05-16 12:37:17'),
(112, 150, '2016-05-16 12:38:46'),
(113, 151, '2016-05-16 12:39:58'),
(114, 152, '2016-05-16 12:42:33'),
(115, 153, '2016-05-16 14:10:41'),
(117, 157, '2016-05-18 19:32:03'),
(118, 158, '2016-05-18 19:34:58'),
(119, 159, '2016-05-18 19:38:27'),
(120, 160, '2016-05-18 19:39:49'),
(121, 161, '2016-05-19 22:07:28');

--
-- Дамп данных таблицы `mts_request_employee`
--

INSERT INTO `mts_request_employee` (`id`, `request_id`, `position`, `name`, `email`, `phone`) VALUES
(6, 37, 'авпаавп', '', '', ''),
(10, 36, 'Директор', 'Дмитрий', 'frt@mail.ru', '222 33 33 '),
(13, 96, '', 'Надежда владимеровна', '', ''),
(14, 96, '', 'Михаил Николаевич', 'benzinger.rb@mail.ru', ''),
(15, 50, '', '', '', ''),
(16, 49, 'sdf', 'csd', 'sdf', 'sdf');

--
-- Дамп данных таблицы `mts_request_process`
--

INSERT INTO `mts_request_process` (`id`, `request_id`, `employee_group_id`, `updated`) VALUES
(1, 30, 0, '2016-04-30 05:44:42'),
(2, 31, 0, '2016-04-30 05:46:37'),
(5, 33, 0, '2016-04-30 11:45:10'),
(8, 36, 0, '2016-05-03 05:49:28'),
(10, 38, 0, '2016-05-03 10:52:44'),
(11, 39, 0, '2016-05-10 06:08:57');

--
-- Дамп данных таблицы `mts_request_process_employee`
--

INSERT INTO `mts_request_process_employee` (`id`, `employee_id`, `request_process_id`, `created`, `finished`) VALUES
(8, 2, 32, '2016-04-30 11:23:16', '2016-05-10 11:09:21'),
(9, 2, 34, '2016-05-03 05:35:37', '2016-05-10 11:13:18'),
(10, 8, 34, '2016-05-03 05:35:37', '2016-05-10 11:13:32'),
(11, 2, 34, '2016-05-03 05:35:37', '2016-05-10 11:13:44'),
(12, 8, 34, '2016-05-03 05:35:37', '2016-05-10 11:14:38'),
(13, 2, 34, '2016-05-03 05:35:37', '2016-05-10 11:14:47');

--
-- Дамп данных таблицы `mts_request_service`
--

INSERT INTO `mts_request_service` (`request_ptr_id`, `official_dealer`, `nonofficial_dealer`) VALUES
(35, 'Пежо, Ваз, Уаз', 'Заз, Газ'),
(44, '', ''),
(45, '', '');

--
-- Дамп данных таблицы `mts_request_service_serve_organisation`
--

INSERT INTO `mts_request_service_serve_organisation` (`id`, `request_ptr_id`, `name`, `phone`) VALUES
(15, 35, 'ООО Белый бок', '2568978'),
(16, 35, 'ООО Серый бок', '2134568');

--
-- Дамп данных таблицы `mts_request_service_work_rate`
--

INSERT INTO `mts_request_service_work_rate` (`id`, `request_ptr_id`, `work_name`, `rate`) VALUES
(4, 35, 'tyuyt', 'ytuytu'),
(5, 35, '4534', '3454354');

--
-- Дамп данных таблицы `mts_request_tires`
--

INSERT INTO `mts_request_tires` (`request_ptr_id`, `service_mounting`, `service_tires_sale`, `service_disk_sale`, `serve_car`, `serve_truck`, `serve_tech`, `sale_for_car`, `sale_for_truck`, `sale_for_tech`) VALUES
(38, 1, 1, 1, 0, 0, 0, 0, 0, 0),
(39, 1, 1, 0, 1, 1, 1, 0, 0, 0);

--
-- Дамп данных таблицы `mts_request_tires_serve_organisation`
--

INSERT INTO `mts_request_tires_serve_organisation` (`id`, `request_ptr_id`, `name`, `phone`) VALUES
(4, 39, '', ''),
(64, 38, 'sdf', 'sdfds'),
(65, 38, 'dh', 'fgh'),
(66, 38, 'dddddddddddddd', '254543');

--
-- Дамп данных таблицы `mts_request_wash`
--

INSERT INTO `mts_request_wash` (`request_ptr_id`) VALUES
(37),
(42),
(49),
(50),
(51),
(52),
(53),
(55),
(56),
(57),
(58),
(60),
(61),
(62),
(66),
(67),
(68),
(69),
(71),
(74),
(75),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(107),
(108),
(109),
(110),
(111),
(112),
(113),
(114),
(115),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144),
(145),
(146),
(147),
(148),
(149),
(150),
(151),
(152),
(153),
(154),
(155),
(157),
(158),
(159),
(160);

--
-- Дамп данных таблицы `mts_request_wash_serve_organisation`
--

INSERT INTO `mts_request_wash_serve_organisation` (`id`, `request_ptr_id`, `name`, `phone`) VALUES
(16, 37, 'ghgfh', 'fghgfh'),
(17, 37, '2', '122'),
(18, 154, 'sdf', 'sdf'),
(19, 154, 'sdf', 'sdf'),
(20, 155, '', ''),
(21, 155, '', '');

--
-- Дамп данных таблицы `mts_request_wash_service`
--

INSERT INTO `mts_request_wash_service` (`id`, `request_ptr_id`, `type`, `price_outside`, `price_inside`) VALUES
(4, 37, 'Самосвал одиночка', '324', '23454');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
