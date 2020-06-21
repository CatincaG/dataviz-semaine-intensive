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
    <title>Gender equality in Europe</title>
    <link rel="stylesheet" href="./src/styles/map.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Title -->
    <h1>Gender equality in Europe</h1>
    <!-- Category choice -->
    <ul class="categories">
        <a href="#" class="global-button"><li>Global</li></a>
        <a href="#" class="education-button"><li>Education</li></a>
        <a href="#" class="work-button"><li>Work</li></a>
        <a href="#" class="health-button"><li>Health</li></a>
        <a href="#" class="power-button"><li>Power</li></a>
        <a href="#" class="violence-button"><li>Violence</li></a>
    </ul>
    <!-- Map -->
    <div id="map-container"></div>
    <!-- Help -->
    <div class="help">
        <img src="./src/images/help.svg" alt="help">
        <p>Help</p>
    </div>
    <!-- Source -->
    <p class="source">2017 data from EUOpen Data</p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src="node_modules/datamaps/dist/datamaps.world.min.js"></script>
    <script src="src/scripts/map.js"></script>
</body>
</html>