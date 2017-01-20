var message = d3.select("#message");
var random_budget_id;
var selected_budget_id;
var budget_titles;
var years;
//var budget_code;


//function get_data_by_year(year) {
	//var data_for_year = data.filter(function(d) { return d.year == year; });
	//var response = [];
	//var poplanu = data_for_year.filter(function(d) { return d.status == "П"; });
	//var pofaktu = data_for_year.filter(function(d) { return d.status == "О"; });

	//for (var a = 0; a < poplanu.length; a++) {
		//for (var b = 0; b < pofaktu.length; b++) {
			//if (poplanu[a].function_title == pofaktu[b].function_title) {
				//response[a] = [];
				//var percentage = (pofaktu[b].amount - poplanu[a].amount) / poplanu[a].amount * 100;
				//var f_title = poplanu[a].function_title;
				//response[a].push(f_title, poplanu[a].amount, pofaktu[b].amount, percentage)
			//} else {
				//continue;
			//}
		//}
	//}
	//for (var i = 0; i < response.length; i++) {
		//if (response[i][0] == "Всего расходов") {
		//var	total = response.splice(i, 1);
	//}
	//}
	//response.sort(function(a, b) { return b[3] - a[3]; });
	//response.push(total[0]);
	//return response;

//}

var formatter = d3.format(",.1f");

//var show_years = ispolneno.map(function(d) { return d.year; });

//var show_year = show_years[show_years.length - 1];
//d3.select("#current_year").text(show_year);
//var year_selection = get_data_by_year(show_year);

//// year_selection.sort(function(a, b) { return b[3] - a[3]; });


//trs.selectAll("td")
	//.data(function(d) { return get_values(d); })
	//.enter()
	//.append("td")
	//.text(function(d) { return (typeof(d) == "number") ? formatter(d) : d; });



var target = d3.select("#graph")
	.append("svg")
	.attrs({
		width: 800,
		height: 250
	});
var legend_data = ["По плану", "По факту"];

var color = d3.scaleOrdinal()
			.domain(legend_data)
			.range(["#EB6A65", "#2A2F4E"])

var legend = target.append("g")
				.attr("transform", "translate(120, 10)");
legend.selectAll("circle")
				.data(legend_data)
				.enter()
				.append("circle")
				.attrs({
					cx: 10,
					cy: function(d, i) { return i * 15; },
					r: 4,
					class: "legend",
					fill: function(d) { return color(d); }
				});
	legend.selectAll("text")
		.data(legend_data)
		.enter()
		.append("text")
		.attrs({
			x: 20,
			y: function(d, i) { return i * 15 + 4; },
			"font-size": "10px"
		})
		.text(function(d) { return d; });

var x_scale = d3.scaleBand()
                .range([0, 700])
                .round(true);
var y_scale = d3.scaleLinear()
				.range([240, 10]);
//
//var formatter = d3.format(",.1f");

var y_axis = d3.axisLeft(y_scale)
				.ticks(5)
			.tickFormat(function(d) { return formatter(d); });


var line = d3.line()
			.x(function(d) { return x_scale(d.year) + 80 + x_scale.bandwidth() / 2; })
			.y(function(d) { return y_scale(+d.amount); });
var fakt_line = d3.line()
			.x(function(d) { return x_scale(d.year) + 80 + x_scale.bandwidth() / 2; })
			.y(function(d) { return y_scale(+d.amount); });

function get_plan(d) {
	if (d.plan) {
		return d.plan;
	}
}

var area = d3.area()
    .x(function(d) { return x_scale(d.year) + 80 + x_scale.bandwidth() / 2; })
    .y0(230)
    .y1(function(d) { return y_scale(+d.amount); });



//d3.select("svg")
	//.append("path")
	//.attr("d", line(plan))
	//.attr("class", "plan");

//d3.select("svg")
	//.append("path")
	//.attr("d", line(ispolneno))
	//.attr("class", "fact");

  //target.append("path")
      //.datum(plan)
      //.attr("class", "area poplanu")
      //.attr("d", area);
  //target.append("path")
      //.datum(ispolneno)
      //.attr("class", "area ispolneno")
      //.attr("d", area);

//target.selectAll("circle.fact")
	//.data(ispolneno)
	//.enter()
	//.append("circle")
	//.attr({
		//cy: function(d) { return y_scale(d.amount); },
		//cx: function(d, i) { return i * x_scale.rangeBand() + x_scale.rangeBand() / 2 + 80; },
		//r: 3,
		//class: "fact",
		//fill: "#2A2F4E",
		//title: function(d) { return d.amount; }
