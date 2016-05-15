<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
            };
    
    $db = new SQLite3("data/budgety.sqlite");
    
    $sql_get_title = "select area_title as title from area_titles where id = $id;";
    $sql_get_population = "select amount from population where area_id = $id order by year desc;";
    $sql_popravki_count = "select count(status) as count from popravki inner join area_titles on area_titles.area_title = popravki.region where id = $id and status <> 'П';";
    $sql_zaniato = "select amount from zaniato where area_id = $id order by year desc;";
    
    $title = $db->query($sql_get_title);
    $population = $db->query($sql_get_population);
    $popravki_count = $db->query($sql_popravki_count);
    $zaniato = $db->query($sql_zaniato);
    
    $pop_count = $population->fetchArray(SQLITE3_ASSOC)['amount'];
    $zaniato_count = $zaniato->fetchArray(SQLITE3_ASSOC)['amount'];
    $zaniato_percent = $zaniato_count / $pop_count * 100;
    
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
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter30802536 = new Ya.Metrika({
                    id:30802536,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
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
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/30802536" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    </head>
<body>
    <header>
        <a href="/budgety.by"><img src="img/logo.jpg"></a>
    </header>
    <main>
        <h1>Бюджетное обозрение Республики Беларусь</h1>
        <section id="caption">
        <p>Гражданский мониторинг государственных финансов</p>
        
        </section>

<h2><?php echo $title->fetchArray(SQLITE3_ASSOC)['title']; ?></h2>
<aside>
<p>Население: <?php echo number_format($pop_count, $decimals = 1); ?></p>
<p>Занято в экономике: <?php echo number_format($zaniato_count, $decimals = 1); ?> (<?php echo number_format($zaniato_percent, $decimals = 1); ?>%)</p>
<!--
<p>Валовый региональный продукт: </p>
-->
<p>Поправок в бюджет с начала года: <?php echo $popravki_count->fetchArray(SQLITE3_ASSOC)['count']; ?></p>
</aside>
   </main>
    <footer>
        <p>Сделано в dataШколе сообщества "<a href="http://opendata.by">Открытые данные для Беларуси</a>".<br>
        Испытательная версия.</p>
    </footer>
        <script src="js/d3.v3.min.js" charset="utf-8"></script>
        <script src="js/script.js"></script>
</body>
</html>
<?php $db->close(); ?>
