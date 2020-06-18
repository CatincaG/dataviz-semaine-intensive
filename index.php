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
    <title>European gender gap</title>
    <link rel="stylesheet" href="./src/styles/map.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src="node_modules/datamaps/dist/datamaps.world.min.js"></script>

    <!-- <div class="categories">
        <button class="js-global">Global</button>
        <button class="js-education">Education</button>
        <button class="js-work">Work</button>
        <button class="js-health">Health</button>
        <button class="js-power">Power</button>
        <button class="js-violence">Violence</button>
    </div> -->
    <div id="container"></div>

    <script src="src/scripts/map.js"></script>
</body>

</html>