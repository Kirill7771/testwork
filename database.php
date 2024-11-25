<?php
function connectDB() { ///Функционал подключения к базе данных
    $host = 'localhost'; ///указал хост так ка на хостинге локальный
    $dbname = 'a0574123_test';  ///имя нашей базы данных
    $dbusers = 'a0574123_test1'; ///пользователь нашей базы данных
    $password = 'nmef43e7'; ///пароль нашей базе данных
    $charset = 'cp1251'; ////язык кодировки нашей базы данных
    $dsnconf = "mysql:host=$host;dbname=$dbname;charset=$charset"; ///функция подключение к базе данных тут все переменые для подключения
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]; ///функция для подключения в PDO
    try {
        $pdo = new PDO($dsnconf, $dbusers, $password, $options);
        return $pdo; ///тут все параметры подключения и переменые
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function getCities($userLang) { ///функция подключения и получение списков городов по заданам фильтрам
    $pdo = connectDB();
    $query = "
        SELECT city.c_name_$userLang AS city_name, city.c_descr_$userLang AS city_description,
               IFNULL(region.r_name_$userLang, country.c_name_$userLang) AS parent_name,
               IFNULL(region.r_descr_$userLang, country.c_descr_$userLang) AS parent_description,
               country.c_name_$userLang AS country_name, country.c_descr_$userLang AS country_description,
               region.r_name_$userLang AS region_name, region.r_descr_$userLang AS region_description
        FROM city
        LEFT JOIN region ON city.c_region_id = region.id
        LEFT JOIN country ON city.c_country_id = country.id
        WHERE country.glob_region_id = (SELECT id FROM glob_region WHERE gr_name_$userLang = 'Европа')
        ORDER BY country_name, region_name, city_name
    ";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll();
}
?>
