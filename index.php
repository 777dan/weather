<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
</head>

<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
        <select name="locations">
            <option value="Kharkiv">Харьков</option>
            <option value="Kyiv">Киев</option>
            <option value="London">Лондон</option>
            <option value="Paris">Париж</option>
            <option value="Ankara">Анкара</option>
        </select>
        <input type="submit" value="Подтвердить" name="submit">
    </form>
    <?php
    if (isset($_GET['submit'])) {
        $code = "";
        $country = "";
        switch ($_GET['locations']) {
            case "Kharkiv":
                $code = "fee5021b4689a56d9c683bcecc8510ef";
                $country = "UA";
                break;
            case "Kyiv":
                $code = "c5f367c6b0faf3dca7dc4de3ac374639";
                $country = "UA";
                break;
            case "London":
                $code = "b8e985491179b0a7c967bff80491541a";
                $country = "UK";
                break;
            case "Paris":
                $code = "e8ad9d50cca1280f2fe8fc4b9268d7af";
                $country = "FR";
                break;
            case "Ankara":
                $code = "c7cf1884fe32e3bb6a5afcb235f90435";
                $country = "TR";
                break;
            default:
                echo "Этого города нет в списке!";
                break;
        }
        $weatherData = json_decode(file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . $_GET['locations'] . ",$country&APPID=$code"));
        $temperature = json_decode(file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . $_GET['locations'] . ",$country&APPID=$code&units=metric"));
        echo "Страна: " . $temperature->sys->country, "\n<br>";
        echo "Населённый пункт: " . $weatherData->name, "\n<br>";
        echo "Температура: " . round(((($weatherData->main->temp) - 32) / 1.8), 1), " &#8451;\n<br>";
        echo "Температура чувствуется как: " . round(((($weatherData->main->feels_like) - 32) / 1.8), 1), "  &#8451;\n<br>";
        echo "Влажность: " . $weatherData->main->humidity, " %\n<br>";
        echo "Скорость ветра: " . $weatherData->wind->speed, " км/ч\n<br>";
        echo "Погода: " . $weatherData->weather[0]->main, "\n<br>";
    }
    ?>
</body>

</html>