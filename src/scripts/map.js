// Datas
const datajson = JSON.parse(data)
const dataset_global = {}

// Colors
const paletteScale = d3.scale.linear()
    .domain([30, 60, 120])
    .range(["white", "#FF9D43", "black"])


// Set database for the map
datajson.forEach((_country) => {
    const country = _country.country
    _country.global_score = parseFloat(_country.global_score)
    const score = _country.global_score
    const color = paletteScale(score)
    dataset_global[country] = { score: score, fillColor: color }
})


console.log(dataset_global)

// MAP
const map = new Datamap({
    element: document.getElementById('map-container'),
    // color if no data
    fills: {
        defaultFill: '#FFFFFF'
    },
    // datas
    data: dataset_global,
    // hover infos
    geographyConfig: {
        highlightBorderColor: '#FFE659',
        popupTemplate: function (geography, data) {
            return '<div class="hoverinfo">' + geography.properties.name + '<br>' + data.score + ' '
        }
    },
    // Europe mercator view and zoom
    setProjection: function (element) {
        const projection = d3.geo.mercator()
            .center([15, 53])
            .scale(950)
            .translate([element.offsetWidth / 2, element.offsetHeight / 2])
        const path = d3.geo.path()
            .projection(projection)
        return { path: path, projection: projection }
    },
})




// Send to the country page on click
// get country path
const getPath = document.querySelectorAll('#container svg g path')
// click on the country
getPath.forEach((_path) => {
    _path.addEventListener('click', () => {
        const idCountry = _path.classList[1]
        window.location.href = `country.php?id=${idCountry}`
    })
})

