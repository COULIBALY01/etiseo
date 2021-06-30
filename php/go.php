

<?php

include('connect.php');

 ?>

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Go ogle Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      <?php
          $sql="SELECT ucm_customer.customer_name, COUNT(*) as value
          FROM ucm_training, ucm_customer WHERE ucm_training.customer_id=ucm_customer.customer_id 
          GROUP BY ucm_customer.customer_name";
          $sth = $dbh->prepare($sql);
          $sth->execute();
          $result = $sth->fetchAll();
      ?>
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
         
          <?php
                foreach($result as $row) {
                    echo "['".$row['customer_name']."',".$row['value']."],";
                }
        
          ?> 
           ]);
        
        // Set chart options
        var options = {'title':'Formation par client',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->

<th2>Nombre de formation par clients</th2>
    <div id="chart_div"></div>
  </body>
</html>