//});


//target.selectAll("circle.plan")
	//.data(plan)
	//.enter()
	//.append("circle")
	//.attrs({
		//cy: function(d) { return y_scale(d.amount); },
		//cx: function(d, i) { return i * x_scale.bandwidth() + x_scale.bandwidth() / 2 + 80; },
		//r: 3,
		//class: "plan",
		//fill: "#EB6A65",
		//title: function(d) { return d.amount; }
//});

//	

//
	
////var x_axis_years = d3.select(".x.axis").selectAll("g");
////console.log(x_axis_years);

////for (var i = 0; i < x_axis_years[0].length; i++) {
	////if (x_axis_years[0][i].textContent == show_year) {
		////d3.select(x_axis_years[0][i]).classed("active", true);
	////}
////}

//target.select(".x.axis")
		//.selectAll("g")
		//.on("click", function() {
			//var text = d3.select(this).select("text").text();
			//d3.select(".x.axis").selectAll("text").classed("active", false);
			//d3.select(this).select("text").classed("active", true);
			//d3.select("#current_year").text(text);
			//year_selection = get_data_by_year(text);
			
//trs.data(year_selection);

//trs.selectAll("td")
	//.data(function(d) { return get_values(d); })
	//.text(function(d) { return (typeof(d) == "number") ? formatter(d) : d; });
		//});

//// Для одностраничной версии

var fioField = d3.select("#budget_title");
fioField.on("focus", function() {
        if (this.value == "Введите название бюджета") {
            this.value = "";
        }
    })
    .on("blur", function() {
        if (this.value == "") {
            this.value = "Введите название бюджета";
        }
   });

////draw_button.on("click", function() {
	////d3.select("#show_fio").classed("hidden", true);
	////d3.json("api.php?d=" + fioField.node().value, draw);
	////});

////d3.json("api.php?d=" + fio_selected, draw)

function get_budget_title(str) {
	var target = d3.select("#show_budget_title");

	var list = target.select("ul");

	if (str.length <= 4 || str == "Введите название бюджета") {
		target.classed("hidden", true);
	} else if (str.length > 4) {
		var search_string = RegExp(str);
		var response = [];
		for (var i = 0; i < budget_titles.length; i++) {
			if (budget_titles[i][0].match(search_string)) {
				response.push(budget_titles[i]);
			}
		}
		if (response.length == 0) {
			target.classed("hidden", true);
			message.text("Запрос не найден.");
		} else {
			target.classed("hidden", false);
				message.text("");
				var list_items = list.selectAll("li")
										.data(response);
				list_items.enter()
					.append("li");
				list_items.text(function(d) { return d[0] ; })
						.attr("id", function(d) { return d[1]; });
				target.selectAll("li")
					.on("click", function() {
						var budget_title_text = d3.select(this).text();
						selected_budget_id = d3.select(this).attr("id");
						console.log(selected_budget_id);
						draw(selected_budget_id);
						var budget_title_field = d3.select("#budget_title");
						budget_title_field.node().value = budget_title_text;
						budget_title_field.node().defaultValue = budget_title_text;
						target.classed("hidden", true);
					});
				list_items.exit()
						.remove();
			}
	}
}

function manage_input(data) {
	
	var titles_subset = data.filter(function(d) { return d.present == 1; })
	
	budget_titles = titles_subset.map(function(d) {
		
		return Array(d.area_title_declined, d.id);
	
	});
	var random_number = Math.floor(Math.random() * (budget_titles.length));
	var random_title = budget_titles[random_number][0];
	random_budget_id = budget_titles[random_number][1];
	d3.select("#budget_title").node().value = budget_titles[random_number][0];
	console.log(random_budget_id);
	console.log("I am random", random_budget_id);
	draw(random_budget_id);
}

d3.csv("data/titles.csv", manage_input);

// Основная функция для рисования графика и таблицы.

function generate_graph_data(data, type, function_title) {
	var response = [];
	for (var a in data) {
		for (var b = 0; b < data[a].length; b++) {
		if (data[a][b]["function"] == function_title && data[a][b][type]) {
			response.push({"year": a, "amount": +data[a][b][type]})
			}
	}
	}
	return response;
}


