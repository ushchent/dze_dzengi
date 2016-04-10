var xScale = d3.scale.linear()
                .range([0, 600]);
var bsgu = d3.select("#bsgu")
			.append("svg")
			.attr({
				width: 800,
				height: 120
			});

var resp = d3.select("#resp")
			.append("svg")
			.attr({
				width: 800,
				height: 120
			});

var fszn = d3.select("#fszn")
			.append("svg")
			.attr({
				width: 800,
				height: 120
			});


d3.json("data/data_2016.json", function(data) {
    var bsguSpending = data.filter(function(d) { return d.title == "БСГУ" && d.type == "Расходы"});
  var bsguRevenue = data.filter(function(d) { return d.title == "БСГУ" && d.type == "Доходы"; });
	var respSpending = data.filter(function(d) { return d.title == "Республиканский" && d.type == "Расходы"; });
  var respRevenue = data.filter(function(d) { return d.title == "Республиканский" && d.type == "Доходы"; });
    var fsznRevenue = data.filter(function(d) { return d.title == "ФСЗН" && d.type == "Доходы"; });
var fsznSpending = data.filter(function(d) { return d.title == "ФСЗН" && d.type == "Расходы"; });

// БСГУ
    xScale.domain([0, bsguRevenue[0].amount])
    bsgu.append("rect")
        .attr({
            x: 90,
            y: 10,
            width: xScale(bsguRevenue[0].amount),
            height: 30,
            fill: "#F46A60",
            opacity: .8
    });
    bsgu.append("rect")
        .attr({
            x: 90,
            y: 10,
            width: xScale(bsguRevenue[1].amount),
            height: 30,
            fill: "#2A2F4E",
            opacity: .9
    })
        .append("text")
        .attr({
            x: 110,
            y: 15
    })

        .text(bsguRevenue[1].amount);
    bsgu.append("text")
        .attr({
            x: 0,
            y: 30 
        })
        .text("Доходы");
    bsgu.append("text")
        .attr({
            x: 0,
            y: 70
        })
        .text("Расходы");
    bsgu.append("text")
        .attr({
            x: 0,
            y: 110
        })
        .text("Долг");
    bsgu.append("rect")
        .attr({
            x: 90,
            y: 50,
            width: xScale(bsguSpending[0].amount),
            height: 30,
            fill: "#F46A60",
            opacity: .7 
    });
    bsgu.append("rect")
        .attr({
            x: 90,
            y: 50,
            width: xScale(bsguSpending[1].amount),
            height: 30,
            fill: "#2A2F4E",
            opacity: .9
    });
    bsgu.append("rect")
        .attr({
            x: 90,
            y: 90,
            width: xScale(379000),
            height: 20,
            fill: "black",
            opacity: .6
    });
    
// Республиканский

    resp.append("rect")
        .attr({
            x: 90,
            y: 10,
            width: xScale(respRevenue[0].amount),
            height: 30,
            fill: "#F46A60",
            opacity: .8
    });
    resp.append("rect")
        .attr({
            x: 90,
            y: 10,
            width: xScale(respRevenue[1].amount),
            height: 30,
            fill: "#2A2F4E",
            opacity: .9
    });
    resp.append("text")
        .attr({
            x: 0,
            y: 30 
        })
        .text("Доходы");
    resp.append("text")
        .attr({
            x: 0,
            y: 70
        })
        .text("Расходы");
    //resp.append("text")
        //.attr({
            //x: 0,
            //y: 110
        //})
        //.text("Долг");
    resp.append("rect")
        .attr({
            x: 90,
            y: 50,
            width: xScale(respSpending[0].amount),
            height: 30,
            fill: "#F46A60",
            opacity: .7 
    });
    resp.append("rect")
        .attr({
            x: 90,
            y: 50,
            width: xScale(respSpending[1].amount),
            height: 30,
            fill: "#2A2F4E",
            opacity: .9
    });
    //resp.append("rect")
        //.attr({
            //x: 90,
            //y: 90,
            //width: xScale(379000),
            //height: 20,
            //fill: "#F46A60",
            //opacity: .5
    //});

// ФСЗН

    fszn.append("rect")
        .attr({
            x: 90,
            y: 10,
            width: xScale(fsznRevenue[0].amount),
            height: 30,
            fill: "#F46A60",
            opacity: .8
    });
    fszn.append("rect")
        .attr({
            x: 90,
            y: 10,
            width: xScale(fsznRevenue[1].amount),
            height: 30,
            fill: "#2A2F4E",
            opacity: .9
    });
    fszn.append("text")
        .attr({
            x: 0,
            y: 30 
        })
        .text("Доходы");
    fszn.append("text")
        .attr({
            x: 0,
            y: 70
        })
        .text("Расходы");
    //fszn.append("text")
        //.attr({
            //x: 0,
            //y: 110
        //})
        //.text("Долг");
    fszn.append("rect")
        .attr({
            x: 90,
            y: 50,
            width: xScale(fsznSpending[0].amount),
            height: 30,
            fill: "#F46A60",
            opacity: .7 
    });
    //fszn.append("rect")
        //.attr({
            //x: 90,
            //y: 50,
            //width: xScale(respSpending[1].amount),
            //height: 30,
            //fill: "#2A2F4E",
            //opacity: .9
    //});
    //fszn.append("rect")
        //.attr({
            //x: 90,
            //y: 90,
            //width: xScale(379000),
            //height: 20,
            //fill: "#F46A60",
            //opacity: .5
    //});

});
