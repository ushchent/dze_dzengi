<?php
	//// Выдаем json. Потом сделаем на этой странице API.
	//if (isset($_GET['region']) and isset($_GET['function'])) {

		//$region = ($_GET['region']);
		//$function = ($_GET['function']);
    //$db = new SQLite3('../data/budgety.sqlite');
    ////echo "Ok<br>";
//function sort_table($a, $b) {
	//return $b['percent'] - $a['percent'];
//}

//function move_total($array_name) {
	//for ($i = 0; $i < count($array_name); $i++) {
		//if ($array_name[$i]['title'] == "ВСЕГО расходов") {
			//$totals = $array_name[$i];
			//array_splice($array_name, $i, 1);
		//}
	//};
	//array_push($array_name, $totals);
	//return $array_name;
//}


////echo $region . " - " . $function;

    //if ($region == "default" and $function == "default") {
	
	//// Вывод для всех функций без указания регионов. Это первая таблица по умолчанию.
	//$sql_total_plan_data = "select title, sum(amount) as plan from raskhody_f where status = 'П' and code_2 = 0 group by title";
		
	//$sql_total_popravki_data = 'select title, sum(amount) as changed from (select title, amount from raskhody_f where (region = "Могилевская область" and status = "У2" and code_2 = 0) or (region = "Минская область" and status = "У2" and code_2 = 0) or (region = "Витебская область" and status = "У1" and code_2 = 0) or (region = "Брестская область" and status = "У1" and code_2 = 0) or (region = "Гродненская область" and status = "У1" and code_2 = 0) or (region = "Минск" and status = "У1" and code_2 = 0) or (region = "Гомельская область" and status = "У1" and code_2 = 0)) group by title;';
	
	//$total_plan_data = $db->query($sql_total_plan_data);
	//$total_popravki_data = $db->query($sql_total_popravki_data);
	
	//$total_result_set = array();
	//$row_array = array();

	//while($row = $total_plan_data->fetchArray(SQLITE3_ASSOC)) {
		//$row_array['title'] = $row["title"];
		//$row_array['plan'] = $row["plan"];
		//array_push($total_result_set, $row_array);
	//}

	//$total_popravki_set = array();
	//while ($row = $total_popravki_data->fetchArray(SQLITE3_ASSOC)) {
		//$temp_arr = array();
		//$temp_arr['title'] = $row['title'];
		//$temp_arr['changed'] = $row['changed'];
		//array_push($total_popravki_set, $temp_arr); 
	//}

	//for ($i = 0; $i < count($total_result_set); $i++) {
		//for ($b = 0; $b < count($total_popravki_set); $b++) {
			//if ($total_result_set[$i]['title'] == $total_popravki_set[$b]['title']) {
				//$total_result_set[$i]['changed'] = $total_popravki_set[$b]['changed'];
				//$total_result_set[$i]["percent"] = 
					//number_format(($total_result_set[$i]['changed'] - $total_result_set[$i]['plan']) / 
					//$total_result_set[$i]['plan'] * 100, $decimals = 1);
			//}
		//}
	//}


//usort($total_result_set, "sort_table");

//$output = move_total($total_result_set);
//echo json_encode($output);
 ////  <select onchange="myFunction()">



    
