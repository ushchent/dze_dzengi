<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
            };
    
    $db = new SQLite3("data/budgety.sqlite");

    $sql_check = "select count(*) as count from area_titles where id = $id;";
    
    $sql_get_title = "select area_title as title from area_titles where id = $id;";
    $sql_get_population = "select amount from population where area_id = $id order by year desc;";
    $sql_popravki_count = "select count(status) as count from popravki inner join area_titles on area_titles.area_title = popravki.region where id = $id and status <> 'П';";
    $sql_zaniato = "select amount from zaniato where area_id = $id order by year desc;";
    
    // Запросы к тестовой таблице minsk. Замени потом на правильную.
    $sql_all = "select function as function_title, amount, year, status from minsk inner join area_titles on minsk.area_id = area_titles.id where (status = 'П' or status = 'О') and Code_2 = 0 and area_id = $id order by year;";
    //$sql_all_otchety = 'select area_title, function, amount, year, status from minsk inner join area_titles on minsk.area_id = area_titles.id where status = "О" and Code_2 = 0 and area_id = $id order by year;';

    $check = $db->query($sql_check);
    $title = $db->query($sql_get_title);
    //$population = $db->query($sql_get_population);
    $popravki_count = $db->query($sql_popravki_count);
    //$zaniato = $db->query($sql_zaniato);
    
    //$pop_count = $population->fetchArray(SQLITE3_ASSOC)['amount'];
    //$zaniato_count = $zaniato->fetchArray(SQLITE3_ASSOC)['amount'];
    //$zaniato_percent = $zaniato_count / $pop_count * 100;
    
    $all = $db->query($sql_all);


function sort_data($a, $b) {
	return $a['year'] - $b['year'];
}

?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Бюджетное обозрение Республики Беларусь</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Бюджетное обозрение Республики
        Беларусь. Гражданский мониторинг государственных финансов. ">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
<!-- Yandex.Metrika counter -->

<script type="text/javascript">
	if (document.location.hostname != "localhost") {
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter30802536 = new Ya.Metrika({
                    id:30802536,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
} else {
	console.log("You're on localhost.");
}
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/30802536" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    </head>
<body>
    <header>
        <a href="/"><img src="img/logo.jpg"></a>
    </header>
    <main>
        <h1>Бюджетное обозрение Республики Беларусь</h1>
        <section id="caption">
        <p>Гражданский мониторинг государственных финансов</p>
        
        </section>

<?php     if ($check->fetchArray(SQLITE3_ASSOC)['count'] > 0) {
	?>


<h2><?php echo $title->fetchArray(SQLITE3_ASSOC)['title']; ?>: расходы бюджета</h2>
<!--
<aside>
<p>Население: <?php echo number_format($pop_count, $decimals = 1); ?></p>
<p>Занято в экономике: <?php echo number_format($zaniato_count, $decimals = 1); ?> (<?php echo number_format($zaniato_percent, $decimals = 1); ?>%)</p>

<p>Валовый региональный продукт: </p>

<p>Поправок в бюджет с начала года: <?php echo $popravki_count->fetchArray(SQLITE3_ASSOC)['count']; ?></p>
</aside>
-->
<!--
<nav id="main_menu">
	<ul>
		<li>Доходы</li>
		<li>Расходы</li>
		<li>Баланс</li>
	</ul>
</nav>
-->
<div id="graph"></div>
<h3>Структура расходов бюджета в <span id="current_year">2015</span> году:</h3>
<div id="table"></div>
<?php 
    $data = [];
    while ($row = $all->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
        //echo $row['function'] . " - " . $row['amount'] . " - " . $row['year']  . " - " . $row['status'] . "<br>";
    };
    usort($data, "sort_data");
?>
<script>
    var data = <?php echo json_encode($data)?>;
</script>
<?php } else { echo "<pre>Неизвестный субъект.</pre>"; } ?>
   </main>
    <footer>
        <div id="cc"><a href="http://creativecommons.org/licenses/by-sa/4.0/deed.be"><img src="img/bysa.png"></a><p>2015 &ndash; 2016 dataШкола сообщества "<a href="http://opendata.by">Открытые данные для Беларуси</a>". Испытательная версия.</p></div>
    </footer>
        <script src="js/d3.v3.min.js" charset="utf-8"></script>
        <script src="js/data.js"></script>
</body>
</html>
<?php $db->close(); ?>
