function addCommas(numberString) {
    numberString += '';
    x = numberString.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

var xScale = d3.scale.linear()
                .range([0, 600]);
                
var yScale = d3.scale.linear()
                .range([0, 60]);

var bsgu_rev = d3.select("#bsgu_rev")
            .append("svg")
            .attr({
                width: 800,
                height: 40
            });

var bsgu_spent = d3.select("#bsgu_spent")
            .append("svg")
            .attr({
                width: 800,
                height: 40
            });

var resp_rev = d3.select("#resp_rev")
            .append("svg")
            .attr({
                width: 800,
                height: 40
            });
var resp_spent = d3.select("#resp_spent")
            .append("svg")
            .attr({
                width: 800,
                height: 40
            });

d3.json("data/data.json", function(data) {
    var bsgu_rev_data = data.filter(function(d) { return d.type == "Всего" && d.title == "Всего доходов"; });
    var bsgu_spent_data = data.filter(function(d) { return d.type == "Всего" && d.title == "Всего расходов"; });
    var resp_rev_data = data.filter(function(d) { return d.type == "Республиканский" && d.title == "Всего доходов"; });
    var resp_spent_data = data.filter(function(d) { return d.type == "Республиканский" && d.title == "Всего расходов"; });
    
    xScale.domain([0, d3.max(data, function(d) { return d.amount})]);

// БСГУ
bsgu_rev.selectAll("rect")
        .data(bsgu_rev_data)
        .enter()
        .append("rect")
        .attr({
            x: 80,
            y: 0,
            width: function(d) { return xScale(d.amount); },
            height: 40,
            fill: function(d) { return (d.status == "УП") ?  "#F46A60" : "#2A2F4E"; },
        });

bsgu_rev.selectAll("text")
    .data(bsgu_rev_data)
    .enter()
    .append("text")
    .attr({
        x: function(d) { return (d.status == "УП") ?  (xScale(d.amount) - 60) : 85; },
        y: 25,
        fill: "white",
        opacity: .9
    })
    .text(function(d) {return (d.status == "УП") ? "План: " +
    addCommas(d.amount) : addCommas(d.amount); });

    bsgu_spent.selectAll("rect")
        .data(bsgu_spent_data)
        .enter()
        .append("rect")
        .attr({
            x: 80,
            y: 0,
            width: function(d) { return xScale(d.amount); },
            height: 40,
            fill: function(d) { return (d.status == "УП") ?  "#F46A60" : "#2A2F4E"; },
        });

    bsgu_spent.selectAll("text")
    .data(bsgu_spent_data)
    .enter()
    .append("text")
    .attr({
        x: function(d) { return (d.status == "УП") ?
        (xScale(d.amount) - 60) : 85; },
        y: 25,
        fill: "white",
        opacity: .9
    })
    .text(function(d) { return (d.status == "УП") ? "План: " +
    addCommas(d.amount) : addCommas(d.amount); });

bsgu_rev.append("text")
        .attr({
            x: 0,
            y: 25
            })
        .text("Доходы");
bsgu_spent.append("text")
        .attr({
            x: 0,
            y: 25
            })
        .text("Расходы");

// Республиканский
resp_rev.selectAll("rect")
        .data(resp_rev_data)
        .enter()
        .append("rect")
        .attr({
            x: 80,
            y: 0,
            width: function(d) { return xScale(d.amount); },
            height: 40,
            fill: function(d) { return (d.status == "УП") ?  "#F46A60" : "#2A2F4E"; },
        });

resp_rev.selectAll("text")
    .data(resp_rev_data)
    .enter()
    .append("text")
    .attr({
        x: function(d) { return (d.status == "УП") ?  (xScale(d.amount) - 50) : 85; },
        y: 25,
        fill: "white",
        "font-size": function(d) { return (d.status == "Исполнено") ?  "9px" : "14px"; },
        opacity: .9
    })
    .text(function(d) { return (d.status == "УП") ? "План: " +
    addCommas(d.amount) : addCommas(d.amount); });

    resp_spent.selectAll("rect")
        .data(resp_spent_data)
        .enter()
        .append("rect")
        .attr({
            x: 80,
            y: 0,
            width: function(d) { return xScale(d.amount); },
            height: 40,
            fill: function(d) { return (d.status == "УП") ?  "#F46A60" : "#2A2F4E"; },
        });

resp_spent.selectAll("text")
    .data(resp_spent_data)
    .enter()
    .append("text")
    .attr({
        x: function(d) { return (d.status == "УП") ?  (xScale(d.amount) - 50) : 85; },
        y: 25,
        fill: "white",
        "font-size": function(d) { return (d.status == "Исполнено") ?  "9px" : "14px"; },
        opacity: .9
    })
    .text(function(d) { return (d.status == "УП") ? "План: " +
    addCommas(d.amount) : addCommas(d.amount); });

    resp_rev.append("text")
        .attr({
            x: 0,
            y: 25
            })
        .text("Доходы");

    resp_spent.append("text")
        .attr({
            x: 0,
            y: 25
            })
        .text("Расходы");
        });
        
// Работа с селекторами меню

function call_selected() {
    var options =  [];
    for (var i = 0; i < menu_oblast.length; i++) {
        options.push(menu_oblast[i].value);
    };

var request;

          if (window.XMLHttpRequest) {
            
            request = new XMLHttpRequest();
          } else {  
            request = new ActiveXObject("Microsoft.XMLHTTP");
          }

request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
              
              var data = JSON.parse(request.responseText);
              jsonData = data;
              
              if (document.getElementById("output_table")) {
                  document.getElementById("output_table").remove();
              };
              var target = document.getElementById("menu");
              var output_table = document.createElement("table");
              output_table.setAttribute("id", "output_table");
              var table_head = document.createElement("thead");
              if (data[0]['region']) {
                  var head_row = document.createElement("tr");
                  var headers = ["Регион", "По плану", "Уточнено", "%"];
                  for (var a = 0; a < headers.length; a++) {
                      var head_cell = document.createElement("td");
                      var head_cell_data = document.createTextNode(headers[a]);
                      head_cell.appendChild(head_cell_data);
                      head_row.appendChild(head_cell);
                      
                  }
              } else if (data[0]['title']) {
                var head_row = document.createElement("tr");
                  var headers = ["Вид расходов", "По плану", "Уточнено", "%"];
                  for (var a = 0; a < headers.length; a++) {
                      var head_cell = document.createElement("td");
                      var head_cell_data = document.createTextNode(headers[a]);
                      head_cell.appendChild(head_cell_data);
                      head_row.appendChild(head_cell);
              }
          }
            table_head.appendChild(head_row);
            output_table.appendChild(table_head);
            target.appendChild(output_table);
              var final_row;
              var table_body = document.createElement("tbody");
              for (var i = 0; i < data.length; i++) {

                var body_row = document.createElement("tr");
                var keys = Object.keys(data[0]);

                for (var b = 0; b < keys.length; b++) {
                    if (keys[b] == "plan" || keys[b] == "changed") {
                        var row_cell_text = document.createTextNode(addCommas(data[i][keys[b]]));
                    } else {
                    var row_cell_text = document.createTextNode(data[i][keys[b]]);
                    }
                    var row_cell = document.createElement("td");
                    row_cell.appendChild(row_cell_text);
                    body_row.appendChild(row_cell);
                }
                table_body.appendChild(body_row);
              }

                table_body.appendChild(body_row);
              output_table.appendChild(table_body);
    if (data[0].region) {
    document.getElementById('regions').getElementsByTagName('option')[0].selected = 'selected';
 };
            }
          }
          request.open("GET","api/?region=" + options[0] + "&function=" + options[1], true);
          request.send();
    };

var menu_oblast = document.getElementById("menu").getElementsByTagName("select");
//console.log(menu_oblast);
for (var i = 0; i < menu_oblast.length; i++) {
    menu_oblast[i].onchange = call_selected;
    };