//} else if ($region != "default" and $function == "default") {
	//// Вывод по указанному региону для всех видов расходов
	//$sql_region_plan = 'select region, title, amount as plan from raskhody_f inner join area_titles on area_titles.area_title = raskhody_f.region where id = ' . $region . ' and status = "П" and code_2 = 0;';

	//$sql_region_last_popravka = 'select distinct subject, status from popravki inner join area_titles on area_titles.area_title = popravki.region where id = ' . $region . ' group by subject order by status;';
	
	//$region_last_popravka = $db->query($sql_region_last_popravka);
	//$popravka = $region_last_popravka->fetchArray()['status'];
    


	//$sql_region_changed = 'select title, amount as changed from raskhody_f inner join area_titles on area_titles.area_title = raskhody_f.region where id = ' . $region . ' and status = "' . $popravka . '" and code_2 = 0;';
	
	

	//$region_plan_data = $db->query($sql_region_plan);
	//$region_changed_data = $db->query($sql_region_changed);


	//$result_set = array();
	//$row_array = array();

	//while($row = $region_plan_data->fetchArray()) {
		//$row_array['title'] = $row["title"];
		//$row_array['plan'] = $row["plan"];
		//array_push($result_set, $row_array);
	//}

	//$region_changed_set = array();
	//while ($row = $region_changed_data->fetchArray(SQLITE3_ASSOC)) {
		//$temp_arr = array();
		//$temp_arr['title'] = $row['title'];
		//$temp_arr['changed'] = $row['changed'];
		//array_push($region_changed_set, $temp_arr); 
	//}


	//for ($i = 0; $i < count($result_set); $i++) {
		//for ($b = 0; $b < count($region_changed_set); $b++) {
			//if ($result_set[$i]['title'] == $region_changed_set[$b]['title']) {
				//$result_set[$i]['changed'] = $region_changed_set[$b]['changed'];
				//$result_set[$i]["percent"] = 
					//number_format(($result_set[$i]['changed'] - $result_set[$i]['plan']) / 
					//$result_set[$i]['plan'] * 100, $decimals = 1);
			//}
		//}
	//}
    
//usort($result_set, "sort_table");

//$output = move_total($result_set);
//echo json_encode($output);

//} else if ($region != "default" and $function != "default"){
	//// вывод для всех регионов по указанной функции
	//// желательно сбросить селектор регионов - на JS?
	
	//// Определяем функцию

//// Проверь логику

	//$sql_function_plan = 'select region, id, amount as plan, function_id  from raskhody_f inner join functions on functions.function = raskhody_f.title inner join area_titles on area_titles.area_title = raskhody_f.region where function_id = ' . $function . ' and status = "П" and code_2 = 0;';

	//$sql_function_title = 'select function from functions where function_id = ' . $function . ';';

	//$get_function_title = $db->query($sql_function_title);
	//$function_title = $get_function_title->fetchArray()['function'];
	

	
	//$sql_function_changed = 'select title, amount as changed, region from (select title, amount, region from raskhody_f where (region = "Могилевская область" and status = "У2" and code_2 = 0) or (region = "Минская область" and status = "У2" and code_2 = 0) or (region = "Витебская область" and status = "У1" and code_2 = 0) or (region = "Брестская область" and status = "У1" and code_2 = 0) or (region = "Гродненская область" and status = "У1" and code_2 = 0) or (region = "Минск" and status = "У1" and code_2 = 0) or (region = "Гомельская область" and status = "У1" and code_2 = 0)) where title = "' . $function_title . '" group by region;';
	

	
	//$function_plan_data = $db->query($sql_function_plan);
	
	//$function_changed_data = $db->query($sql_function_changed);
	

	
	//$function_set = array();
	//$row_array = array();

	//while($row = $function_plan_data->fetchArray(SQLITE3_ASSOC)) {
		//$row_array['region'] = $row["region"];
		//$row_array['plan'] = $row["plan"];
        //$row_array['id'] = $row['id'];
		//array_push($function_set, $row_array);
	//}

	//$function_changed_set = array();
	//while ($row = $function_changed_data->fetchArray(SQLITE3_ASSOC)) {
		//$temp_arr = array();
		//$temp_arr['region'] = $row['region'];
		//$temp_arr['changed'] = $row['changed'];
		//array_push($function_changed_set, $temp_arr); 
	//}

	//for ($i = 0; $i < count($function_set); $i++) {
		//for ($b = 0; $b < count($function_changed_set); $b++) {
			//if ($function_set[$i]['region'] == $function_changed_set[$b]['region']) {
				//$function_set[$i]['changed'] = $function_changed_set[$b]['changed'];
				//$function_set[$i]["percent"] = 
					//number_format(($function_set[$i]['changed'] - $function_set[$i]['plan']) / 
					//$function_set[$i]['plan'] * 100, $decimals = 1);
			//}
		//}
	//};
