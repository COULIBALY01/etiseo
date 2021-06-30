	/*	Function: renderPieChart
    *	Variables:
    *		*	dataset: contains the input data for plotting the pie chart,
    *					input should be in the form of array of objects where each object should be like {name: , value: }
	*		*	dom_element_to_append_to : class name of the div element where the graph have to be appended
	*	Contains transitions and hover effects, load the css file 'css/pieChart.css' at the top of html page where the pie chart has to be loaded
	*/
	function renderPieChart (dataset,dom_element_to_append_to, colorScheme){
		var margin = {top:10,bottom:10,left:40,right:10};
		var width = 800 - margin.left - margin.right;
		var height = width-100;
		radius = Math.min(width, height) / 3;
		var donutWidth = 150;
		var legendRectSize = 18;
		var legendSpacing = 4;

		dataset.forEach(function(item){
			item.enabled = true;
		});

		var color = d3.scaleOrdinal()
		.range(colorScheme);

		var svg = d3.select(dom_element_to_append_to)
		.append("svg")
		.attr("width", width-400)
		.attr("height", height-300)
		.append("g")
		.attr("transform", "translate(" + width/5 + "," + height / 4 + ")");

		var arc = d3.arc()
		.outerRadius(radius - 100)
		.innerRadius(radius - donutWidth);

		var pie = d3.pie()
		.sort(null)
		.value(function(d) { return d.value; });

		var tooltip = d3.select(dom_element_to_append_to)
		.append('div')
		.attr('class', 'tooltip')
		.style("opacity", 0);

        var pageX=document.getElementById("chart").getBoundingClientRect().x;
        var pageY=document.getElementById("chart").getBoundingClientRect().y;

		tooltip.append('div')
		.attr('class', 'name')
        .attr('transform',"translate("+pageX+","+pageY+")");

		tooltip.append('div')
		.attr('class', 'count');

		tooltip.append('div')
		.attr('class', 'percent');

		var path = svg.selectAll('path')
		.data(pie(dataset))
		.enter()
		.append('path')
		.attr('d', arc)
		.attr('fill', function(d, i) {
			return color(d.data.name);
		})
		.each(function(d) { this._current = d; });


		path.on('mouseover', function(d) {
			var total = d3.sum(dataset.map(function(d) {
				return (d.enabled) ? d.value : 0;
			}));
 
                 
            var percent = Math.round(1000 * d.data.value / total) / 10;
			tooltip.select('.name').html('<b>Nom: </b>'+d.data.name.toUpperCase()).style('color','black');
			tooltip.select('.count').html('<b>Total: </b>'+d.data.value);
			tooltip.select('.percent').html('<b>Pourcent: </b>'+percent + '%');
			tooltip.style('opacity',1);

		});

		path.on('mousemove', function(d) {
			
			tooltip.style('top', ( d3.event.pageY)-50+'px')
			.style('left', (d3.event.pageX) + 'px');
		});

		path.on('mouseout', function() {
			tooltip.style('opacity',0);
		});

		var legend = svg.selectAll('.legend')
		.data(color.domain())
		.enter()
		.append('g')
		.attr('class', 'legend')
		.attr('transform', function(d, i) {
			var height = legendRectSize + legendSpacing;
			var offset =  height * color.domain().length / 2;
			var horz = -2 * legendRectSize;
			var vert = i * height - offset;
			return 'translate(' + horz + ',' + vert + ')';
		});

		legend.append('rect')
		.attr('width', legendRectSize)
		.attr('height', legendRectSize)
		.style('fill', color)
		.style('stroke', color)
		.on('click', function(name) {
			var rect = d3.select(this);
			var enabled = true;
			var totalEnabled = d3.sum(dataset.map(function(d) {
				return (d.enabled) ? 1 : 0;
			}));

			if (rect.attr('class') === 'disabled') {
				rect.attr('class', '').style('fill',color);

			} else {
				if (totalEnabled < 2) return;
				rect.attr('class', 'disabled')
				.style('fill','white');
				enabled = false;
			}

			pie.value(function(d) {
				if (d.name === name) d.enabled = enabled;
				return (d.enabled) ? d.value : 0;
			});

			path = path.data(pie(dataset));

			path.transition()
			.duration(750)
			.attrTween('d', function(d) {
				var interpolate = d3.interpolate(this._current, d);
				this._current = interpolate(0);
				return function(t) {
					return arc(interpolate(t));
				};
			});
		});
		legend.append('text')
		.attr('x', legendRectSize + legendSpacing)
		.attr('y', legendRectSize - legendSpacing)
		.text(function(d) { return d; })
	};