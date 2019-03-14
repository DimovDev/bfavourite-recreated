-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.21 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table laravel_bfavourite.assets
CREATE TABLE IF NOT EXISTS `assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `asset_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.assets: ~10 rows (approximately)
DELETE FROM `assets`;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` (`id`, `title`, `content`, `asset_type`, `asset_status`, `slug`, `summary`, `published_at`, `created_at`, `updated_at`, `photo_id`) VALUES
	(65, 'Dev Projects', '<p>Dev Projects е семпъл плъгин за Wordpress, с който се добавя възможност за създаване и управление на портфолио. Използвах възможностите на CMS-а за създавне на собствен тип постове и категоризация.&nbsp;</p>\r\n<p>Тъй като имах спешна нужда от прилично портфолио, реших да използвам WordPress..</p>\r\n<p>Сайтът беше готов за часове, но се оказа, че не съществува портфолио плъгин, който да е подходящ за показване на проекти на програмисти. Всички варианти, на които попаднах, бяха насочени към фотографи и графични дизайнери.</p>\r\n<p>От друга страна, аз не исках нищо кой знае какво&hellip;</p>\r\n<p>Оглеждах се за нещо, което предлага:</p>\r\n<ul>\r\n<li>Собствен тип пост, при който се въвежда име на проекта, кратка информация за него, изображение, подробно описание при нужда, линк към проекта, линк към кода в GitHub и възможност за галерия от скрийншотове.</li>\r\n<li>Категоризация по тип проект (Website, Website Layout, PHP Component, etc.) и вид технология (PHP7, JavaScript, Vuejs, Laravel, etc.)</li>\r\n</ul>\r\n<p>Не беше трудно да постигна всичко това с малко помощ от един наръчник и документацията на WordPress.</p>\r\n<h2>Дотук добре, но...</h2>\r\n<p>Уловката е, че по поправилата на CMS-а&nbsp; не съм добавил никакво форматиране на информацията. Т.е. когато свалите и инсталирате плъгина, въведените проекти и технологии ще се визуализират като обикновени постове и категории при фронтенд-а.</p>\r\n<p>Това е така, защото тяхната презентация трябва да е уточнена при файловете на темата, за да се гарантира преносимост на данните при смяна на дизайна.</p>\r\n<p>Обикновено при плъгините за дистрибуция се добавят шорткодове. Те са лесни за употреба от непрограмисти, но не предлагат пълна интеграция с темата.&nbsp; Последната е възможна само с добавянето на темплейти в конкретната тема.</p>\r\n<p>Затова не съм си правил труда да създавам шорткодове , след като използвам темата.</p>\r\n<p>Веднага ми хрумнаха безброй готини функции, които да добавя и дори започна да ми се върти в главата да подготвя плъгина за дистрибуция. Но това го оставям за по-нататък.</p>', 'project', 'publish', 'dev-projects', 'Семпъл плъгин за Wordpress, с който се добавя възможност за създаване и управление на портфолио...', '2018-08-28 00:00:00', '2019-02-26 14:42:34', '2019-03-07 11:39:17', 123),
	(75, 'BFavourite Refactoring', '<p><span style="color: #3a3a3a; font-family: Open Sans, sans-serif;"><span style="background-color: #ffffff;">За мотивация и бързина, реших да стартирам портфолиото си на платформата Wordpress, когато взех решение да рестартирам кариерата си на уеб програмист.&nbsp;</span></span></p>\r\n<p><span style="color: #3a3a3a; font-family: Open Sans, sans-serif;">Тъй като беше малко нетипично уеб програмист да използва готов CMS за собствения си сайт, реших да покажа, че като нищо мога да създам статичен сайт с такъв дизайн.</span></p>\r\n<p><span style="color: #3a3a3a; font-family: Open Sans, sans-serif;">Плановете ми за BFavourite.com включват повече неща от няколкото страници тогава, а и имах спешна нужда от портфолио онлайн. Затова избрах WordPress, с който работя свободно.</span></p>\r\n<p><span style="color: #3a3a3a; font-family: Open Sans, sans-serif;">В последствие реших, че задължително сайта ми трябва да е на Laravel, защото все пак специализирам в тази технологична рамка. Някак си не стои да съм Laravel Dev, а собственото ми портфолио да е писано с нещо друго.&nbsp;</span></p>\r\n<p>Затова се зарекох щом ми се освободи малко време, веднага да си преработя сайта и така нарпавих. Можете да научите повече за новата версия тук.</p>\r\n<p>За съжаление,&nbsp; Wordpress варианта трябваше да си замине, защото все пак трябва да се ъпдейтва, да се обновяват темите и т.н.&nbsp; Неща, които натоварват излишно, когато не се използва.&nbsp;</p>\r\n<p>Все пак можете да видите кода на дизайна му онлайн:</p>', 'project', 'publish', 'bfavourite-refactoring', 'Тъй като имах спешна нужда от портфолио онлайн, реших да действам бързо. Затова предишната версия на портфолиото ми беше базирана на Wordpress. Кликнете, за да научите повече за нея...', '2018-07-25 00:00:00', '2019-03-02 11:42:46', '2019-03-07 12:08:04', 126),
	(80, 'Как да изключим кеширането на Laravel в dev среда?', '<p>Laravel предлага по подразбиране страхотна функционалност за кеширане, която върши добра работа при съхраняване на резултата от по-тежки заявки към базата данни, външни услуги, тежки изчисления и други.&nbsp;<br /><br />Когато оптимизираме кода си с кеширане обаче, се появява проблем: То започва да работи веднага и към момента няма официален начин, по който да се изключи, докато сме в процес на разработка на приложението.&nbsp;<br /><br />&nbsp;За щастие, все пак има как:</p>\r\n<p>Първата стъпка е да отворим .env файла и да сменим драйвъра за кеширане, както и да настроим времевия интервал, в които изтична валидността на кеша.&nbsp;</p>\r\n<pre class="language-php"><code>CACHE_DRIVER=array\r\nCACHE_EXPIRE=-1</code></pre>\r\n<p>След това изчистваме кеша с Artisan и сме готови:</p>\r\n<pre class="language-php"><code>php artisan cache:clear</code></pre>\r\n<p>Кешът вече може да се брои за изключен и наблюдаваме данните в реално време.&nbsp;</p>', 'textNote', 'publish', 'kak-da-izklyuchim-keshiraneto-na-laravel-v-dev-sreda', 'Laravel предлага страхотна функционалност за кеширане, която обаче не идва с документиран начин да бъде изключена по време на разработка на приложенито. Ето как можем да "изключим" кеша, докато пише код и тестваме...', '2018-08-31 00:00:00', '2019-03-08 13:09:10', '2019-03-08 23:27:53', NULL),
	(81, 'Moiatdom.bg', '<p>Проектът е малък сайт на фирма за професионално управление на етажна собственост в София.&nbsp;</p>\r\n<p>За фронтенд часта използвах Bootstrap 4 и малко jQuery, като самият дизайн също е мое дело. Не само това, но и в амплоато ми на професионален копирайтър помогнах за написването на текста.&nbsp;<br /><br /></p>\r\n<p><strong>За бекенд часта използвах Laravel...</strong></p>\r\n<p>Първоначално имах идея да използвам Lumen, Slim 3 или чист php код без фреймуърк. Това изглеждаше логично, защото сайтът има само две страници и една малка форма.&nbsp;</p>\r\n<p>Клиентът обаче ми сподели, че има идеи след време да добавим блог и разни други допълнителни неща. Затова в крайна сметка реших да използвам тежката артилерия и да положа основите така, че да можем после спокойно да надграждаме.&nbsp;</p>', 'project', 'publish', 'moiatdombg', 'Малък сайт на фирма за професионално управление на етажна собственост в София.', '2018-10-10 00:00:00', '2019-03-08 23:54:21', '2019-03-08 23:59:19', 127),
	(82, 'Когато хейтят повече JavaScript от PHP...', NULL, 'photoNote', 'publish', 'kogato-kheytyat-poveche-javascript-ot-php', '', '2018-11-11 00:00:00', '2019-03-09 00:12:49', '2019-03-09 00:12:49', 128),
	(83, 'Madaraagro.com', '<p>Мадара Агро е един от най-големите производители на земеделска техника и оборудване в България. С приятелите от M3 Communications Group направихме цялостен редизайн на техния сайт.&nbsp;</p>\r\n<p>Моята роля в проекта беше:&nbsp;</p>\r\n<ul>\r\n<li>В голямата си част бекенд-а и фронтенд-а</li>\r\n<li>Мигриране на базата данни&nbsp;</li>\r\n<li>Преместване и оразмеряване на 2GB изображения&nbsp;</li>\r\n<li>Преформатиране на съдържанието - описания на машините, технически характеристики и други.&nbsp;</li>\r\n</ul>\r\n<p>За проекта използвахе микро технологичната рамка Slim 3 с няколко допълнителни пакета като ORM Eloquent, Respect/Validation, Twig и други.&nbsp;</p>', 'project', 'publish', 'madaraagrocom', 'Цялостен редизайн на сайта на Мадара Агро EOОД.', '2018-12-03 00:00:00', '2019-03-09 00:53:05', '2019-03-09 00:54:47', 129),
	(84, 'BFavourite Recreated', '<p>Някои хора казват, че "обущарите ходели боси"...&nbsp;</p>\r\n<p>Никога не съм бил привърженик на това схващане, защото вярвам, че преди да се погрижиш за някой друг, първо трябва да си способен да се грижиш за себе си.&nbsp;</p>\r\n<p>В моя случай - преди да правиш сайтове на други хора и то срещу заплащане, първо трябва да си направиш собствен сайт и то с технологиите, които предлагаш на клиентите си.&nbsp; &nbsp;</p>\r\n<h2>Всяко начало е трудно (но само ако му позволиш)...</h2>\r\n<p>Първоначално, портфолиото ми беше изградено на базата на Wordpress (<a href="/project/75/bfavourite-refactoring?#first-screen" target="_blank" rel="noopener">научи повече тук</a>), защото имах спешна нужда от собствен сайт, а и не се бях ориентирал в какви технологии точно ще специализирам (по това време си мислих да разработвам сайтове с Wordpress -&gt; теми и плъгини).&nbsp;</p>\r\n<p>Веднага щом се ориентирах към Laravel, започнах да работя по този проект, като същинската фаза на разработката ми отне месец и половина.&nbsp;</p>\r\n<h2>Не говорим за обикновен сайт...</h2>\r\n<p>CMS-ът, който задвижва всичко, предлага 5 типа съдържание с опцията да се добавят неограничено количество допълнителни типове.&nbsp;</p>\r\n<p>Като професионален копирайтър, маркетолог и блогър много държа на съдържанието. Обожавам да се изразявам в писмен вид. Хоби ми е и затова съм готов да инвестирам както време, така и пари в най-добрите "играчки", които ми помагат да го упражнявам.&nbsp;</p>\r\n<p>Към момента мога да публикувам:</p>\r\n<ul>\r\n<li>Текстови бележки</li>\r\n<li>Фото бележки</li>\r\n<li>Линк бележки</li>\r\n<li>Блог постове</li>\r\n<li>Проекти</li>\r\n</ul>\r\n<p>За класификация на всичко това съм създал тагове (няма категории), които могат да се използват самостоятелно или в йерархична структура.&nbsp;</p>\r\n<p>Залагам на стандартната система на Laravel за автентикация, като в момента няма авторизации, понеже съм единствен юзер, а пък и съм оставил за друг път всичко, което не ми е необходимо към момента.&nbsp;</p>\r\n<p>За фотненда използвам jQuery, jQuery UI, TinyMCE, FontAwesome, Bootstrap 4, PrismJs.</p>\r\n<p>Няма как да не сте забелязвали, че този сайт не е традиционно портфолио или блог. Той взима най-доброто от социалните мрежи и го впряга в една композиция, при която качественото съдържание има централно място.&nbsp;</p>\r\n<h2>Ще издам малка тайна...&nbsp;</h2>\r\n<p>Всичко, свършено дотук, е част от по-голям проект, който ще промени не само българското интернет пространство, но и цяла България. Поне така се случва в ума ми, когато мисля за него.&nbsp;&nbsp;</p>\r\n<p>Разбира се, следващите фази няма да се случват в публичния репозитор в Github, който използвам за BFavourite Recreated.&nbsp;</p>', 'project', 'publish', 'bfavourite-recreated', 'BFavourite Recreated е настоящето ми портфолио, което взима най-доброто то социални мрежи като Facebook, Twitter и Medium и го впряга в една композиция, при която качественото съдържание има централно място.', '2019-03-03 00:00:00', '2019-03-11 02:43:58', '2019-03-11 02:45:03', 130),
	(85, 'Да поговрим за Design Patterns...', '<p>Страхотен сайт, който предлага изобилие от информация за софтуерения дизайн и добрите практики.</p>', 'linkNote', 'publish', 'da-pogovrim-za-design-patterns', 'Страхотен сайт, който предлага изобилие от информация за софтуерения дизайн и добрите практики.', '2019-03-10 00:00:00', '2019-03-11 03:21:07', '2019-03-11 03:21:07', 131),
	(86, 'Job Market Analytics', '<p>Никак не е лесна задача да си избереш основния език, на който ще програмираш...</p>\r\n<p>Когато реших да се завърна в програмирането, се изправих пред дилемата - PHP или Python?</p>\r\n<p>Който и да попиташ, каквото и да четеш, всички са на едно мнение - Python и в краен случай Javascript. За мое съжаление PHP изобщо не е на мода в световен мащаб и вероятно за това си има добри причини.&nbsp;</p>\r\n<p>Все пак избрах слончето в стъкларския магазин...</p>\r\n<ul>\r\n<li>Защото вече имам опит с него;</li>\r\n<li>Защото към момента е най-търсения език в България за уеб разработки;</li>\r\n<li>Защото има шанс отново да стане тренд;</li>\r\n<li>Защото винаги мога да превключва на JavaScript или Python, но междувременно не мога да си позволя да не работя.</li>\r\n</ul>\r\n<p>Разбира се, едно червейче продължава и до днес да ме чопли отвътре и вероятно ще продължи, докато PHP не стане най-популярния език на всички времена. (Вие не сте ли го сънували този мокър сън?)&nbsp;</p>\r\n<p><strong>Ще го бъде ли в близкото и далечното бъдеще?&nbsp;</strong></p>\r\n<p>Тъй като не обичам да гадая, а и не мога да имам пълно доверие на колегите - програмисти, всеки от които тегли световно-широката мрежа към собствените си пристрастия, реших да създам анализатор, който да засича, проследява и анализира трендовете на трудовия пазар и в частност - IT сектора.&nbsp;</p>\r\n<p>Така ще имам обективна информация дали и кога да превключа на Python, Javascript, Kotlin, Go или каквото друго там се пръкне и почне да се наливат милиарди в него.&nbsp;&nbsp;</p>', 'project', 'publish', 'job-market-analytics', 'Job Market Analyzer засича, проследява и анализира трендовете на трудовия пазар и в частност - IT сектора.', '2019-03-11 00:00:00', '2019-03-11 03:39:21', '2019-03-11 03:39:21', 132),
	(87, 'Как да подкараме Laravel апликация на споделен хостинг', '<p>По принцип не се гледа с добро око на споделените хостинг планове, когато става дума за Laravel...</p>\r\n<p>Има няколко причини за това, като сред тях са:</p>\r\n<ul>\r\n<li>ограничените ресурси, с които се ползва даден план;</li>\r\n<li>по-ниската сигурност и перформънса;</li>\r\n<li>липсата на SSH достъп, който драстично усложнява деплоймънта и лишава разработчика от Composer и Artisan.</li>\r\n</ul>\r\n<p>Колкото по-голяма и натоварена е дадена апликация, толкова повече тези недостатъци натежават, но според мен при малки проекти от сорта на блог или фирмен сайт, тяхната роля е пренебрежима.&nbsp;</p>\r\n<p>Т.е. можем да се възползваме от цялата сила на Laravel.&nbsp;&nbsp;</p>\r\n<p>Именно за това става дума в следващите няколко реда:</p>\r\n<ul>\r\n<li>Как да качим файловете на апликацията си на сървъра&nbsp;</li>\r\n<li>Как да настроим публичната папка&nbsp;</li>\r\n<li>Как да настроим конфигурациите, така че да се възползваме от кешираните routes, configurations &amp; views.</li>\r\n<li>И в крайна сметка - как да подкараме проекта си без никакви проблеми.&nbsp;</li>\r\n</ul>\r\n<p>Ще се постаря да не отплесвам в излишни дейтайли, но все пак този пост ще е малко по-дълъг от обикновено...</p>\r\n<p>Ако хостинг планът ви позволява SSH достъп до сървъра, тогава можете спокойно да спрете да четете още сега. Освен, разбира се, ако не ви е любопитно как се случват нещата без тази "екстра".&nbsp;</p>\r\n<h2>Как да качим файловете на сървъра&nbsp;</h2>\r\n<p><strong>Стъпка 1.</strong> През FTP клиент създаваме папка, която е извън публичната. В нея ще се намира всичко, освен публичната папка на проекта.&nbsp;</p>\r\n<p><strong>Стъпка 2.</strong> Копираме папките и файловете, като спокойно можем да пропуснем папката node_modules.&nbsp;</p>\r\n<p>Тъй като не можем да компилираме javascript файлове директно на сървъра, тя не е нужна. А пък и ще спестим доста inodes, високата бройка на които има потенциал да ни докара проблеми.&nbsp;</p>\r\n<p><strong>Стъпка 3.</strong> Копираме публичната папка в public_html или както се казва root директорията в конкретния случай.&nbsp;</p>\r\n<p><strong>Стъпка 4.</strong> Отваряме public_html/index.php и сменяме пътищата. Няма нужда да пипаме .htaccess.</p>\r\n<p><strong>Стъпка 5.</strong> Създаваме база данни през PHPMyAdmin и импортваме таблиците си. (Няма как да изпозлваме миграциите, кофти!)&nbsp;</p>\r\n<h2>В един идеален свят...</h2>\r\n<p>Написаното дотук би трябвало да е достатъчно, за да подкараме апликацията си на споделен хостинг.&nbsp; В реалността обаче, възникват следните проблеми:</p>\r\n<ul>\r\n<li>Тъй като нямаме SSH достъп, трябва да кешираме на локалния сървър - така пътищата към директориите се оказват грешни.</li>\r\n<li>Ако сме писали апликацията в Уиндоус среда, тогава има потенциален проблем със сепарторите - колкото и да внимавате Laravel все някак си ще вмъкне някъде backslash и според конфигурацията на сървъра ви, това може да е проблем, а може и да не е. (При Superhosting.bg е проблем...)</li>\r\n</ul>\r\n<p>Решението на тези казуси е следното:</p>\r\n<p><strong>Стъпка 1.</strong> Задаваме ръчно на Laravel директорията за съхранение на файлове.&nbsp;</p>\r\n<p>Най-бързият вариант е да добавим следния код в bootstrap/app.php</p>\r\n<pre class="language-php"><code>// new storage path\r\n\r\n$path_storage = \'/path/to/storage\';\r\n\r\n\r\n\r\n# override already $app-&gt;storagePath using the function\r\n\r\n$app-&gt;useStoragePath($path_storage);</code></pre>\r\n<p>Най-правилният вариант е да създадем настройка за пътя в .env, която после можем да сменяме, според средата, но това го оставям на вашата фантазия, за да не разтягам локуми.&nbsp;</p>\r\n<p><strong>Стъпка 2.</strong> Кешираме наново&nbsp;</p>\r\n<pre class="language-markup"><code>php artisan optimize \r\n\r\ncomposer dump-autoload -o</code></pre>\r\n<p><strong>Стъпка 3.</strong> Ако сте писали под Windows</p>\r\n<p>След като качите апликацията, отворете bootstrap/cache/config.php и се уверете, че всички кеширани пътища са коректни, като внимавате особено много за пътищата към views, защото при тях има тенденцията да си запазват директориите на локалния сървър, въпреки стъпка 1.</p>\r\n<h2>Общо взето, това е всичко...&nbsp;</h2>\r\n<p>Не гарантирам, че ще минете само с описаното дотук, когато се опитвате да подкарате Laravel апликация на споделен хостинг, но определно е един добър старт, който ще ви спести половин ден мислене и търсене с Google, ако досега не сте имали подобен опит.</p>\r\n<p>Но едно е ясно -&gt; SSH достъпът трябва да е ключов фактор за избиране на споделен хостинг план, когато става дума за Laravel.</p>', 'post', 'publish', 'kak-da-podkarame-laravel-aplikatsiya-na-spodelen-khosting', 'Попринцип не се гледа с добро око на споделния хостинг, когато говорим за Laravel, но ако все пак ви се наложи да подкарате апликацията си в такава среда, ето как да го направите.', '2019-03-11 00:00:00', '2019-03-11 04:05:18', '2019-03-11 04:18:53', 133);
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.assets_meta
CREATE TABLE IF NOT EXISTS `assets_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.assets_meta: ~11 rows (approximately)
DELETE FROM `assets_meta`;
/*!40000 ALTER TABLE `assets_meta` DISABLE KEYS */;
INSERT INTO `assets_meta` (`id`, `asset_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
	(36, 65, 'note_title', 'Семпло, но полезно...', '2019-03-08 23:16:21', '2019-03-08 23:20:53'),
	(37, 75, 'note_title', 'Когато времето те притиска...', '2019-03-08 23:19:54', '2019-03-08 23:26:45'),
	(39, 81, 'note_title', 'С основание използвах тежката артилерия...', '2019-03-08 23:54:21', '2019-03-08 23:54:21'),
	(41, 83, 'note_title', 'Един як проект с як екип...', '2019-03-09 00:53:06', '2019-03-09 00:53:06'),
	(43, 84, 'note_title', 'Не говорим за обикновен сайт...', '2019-03-11 02:43:59', '2019-03-11 02:44:38'),
	(44, 85, 'link_url', 'https://sourcemaking.com/', '2019-03-11 03:21:07', '2019-03-11 03:21:07'),
	(45, 85, 'link_title', 'Design Patterns and Refactoring', '2019-03-11 03:21:07', '2019-03-11 03:21:07'),
	(46, 85, 'link_desc', 'Design Patterns and Refactoring articles and guides. Design Patterns video tutorials for newbies. Simple descriptions and full source code examples in Java, C++, C#, PHP and Delphi.', '2019-03-11 03:21:07', '2019-03-11 03:21:07'),
	(47, 85, 'publisher', 'SourceMaking.com', '2019-03-11 03:21:08', '2019-03-11 03:21:08'),
	(48, 86, 'note_title', 'Време е играта да загрубее...', '2019-03-11 03:39:21', '2019-03-11 03:39:21'),
	(49, 87, 'note_title', 'Трудно ли? Просто не е удобно...', '2019-03-11 04:05:18', '2019-03-11 04:11:01');
/*!40000 ALTER TABLE `assets_meta` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sizes` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.media: 35 rows
DELETE FROM `media`;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `media_type`, `url`, `title`, `created_at`, `updated_at`, `sizes`) VALUES
	(70, 'image/jpeg', '/022019/ydL1iNtlex8sE59H1BUtSlp7fTc0t0UvE4kdGA08.jpeg', 'anonymous.jpg', '2019-02-06 14:44:42', '2019-02-06 14:44:42', NULL),
	(47, 'image/jpeg', '/022019/odnZwD7Ouets5PVjJZVTzc90bcobD6Crnukqhu7B.jpeg', 'charlie-sheen.jpg', '2019-02-06 13:38:01', '2019-02-06 13:38:01', NULL),
	(71, 'image/jpeg', '/022019/iwUR2MkFj3YornJlkV2aVanDwKxwdJ4gwUOsHbDW.jpeg', '8-mile.jpg', '2019-02-06 14:46:48', '2019-02-06 14:46:48', NULL),
	(39, 'image/jpeg', '/022019/kXO24ox6kkPPXdqabc9PPYw5FlBJGUJFS9b3o4VO.jpeg', 'bullseye.jpg', '2019-02-06 12:49:17', '2019-02-06 12:49:17', NULL),
	(40, 'image/jpeg', '/022019/YAszbZThLEvI0vJn2ovWQx84lCGOH2JrtQcLhmqY.jpeg', 'black-friday.jpg', '2019-02-06 12:52:02', '2019-02-06 12:52:02', NULL),
	(41, 'image/jpeg', '/022019/7qQr0LK9z9oj04Y3tu9yQAJls0qjgc0iw8gfEw7u.jpeg', 'big-brother-eye.jpg', '2019-02-06 12:52:19', '2019-02-06 12:52:19', NULL),
	(42, 'image/jpeg', '/022019/FDBo5Y5L5P9vJyTpySstSA8E7XfIzI1IEnZ6RF6U.jpeg', 'biznes-plamuk.jpg', '2019-02-06 12:52:32', '2019-02-06 12:52:32', NULL),
	(43, 'image/jpeg', '/022019/VBqWYQ84qDUwKq7uVcSexmUuOQidabOMsQPPUYTw.jpeg', 'eye.jpg', '2019-02-06 12:52:46', '2019-02-06 12:52:46', NULL),
	(74, 'image/jpeg', '/022019/OeSsryyxbZpbsO6Sk40p0iI2kqT5N21lQHnPJxHT.jpeg', 'astronaut.jpg', '2019-02-07 18:21:56', '2019-02-07 18:21:56', NULL),
	(52, 'image/png', '/022019/vGTbdzr2MGN2KXUuYLsRuczrfYRYg6swPBvnDkLn.png', 'bau-bau.png', '2019-02-06 13:54:54', '2019-02-06 13:54:54', NULL),
	(33, 'image/jpeg', '/022019/NUJLQM8xMG0VgaHWb1La0mMojEufZ6a2NbvxZEeg.jpeg', 'anonymous.jpg', '2019-02-06 12:45:58', '2019-02-06 12:45:58', NULL),
	(31, 'image/jpeg', '/022019/veNeE18WV6MwDDi1zpsYgZhR5nBICaVQRJHSwWuc.jpeg', 'abstract-man-face.jpg', '2019-02-06 12:16:15', '2019-02-06 12:16:15', NULL),
	(45, 'image/png', '/022019/uLnwDNHDWi1GJg1iYyojKQdlu8LOqHzKW37uXmR3.png', '8-dekemvri.png', '2019-02-06 13:12:30', '2019-02-06 13:12:30', NULL),
	(53, 'image/png', '/022019/Un2gNAdOeuNL8soGzhxXlM8t3OkWcLWB3ncZ2ZnT.png', 'conversation.png', '2019-02-06 14:04:15', '2019-02-06 14:04:15', NULL),
	(54, 'image/jpeg', '/022019/tmiaVm9YlsYG6TQ7J8uIhYzr7rY8HD7mdWspLM7g.jpeg', 'content-question.jpg', '2019-02-06 14:04:50', '2019-02-06 14:04:50', NULL),
	(55, 'image/jpeg', '/022019/wUoJPAGX9CsmC37e7DviNf0EgJKY3WkdudY88MWf.jpeg', '4ps.jpg', '2019-02-06 14:05:30', '2019-02-06 14:05:30', NULL),
	(73, 'image/jpeg', '/022019/ptQaqNegfEFClF0DQDHigGqbU9sSIX8dYOgegsYJ.jpeg', 'abstract-man-face.jpg', '2019-02-06 15:19:05', '2019-02-06 15:19:05', NULL),
	(72, 'image/png', '/022019/7ld2FEQUlytJ26IyBNouzVBFf4XxGutfbvR3YvqP.png', '8-dekemvri.png', '2019-02-06 14:56:47', '2019-02-06 14:56:47', NULL),
	(64, 'image/jpeg', '/022019/XG6ye4z4J2z801Y7yywyX7NTsSACr3Qok6ZocWWH.jpeg', 'biznes-plamuk.jpg', '2019-02-06 14:25:45', '2019-02-06 14:25:45', NULL),
	(67, 'image/jpeg', '/022019/dXFDdDkr15wHhaoYUElXtxKi5PctQ6oyZzwfwtuE.jpeg', 'black-friday.jpg', '2019-02-06 14:36:20', '2019-02-06 14:36:20', NULL),
	(75, 'image/jpeg', '/022019/MVY942Hi5Z6lcLdaInLUxYvNwww96eywXksMrPh3.jpeg', 'alexander-vuchkov.jpg', '2019-02-07 23:17:29', '2019-02-07 23:17:29', '["small"]'),
	(69, 'image/jpeg', '/022019/z2XBV6OCh5nVylRxQvumJtePODeMSxbNZiirxo4P.jpeg', 'bfavourite-header-bg-2-min.jpg', '2019-02-06 14:41:02', '2019-02-06 14:41:02', '["small","medium"]'),
	(77, 'image/jpeg', '/022019/K2PhNSWDzZ0A3hEl3s2j7kuvz6h5ir7IUCHG0yp3.jpeg', 'brooke-cagle-52215-unsplash.jpg', '2019-02-19 08:50:17', '2019-02-19 08:50:17', '["small","medium","large"]'),
	(78, 'image/jpeg', '/022019/MgHEUvS5Dz3zIglzrAKHGWfebKr4FzRBIFuwtvSf.jpeg', 'assembly.jpg', '2019-02-19 08:55:21', '2019-02-19 08:55:21', '["small","medium","large","extra"]'),
	(123, 'image/png', '/022019/580d0ffd3d17f1ed9d263696bc40e421.png', 'wordrpress.png', '2019-02-26 14:41:52', '2019-02-26 14:41:52', '["small","medium"]'),
	(124, 'image/jpeg', '/fbf293f3bcb919c652f394e2c29aba3f.jpg', '768x432.jpg', '2019-02-27 12:08:06', '2019-02-27 12:08:06', '["small","medium"]'),
	(125, 'image/jpeg', '/b63fbbb6d554fbb7b342ea69bf48c03e.jpg', '768x432.jpg', '2019-02-27 12:13:54', '2019-02-27 12:13:54', '["small","medium"]'),
	(126, 'image/png', '/032019/5bde31ad5486ba833469a4935c147061.png', 'bfavourite-refactoring.png', '2019-03-02 11:26:56', '2019-03-02 11:26:56', '["small","medium"]'),
	(127, 'image/png', '/032019/bb8e82af2a4a8ff6e15165ed0092c276.png', 'moiatdom.png', '2019-03-08 23:53:45', '2019-03-08 23:53:45', '["small","medium"]'),
	(128, 'image/jpeg', '/032019/1d134891e899a6917500a1060d38dc66.jpeg', 'photo-1453227588063-bb302b62f50b.jpg', '2019-03-09 00:09:55', '2019-03-09 00:09:55', '["small","medium"]'),
	(129, 'image/png', '/032019/8e3d0926bb824f5d0526e367d2a7aea8.png', 'madaraagro.png', '2019-03-09 00:51:46', '2019-03-09 00:51:46', '["small","medium"]'),
	(130, 'image/png', '/032019/c97cb092cca9d44b601948f766215dde.png', 'bfavourite-recreated.png', '2019-03-11 02:42:54', '2019-03-11 02:42:54', '["small","medium"]'),
	(131, 'image/jpeg', '/032019/553f9b5d41da237931f900dbb758b2a1.jpeg', 'sourcemaking-logo.jpg', '2019-03-11 03:17:38', '2019-03-11 03:17:38', '["small","medium"]'),
	(132, 'image/png', '/032019/96244e07e4d6583de68c734935379592.png', 'job-market-analytics.png', '2019-03-11 03:38:27', '2019-03-11 03:38:27', '["small","medium"]'),
	(133, 'image/jpeg', '/032019/dcfb991b2c9eea0fbf26771640afd3fb.jpeg', 'laravel.jpg', '2019-03-11 03:51:50', '2019-03-11 03:51:50', '["small","medium"]');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.migrations: 19 rows
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(8, '2019_01_26_023306_add_role_status_columns_users_table', 2),
	(9, '2019_01_26_054025_create_taxonomies_table', 3),
	(16, '2019_01_26_082602_create_assets_table', 4),
	(17, '2019_01_26_082703_create_assets_meta_table', 4),
	(20, '2019_01_27_194610_create_user_object_pivot_table', 5),
	(21, '2019_01_27_211302_create_taxonomy_object_pivot_table', 6),
	(23, '2019_02_01_034002_create_media_table', 7),
	(25, '2019_02_07_213319_add_photo_column_to_assets', 8),
	(27, '2019_02_07_230528_add_photo_column_to_users', 9),
	(28, '2019_02_07_234520_add_photo_summay_columns_to_taxonomies', 10),
	(30, '2019_02_19_082446_add_column_sizes_to_media', 11),
	(32, '2019_02_19_114837_add_column_assets_id_to_taxonomies', 12),
	(42, '2019_02_25_123901_change_photo_column_to_photo_id_in_assets', 13),
	(43, '2019_02_25_124020_change_icon_column_to_icon_id_in_taxonomies', 13),
	(44, '2019_02_25_124056_change_photo_column_to_photo_id_in_users', 13),
	(45, '2019_02_28_091425_add_base_type_column_to_taxonomy_object', 14),
	(46, '2019_03_01_121554_add_base_type_column_to_user_object', 15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.taxonomies
CREATE TABLE IF NOT EXISTS `taxonomies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxonomy_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxonomy_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon_id` int(11) DEFAULT NULL,
  `summary` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.taxonomies: ~19 rows (approximately)
DELETE FROM `taxonomies`;
/*!40000 ALTER TABLE `taxonomies` DISABLE KEYS */;
INSERT INTO `taxonomies` (`id`, `name`, `taxonomy_status`, `taxonomy_type`, `slug`, `created_at`, `updated_at`, `icon_id`, `summary`, `asset_id`) VALUES
	(37, 'PHP 7', 'active', 'tag', 'php-7', '2019-02-25 10:06:45', '2019-02-25 10:06:45', NULL, NULL, NULL),
	(38, 'Laravel', 'active', 'tag', 'laravel', '2019-02-25 10:07:00', '2019-02-25 10:10:38', NULL, NULL, NULL),
	(39, 'JavaScript', 'active', 'tag', 'javascript', '2019-02-25 10:07:15', '2019-02-25 10:07:42', NULL, NULL, NULL),
	(40, 'jQuery', 'active', 'tag', 'jquery', '2019-02-25 10:07:31', '2019-02-25 10:07:31', NULL, NULL, NULL),
	(41, 'Технологии', 'system', 'tag', 'tekhnologii', '2019-02-25 10:09:30', '2019-03-05 07:38:29', NULL, NULL, NULL),
	(42, 'HTML5', 'active', 'tag', 'html5', '2019-02-25 10:11:16', '2019-02-25 10:11:16', NULL, NULL, NULL),
	(43, 'CSS3', 'active', 'tag', 'css3', '2019-02-25 10:11:47', '2019-02-25 10:11:47', NULL, NULL, NULL),
	(44, 'MySQL', 'active', 'tag', 'mysql', '2019-02-25 10:12:15', '2019-02-25 10:12:15', NULL, NULL, NULL),
	(46, 'Current Project', 'system', 'tag', 'current-project', '2019-02-27 08:50:10', '2019-03-05 07:38:15', NULL, NULL, NULL),
	(50, 'Bootstrap 4', 'active', 'tag', 'bootstrap-4', '2019-03-02 14:12:22', '2019-03-05 07:38:03', NULL, NULL, NULL),
	(51, 'Featured Projects', 'system', 'tag', 'featured-projects', '2019-03-04 22:50:44', '2019-03-05 07:37:51', NULL, NULL, NULL),
	(52, 'Featured Technologies', 'system', 'tag', 'featured-technologies', '2019-03-07 10:55:38', '2019-03-07 10:55:38', NULL, NULL, NULL),
	(53, 'Git', 'active', 'tag', 'git', '2019-03-07 11:14:09', '2019-03-07 11:14:09', NULL, NULL, NULL),
	(54, 'Wordpress', 'active', 'tag', 'wordpress', '2019-03-07 12:05:57', '2019-03-07 12:05:57', NULL, NULL, NULL),
	(55, 'Photoshop', 'active', 'tag', 'photoshop', '2019-03-08 23:52:48', '2019-03-08 23:52:48', NULL, NULL, NULL),
	(56, 'meme-time', 'active', 'tag', 'meme-time', '2019-03-09 00:10:54', '2019-03-09 00:10:54', NULL, NULL, NULL),
	(57, 'Slim 3', 'active', 'tag', 'slim-3', '2019-03-09 00:49:12', '2019-03-09 00:49:12', NULL, NULL, NULL),
	(58, 'Good Practice', 'active', 'tag', 'good-practice', '2019-03-11 03:18:40', '2019-03-11 03:18:40', NULL, NULL, NULL),
	(59, 'Design Patterns', 'active', 'tag', 'design-patterns', '2019-03-11 03:19:01', '2019-03-11 03:19:01', NULL, NULL, NULL);
/*!40000 ALTER TABLE `taxonomies` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.taxonomy_object
CREATE TABLE IF NOT EXISTS `taxonomy_object` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taxonomy_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `obj_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.taxonomy_object: ~66 rows (approximately)
DELETE FROM `taxonomy_object`;
/*!40000 ALTER TABLE `taxonomy_object` DISABLE KEYS */;
INSERT INTO `taxonomy_object` (`id`, `taxonomy_id`, `obj_id`, `obj_type`, `base_type`) VALUES
	(80, 41, 40, 'tag', 'taxonomy'),
	(81, 41, 39, 'tag', 'taxonomy'),
	(82, 41, 38, 'tag', 'taxonomy'),
	(83, 41, 37, 'tag', 'taxonomy'),
	(84, 41, 42, 'tag', 'taxonomy'),
	(85, 41, 43, 'tag', 'taxonomy'),
	(86, 41, 44, 'tag', 'taxonomy'),
	(123, 42, 75, 'project', 'asset'),
	(124, 43, 75, 'project', 'asset'),
	(137, 43, 50, 'tag', 'taxonomy'),
	(138, 37, 50, 'tag', 'taxonomy'),
	(141, 41, 50, 'tag', 'taxonomy'),
	(142, 52, 50, 'tag', 'taxonomy'),
	(143, 52, 44, 'tag', 'taxonomy'),
	(144, 52, 42, 'tag', 'taxonomy'),
	(145, 52, 40, 'tag', 'taxonomy'),
	(146, 52, 39, 'tag', 'taxonomy'),
	(147, 52, 38, 'tag', 'taxonomy'),
	(149, 52, 37, 'tag', 'taxonomy'),
	(150, 52, 43, 'tag', 'taxonomy'),
	(151, 40, 75, 'project', 'asset'),
	(152, 41, 53, 'tag', 'taxonomy'),
	(153, 41, 54, 'tag', 'taxonomy'),
	(154, 54, 75, 'project', 'asset'),
	(155, 39, 75, 'project', 'asset'),
	(156, 38, 80, 'textNote', 'asset'),
	(157, 41, 55, 'tag', 'taxonomy'),
	(166, 38, 81, 'project', 'asset'),
	(167, 37, 81, 'project', 'asset'),
	(168, 42, 81, 'project', 'asset'),
	(169, 43, 81, 'project', 'asset'),
	(170, 50, 81, 'project', 'asset'),
	(171, 39, 81, 'project', 'asset'),
	(172, 40, 81, 'project', 'asset'),
	(173, 55, 81, 'project', 'asset'),
	(174, 56, 82, 'photoNote', 'asset'),
	(175, 37, 82, 'photoNote', 'asset'),
	(176, 39, 82, 'photoNote', 'asset'),
	(177, 41, 57, 'tag', 'taxonomy'),
	(178, 57, 83, 'project', 'asset'),
	(179, 44, 83, 'project', 'asset'),
	(180, 39, 83, 'project', 'asset'),
	(181, 42, 83, 'project', 'asset'),
	(182, 43, 83, 'project', 'asset'),
	(183, 50, 83, 'project', 'asset'),
	(184, 40, 83, 'project', 'asset'),
	(185, 55, 83, 'project', 'asset'),
	(186, 38, 84, 'project', 'asset'),
	(187, 37, 84, 'project', 'asset'),
	(188, 44, 84, 'project', 'asset'),
	(189, 42, 84, 'project', 'asset'),
	(190, 40, 84, 'project', 'asset'),
	(191, 50, 84, 'project', 'asset'),
	(192, 43, 84, 'project', 'asset'),
	(193, 58, 85, 'linkNote', 'asset'),
	(194, 59, 85, 'linkNote', 'asset'),
	(195, 37, 86, 'project', 'asset'),
	(196, 44, 86, 'project', 'asset'),
	(197, 38, 86, 'project', 'asset'),
	(198, 37, 65, 'project', 'asset'),
	(199, 44, 65, 'project', 'asset'),
	(200, 51, 81, 'project', 'asset'),
	(201, 51, 84, 'project', 'asset'),
	(202, 51, 86, 'project', 'asset'),
	(203, 46, 86, 'project', 'asset'),
	(204, 38, 87, 'post', 'asset');
/*!40000 ALTER TABLE `taxonomy_object` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `user_status`, `photo_id`) VALUES
	(44, 'SasheVuchkov', 'sashevuchkov@gmail.com', NULL, '$2y$10$f.42QFmeZa.i/hjHEwlPF.rP1qCuNLqyVUk4TatqXVB0EA5BOq97q', '7YX7jPUggLY76YaZy20mJk4pgO29CQSj218s5n9RPlvw3Saqj0915Z7IjfMW', '2019-01-27 20:48:21', '2019-03-11 04:26:28', 'subscriber', 'active', 75);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table laravel_bfavourite.user_object
CREATE TABLE IF NOT EXISTS `user_object` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `obj_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_bfavourite.user_object: ~20 rows (approximately)
DELETE FROM `user_object`;
/*!40000 ALTER TABLE `user_object` DISABLE KEYS */;
INSERT INTO `user_object` (`id`, `user_id`, `obj_id`, `obj_type`, `base_type`) VALUES
	(28, 44, 65, 'project', 'asset'),
	(31, 44, 75, 'project', 'asset'),
	(38, 44, 50, 'tag', 'taxonomy'),
	(39, 44, 51, 'tag', 'taxonomy'),
	(40, 44, 52, 'tag', 'taxonomy'),
	(41, 44, 53, 'tag', 'taxonomy'),
	(42, 44, 54, 'tag', 'taxonomy'),
	(43, 44, 80, 'textNote', 'asset'),
	(44, 44, 55, 'tag', 'taxonomy'),
	(45, 44, 81, 'project', 'asset'),
	(46, 44, 56, 'tag', 'taxonomy'),
	(47, 44, 82, 'photoNote', 'asset'),
	(48, 44, 57, 'tag', 'taxonomy'),
	(49, 44, 83, 'project', 'asset'),
	(50, 44, 84, 'project', 'asset'),
	(51, 44, 58, 'tag', 'taxonomy'),
	(52, 44, 59, 'tag', 'taxonomy'),
	(53, 44, 85, 'linkNote', 'asset'),
	(54, 44, 86, 'project', 'asset'),
	(55, 44, 87, 'post', 'asset');
/*!40000 ALTER TABLE `user_object` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