//usort($function_set, "sort_table");



//echo json_encode($function_set);

//} else if ($region == "default" and $function != "default") {
//$sql_function_plan = 'select region, amount as plan, function_id, id  from raskhody_f inner join functions on functions.function = raskhody_f.title inner join area_titles on area_titles.area_title = raskhody_f.region where function_id = ' . $function . ' and status = "П" and code_2 = 0;';

	//$sql_function_title = 'select function from functions where function_id = ' . $function . ';';

	//$get_function_title = $db->query($sql_function_title);
	//$function_title = $get_function_title->fetchArray()['function'];
	

	
	//$sql_function_changed = 'select title, amount as changed, region from (select title, amount, region from raskhody_f where (region = "Могилевская область" and status = "У2" and code_2 = 0) or (region = "Минская область" and status = "У2" and code_2 = 0) or (region = "Витебская область" and status = "У1" and code_2 = 0) or (region = "Брестская область" and status = "У1" and code_2 = 0) or (region = "Гродненская область" and status = "У1" and code_2 = 0) or (region = "Минск" and status = "У1" and code_2 = 0) or (region = "Гомельская область" and status = "У1" and code_2 = 0)) where title = "' . $function_title . '" group by region;';
	

	
	//$function_plan_data = $db->query($sql_function_plan);
	
	//$function_changed_data = $db->query($sql_function_changed);
	

	
	//$function_set = array();
	//$row_array = array();

	//while($row = $function_plan_data->fetchArray(SQLITE3_ASSOC)) {
		//$row_array['region'] = $row["region"];
		//$row_array['plan'] = $row["plan"];
        //$row_array['id'] = $row['id'];
		//array_push($function_set, $row_array);
	//}

	//$function_changed_set = array();
	//while ($row = $function_changed_data->fetchArray(SQLITE3_ASSOC)) {
		//$temp_arr = array();
		//$temp_arr['region'] = $row['region'];
		//$temp_arr['changed'] = $row['changed'];
		//array_push($function_changed_set, $temp_arr); 
	//}

	//for ($i = 0; $i < count($function_set); $i++) {
		//for ($b = 0; $b < count($function_changed_set); $b++) {
			//if ($function_set[$i]['region'] == $function_changed_set[$b]['region']) {
				//$function_set[$i]['changed'] = $function_changed_set[$b]['changed'];
				//$function_set[$i]["percent"] = 
					//number_format(($function_set[$i]['changed'] - $function_set[$i]['plan']) / 
					//$function_set[$i]['plan'] * 100, $decimals = 1);
			//}
		//}
	//};
//usort($function_set, "sort_table");

//echo json_encode($function_set);


if (isset($_GET["id"])) {
	$db = new SQLite3('../data/budgety.sqlite');
	$query = (string)trim($_GET['id']);
	if (strlen($query) > 4) {
		$sql_area_title_declined = "SELECT area_title_declined, id from area_titles where area_title_declined like '%{$query}%';";
		
		$area_title_declined = $db->query($sql_area_title_declined);
		$area_titles_declined_output = array();
		while ($row = $area_title_declined->fetchArray(SQLITE3_ASSOC)) {
			$temp_arr = array();
			$temp_arr["area_title_declined"] = $row["area_title_declined"];
			$temp_arr["id"] = $row["id"];
			array_push($area_titles_declined_output, $temp_arr);
		}
		echo json_encode($area_titles_declined_output);
	
	} else {
	echo "Hello there";
	}


} else {

    //$db->close();
		
	echo "Unknown query.";
	}
	 

?>
