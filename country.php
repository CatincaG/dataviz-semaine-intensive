<?php
    include_once './includes/config.php';

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
    <!-- Studies category -->
    <div class="studies-content">
        <h2><?= $dataStudies[22]->country ?></h2>
        <p class="value"><?= $dataStudies[22]->value.'%' ?></p>
        <p class="description">of students are women</p>
    </div>
    <!-- Work category -->
    <div class="work-content js-hidden">
        <h2><?= $dataWork[10]->country ?></h2>
        <p><?= $dataWork[10]->value.'%' ?></p>
    </div>
    <!-- Power category -->
    <div class="power-content js-hidden">
        <h2><?= $dataPower[6]->country ?></h2>
        <p><?= $dataPower[6]->value.'%' ?></p>
    </div>
    <!-- Health category -->
    <div class="health-content js-hidden">
        <h2><?= $dataHealth[13]->country ?></h2>
        <p><?= $dataHealth[13]->value.'%' ?></p>
    </div>
    <!-- Violence category -->
    <div class="violence-content js-hidden">
        <h2><?= $dataViolence[17]->country ?></h2>
        <p><?= $dataViolence[17]->value.'%' ?></p>
    </div>
    <!-- 5 domains navigation -->
    <div class="domains">
        <a href="#" class="studies-button  js-current-button">STUDIES</a>
        <a href="#" class="work-button">WORK</a>
        <a href="#" class="power-button">POWER</a>
        <a href="#" class="health-button">HEALTH</a>
        <a href="#" class="violence-button">VIOLENCE</a>
    </div>
</body>
</html>