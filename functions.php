<?php
require_once 'database.php'; ///само подключение файла

function renderCityList($cities) { ///выводит массив чтобы для получение на html
    $currentCountry = '';
    $currentRegion = '';
    foreach ($cities as $city) { ///массив о городах информацию выводит
        if ($currentCountry !== $city['country_name']) {
            $currentCountry = $city['country_name'];
            echo "<div class='country' data-description='{$city['country_description']}'><span class='text'>{$currentCountry}</span></div>";
        }
        if ($currentRegion !== $city['region_name']) { ///Проверяет и выводит регион
            $currentRegion = $city['region_name'];
            if ($city['region_name']) {
                $regionDescription = 'Регион: ' . $city['region_name'] . ' (Город под регионом)';
                echo "<div class='region' data-description='{$regionDescription}' style='margin-left: 20px;'><span class='text'>{$currentRegion}</span></div>";
            }
        }
        $cityDescription = $city['region_name'] ? 'Город под регионом' : 'Город без региона'; ///Проверяет и выводит города
        echo "<div class='city' data-description='{$cityDescription}' style='margin-left: 40px;'><span class='text'>{$city['city_name']}</span></div>";
    }
}
?>
