<?php

//Instantiate curl for datastudies for SPAIN ONLY
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datastudies?country=Spain');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$datastudies = curl_exec($curl);
curl_close($curl);

//Json decode datastudies
$datastudies = json_decode($datastudies);

// Convert array of objects to array of numbers
$years = array_map(function($d) {
  return $d->year;
}, $datastudies);
$years = array_unique($years);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de Charts.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
<!--Container of the chart-->
<div class="chart-container" style="position: relative; height:40vh; width:80vw">
  <canvas id="myChart"></canvas>
</div>
<!--Script for the chart-->
<script>
  const ctx = document.getElementById('myChart').getContext('2d')

  const myChart = new Chart(ctx, {
  type: 'line',

    data: {
      // Years
      labels: [<?php
        foreach ($years as $year):
          echo $year.',';
        endforeach;
      ?>],

      datasets: [{
        // Woman
        label: 'Woman',
        data: [<?php
          foreach ($datastudies as $dataItem): if($dataItem->sex === 'W') {
            echo str_replace(',','.',$dataItem->value).',';
          }
          endforeach;
        ?>],
        backgroundColor: "rgba(153,255,51,0.4)"
        }, {

        // Men
        label: 'Men',
        data: [<?php
          foreach ($datastudies as $dataItem):
            if($dataItem->sex === 'M')
            {
              echo str_replace(',','.',$dataItem->value).',';
            }
          endforeach;
        ?>],
        backgroundColor: "rgba(255,153,0,0.4)"
      }]
    },

    options: {
      legend: { display: true },
      title: {
        display: true,
        text: 'Percentage of women and men graduated'
      }
    }
  })
</script>
<!--End of the script for the chart-->

</body>
</html>