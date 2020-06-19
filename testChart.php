<?php

//Instantiate curl for datastudies for SPAIN ONLY
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datastudies?country=Spain');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$datastudies = curl_exec($curl);
curl_close($curl);

//Json decode datastudies
$datastudies = json_decode($datastudies);

// Show datastudies
// echo '<pre>';
// var_dump($datastudies);
// echo '</pre>';

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
<canvas id="myChart" width="800" height="450"></canvas>

<!-- <?php foreach ($datastudies as $key => $dataItem):?>
  <p><?= $dataItem->year ?></p>
<?php endforeach ?> -->

<script>
  const ctx = document.getElementById('myChart').getContext('2d')

  // beginning of Chart generation
  const myChart = new Chart(ctx, {
  type: 'line',

    data: {
      // Years
      labels: 
      [
        <?php foreach ($datastudies as $dataItem):?>
          <?= $dataItem->year.',' ?>
        <?php endforeach ?>
      ],

      datasets: [{
      // Woman
      label: 'Woman',
      data: 
      [
        <?php foreach ($datastudies as $dataItem):?>
          <?php 
          if($dataItem->sex === 'W')
          {
          ?>
            <?= $dataItem->value.',' ?>
          <?php
          }
          ?>
        <?php endforeach ?>
      ],
      backgroundColor: "rgba(153,255,51,0.4)"
      }, {

      // Men
      label: 'Men',
      data: 
      [
        <?php foreach ($datastudies as $dataItem):?>
          <?php 
          if($dataItem->sex === 'M')
          {
          ?>
            <?= $dataItem->value.',' ?>
          <?php
          }
          ?>
        <?php endforeach ?>
      ],
      backgroundColor: "rgba(255,153,0,0.4)"
      }]
    },

    options: {
      legend: { display: true },
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
  })
</script>

</body>
</html>