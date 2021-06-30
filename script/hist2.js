chart = {
    const svg = d3.create("svg")
        .attr("viewBox", [0, 0, width, height]);
  
    svg.append("g")
        .attr("fill", color)
      .selectAll("rect")
      .data(data)
      .join("rect")
        .attr("x", (d, i) => x(i))
        .attr("y", d => y(d.value))
        .attr("height", d => y(0) - y(d.value))
        .attr("width", x.bandwidth());
  
    svg.append("g")
        .call(xAxis);
  
    svg.append("g")
        .call(yAxis);
  
    return svg.node();
  }
  data = Array(26) [
    0: Object {name: "E", value: 0.12702}
    1: Object {name: "T", value: 0.09056}
    2: Object {name: "A", value: 0.08167}
    3: Object {name: "O", value: 0.07507}
    4: Object {name: "I", value: 0.06966}
    5: Object {name: "N", value: 0.06749}
    6: Object {name: "S", value: 0.06327}
    7: Object {name: "H", value: 0.06094}
    8: Object {name: "R", value: 0.05987}
    9: Object {name: "D", value: 0.04253}
    10: Object {name: "L", value: 0.04025}
    11: Object {name: "C", value: 0.02782}
    12: Object {name: "U", value: 0.02758}
    13: Object {name: "M", value: 0.02406}
    14: Object {name: "W", value: 0.0236}
    15: Object {name: "F", value: 0.02288}
    16: Object {name: "G", value: 0.02015}
    17: Object {name: "Y", value: 0.01974}
    18: Object {name: "P", value: 0.01929}
    19: Object {name: "B", value: 0.01492}
    20: Object {name: "V", value: 0.00978}
    21: Object {name: "K", value: 0.00772}
    22: Object {name: "J", value: 0.00153}
    23: Object {name: "X", value: 0.0015}
    24: Object {name: "Q", value: 0.00095}
    25: Object {name: "Z", value: 0.00074}
    columns: Array(2) ["letter", "frequency"]
    format: "%"
    y: "↑ Frequency"
  ]
  