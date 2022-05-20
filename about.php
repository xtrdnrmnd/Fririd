<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');
?>
<html>

<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <title>about</title>

    <!--CSS-->
    <link rel="stylesheet" href="style.css" />
    <style>
        .wrapper .footer a {
            color: #F4C095;
        }

        #menu-items {
            background-color: #071E22;
        }

        .block {
            background: #F4C095;
        }
    </style>
</head>

<body id="about">
    <div class="wrapper2">
        <div id="about-text">Для получения информации по ковидным ограничениям будет использоваться сторонний API, который каждые сутки обновляет информацию. Это поможет сэкономить время разработки. Для других параметров, которые необходимо получить будет использоваться написанный веб-скрапер.
            Так как, в сервисе также существует «общий рейтинг» страны, то для него будет использоваться простой алгоритм. Каждый параметр конкретной страны будет преобразован в числовое значение. Далее для любого из этих параметров будет установлен вес. Путем вычисления суммы
            всех параметров с учетом весов мы получим значение в диапазоне от 0 до 10. Общий расчет будет производиться так:<br>
            • Статус(S) – 50% (открыто(3), частично открыто(2), закрыто(1))<br>
            • Виза(V) – 20% (нужна(3), не нужна(2), упрощенная процедура(1))<br>
            • Безопасность(B) – 20% (безопасно(4), не очень безопасно(3),<br>
            опасно(2), очень опасно(1))<br>
            • Дороговизна(P) – 10% (очень дорого(1), дорого(2), средне(3),<br>
            дешево(4), очень дешево(5))<br>
            Формула расчета выглядит следующим образом:<br>
            𝑅= 𝑆×10÷2+ 𝑉×10÷5+𝐵×10÷5+ 𝑃<br>
            𝑆𝑉𝐵𝑃<br>
            𝑚𝑎𝑥 𝑚𝑎𝑥 𝑚𝑎𝑥 𝑚𝑎𝑥<br>
            При поиске страны в поисковой строке введенное значение будет проверяться и сравниваться со списком, который будет храниться в текстовом файле. Так как стран всего 198, смысла создавать под них таблицы нет.
            Сортировка на странице со списком стран будет работать на основе числовых значений, определенных выше. То есть, при выборе данного типа сортировки будет помещать страны с наибольшим значением наверх.<br><br><br><br></div>
    </div>
</body>

</html>