function draw(budget_id) {

d3.json("data/" + budget_id + ".json", function(data) {
	console.log(data);
	years = Object.keys(data);
	//years = new Set(data.map(function(d) { return +d.year; }));
	console.log(years);

var last_year = years.sort()[ years.length- 1]

var amount_list = [];
//var amount_list = data.map(function(d) { return d.amount; })




for (var i = 0; i < years.length; i++) {
	for (var b = 0; b < data[years[i]].length; b++) {
		if (data[years[i]][b].edit) {
			amount_list.push(data[years[i]][b].edit);
		} else if (data[years[i]][b].plan) {
			amount_list.push(data[years[i]][b].plan);
		} else if (data[years[i]][b].spent) {
			amount_list.push(data[years[i]][b].spent);
			}
	}
	
}


var max_value = d3.max(amount_list, function(d) { return +d; });
y_scale.domain([0, max_value]);
//console.log(max_value);

x_scale.domain(years);

var x_axis = d3.axisBottom(x_scale);

target.append("g")
	.attr("class", "x axis")
	.attr("transform", "translate(80, 230)")
	.call(x_axis);

target.append("g")
	.attr("class", "y axis")
	.attr("transform", "translate(80, -10)")
	.call(y_axis);



//console.log(amount_list);

// generate_graph_data(data, type = "plan", function_title = "Всего расходов")



var plan = generate_graph_data(data, type = "plan", function_title = "Всего расходов");
console.log(plan);
var fakt = generate_graph_data(data, type = "spent", function_title = "Всего расходов");
console.log(fakt);

//var poplanu = data.map(function(d) { return d.plan; });
//var pofaktu = data[2015].map(function(d) { return d.spent || d.edit; });

//console.log(poplanu);
//console.log(pofaktu);


d3.select("svg")
	.append("path")
	.attr("d", line(plan))
	.attr("class", "plan");

d3.select("svg")
	.append("path")
	.attr("d", line(fakt))
	.attr("class", "fact");

  target.append("path")
      .datum(plan)
      .attr("class", "area poplanu")
      .attr("d", area);
  target.append("path")
      .datum(fakt)
      .attr("class", "area ispolneno")
      .attr("d", area);

target.selectAll("circle.plan")
	.data(plan)
	.enter()
	.append("circle")
	.attrs({
		cy: function(d) { return y_scale(d.amount); },
		cx: function(d, i) { return i * x_scale.bandwidth() + x_scale.bandwidth() / 2 + 80; },
		r: 3,
		class: "plan",
		fill: "#EB6A65",
		title: function(d) { return d.amount; }
});

target.selectAll("circle.fact")
	.data(fakt)
	.enter()
	.append("circle")
	.attrs({
		cy: function(d) { return y_scale(d.amount); },
		cx: function(d, i) { return i * x_scale.bandwidth() + x_scale.bandwidth() / 2 + 80; },
		r: 3,
		class: "fact",
		fill: "#2A2F4E",
		title: function(d) { return d.amount; }
});


function get_sibling(datum) {
	    if (datum['spent']) {
	        var sibling = datum['spent'];
	    } else if (datum['edit']) {
	        sibling = datum['edit'];
	    }
    return sibling;
}
        












function extract_data(par) {
	response = [];
	for (var i = 0; i < years.length; i++) {
		var filtered_object = data[years[i]].filter(function(d) { return d.function == par; })[0];
		filtered_object.year = years[i];
		response.push(filtered_object);
	}
	return response;
}
function get_values(d) {
	var alist = [];
    alist.push(d["function"], d.plan, d.edit ? d.edit : d.spent, formatter((d.edit ? d.edit : d.spent - d.plan) / d.plan * 100));
	return alist;
}

//console.log(response);

var table = d3.select("#table")
				.append("table");

function make_table_headers(data) {
	//var key = Object.keys(data)[0];
	var response = ["Статья", "По плану"];
	for (var i = 0; i < data.length; i++) {
		if (data[i].edit) {
			response.push("Уточнено", "%");
			break;
		} else if (data[i].spent) {
			response.push("Исполнено", "%");
			break;
		}
	}
	return response;
}

var table_headers = make_table_headers(data[last_year])
table.append("thead")
	.append("tr")
	.selectAll("td")
	.data(table_headers)
	.enter()
	.append("td")
	.text(function(d) { return d; });

var tbody = table.append("tbody");

var trs = tbody.selectAll("tr")
			.data(data[last_year])
			.enter()
			.append("tr");

trs.selectAll("td")
	.data(function(d) { return get_values(d); })
	.enter()
	.append("td")
	.text(function(d) { return d; });

//var plan = extract_data("Всего расходов");
//console.log(plan);
});


}


//var ispolneno = data.filter(function(d) { return d.status == "О" && d.function_title == "Всего расходов"; });


