// Datas
const datajson = JSON.parse(data)
const dataset = {}

// Creating a map
const createMap = (_dataset) => {
    const map = new Datamap({
        element: document.getElementById('map-container'),
        // color if no data
        fills: {
            defaultFill: '#FFFFFF'
        },
        // datas
        data: _dataset,
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
}


// Colors
const paletteScale = d3.scale.linear()
    .domain([30, 60, 120])
    .range(["white", "#FF9D43", "black"])


// Set database for the global map at first
datajson.forEach((_country) => {
    const country = _country.country
    _country.global_score = parseFloat(_country.global_score)
    const score = _country.global_score
    const color = paletteScale(score)
    dataset[country] = { score: score, fillColor: color }
})
createMap(dataset)


// EDUCATION
const educationButton = document.querySelector('.education-button')
educationButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for education map
    const paletteScale = d3.scale.linear()
        .domain([30, 60, 120])
        .range(["white", "#5941A9", "black"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.studies_score = parseFloat(_country.studies_score)
        const score = _country.studies_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
})

// WORK
const workButton = document.querySelector('.work-button')
workButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for education map
    const paletteScale = d3.scale.linear()
        .domain([30, 60, 100])
        .range(["white", "#A9417F", "black"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.work_score = parseFloat(_country.work_score)
        const score = _country.work_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
})

// HEALTH
const healthButton = document.querySelector('.health-button')
healthButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for education map
    const paletteScale = d3.scale.linear()
        .domain([30, 60, 110])
        .range(["white", "#41A95E", "black"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.health_score = parseFloat(_country.health_score)
        const score = _country.health_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
})

// POWER
const powerButton = document.querySelector('.power-button')
powerButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for education map
    const paletteScale = d3.scale.linear()
        .domain([30, 60, 110])
        .range(["white", "#3E9FAC", "black"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.power_score = parseFloat(_country.power_score)
        const score = _country.power_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
})

// VIOLENCE
const violenceButton = document.querySelector('.violence-button')
violenceButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for education map
    const paletteScale = d3.scale.linear()
        .domain([0, 50, 200])
        .range(["white", "#B43838", "black"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        if (_country.violence_score == null) {
            _country.violence_score = 0
        }
        _country.violence_score = parseFloat(_country.violence_score)
        const score = _country.violence_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
})

// GLOBAL
const globalButton = document.querySelector('.global-button')
globalButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for education map
    const paletteScale = d3.scale.linear()
        .domain([30, 60, 120])
        .range(["white", "#FF9D43", "black"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.global_score = parseFloat(_country.global_score)
        const score = _country.global_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
})


// Send to the country page on click
// get country path
const getPath = document.querySelectorAll('#map-container svg g path')
// click on the country
getPath.forEach((_path) => {
    _path.addEventListener('click', () => {
        const idCountry = _path.classList[1]
        window.location.href = `country.php?id=${idCountry}`
    })
})

