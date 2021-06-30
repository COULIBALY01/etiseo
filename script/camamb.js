function cammamber(data,id_graph){
var width = 800,
    height = 475,
    margin = 40;
// The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
var radius = Math.min(width, height) / 3 - margin;
//total value
var sum = 0;
for (let i = 0; i < data.length; i++) {
    sum+=parseFloat(data[i].value);
}

// append the svg object to the div called 'my_dataviz'
var svg = d3.select(id_graph)
  .append("svg")
    .attr("width", width-400)
    .attr("height", height-200)
  .append("g")
    .attr("transform", "translate(" + width/4  + "," + height / 4 + ")");



// set the color scale
var color = d3.scaleOrdinal()
    .domain(data.map(d => d.value))
    .range(d3.quantize(t => d3.interpolateRainbow(t*0.8  + 0.1), data.length));

var color2 = d3.scaleOrdinal()
              .domain(data.map(d => d.value))
              .range(d3.quantize(t => d3.interpolateSpectral(t*0.8  + 0.1), data.length));

// Compute the position of each group on the pie:
var pie = d3.pie().sort(null)
            .value(d => d.value)
var data_ready = pie(data)
// Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
svg.selectAll('circle')
  .data(data_ready)
  .enter()
  .append('path')
  .attr('d', d3.arc()
    .innerRadius(radius/2)         // This is the size of the donut hole
    .outerRadius(radius)
      )
  .attr("width", width)
  .attr("height", height)
  .attr("viewBox", "0, 0, " + width + ", " + height)
  .attr("preserveAspectRatio", "xMinYMin")
  .attr("class", d=>d.data.name.replace(/\s/g, '') )
  .style('fill', function(d){ return(color(d.data.name)) })
  .attr("stroke", "white")
  .style("stroke-width", "0.8px")
  .style("opacity", 0.5)
  .on("mouseover",d=>onOverEnter(d,color2))
  .on("mouseleave",d=>onOverLeave(d,color))
  
// create a tooltip

// set text value
arcLabel =  d3.arc().innerRadius(radius/2).outerRadius(radius);
svg.append('g')
    .attr("font-family", "sans-serif")
    .attr("font-size", 12)
    .attr("text-anchor", "middle")
    .selectAll("text")
    .data(data_ready)
    .join("text")
      .call(text => text.filter(d => (d.endAngle - d.startAngle) > 0.25).append("tspan") 
          .attr("fill-opacity", 0.9)
          .text(d => Math.round(((d.data.value/sum)*100)).toLocaleString()+"%"))
          .attr("transform",d=>"translate("+arcLabel.centroid(d)+")")
          .attr("class",d=>d.data.name.replace(/\s/g, ''))
          .style("text-anchor", "middle")
    

svg.append('g')
  .attr("font-family", "sans-serif")
  .attr("font-size", 12)
  .attr("text-anchor", "middle")
  .selectAll("text")
  .data(data_ready)
    .join("text")
    .call(text => text.filter(d => (d.endAngle - d.startAngle) > 0).append("tspan") 
      .text(d=>d.data.name+",\n"+d.data.value))
    .attr("id", d=>d.data.name.replace(/\s/g, ''))
    .style("position", "absolute")
    .style("visibility", "hidden")

// set text value label
/** 
svg.selectAll("mydots")
  
    .data(data_ready)
    .enter()
    .append("circle")
    .attr("transform", `translate(100,-150)`)
    .attr("cx", 100)
    .attr("cy", function(d,i){ return 100 + i*25}) // 100 is where the first dot appears. 25 is the distance between dots
    .attr("r", 7)
    .style("fill", function(d){ return color(d.data.name)})
    
svg.selectAll("mylabels")    
.data(data_ready)
.enter()
.append("text")
    .attr("transform", `translate(100,-150)`)
    .attr("x", 120)
    .attr("y", function(d,i){ return 100 + i*25}) // 100 is where the first dot appears. 25 is the distance between dots
    .style("fill", function(d){ return color(d.data.name)})
    .text(function(d){ return d.data.name})
    .attr("text-anchor", "left")
    .style("alignment-baseline", "middle")
    */

}


 onOverEnter = function(d){
    value=d.data.name.replace(/\s/g, '')

    d3.selectAll("." + value)
    .transition()
    .duration(200)
    .style("opacity", 1)
    .attr("font-size", 24);

    d3.select("#" + value)
    .style("visibility", "visible"); 
  }


  onOverLeave = function(d){

    value=d.data.name.replace(/\s/g, '');
   

    d3.selectAll("." + value)
    .transition()
    .duration(200)
    .style("opacity", 0.5)
    .attr("font-size", 12);

    d3.select("#" + value)
      .style("visibility", "hidden") 
    }

  textLabel = function(){
    const radius = Math.min(width, height) +100;
    return radius;
  }

