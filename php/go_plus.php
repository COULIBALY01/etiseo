
<?php
include('connect.php');
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for Sarah's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawSarahChart);

      // Draw the pie chart for the Anthony's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawAnthonyChart);

       <?php
          $sql="SELECT ucm_customer.customer_name, COUNT(*) as value
          FROM ucm_training, ucm_customer WHERE ucm_training.customer_id=ucm_customer.customer_id 
          GROUP BY ucm_customer.customer_name";
          $result = $dbh->query($sql);
          $result = $result->fetchAll();
         
      ?>
      // Callback that draws the pie chart for Sarah's pizza.
      function drawSarahChart() {
       

        // Create the data table for Sarah's pizza.
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

        // Set options for Sarah's pie chart.
        var options = {title:'Nombre de formation par rapport aux clients',
                       width:400,
                       height:300};

        // Instantiate and draw the chart for Sarah's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Sarah_chart_div'));
        chart.draw(data, options);
      }
     
      // Callback that draws the pie chart for Anthony's pizza.
      <?php
         $sq="SELECT  ucm_training_old.status as name, COUNT(*) as value FROM ucm_training_old GROUP BY ucm_training_old.status";
         $sth =$dbh->prepare($sq);
         $sth->execute();  
         $resul = $sth->fetchAll();
          
      ?>
      function drawAnthonyChart() {

        // Create the data table for Anthony's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?php
            foreach ($resul as $row) {
                echo "['".$row['name']."',".$row['value']."],";

            	}
           ?>
        ]);

        // Set options for Anthony's pie chart.
        var options = {title:'L\'état du status des formations',
                       width:400,
                       height:300};

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Anthony_chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td><div id="Sarah_chart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="Anthony_chart_div" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
  </body>
</html>