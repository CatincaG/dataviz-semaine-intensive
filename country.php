<?php
    include_once './includes/config.php';

    // Get the id of the country
    $id = $_GET['id'];
    echo($id);

    //Instantiate curl for data studies
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datastudies');
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
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datawork');
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
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datapower');
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
    curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datahealth');
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>European gender gap</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./src/styles/country.css">
</head>
<body>
    <!-- Name of the country -->
    <h3><?= $dataStudies[22]->country ?></h3>
    <!-- Studies category -->
    <div class="studies-content">
        <p class="value"><?= $dataStudies[22]->value.'%' ?></p>
        <p class="description">of students are women</p>
        <p>Studies category</p>
    </div>
    <!-- Work category -->
    <div class="work-content js-hidden">
        <p class="description">Women earn</p>
        <p class="value"><?= $dataWork[10]->value.'%' ?></p>
        <p class="description">less than men</p>
        <p>Work category</p>
    </div>
    <!-- Power category -->
    <div class="power-content js-hidden">
        <p class="description">For 100 CEO, only</p>
        <p class="value"><?= $dataPower[6]->value.'%' ?></p>
        <p class="description">are woman</p>
        <p>Power category</p>
    </div>
    <!-- Health category -->
    <div class="health-content js-hidden">
        <p class="description">Women live</p>
        <p class="value"><?= $dataHealth[13]->value.'%' ?></p>
        <p class="description">years more than a men</p>
        <p>Health category</p>
    </div>
    <!-- Violence category -->
    <div class="violence-content js-hidden">
        <p class="description">In 2017,</p>
        <p class="value"><?= $dataViolence[17]->value.'%' ?></p>
        <p class="description"> woman were raped</p>
        <p>Violence category</p>
    </div>
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