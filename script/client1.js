function client(data){
  
    var width = 800
        height = 450
        margin = 40
    // The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
    var radius = Math.min(width, height) / 2 - margin
    
    //total value
    var sum = 0;
    for (let i = 0; i < data.length; i++) {
        sum+=parseFloat(data[i].value);
        
    }
    console.log(data);
    console.log(sum);
    // append the svg object to the div called 'my_dataviz'
    var svg = d3.select("#graph1")
      .append("svg")
        .attr("width", width)
        .attr("height", height)
      .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
    
    
    
    // set the color scale
    var color = d3.scaleOrdinal()
        .domain(data.map(d => d.value))
        .range(d3.quantize(t => d3.interpolateSpectral(t*0.8  + 0.1), data.length));
    
    // Compute the position of each group on the pie:
    console.log(color);
    var pie = d3.pie().sort(null)
      .value(d => d.value)
    var data_ready = pie(data)
    console.log(data_ready);
    // Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
    svg
      .selectAll('whatever')
      .data(data_ready)
      .enter()
      .append('path')
      .attr('d', d3.arc()
        .innerRadius(100)         // This is the size of the donut hole
        .outerRadius(radius)
      )
      .attr('fill', function(d){ return(color(d.data.name)) })
      .attr("stroke", "white")
      .style("stroke-width", "0.8px")
      .style("opacity", 0.7);
    
    // set text value
    svg.append('g')
        .attr("font-family", "sans-serif")
        .attr("font-size", 12)
        .attr("text-anchor", "middle")
        .selectAll("text")
        .data(data_ready)
        .join("text")
        .attr("transform", d => `translate(${arcLabel().centroid(d)})`)
    
          .call(text => text.filter(d => (d.endAngle - d.startAngle) > 0.25).append("tspan")
              .attr("x", 0)
              .attr("y", "0.7em")
              .attr("fill-opacity", 0.7)
              .text(d => Math.round(((d.data.value/sum)*100)).toLocaleString()+"%"));
    
    // set text value label
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
    
    }
    arcLabel = function(){
        const radius = Math.min(width, height) / 2 * 0.7;
        return d3.arc().innerRadius(radius).outerRadius(radius);
      }
    
      textLabel = function(){
        const radius = Math.min(width, height) +100;
        return radius;
      }
    