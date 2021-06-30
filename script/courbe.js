
var body=d3.select("body");
var format_date=d3.time.format("%d/%m/%Y");
var echelleX = d3.time.scale().range([50, 870]);
var echelleY= d3.scale.linear().range([570,50]);
var xAxe = d3.svg.axis()
                  .scale(echelleX)
                  .orient("bottom");
var yAxe = d3.svg.axis()
                  .scale(echelleY)
                  .orient("left");
var line = d3.svg.line()
    .x(function(d) { return echelleX(d.date); })
    .y(function(d) { return echelleY(d.close); });
var svg=body.append("svg");
svg.attr({"width":"900px","height":"600px"});
d3.tsv("data.tsv", function(data) {
	data.forEach(function(d) {
        d.date = format_date.parse(d.date);
        d.close = +d.close;
    });
   echelleX.domain(d3.extent(data, function(d) { return d.date; }));
   echelleY.domain(d3.extent(data, function(d) { return d.close; }));
   svg.append("g")
    	.style("font-family","sans-serif")
    	.style("font-size","9px")
    	.attr({"fill": "none","stroke": "black"})
    	.attr("transform","translate(0,570)")
    	.call(xAxe);
	svg.append("g")
    	.style("font-family","sans-serif")
    	.style("font-size","11px")
    	.attr({"fill": "none","stroke": "black"})
    	.attr("transform","translate(50,0)")
    	.call(yAxe);

   svg.append("path")
      .datum(data)
      .attr({"fill": "none", "stroke": "black","stroke-width": "1px"})
      .attr("d",line);
     
});