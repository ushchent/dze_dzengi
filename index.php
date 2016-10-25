<?php
    $db = new SQLite3("data/budgety.sqlite");

	$sql_random_budget_title_declined = "SELECT area_title_declined, id from area_titles where area_titles.present = 1 order by random() limit 1;";

	$random_budget_title_declined = $db->query($sql_random_budget_title_declined);

	$keys = array();
	while ($row = $random_budget_title_declined->fetchArray(SQLITE3_ASSOC)) {
//		$temp_arr = array();
		$keys["budget_id"] = $row["id"];
		$keys["budget_title_declined"] = $row["area_title_declined"];
//		array_push($temp_arr, )
	}

//	$random_budget_title = $random_budget_title_declined->fetchArray(SQLITE3_ASSOC)["area_title_declined"];
//	$random_budget_title_id = $random_budget_title_declined->fetchArray(SQLITE3_ASSOC)["id"];

// echo "Код бюджета - " . $keys["budget_id"] . "<br>";
// echo "Название бюджета - " . $keys["budget_title_declined"] . "<br>";

//    $sql_check = "select count(*) as count from area_titles where id = $id;";
    

//    $sql_get_population = "select amount from population where area_id = {$random_budget_title_declined_id} order by year desc;";
//    $sql_popravki_count = "select count(status) as count from popravki inner join area_titles on area_titles.area_title = popravki.region where id = {$random_budget_title_declined_id} and status <> 'П';";
//    $sql_zaniato = "select amount from zaniato where area_id = {$random_budget_title_declined_id} order by year desc;";
    
    // Запросы к тестовой таблице minsk. Замени потом на правильную.
    $sql_all = "select function as function_title, amount, year, status from minsk_1 inner join area_titles on minsk_1.area_id = area_titles.id where (status = 'П' or status = 'О') and Code_2 = 0 and area_id = {$keys['budget_id']} order by year;";
    //$sql_all_otchety = 'select area_title, function, amount, year, status from minsk inner join area_titles on minsk.area_id = area_titles.id where status = "О" and Code_2 = 0 and area_id = $id order by year;';

//    $check = $db->query($sql_check);

    //$population = $db->query($sql_get_population);
//    $popravki_count = $db->query($sql_popravki_count);
    //$zaniato = $db->query($sql_zaniato);
    
    //$pop_count = $population->fetchArray(SQLITE3_ASSOC)['amount'];
    //$zaniato_count = $zaniato->fetchArray(SQLITE3_ASSOC)['amount'];
    //$zaniato_percent = $zaniato_count / $pop_count * 100;
    
    $all = $db->query($sql_all);



function sort_data($a, $b) {
	return $a['year'] - $b['year'];
}

    $data = [];
    while ($row = $all->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $row);
        //echo $row['function'] . " - " . $row['amount'] . " - " . $row['year']  . " - " . $row['status'] . "<br>";
    };
    usort($data, "sort_data");

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
        <img src="img/logo.jpg">
    </header>
    <main>
        <h1>Бюджетное обозрение Республики Беларусь</h1>
        <section id="caption">
        <p>Гражданский мониторинг государственных финансов</p>
        </section>


        <input id="budget_title" value="<?php echo $keys["budget_title_declined"]; ?>"
			onkeyup="get_budget_title(this.value)">
<!--
		<input type="button" id="show_button" value="Показать">
-->
		<div id="show_budget_title">
			<ul></ul>
		</div>
		<p id="message"></p>

<div id="graph"></div>
<h3>Структура расходов бюджета в <span id="current_year">2015</span> году (млрд. рублей):</h3>
<div id="table"></div>
<?php 

?>
<script>
    var data = <?php echo json_encode($data)?>;
</script>

   </main>
    <footer>
        <div id="cc"><a href="http://creativecommons.org/licenses/by-sa/4.0/deed.be"><img src="img/bysa.png"></a><p>2015 &ndash; 2016 dataШкола сообщества "<a href="http://opendata.by">Открытые данные для Беларуси</a>". Испытательная версия.</p></div>
    </footer>
        <script src="js/d3.v3.min.js" charset="utf-8"></script>
        <script src="js/data.js"></script>
</body>
</html>
<?php $db->close(); ?>
