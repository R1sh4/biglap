-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 29 2023 г., 15:02
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `biglap`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kittens`
--

CREATE TABLE `kittens` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `characteristic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `kittens`
--

INSERT INTO `kittens` (`id`, `name`, `gender`, `age`, `characteristic`, `image`) VALUES
(1, 'Линда', 'Девочка', '3 месяца', 'Общительная, очень игривая, постоянно требует ласки и внимания', 'linda.jpg'),
(2, 'Майк', 'Мальчик', '3 месяца', 'Спокойный, любит ластиться, но только когда сам захочет', 'maik.jpg'),
(3, 'Ника', 'Девочка', '6 месяцев', 'Любит детей, хорошо уживается с другими домашними животными', 'nika.jpg'),
(4, 'Каин', 'Мальчик', '6 месяцев', 'Когда хочет есть, смотрит прямо в глаза хозяина и наклоняет головку набок', 'kain.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`) VALUES
(1, 'Главная', 'Мы предлагаем котят породы Мейн-кун с отличной родословной и гарантируем\n                отличный уход, питание и ветеринарное сопровождение всех котят.'),
(2, 'О породе', '<h1>История происхождения</h1>\r\n            <p>\r\n                Некоторые «знатоки» утверждают, что прародители породы появились в результате скрещивания домашнего кота и енота, отсюда длинный пышный хвост и характерный окрас. Другие считают, что не обошлось без участия рыси – отсюда и кисточки на ушах, однако, обе версии не нашли научного подтверждения у специалистов. Официальная версия проста: мейн-куны появились в результате естественной эволюции, а отличительные черты породы, например, внушительные размеры и густая длинная шерсть – природная необходимость для выживания в условиях суровых северных зим.\r\n            </p>\r\n            <p>\r\n                Изначально мейн-куны жили на фермах, где охотились за грызунами и охраняли урожай. В 1885 году на сельской ярмарке в Мэне гигантские кошки пользовались огромным успехом, и вскоре распространились по всей Америке, выставлялись на выставках в Бостоне и Нью-Йорке, а позже стали популярны во всем мире.\r\n            </p>\r\n            <h1 id=\"h1\" class=\"linkanc\">Описание породы</h1>\r\n            <p>\r\n                Мейн-кун значительно отличается от других представителей кошачьих своими гигантскими размерами. У него массивная пушистая голова с высокими скулами и очень длинными усами, а широкие уши увенчиваются кисточками, как у рыси. Несмотря на развитую мускулатуру кошки весьма грациозны, лапы у них длинные с лохматыми «валенками». Хвост удлиненный и очень пушистый. Мейн-куны отличаются повышенной лохматостью, шерсть длинная, густая и шелковистая. Что касается окрасов, они самые разнообразные: однотонные, пятнистые, пестрые, тигровые и дымчатые. Единственный запрет в стандарте породы на шоколадный, лавандовый и гималайский окрасы: животные с такой расцветкой не разводятся и не участвуют в выставках.\r\n            </p>\r\n            <p>\r\n                Особенностью породы является и необычный мелодичный голос. Мейн-кун не будет истошно мяукать на всю квартиру, когда голоден, а промурлыкает свою просьбу непосредственно хозяину.\r\n            </p>\r\n            <h1 id=\"h2\" class=\"linkanc\">Характер</h1>\r\n            <p>\r\n                Несмотря на свой суровый вид, мейн-куны очень общительные и ласковые животные. Они очень привязаны к своим хозяевам, при этом совершенно ненавязчивы и спокойно переносят одиночество. Кошки отлично ладят с детьми, принимая участие в их активных играх и не проявляя агрессии, если те будут теребить их и дергать за хвост. Неплохо кошки уживаются и с другими домашними животными, за исключением мелких птиц и грызунов. Охотничий инстинкт у них сильно развит, поэтому мейн-кун с удовольствием запустит свою когтистую лапку в аквариум за рыбкой или попытается достать хомячка из клетки. Как и все кошки, мейн-куны обожают подвижные игры, особенно, если нужно за кем-то охотиться или гоняться, так что позаботьтесь о том, чтобы вашему питомцу не было скучно.\r\n            </p>\r\n            <p>\r\n                Идеально заводить мейн-куна, живя в частном доме, во дворе которого кошка может погулять и поохотиться. Но если вы живете в квартире, почаще выгуливайте своего любимца на поводке. Также не забывайте закрывать окно, ведь кошки очень любопытны и могут вывалиться с высоты, заглядевшись на голубя на карнизе.\r\n            </p>\r\n            <h1 id=\"h3\" class=\"linkanc\">Уход и содержание</h1>\r\n            <p>\r\n                И хотя мейн-кун идеально приспособлен к суровым реалиям жизни вроде морозных зим, уход за ним требуется тщательный. В первую очередь, это касается шерсти животного. Чтобы избежать колтунов, кошку нужно расчесывать каждый день (или хотя бы через день) гребнем с тупыми зубцами. Если колтуны все же образовались, лучше обратитесь к профессиональному грумеру, чем самостоятельно выстригать их. Раз в полгода следует купать кошку, используя специальные распутывающие шампуни для длинношерстных пород. Многие с ужасом представляют себе картину, как удержать здоровенного кота, в ужасе удирающего из ванной. Успокойтесь: мейн-куны просто обожают водные процедуры, особенно, играться со струйкой воды из крана.\r\n            </p>\r\n            <p>\r\n                Не забывайте регулярно протирать глаза ватным тампоном, смоченным в кипяченой воде, и чистить уши от скопившейся грязи и серы. При склонности к образованию зубного камня, очищайте пасть питомца с помощью специальной щеточки и пасты, которые можно приобрести в любой ветклинике. Что касается стрижки когтей, то нужно подстригать самые кончики, чтобы не повредить кровеносные сосуды, или приобретите высокую удобную когтеточку.\r\n            </p>\r\n            <p>\r\n                Также не забывайте про чистоту лотка: обязательно используйте наполнитель, лучше древесный, а для наилучшего уничтожения запахов прикупите в ветаптеке специальный кошачий дезодорант.\r\n            </p>\r\n            <p>\r\n                Что касается питания мейн-кунов, то можете вместе с ветеринаром или заводчиком подобрать для кошки профессиональные корма супер-премиум класса, или остановиться на «натуралке». Подходят сырая и отварная говядина, отварная курица, крольчатина и индейка, а вот от свинины, гусиного или утиного мяса, а также колбас и копченостей лучше отказаться. Рыбу следует выбирать морскую, нежирную, также включайте в рацион питомца кисломолочные продукты, вареный желток или перепелиные яйца. Чтобы удовлетворить потребность кошки в клетчатке и витаминах, давайте ей каши, пророщенные зерна. Всегда следите, чтобы у питомца стояла миска с чистой кипяченой водой.\r\n            </p>\r\n            <table class=\"table table-bordered\">\r\n                <thead class=\"thead-light\">\r\n                    <tr>\r\n                        <th scope=\"col\">Возраст</th>\r\n                        <th scope=\"col\">Суточное меню</th>\r\n                        <th scope=\"col\">Количество кормлений</th>\r\n                    </tr>\r\n                </thead>\r\n                <tbody>\r\n                    <tr>\r\n                        <th scope=\"row\">1-й месяц</th>\r\n                        <td>В этом возрасте основу питания все еще должно составлять материнское молоко, но необходимо постепенно вводить прикорм в виде жидких каш и соскобленного отварного мяса. Также допускается употребление котенком небольшого количества творога, кефира и желтка. Если по каким — то причинам кормление материнским молоком невозможно, следует использовать его заменитель\r\n                        </td>\r\n                        <td>8</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <th scope=\"row\">2-й месяц</th>\r\n                        <td>Материнское молоко или его заменитель все еще входят в рацион котенка. Постепенно нужно вводить в меню отварные перетертые овощи с несколькими каплями масла. Количество каш нужно сократить, увеличив порцию мяса, которое следует нарезать на длинные тонкие полоски. Раз в неделю можно заменить мясо рыбой\r\n                        </td>\r\n                        <td>6</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <th scope=\"row\">3-й месяц</th>\r\n                        <td>В этом возрасте рацион должен включать все необходимые продукты: сырое или отварное мясо нежирных сортов, субпродукты (печень максимум 1 раз в неделю, другие потроха – не чаще 3 — х раз), отварную морскую рыбу, морепродукты, овощи и фрукты, каши, кисломолочные продукты, яйца\r\n                        </td>\r\n                        <td>5</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <th scope=\"row\">Взрослая кошка</th>\r\n                        <td colspan=\"2\">Многие заводчики считают, что кормление должно быть ограничено во времени (2 раза в день), другие, что должен быть свободный доступ к корму. В принципе, правомерны оба типа кормления\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            <ul>Категорически нельзя включать в рацион:\r\n                <li>Кости куриные, рыбьи - Котенок или кошка могут подавиться, к тому же кости повреждают пищевод и желудок, засоряют кишечник\r\n                </li>\r\n                <li>Свинина. Мясо домашней птицы (кроме курицы и индейки): гусь, утка. В сыром виде приводит к заражению глистами, в некоторых случаях к опасным инфекционным заболеваниям, что влечет смерть животного. Такое мясо очень жирное и плохо усваивается организмом кошки\r\n                </li>\r\n                <li>\r\n                    Жирные, острые, соленые, копченые продукты, в т.ч. колбасы и консервы для людей. Жареные продукты. Вызывают расстройство желудочно-кишечного тракта, нарушают обмен веществ. В результате животное плохо выглядит, появляются хронические заболевания\r\n                </li>\r\n                <li>\r\n                    Сахар, шоколад, конфеты, торты и все сладкое. Нарушает обмен веществ, слабый иммунитет, тусклая шерсть, заболевания зубов. ШОКОЛАД содержит теобромин, что для кошек – ЯД, вызывает сильные отравления, гибель животного\r\n                </li>\r\n                <li>\r\n                    Картофель. Крахмал не переваривается кишечником кошки, картофель для нее абсолютно бесполезен, может вызвать расстройство\r\n                </li>\r\n                <li>\r\n                    Бобовые (соя, горох, фасоль). Не усваивается организмом, вызывает вздутие и брожение в кишечнике\r\n                </li>\r\n                <li>\r\n                    Соль, специи. Пищу для кошек не солят и не используют специи, т.к. это не приносит ее организму пользы, только вред\r\n                </li>\r\n                <li>\r\n                    Лекарственные препараты, в т.ч. витамины, предназначенные для людей. У кошки свой особый баланс веществ в организме, витамины для людей им не подходят. К тому же многие лекарства для людей у них вызывают сильнейшие отравления, могут отказывают почки, что приводит к гибели. Например, ослабленную кошку можно убить таблеткой но-шпы\r\n                </li>\r\n            </ul>\r\n\r\n            <h1 id=\"h4\" class=\"linkanc\">Обучение и дрессировка</h1>\r\n            <p>\r\n                Мейн-куны отличаются высоким интеллектом и сообразительностью. Они быстро запоминают интонации, поэтому соображают, что хочет хозяин, и понимают его с первого слова или жеста. После того, как вы приучите котенка к лотку и гигиеническим процедурам, можете заняться его дрессировкой. Мейн-куны могут выполнять несложные команды, например, приносить какой-то предмет, кружиться вокруг себя, подавать лапу или мяукать по просьбе хозяина. Главное, не принуждать кошку, не повышать на нее голос и не забывать угощать вкусненьким за каждый успех.\r\n            </p>\r\n            <h1 id=\"h5\" class=\"linkanc\">Здоровье и болезни</h1>\r\n            <p>\r\n                И хотя мейн-куны отличаются крепким здоровьем и выносливостью, они подвержены некоторым опасным болезням, например, поликистозу почек, гипертрофической кардиомиопатии (чревато параличом задних конечностей или внезапной смертью), спинальной мышечной атрофии и дисплазии тазобедренного сустава, от которой животное начинает хромать. Все перечисленные заболевания тяжело поддаются лечению, поэтому остается только поддерживать стабильное состояние кошки, продлевая срок ее жизни. Всегда немедленно обращайтесь к ветеринару, если ваш питомец стал вялым и апатичным, у него изменилась походка или возникли проблемы с пищеварением.\r\n            </p>\r\n            <p>\r\n                Начиная с раннего возраста мейн-кунов нужно вакцинировать, а также регулярно проводить профилактику гельминтов. Если вы не планируете заниматься разведением котят, лучше стерилизовать или кастрировать животное, это увеличит продолжительность его жизни и убережет от многих проблем со здоровьем.\r\n            </p>'),
(3, 'Наши коты', '<h1>Наши коты</h1>'),
(4, 'Котята', '<h1>Наши котята</h1>'),
(5, 'Галерея', '<h1>Галерея</h1>');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag_admin` tinyint(1) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_message` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `flag_admin`, `name`, `surname`, `number`, `email`, `message`, `send_message`) VALUES
(1, 'admin', 'admin', 1, NULL, NULL, NULL, NULL, '', 0),
(2, 'ivankram', '12345', 0, 'Иван', 'Крамской', '9534682158', 'user1@mail.ru', '', 0),
(3, 'vasiliy', '223344', 0, 'Василий', 'Суриков', '9565682381', 'user2@mail.ru', '', 0),
(5, 'user4', '33445566', 0, 'Патрик', 'Джейн', '9566243120', 'user4@mail.ru', 'Есть взрослая собака', 1),
(6, 'user5', '64758697', 0, 'Василий', 'Тропинин', '9563241211', 'user5@mail.ru', 'Живу в 3х комнатной квартире, животных нет', 1),
(10, 'user3', '344556', 0, 'Виктор', 'Васнецов', '9652351475', 'user3@mail.ru', 'Есть взрослая кошка', 1),
(12, 'admin1', 'admin1', 1, 'Федор', 'Рокотов', '9522362415', 'rokotov@mail.ru', '', 0),
(13, 'admin3', 'admin3', 1, 'Михаил', 'Нестеров', '9566548525', 'nester@mail.ru', '', 0),
(14, 'admin2', 'admin2', 1, 'Константин', 'Маковский', '9566487564', 'makov@mail.ru', '', 0),
(15, 'shishkin', '221234', 0, 'Иван', 'Шишкин', '9522142362', 'shishkin@mail.ru', '', 0),
(16, 'valentin', '233412', 0, 'Валентин', 'Серов', '9523264551', 'valentin@mail.ru', '', 0),
(17, 'pasternak', '1234567', 0, 'Леонид', 'Пастернак', '9655366421', 'pasternak@mail.ru', '', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `kittens`
--
ALTER TABLE `kittens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `kittens`
--
ALTER TABLE `kittens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;