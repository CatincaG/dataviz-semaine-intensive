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
    // exit;

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
    // exit;

    /*
    *--------------
    *
    * Filtering data in arrays to have only the parts that are relevant
    *
    *--------------
    */

    // dataStudies array
    if(!empty($dataStudies))
    {
        $currentDataStudies = array_filter($dataStudies, function($d) {
            return $d->sex === 'W';
        });
    }

    // dataPower array
    if(!empty($dataPower))
    {
        $currentDataPower = array_filter($dataPower, function($d) {
            return $d->sex === 'W' && $d->position === 'CEO (Chief Executive Officer)';
        });
    }

    // dataHealth array
    if(!empty($dataHealth))
    {
        $currentDataHealth = array_filter($dataHealth, function($d) {
            return $d->sex === 'W' && $d->info === 'Life expectancy in absolute value at birth';
        });
    }

    // dataViolence array
    if(!empty($dataViolence))
    {
        $currentDataViolence = array_filter($dataViolence, function($d) {
            return $d->unit === 'Number' && $d->crime === 'Rape';
        });
    
        $currentDataViolenceWoman = array_filter($currentDataViolence, function($d) {
            return $d->sex === 'W';
        });
    }

    // echo '<pre>';
    // var_dump($currentDataViolence);
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
    if(!empty($dataStudies))
    {
        $years = array_map(function($d) {
            return $d->year;
        }, $dataStudies);
        $years = array_unique($years);
    
        $firstYear = array_values($years)[0];
        $lastYear = end($years);
    }

    // Years for work category
    if(!empty($dataWork))
    {
        $workYears = array_map(function($d) {
            return $d->year;
        }, $dataWork);
        $workYears = array_unique($workYears);
    
        $workFirstYear = array_values($workYears)[0];
        $workLastYear = end($workYears);
    }

    // Years for power category
    if(!empty($currentDataPower))
    {
        $powerYears = array_map(function($d) {
            return $d->year;
        }, $currentDataPower);
        $powerYears = array_unique($powerYears);
    
        $powerFirstYear = array_values($powerYears)[0];
        $powerLastYear = end($powerYears);
    }

    // Years for health category
    if(!empty($currentDataHealth))
    {
        $healthYears = array_map(function($d) {
            return $d->year;
        }, $currentDataHealth);
        $healthYears = array_unique($healthYears);
    
        $healthFirstYear = array_values($healthYears)[0];
        $healthLastYear = end($healthYears);
    }

    // echo '<pre>';
    // var_dump(array_values($healthYears)[0]);
    // echo '</pre>';
    // exit;

    // Years for violence category
    if(!empty($currentDataViolence))
    {
        $violenceYears = array_map(function($d) {
            return $d->year;
        }, $currentDataViolence);
        $violenceYears = array_unique($violenceYears);
    
        $violenceFirstYear = array_values($violenceYears)[0];
        $violenceLastYear = end($violenceYears);
    }

    // echo '<pre>';
    // var_dump($violenceYears);
    // echo '</pre>';
    // exit;

    /*
    * Check if value is negative for work wage difference between women and men
    */

    $negativeString = "-"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equally</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./src/styles/country.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
    <div class="button-back">
        <a href="./map.php"><img src="./assets/svg/icons/back-button-arrow.svg" class="back-arrow" alt="back arrow">BACK</a>
    </div>
    <?php if($id) {?>
        <?php if(!empty($dataStudies) || !empty($dataWork) || !empty($dataPower) || !empty($dataHealth) || !empty($dataViolence)) { ?>
            <!-- Name of the country selected -->
            <h2><?= end($dataStudies)->country ?></h2>
            <!--
            *--------------
            *
            * Studies category
            *
            *--------------
            * -->
            <!-- Display data-->
            <div class="studies-content">
                <?php if (!empty($currentDataStudies)) {?>
                    <p class="value"><?= end($currentDataStudies)->value.'%' ?></p>
                    <p class="description">of students were women in <?= end($currentDataStudies)->year ?></p>
                <!-- Error if the country doesn't exist in the category -->
                <?php } else { ?>
                    <p class="missing-data">Sorry, there is no data available for this country in this category</p>
                <?php } ?>
            </div>
            <!-- Illustration studies -->
            <img src="./assets/svg/illustrations/studies-all-content.svg" class="studies-illustration" alt="graduated girl illustration">
            <!--Container of the chart-->
            <div class="chart-container js-chart-studies" style="position: relative; height:20vh; width:62vw">
                <canvas id="myChart" class="canvas-studies"></canvas>
            </div>
            <!--Script for the chart-->
            <?php if(!empty($dataStudies)) { ?>
                <script>
                const ctx = document.getElementById('myChart').getContext('2d')

                Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
                Chart.defaults.global.defaultFontColor = '#4F4F4F'
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
                            // Women
                            label: 'Women',
                            data: [<?php
                            foreach ($dataStudies as $dataItem): if($dataItem->sex === 'W') {
                                echo str_replace(',','.',$dataItem->value).',';
                            }
                            endforeach;
                            ?>],
                            backgroundColor: "rgba(246, 174, 45, 0.4)",
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
                            backgroundColor: "rgba(89, 65, 169, 1)",
                        }]
                    },

                    options: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: 'Percentage of women and men students in <?= end($dataStudies)->country?> from <?= $firstYear ?> to <?= $lastYear ?>',
                            fontSize: 16,
                            fontStyle: '500',
                            padding: 16
                        }
                    }
                })
                </script>
                <!--End of the script for the chart-->
            <?php } ?>
            <!--
            *--------------
            *
            * Work category
            *
            *--------------
            * -->
            <!-- Display data-->
            <div class="work-content js-hidden">
                <?php if (!empty($dataWork)) {?>
                    <p class="description"> Women earned </p>
                    <p class="value"><?= intval(end($dataWork)->value).'%' ?></p>
                    <p class="description">less than men in <?= $workLastYear ?></p>
                <!-- Error if the country doesn't exist in the category -->
                <?php } else { ?>
                    <p class="missing-data">Sorry, there is no data available for this country in this category</p>
                <?php } ?>
            </div>
            <!-- Illustration work -->
            <img src="./assets/svg/illustrations/work-balance-income.svg" class="work-illustration js-hidden" alt="girl working illustration">
            <!--Container of the chart-->
            <div class="chart-container js-chart-work js-hidden" style="position: relative; height:20vh; width:62vw">
                <canvas id="chart-data-work" class="canvas-work"></canvas>
            </div>
            <!--Script for the chart-->
            <?php if (!empty($dataWork)) { ?>
                <script>
                const chartWork = document.getElementById('chart-data-work').getContext('2d')

                Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
                Chart.defaults.global.defaultFontColor = '#4F4F4F'
                let chartDataWork = new Chart(chartWork, {
                type: 'bar',

                    data: {
                        // Years
                        labels: [<?php
                            foreach ($workYears as $_year):
                                echo $_year.',';
                            endforeach;
                        ?>],

                        datasets: [{
                            // Women
                            label: 'Women',
                            data: [<?php
                            foreach ($dataWork as $_dataWork):
                                if(strpos($_dataWork->value, $negativeString) !== false)
                                {
                                    $commaToDot = str_replace(',','.',$_dataWork->value);
                                    echo str_replace('-', '+', $commaToDot).',';

                                } else {
                                    echo "-".str_replace(',','.',$_dataWork->value).',';
                                }
                            endforeach;
                            ?>],
                            backgroundColor: "rgba(169, 65, 127, 0.6)"
                        }]
                    },

                    options: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: 'Wage difference between women and men in <?= end($dataWork)->country?> from <?= $workFirstYear ?> to <?= $workLastYear ?>',
                            fontSize: 16,
                            fontStyle: '500',
                            padding: 16
                        }
                    }
                })
                </script>
                <!--End of the script for the chart-->
            <?php } ?>
            <!--
            *--------------
            *
            * Power category
            *
            *--------------
            * -->
            <!-- Display data-->
            <div class="power-content js-hidden">
                <?php if (!empty($currentDataPower)) {?>
                    <p class="description"> For 100 CEO, </p>
                    <p class="value"><?= intval(end($currentDataPower)->value) ?></p>
                    <p class="description">were woman in <?= end($currentDataPower)->year ?></p>
                <!-- Error if the country doesn't exist in the category -->
                <?php } else { ?>
                    <p class="missing-data">Sorry, there is no data available for this country in this category</p>
                <?php } ?>
            </div>
            <!-- Illustration power -->
            <img src="./assets/svg/illustrations/power-all-content.svg" class="power-illustration js-hidden" alt="woman and men flying illustration">
            <!--Container of the chart-->
            <div class="chart-container js-chart-power js-hidden" style="position: relative; height:20vh; width:62vw">
                <canvas id="chart-data-power" class="canvas-power"></canvas>
            </div>
            <!--Script for the chart-->
            <?php if (!empty($dataPower)) {?>
                <script>
                const chartPower = document.getElementById('chart-data-power').getContext('2d')

                Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
                Chart.defaults.global.defaultFontColor = '#4F4F4F'
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
                            // Women
                            label: 'Women',
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
                            fontSize: 16,
                            fontStyle: '500',
                            padding: 16
                        }
                    }
                })
                </script>
                <!--End of the script for the chart-->
            <?php } ?>
            <!--
            *--------------
            *
            * Health category
            *
            *--------------
            * -->
            <!-- Display data-->
            <div class="health-content js-hidden">
                <?php if (!empty($currentDataHealth)) {?>
                    <p class="description">Life expectancy for women was</p>
                    <p class="value"><?= intval(end($currentDataHealth)->value).' '.'years' ?></p>
                    <p class="description">in <?= end($currentDataHealth)->year ?></p>
                <!-- Error if the country doesn't exist in the category -->
                <?php } else { ?>
                    <p class="missing-data">Sorry, there is no data available for this country in this category</p>
                <?php } ?>
            </div>
            <!-- Illustration health -->
            <img src="./assets/svg/illustrations/health-all-content.svg" class="health-illustration js-hidden" alt="grandma illustration">
            <!--Container of the chart-->
            <div class="chart-container js-chart-health js-hidden" style="position: relative; height:20vh; width:62vw">
                <canvas id="chart-data-health" class="canvas-health"></canvas>
            </div>
            <!--Script for the chart-->
            <?php if (!empty($dataHealth)) {?>
                <script>
                const chartHealth = document.getElementById('chart-data-health').getContext('2d')

                Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
                Chart.defaults.global.defaultFontColor = '#4F4F4F'
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
                            // Women
                            label: 'Women',
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
                            fontSize: 16,
                            fontStyle: '500',
                            padding: 16
                        }
                    }
                })
                </script>
                <!--End of the script for the chart-->
            <?php } ?>
            <!--
            *--------------
            *
            * Violence category
            *
            *--------------
            * -->
            <!-- Display data-->
            <div class="violence-content js-hidden">
                <?php if (!empty($currentDataViolence)) {?>
                    <p class="description"> In <?= end($currentDataViolenceWoman)->country ?>, </p>
                    <p class="value"><?= end($currentDataViolenceWoman)->value ?></p>
                    <p class="description"> woman were raped in <?= $violenceLastYear ?></p>
                <!-- Error if the country doesn't exist in the category -->
                <?php } else { ?>
                    <div class="error-message studies-position-error">
                        <p class="missing-data violence-error">Sorry,</p>
                        <p class="missing-data-explanation violence-error">there is no data available for this country in this category</p>
                    </div>
                <?php } ?>
            </div>
            <!-- Illustration violence -->
            <img src="./assets/svg/illustrations/violence-woman.svg" class="violence-illustration js-hidden" alt="woman sitting illustration">
            <!-- Container of the chart -->
            <div class="chart-container js-chart-violence js-hidden" style="position: relative; height:20vh; width:62vw">
                <canvas id="chart-data-violence" class="canvas-violence"></canvas>
            </div>
            <!--Script for the chart-->
            <?php if (!empty($currentDataViolence)) {?>
                <script>
                const chartDoughnutViolence = document.getElementById('chart-data-violence').getContext('2d')

                Chart.defaults.global.defaultFontFamily = "'Rubik', 'Arial', sans-serif"
                Chart.defaults.global.defaultFontColor = '#4F4F4F'

                let chartDataViolence = new Chart(chartDoughnutViolence, {
                type: 'bar',

                    data: {
                        // Years
                        labels: [<?php
                            foreach ($violenceYears as $_year):
                                echo $_year.',';
                            endforeach;
                        ?>],

                        datasets: [{
                            // Women
                            label: 'Women',
                            data: [<?php
                            foreach ($currentDataViolence as $_dataViolence):
                                if($_dataViolence->sex === 'W') {
                                    echo $_dataViolence->value.',';
                                }
                            endforeach;
                            ?>],
                            backgroundColor: "#B43838"
                            }, {

                            // Men
                            label: 'Men',
                            data: [<?php
                            foreach ($currentDataViolence as $_dataViolence):
                                if($_dataViolence->sex === 'M')
                                {
                                    echo $_dataViolence->value.',';
                                }
                            endforeach;
                            ?>],
                            backgroundColor: "#C36060"
                        }]
                    },

                    options: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: 'Number of women and men victim of rape in <?= end($currentDataViolenceWoman)->country ?> , from <?= $violenceFirstYear ?> to <?= $violenceLastYear ?>',
                            fontSize: 16,
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
            <?php } ?>
            <!--End of the script for the chart-->
            <!--
            *--------------
            *
            * 5 categories for the navigation
            *
            *--------------
            * -->
            <div class="categories">
                <div class="container-button">
                    <a href="#" class="studies-button  js-current-button">EDUCATION</a>
                    <div class="rectangle-button js-current-rectangle"></div>
                </div>
                <div class="container-button">
                    <a href="#" class="work-button">WORK</a>
                    <div class="rectangle-button"></div>
                </div>
                <div class="container-button">
                    <a href="#" class="power-button">RESPONSABILITY</a>
                    <div class="rectangle-button"></div>
                </div>
                <div class="container-button">
                    <a href="#" class="health-button">HEALTH</a>
                    <div class="rectangle-button"></div>
                </div>
                <div class="container-button">
                    <a href="#" class="violence-button">VIOLENCE</a>
                    <div class="rectangle-button"></div>
                </div>
            </div>
        <!-- Error if the country doesn't exist in the database -->
        <?php } else { ?>
            <div class="error-message general-error-position">
                <p class="missing-data general-error">Sorry,</p>
                <p class="missing-data-explanation general-error">there is no data available for this country</p>
            </div>
        <?php } ?>
    <!-- Error if there is no id in the URL -->
    <?php } else { ?>
        <div class="error-message general-error-position">
            <p class="missing-data general-error">Sorry,</p>
            <p class="missing-data-explanation general-error">there is no data available</p>
        </div>
    <?php } ?>
    <script src="./src/scripts/country.js"></script>
</body>
</html>