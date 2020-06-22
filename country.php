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
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/dataviolence');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dataViolence = curl_exec($curl);
    curl_close($curl);

    //Json decode data violence
    $dataViolence= json_decode($dataViolence);

    //Show data violence
    // echo '<pre>';
    // var_dump($dataViolence);
    // echo '</pre>';

    /*
    *--------------
    *
    * Filtering data in arrays to have only the parts that are relevant
    *
    *--------------
    */

    // dataStudies array
    $currentDataStudies = array_filter($dataStudies, function($d) {
        return $d->sex === 'W';
    });

    // dataPower array
    $currentDataPower = array_filter($dataPower, function($d) {
        return $d->sex === 'W' && $d->position === 'CEO (Chief Executive Officer)';
    });

    // dataHealth array
    $currentDataHealth = array_filter($dataHealth, function($d) {
        return $d->sex === 'W' && $d->info === 'Life expectancy in absolute value at birth';
    });

    // echo '<pre>';
    // var_dump($currentDataHealth);
    // echo '</pre>';
    // exit;

    /*
    *--------------
    *
    * Convert array of objects to array of numbers for the chart in order to display only the years once
    *
    *--------------
    */

    // Years for studies
    $years = array_map(function($d) {
        return $d->year;
    }, $dataStudies);
    $years = array_unique($years);

    $firstYear = array_values($years)[0];
    $lastYear = end($years);

    // Years for work category
    $workYears = array_map(function($d) {
        return $d->year;
    }, $dataWork);
    $workYears = array_unique($workYears);

    $workFirstYear = array_values($workYears)[0];
    $workLastYear = end($workYears);

    // Years for power category
    $powerYears = array_map(function($d) {
        return $d->year;
    }, $currentDataPower);
    $powerYears = array_unique($powerYears);

    $powerFirstYear = array_values($powerYears)[0];
    $powerLastYear = end($powerYears);

    // Years for health category
    $healthYears = array_map(function($d) {
        return $d->year;
    }, $currentDataHealth);
    $healthYears = array_unique($healthYears);

    $healthFirstYear = array_values($healthYears)[0];
    $healthLastYear = end($healthYears);

    // echo '<pre>';
    // var_dump(array_values($healthYears)[0]);
    // echo '</pre>';
    // exit;

    // Years for violence category
    // $violenceYears = array_map(function($d) {
    //     return $d->year;
    // }, $dataViolence);
    // $violenceYears = array_unique($violenceYears);

    // $violenceFirstYear = array_values($violenceYears)[0];
    // $violenceLastYear = end($violenceYears);
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
    <div class="container-studies-illustration">
        <img src="./assets/svg/illustrations/studies-woman.svg" class="studies-illustration" alt="graduated girl illustration">
        <div class="stage-rectangle"></div>
    </div>
    <!--Container of the chart-->
    <div class="chart-container js-chart-studies" style="position: relative; height:20vh; width:62vw">
        <canvas id="myChart" class="canvas-studies"></canvas>
    </div>
    <!--Script for the chart-->
    <script>
    const ctx = document.getElementById('myChart').getContext('2d')

    Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
    Chart.defaults.global.defaultFontColor = 'black'
    let myChart = new Chart(ctx, {
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
                text: 'Percentage of women and men students in <?= end($dataStudies)->country?> from <?= $firstYear ?> to <?= $lastYear ?>',
                fontSize: 14,
                fontStyle: '500',
                padding: 16
            }
        }
    })
    </script>
    <!--End of the script for the chart-->
    <p class="source-studies">https://eige.europa.eu/gender-statistics/dgs/indicator/eustrat_epsr_eoalm_esll__edat_lfse_03/datatable</p>
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
        <p class="value"><?= intval(end($dataWork)->value).'%' ?></p>
        <p class="description">less than men</p>
    </div>
    <!-- Illustration work -->
    <img src="./assets/svg/illustrations/work-balance-income.svg" class="work-illustration js-hidden" alt="girl working illustration">
    <!--Container of the chart-->
    <div class="chart-container js-chart-work js-hidden" style="position: relative; height:20vh; width:62vw">
        <canvas id="chart-data-work" class="canvas-work"></canvas>
    </div>
    <!--Script for the chart-->
    <script>
    const chartWork = document.getElementById('chart-data-work').getContext('2d')

    Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
    Chart.defaults.global.defaultFontColor = 'black'
    let chartDataWork = new Chart(chartWork, {
    type: 'line',

        data: {
            // Years
            labels: [<?php
                foreach ($workYears as $_year):
                    echo $_year.',';
                endforeach;
            ?>],

            datasets: [{
                // Woman
                label: 'Woman',
                data: [<?php
                foreach ($dataWork as $_dataWork):
                    echo str_replace(',','.',$_dataWork->value).',';
                endforeach;
                ?>],
                backgroundColor: "rgba(169, 65, 127, 0.6)"
            }]
        },

        options: {
            legend: { display: true },
            title: {
                display: true,
                text: 'Wage difference between woman and men in <?= end($dataWork)->country?> from <?= $workFirstYear ?> to <?= $workLastYear ?>',
                fontSize: 14,
                fontStyle: '500',
                padding: 16
            }
        }
    })
    </script>
    <!--End of the script for the chart-->
    <p class="source-work js-hidden">https://eige.europa.eu/gender-statistics/dgs/indicator/eustrat_sege1619_gpaygap__tesem180/datatable</p>
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
        <p class="value"><?= intval(end($currentDataPower)->value) ?></p>
        <p class="description">are woman in <?= end($currentDataPower)->year ?></p>
    </div>
    <!-- Illustration power -->
    <img src="./assets/svg/illustrations/power-all-content.svg" class="power-illustration js-hidden" alt="woman and men flying illustration">
    <!--Container of the chart-->
    <div class="chart-container js-chart-power js-hidden" style="position: relative; height:20vh; width:62vw">
        <canvas id="chart-data-power" class="canvas-power"></canvas>
    </div>
    <!--Script for the chart-->
    <script>
    const chartPower = document.getElementById('chart-data-power').getContext('2d')

    Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
    Chart.defaults.global.defaultFontColor = 'black'
    let chartDataPower = new Chart(chartPower, {
    type: 'bar',

        data: {
            // Years
            labels: [<?php
                foreach ($powerYears as $_year):
                    echo $_year.',';
                endforeach;
            ?>],

            datasets: [{
                // Woman
                label: 'Woman',
                data: [<?php
                foreach ($dataPower as $_dataPower):
                    if($_dataPower->sex === 'W' && $_dataPower->position === 'CEO (Chief Executive Officer)') {
                        echo str_replace(',','.',$_dataPower->value).',';
                    }
                endforeach;
                ?>],
                backgroundColor: "rgba(62, 159, 172, 0.8)"
                }, {

                // Men
                label: 'Men',
                data: [<?php
                foreach ($dataPower as $_dataPower):
                    if($_dataPower->sex === 'M' && $_dataPower->position === 'CEO (Chief Executive Officer)')
                    {
                    echo str_replace(',','.',$_dataPower->value).',';
                    }
                endforeach;
                ?>],
                backgroundColor: "rgba(216, 236, 238, 1)"
            }]
        },

        options: {
            legend: { display: true },
            title: {
                display: true,
                text: 'Percentage of women and men who have the position of CEO in <?= end($currentDataPower)->country?> from <?= $powerFirstYear ?> to <?= $powerLastYear ?>',
                fontSize: 14,
                fontStyle: '500',
                padding: 16
            }
        }
    })
    </script>
    <!--End of the script for the chart-->
    <p class="source-power js-hidden">https://eige.europa.eu/gender-statistics/dgs/indicator/wmidm_bus_bus__wmid_comp_compex/datatable</p>
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
    <img src="./assets/svg/illustrations/health-all-content.svg" class="health-illustration js-hidden" alt="grandma illustration">
    <!--Container of the chart-->
    <div class="chart-container js-chart-health js-hidden" style="position: relative; height:20vh; width:62vw">
        <canvas id="chart-data-health" class="canvas-health"></canvas>
    </div>
    <!--Script for the chart-->
    <script>
    const chartHealth = document.getElementById('chart-data-health').getContext('2d')

    Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
    Chart.defaults.global.defaultFontColor = 'black'
    let chartDataHealth = new Chart(chartHealth, {
    type: 'bar',

        data: {
            // Years
            labels: [<?php
                foreach ($healthYears as $_year):
                    echo $_year.',';
                endforeach;
            ?>],

            datasets: [{
                // Woman
                label: 'Woman',
                data: [<?php
                foreach ($dataHealth as $_dataHealth):
                    if($_dataHealth->sex === 'W' && $_dataHealth->info === 'Life expectancy in absolute value at birth') {
                        echo str_replace(',','.',$_dataHealth->value).',';
                    }
                endforeach;
                ?>],
                backgroundColor: "rgba(65, 169, 94, 0.8)"
                }, {

                // Men
                label: 'Men',
                data: [<?php
                foreach ($dataHealth as $_dataHealth):
                    if($_dataHealth->sex === 'M' && $_dataHealth->info === 'Life expectancy in absolute value at birth')
                    {
                    echo str_replace(',','.',$_dataHealth->value).',';
                    }
                endforeach;
                ?>],
                backgroundColor: "rgba(65, 169, 94, 0.4)"
            }]
        },

        options: {
            legend: { display: true },
            title: {
                display: true,
                text: 'Life expectancy in absolute value at birth for women and men in <?= end($currentDataHealth)->country?> from <?= $healthFirstYear ?>  to <?= $healthLastYear ?>',
                fontSize: 14,
                fontStyle: '500',
                padding: 16
            }
        }
    })
    </script>
    <!--End of the script for the chart-->
    <p class="source-health js-hidden">https://eige.europa.eu/gender-statistics/dgs/indicator/ta_hlthmort_hlth_years__hlth_silc_17/hbar</p>
    <!--
    *--------------
    *
    * Violence category
    *
    *--------------
    * -->
    <!-- Display data-->
    <div class="violence-content js-hidden">
        <p class="description"> 
            In 
            <?php
                foreach ($dataViolence as $_dataViolence):
                    if($id === $_dataViolence->id)
                    {
                        echo $_dataViolence->country.',';
                    }
                endforeach;
            ?>
        </p>
        <p class="value">
            <?php
                foreach ($dataViolence as $_dataViolence):
                    if($id === $_dataViolence->id)
                    {
                        echo intval($_dataViolence->value).' '.'000';
                    }
                endforeach;
            ?>
        </p>
        <p class="description"> woman were raped in 2017</p>
        <p class ="missing-data">
            <!-- <?php
                if(empty($dataViolence))
                {
                    echo('There is no data available for this country');
                }
            ?> -->
        </p>
    </div>
    <!-- Illustration violence -->
    <img src="./assets/svg/illustrations/violence-woman.svg" class="violence-illustration js-hidden" alt="woman sitting illustration">
    <!--Container of the doughnut-->
    <div class="chart-container js-chart-violence js-hidden" style="position: relative; height:20vh; width:62vw">
        <canvas id="chart-data-violence" class="canvas-violence"></canvas>
    </div>
    <!--Script for the chart-->
    <script>
    const chartDoughnutViolence = document.getElementById('chart-data-violence').getContext('2d')

    Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
    Chart.defaults.global.defaultFontColor = 'black'

    let chartDataViolence = new Chart(chartDoughnutViolence, {
    type: 'doughnut',

        data: {
            // Name of countries
            labels: [<?php
                foreach ($dataViolence as $_dataViolence):
                    echo '"'.$_dataViolence->country.'"'.',';
                endforeach;
            ?>],

            datasets: [{
                // Numbers of victim
                label: 'Per hundred thousand inhabitants',
                data: [<?php
                foreach ($dataViolence as $_dataViolence):
                    echo str_replace(',','.',$_dataViolence->value).',';
                endforeach;
                ?>],
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#f6068e", "#2a62b2", "#b27a2a", "#face4e", "#f2bae0", "#5a2ea6", "#508810", "#962612", "#0e2432", "#bd6c1f", "#89a0d8", "#8acada", "#da9a8a", "#900c94", "#10940c", "#f06644"]

            }]
        },

        options: {
            legend: { display: true, position: 'bottom', align: 'start' },
            title: {
                display: true,
                text: 'Number of woman victim of rape per hundred thousand inhabitants, in 2017',
                fontSize: 14,
                fontStyle: '500',
                padding: 16
            },
            layout: {
                padding: {
                    left: 40,
                    right: 40,
                    top: 0,
                    bottom: 0
                }
            }
        }
    })
    </script>
    <!--End of the script for the chart-->
    <!--
    *--------------
    *
    * 5 categories for the navigation
    *
    *--------------
    * -->
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