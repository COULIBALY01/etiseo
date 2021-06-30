function histo(data,id_dom){

    const margin = {top: 20, right: 20, bottom: 90, left: 120},
        width = 800 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;
	

    const x = d3.scaleBand()
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .range([height, 0]);
	
	

    const svg = d3.select(id_dom).append("svg")
        .attr("id", "svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
	
	

    const div = d3.select(id_dom).append("div")
        .attr("class", "tooltip")         
        .style("opacity", 0);

    // traitement des données


// On demande à D3JS de charger notre fichier

    // Pour l'axe Y, c'est le max des populations
    x.domain(data.map(d => d.created));
    y.domain([0, d3.max(data, d => d.termine)]);
    
    // Ajout de l'axe X au SVG
    // Déplacement de l'axe horizontal et du futur texte (via la fonction translate) au bas du SVG
    // Selection des noeuds text, positionnement puis rotation
    svg.append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x).tickSize(0))
        .selectAll("text")	
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", "rotate(-65)");
    
    // Ajout de l'axe Y au SVG avec 6 éléments de légende en utilisant la fonction ticks (sinon D3JS en place autant qu'il peut).
    svg.append("g")
        .call(d3.axisLeft(y).ticks(6));

    // Ajout des bars en utilisant les données de notre fichier data.tsv
    // La largeur de la barre est déterminée par la fonction x
    // La hauteur par la fonction y en tenant compte de la population
    // La gestion des events de la souris pour le popup
    svg.selectAll(".bar")
        .data(data)
    .enter().append("rect")
        .attr("class", "bar")
        .attr("x", d => x(d.created))
        .attr("width", x.bandwidth())
        .attr("y", d => y(d.termine))
        .attr("height", d => height - y(d.termine))	
        .style("fill","rgba(0,100,100,.6)")				
        .on("mouseover", function(d) {
            div.transition()        
                .duration(10)      
                .style("opacity", 2);
            div.html("Termine : " + d.termine)
                .style("left", (d3.event.pageX + 10) + "px")     
                .style("top", (d3.event.pageY - 50) + "px");
        })
        .on("mouseout", function(d) {
            div.transition()
                .duration(10)
                .style("opacity", 0);
        });
}


function line(data,id_dom){
    const margin = {top: 20, right: 20, bottom: 90, left: 120},
    width = 800 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

    const parseTime = d3.timeParse("%Y-%m-%d");
    const dateFormat = d3.timeFormat("%Y-%m-%d");
    const x = d3.scaleTime()
    .range([0, width]);

    const y = d3.scaleLinear()
        .range([height, 0]);
     // Ajout d'un path calculé par la fonction line à partir des données de notre fichier.
     
    const line = d3.line()
        .x(d => x(d.created))
        .y(d => y(d.termine));
    var map = {};
    data.forEach(function(d) {
        d.created =+parseTime(d.created);
        map[d.created] = d; // sauvegarde sous forme de hashmap de nos données.
    });
   
    console.log(line(data));
    const svg = d3.select(id_dom).append("svg")
        .attr("id", "svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    
        x.domain(d3.extent(data,d=>d.created))
        y.domain(d3.extent(data, d => d.termine));

          // Ajout de l'axe X
    svg.append("g")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x).tickFormat(d3.timeFormat("%d/%m/%Y")))
    .selectAll("text")	
    .style("text-anchor", "end")
    .attr("dx", "-.8em")
    .attr("dy", ".15em")
    .attr("transform", "rotate(-65)");

    // Ajout de l'axe Y et du texte associé pour la légende
    svg.append("g")
        .call(d3.axisLeft(y))
        .append("text")
        .attr("fill", "#000")
        .attr("transform", "rotate(-90)")
        .attr("y", 6)
        .attr("dy", "0.71em")
        .style("text-anchor", "end")
        .text("Pts");

    svg.selectAll("y axis").data(y.ticks(10)).enter()
        .append("line")
        .attr("class", "horizontalGrid")
        .attr("x1", 0)
        .attr("x2", width)
        .attr("y1", d => y(d))
        .attr("y2", d => y(d));
    
   

    svg.append("path")
        .datum(data)
        .attr("class", "line")
        .attr("d", line)
        .attr('fill',"green").attr('stroke','blue')
        .attr("fill-opacity", .3)
        .attr("d", d3.area()
            .x(function(d) { return x(d.created) })
            .y0( height )
            .y1(function(d) { return y(d.termine) }));
    
            // Define the div for the tooltip
    var div = d3.select(id_dom).append('div')	
    .attr('class', 'tooltip').style("opacity", 0);

    svg.selectAll("myCircles")
      .data(data)
      .enter()
      .append("circle")
        .attr("fill", "red")
        .attr("stroke", "none")
        .attr("cx", function(d) { return x(d.created) })
        .attr("cy", function(d) { return y(d.termine) })
        .attr("r", 5).style('opacity','0.5')
        .on("mouseover", function(d) {	
            div.transition()		
                .duration(50)		
                .style("opacity", .9);		
            div.html(dateFormat(d.created) + "<br/>"  + d.termine)	
                .style("left", (d3.event.pageX) + "px")		
                .style("top", (d3.event.pageY - 28) + "px");	
            })					
        .on("mouseout", function(d) {		
            div.transition()		
                .duration(50)		
                .style("opacity", 0);	
        });
        
}