<?php
    include_once './includes/config.php';

    // Get the id of the country
    $id = $_GET['id'];
    // echo($id);

    //Instantiate curl for data studies
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datastudies?id='.$id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dataStudies = curl_exec($curl);
    curl_close($curl);

    //Json decode data studies
    $dataStudies = json_decode($dataStudies);

    //Show data studies 
    // echo '<pre>';
    // var_dump($dataStudies);
    // echo '</pre>';

    //Instantiate curl for data work
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datawork?id='.$id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dataWork = curl_exec($curl);
    curl_close($curl);

    //Json decode data work
    $dataWork = json_decode($dataWork);

    //Show data work
    // echo '<pre>';
    // var_dump($dataWork);
    // echo '</pre>';

    //Instantiate curl for data power
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datapower?id='.$id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dataPower = curl_exec($curl);
    curl_close($curl);

    //Json decode data power
    $dataPower = json_decode($dataPower);

    //Show data power
    // echo '<pre>';
    // var_dump($dataPower);
    // echo '</pre>';

    //Instantiate curl for data health
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datahealth?id='.$id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dataHealth = curl_exec($curl);
    curl_close($curl);

    //Json decode data health
    $dataHealth = json_decode($dataHealth);

    //Show data health
    // echo '<pre>';
    // var_dump($dataHealth);
    // echo '</pre>';

    //Instantiate curl for data violence
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/dataviolence?id='.$id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dataViolence = curl_exec($curl);
    curl_close($curl);

    //Json decode data violence
    $dataViolence= json_decode($dataViolence);

    //Show data violence
    // echo '<pre>';
    // var_dump($dataViolence);
    // echo '</pre>';

    // Filtering dataStudies array
    $currentDataStudies = array_filter($dataStudies, function($d) {
        return $d->sex === 'W';
    });

    // Filtering dataPower array
    $currentDataPower = array_filter($dataPower, function($d) {
        return $d->sex === 'W' && $d->position === 'CEO (Chief Executive Officer)';
    });

    // Filtering dataHealth array
    $currentDataHealth = array_filter($dataHealth, function($d) {
        return $d->sex === 'W' && $d->info === 'Life expectancy in absolute value at birth';
    });

    // Convert array of objects to array of numbers for the chart in order to display only the years once
    $years = array_map(function($d) {
        return $d->year;
    }, $dataStudies);
    $years = array_unique($years);

    $firstYear = $years[0];
    $lastYear = end($years);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>European gender gap</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./src/styles/country.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
    <!-- Name of the country selected -->
    <h3><?= end($dataStudies)->country ?></h3>
    <!--
    *--------------
    *
    * Studies category
    *
    *--------------
    * -->
    <!-- Display data-->
    <div class="studies-content">
        <p class="value"><?= end($currentDataStudies)->value.'%' ?></p>
        <p class="description">of students are women in <?= end($currentDataStudies)->year ?></p>
    </div>
    <!-- Illustration studies -->
    <img src="./assets/svg/illustrations/studies-illustration.svg" class="studies-illustration" alt="graduated girl illustration">
    <!--Container of the chart-->
    <div class="chart-container chart-studies" style="position: relative; height:20vh; width:62vw">
        <canvas id="myChart"></canvas>
    </div>
    <!--Script for the chart-->
    <script>
    const ctx = document.getElementById('myChart').getContext('2d')

    Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
    Chart.defaults.global.defaultFontColor = 'black'
    const myChart = new Chart(ctx, {
    type: 'line',

        data: {
        // Years
        labels: [<?php
            foreach ($years as $_year):
                echo $_year.',';
            endforeach;
        ?>],

        datasets: [{
            // Woman
            label: 'Woman',
            data: [<?php
            foreach ($dataStudies as $dataItem): if($dataItem->sex === 'W') {
                echo str_replace(',','.',$dataItem->value).',';
            }
            endforeach;
            ?>],
            backgroundColor: "rgba(246, 174, 45, 0.4)"
            }, {

            // Men
            label: 'Men',
            data: [<?php
            foreach ($dataStudies as $dataItem):
                if($dataItem->sex === 'M')
                {
                echo str_replace(',','.',$dataItem->value).',';
                }
            endforeach;
            ?>],
            backgroundColor: "rgba(89, 65, 169, 1)"
        }]
        },

        options: {
        legend: { display: true },
        title: {
            display: true,
            text: 'Percentage of women and men students in <?= end($dataStudies)->country?> from <?= $firstYear ?> to <?= $lastYear ?>'
        }
        }
    })
    </script>
    <!--End of the script for the chart-->
    <!--
    *--------------
    *
    * Work category
    *
    *--------------
    * -->
    <!-- Display data-->
    <div class="work-content js-hidden">
        <p class="description">Women earn</p>
        <p class="value"><?= end($dataWork)->value.'%' ?></p>
        <p class="description">less than men</p>
    </div>
    <!-- Illustration work -->
    <img src="" alt="">
    <!--
    *--------------
    *
    * Power category
    *
    *--------------
    * -->
    <!-- Display data-->
    <div class="power-content js-hidden">
        <p class="description">For 100 CEO, only</p>
        <p class="value"><?=end($currentDataPower)->value.'%'?></p>
        <p class="description">are woman</p>
    </div>
    <!-- Illustration power -->
    <img src="" alt="">
    <!--
    *--------------
    *
    * Health category
    *
    *--------------
    * -->
    <!-- Display data-->
    <div class="health-content js-hidden">
        <p class="description">Life expectancy for women is</p>
        <p class="value"><?= intval(end($currentDataHealth)->value).' '.'year old' ?></p>
        <p class="description">in <?= end($currentDataHealth)->year ?></p>
    </div>
    <!-- Illustration health -->
    <img src="" alt="">
    <!--
    *--------------
    *
    * Violence category
    *
    *--------------
    * -->
    <!-- Display data-->
    <div class="violence-content js-hidden">
        <p class="description">In <?= $dataViolence[0]->year ?></p>
        <p class="value">
            <?php
                if(!empty($dataViolence))
                {
                    echo intval($dataViolence[0]->value);
                }
            ?>
        </p>
        <p class="description"> woman were raped</p>
        <p class ="missing-data">
            <?php
                if(empty($dataViolence))
                {
                    echo('There is no data available for this country');
                }
            ?>
        </p>
    </div>
    <!-- Illustration violence -->
    <img src="" alt="">
    <!-- 5 domains navigation -->
    <div class="domains">
        <a href="#" class="studies-button  js-current-button">STUDIES</a>
        <a href="#" class="work-button">WORK</a>
        <a href="#" class="power-button">POWER</a>
        <a href="#" class="health-button">HEALTH</a>
        <a href="#" class="violence-button">VIOLENCE</a>
    </div>

    <script src="./src/scripts/country.js"></script>
</body>
</html>