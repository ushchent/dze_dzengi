<?php
	$db = new SQLite3("data/budgety.sqlite");

$sql_popravki_total_count = 'SELECT count(*) as count from popravki where status != "П";';

	$sql_total_plan_data = 'select title, sum(amount) as plan, function_id  from raskhody_f inner join functions on functions.function = raskhody_f.title where status = "П" and code_2 = 0 group by title;';
	
	
	$sql_total_popravki = "select distinct subject, status from popravki group by subject order by status;";
	$sql_region_names = 'select distinct area_title as title, id from raskhody_f inner join area_titles on raskhody_f.region = area_titles.area_title;';
	$sql_function_names = 'select distinct title, function_id from raskhody_f inner join functions on raskhody_f.title = functions.function;';
	
	
	$sql_plan = "select title, amount as plan from raskhody_f where status = 'П' and region = 'Могилевская' and code_2 = 0;";
	
	$sql_fact = "select title, amount as fact from raskhody_f
				where status = 'У2'
				and region = 'Могилевская'
				and code_2 = 0
				group by title;";
	$sql_total_popravki_data = 'select title, sum(amount) as changed
		from (select title, amount from raskhody_f where (region = "Могилевская область" and status = "У2" and code_2 = 0) or (region = "Минская область" and status = "У2" and code_2 = 0) or (region = "Витебская область" and status = "У2" and code_2 = 0) or (region = "Брестская область" and status = "У1" and code_2 = 0) or (region = "Гродненская область" and status = "У1" and code_2 = 0) or (region = "Минск" and status = "У1" and code_2 = 0) or (region = "Гомельская область" and status = "У1" and code_2 = 0)) group by title;';


	$popravki_total_count = $db->query($sql_popravki_total_count);
	$total_plan_data = $db->query($sql_total_plan_data);
	$total_popravki = $db->query($sql_total_popravki);
	$popravki_data = $db->query($sql_total_popravki_data);

	$region_names = $db->query($sql_region_names);
	$function_names = $db->query($sql_function_names);

	$plan = $db->query($sql_plan);
	$fact = $db->query($sql_fact);



	$result_set = array();
	$row_array = array();

	while($row = $total_plan_data->fetchArray(SQLITE3_ASSOC)) {
		$row_array['title'] = $row["title"];
		$row_array['plan'] = $row["plan"];
		array_push($result_set, $row_array);
	}

	$popravki_set = array();
	while ($row = $popravki_data->fetchArray()) {
		$temp_arr = array();
		$temp_arr['title'] = $row['title'];
		$temp_arr['changed'] = $row['changed'];
		array_push($popravki_set, $temp_arr); 
	}

	for ($i = 0; $i < count($result_set); $i++) {
		for ($b = 0; $b < count($popravki_set); $b++) {
			if ($result_set[$i]['title'] == $popravki_set[$b]['title']) {
				$result_set[$i]['changed'] = $popravki_set[$b]['changed'];
				$result_set[$i]["percent"] = 
					($result_set[$i]['changed'] - $result_set[$i]['plan']) / 
					$result_set[$i]['plan'] * 100;
			}
		}
	}

function sort_table($a, $b) {
	return $b['percent'] - $a['percent'];
}

usort($result_set, "sort_table");


//$db->close();
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
<!--		<p>Журнал "Дзе дзеньгi"</p> -->
    </header>
    <main>
        <h1>Бюджетное обозрение Республики Беларусь</h1>
        <section id="caption">
        <p>Гражданский мониторинг государственных финансов <sup>январь-март 2016</sup></p>
        
        </section>
        <h2>Бюджет сектора государственного управления</h2>
        <div id="bsgu_rev">
        </div>
        <div id="bsgu_spent">
        </div> 
        <div id="bsgu_dolg">
        </div>
          <h3><a href="/data.php?id=2">Республиканский бюджет</a></h3>
        <div id="resp_rev">
        </div> 
        <div id="resp_spent">
        </div> 
        <h3>Местные бюджеты</h3>
        <div id="loc_rev">
        </div> 
        <div id="loc_spent">
        </div> 
        <p>Расходы областных бюджетов в 2016 году (тыс. рублей):</p>
        <div id="menu">

<?php
	echo "<select class='select' id='regions'>";
	echo "<option value='default'>Все регионы</option>";



	while ($row = $region_names->fetchArray()) {
		echo "<option value=" . $row['id'] . ">" . $row['title'] . "</option>";
	}
echo "</select>";

echo "<select class='select' id='functions'>";
	echo "<option value='default'>Все виды расходов</option>";



	while ($row = $function_names->fetchArray()) {
		echo "<option value=" . $row['function_id'] . ">" . $row['title'] . "</option>";
	}
echo "</select>";
?>


<?php 

echo "<table id='output_table'><thead><tr><td>Вид расходов</td><td>По плану</td><td>Уточнено</td><td>%</td></tr></thead><tbody>";
for ($i = 0; $i < count($result_set); $i++) {
	if ($result_set[$i]['title'] == "ВСЕГО расходов") {
		$final_row = $result_set[$i];
		continue;
	}
		echo "<tr>
		<td>{$result_set[$i]['title']}</td>" .
		"<td>" . number_format($result_set[$i]['plan']) . "</td>" .
		"<td>" . number_format($result_set[$i]['changed']) . "</td>" .
		"<td>" . number_format($result_set[$i]['percent'], $decimals = 1) .
		"</td></tr>";

	};
	
echo "<tr>
		<td>{$final_row['title']}</td>" .
		"<td>" . number_format($final_row['plan']) . "</td>" .
		"<td>" . number_format($final_row['changed']) . "</td>" .
		"<td>" . number_format($final_row['percent'], $decimals = 1) .
		"</td></tr>";

echo "</tbody></table>";
?>
</div>
<p>С начала 2016 года поправки в областные бюджеты вносились <?php echo $popravki_total_count->fetchArray(SQLITE3_ASSOC)['count']?> раз.</p>
        <section id="local">
        </section>

<!--
        <h3>Бюджет Фонда социальной защиты населения</h3>
        <section id="fszn">
        </section>
-->
   </main>
    <footer>
        <div id="cc"><a href="http://creativecommons.org/licenses/by-sa/4.0/deed.be"><img src="img/bysa.png"></a><p>2015 &ndash; 2016 dataШкола сообщества "<a href="http://opendata.by">Открытые данные для Беларуси</a>". Испытательная версия.</p></div>
    </footer>
        <script src="js/d3.v3.min.js" charset="utf-8"></script>
        <script src="js/script.js"></script>
</body>
</html>
<?php $db->close(); ?>
