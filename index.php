<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);///////Это для вывод ошибок если выйдут ошибки чтобы их проверять

$userLang = $_GET['userLang'] ?? 'rus';////////Чтобы был обязательный язык русский во избежание проблем с кодировкой в базе данных
require_once 'functions.php';///Подключает файл я их отдельно вывел для чистоты кода и быстрой загрузки

$cities = getCities($userLang); //выводит города
?>

<!DOCTYPE html>///Обязательно условия если если работаеш с js
<html lang="ru"> //вывод языка русский
<head>
    <meta charset="UTF-8">//кодировка обязательная
    <title>Список городов Европы</title>
    <link rel="stylesheet" href="/css/styles.css">//подключение стилей
</head>
<body>
    <div class="container">
        <h1>Список городов Европы</h1>
        <?php renderCityList($cities); ?>///подключение списка городов
    </div>
    <script src="/js/scripts.js"></script>///подключение файла js
</body>
</html>

