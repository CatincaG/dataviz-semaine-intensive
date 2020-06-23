<?php
include_once './includes/config.php';

//****GET API DATAS WITH CURL METHOD***//
// Instantiate curl
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://bridge.buddyweb.fr/api/gendergap/datascore');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl);
curl_close($curl);
?>

<!-- Send datas to javascript -->
<script>
    const data = <?= json_encode($data); ?>
</script>

<!-- DOM -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Equally</title>
    <link rel="stylesheet" href="./src/styles/map.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Title -->
    <div class="title">
        <h1>Gender equality in Europe for</h1>
        <!-- Category choice -->
        <div class="categories">
            <ul class="menu">
                <li class="global-button">all categories</li>
                <li class="education-button">education</li>
                <li class="work-button">work</li>
                <li class="health-button">health</li>
                <li class="power-button">responsability</li>
            </ul>
            <img class="arrow" src="./assets/icons/arrow.svg" alt="arrow">
        </div>
    </div>
    <!-- Subtitle -->
    <h2>The Gender Equality Index is an equality success score calculated as a percentage</h2>
    <!-- Map -->
    <div id="map-container"></div>
    <!-- Legend -->
    <div class="legend">
        <p>Inequality</p>
        <div class="colors">
            <img src="./assets/svg/gradient.svg" alt="gradient">
        </div>
        <p>Equality</p>
    </div>
    <!-- Source -->
    <p class="source">2017 datas from EUOpen Data</p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src="node_modules/datamaps/dist/datamaps.world.min.js"></script>
    <script src="src/scripts/map.js"></script>
</body>
</html>