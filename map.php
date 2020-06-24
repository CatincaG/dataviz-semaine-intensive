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
            <div class="selected-category">
                <p class="selected-category-text">all categories</p>
                <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.0837 12.4236C8.04423 12.484 7.95577 12.484 7.9163 12.4236L0.101155 0.469906C0.0576717 0.403396 0.105391 0.315185 0.184855 0.315185L15.8151 0.315186C15.8946 0.315186 15.9423 0.403396 15.8988 0.469907L8.0837 12.4236Z" fill="#333333"/>
                </svg>
            </div>
            <ul class="menu hidden">
                <li class="global-button">all categories</li>
                <li class="education-button">education</li>
                <li class="work-button">work</li>
                <li class="health-button">health</li>
                <li class="power-button">responsability</li>
            </ul>
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
    <a class="source" href="https://data.europa.eu/euodp/en/data/dataset/gender-equality-index">2017 datas from EUOpen Data</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datamaps/0.5.9/datamaps.all.min.js"></script>
    <script src="src/scripts/map.js"></script>
</body>
</html>