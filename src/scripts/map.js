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
            highlightBorderColor: '#FFEE90',
            popupTemplate: function (geography, data) {
                return '<div class="hoverinfo">' + geography.properties.name + '<br><strong>' + data.score + '</strong><br>' + "Click to learn more" + '</div>'
            }
        },
        // Europe mercator view and zoom
        setProjection: function (element) {
            const projection = d3.geo.mercator()
                .center([15, 52])
                .scale(700)
                .translate([element.offsetWidth / 2, element.offsetHeight / 2])
            const path = d3.geo.path()
                .projection(projection)
            return { path: path, projection: projection }
        },
    })
}

const redirection = () => {
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
redirection()


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
    // legend
    const colors = ["#BDB3DD", "#9B8DCB", "#7A67BA", "#5941A9", "#392A6C", "#2E2256"]
    const colorBoxes = document.querySelectorAll('.colorbox')
    colorBoxes.forEach((_colorbox, _key) => {
        _colorbox.style.backgroundColor = colors[_key]
    })
    redirection()
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
        .domain([30, 60, 120])
        .range(["white", "#A9417F", "black"])
    // Set database for the work map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.work_score = parseFloat(_country.work_score)
        const score = _country.work_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
    // legend
    const colors = ["#DDB3CC", "#CB8DB2", "#BA6799", "#A9417F", "#6C2A52", "#562242"]
    const colorBoxes = document.querySelectorAll('.colorbox')
    colorBoxes.forEach((_colorbox, _key) => {
        _colorbox.style.backgroundColor = colors[_key]
    })
    redirection()
})

// HEALTH
const healthButton = document.querySelector('.health-button')
healthButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for health map
    const paletteScale = d3.scale.linear()
        .domain([40, 70, 110])
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
    // legend
    const colors = ["#B3DDBF", "#8DCB9E", "#67BA7E", "#41A95E", "#2A6C3C", "#225630"]
    const colorBoxes = document.querySelectorAll('.colorbox')
    colorBoxes.forEach((_colorbox, _key) => {
        _colorbox.style.backgroundColor = colors[_key]
    })
    redirection()
})

// POWER
const powerButton = document.querySelector('.power-button')
powerButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for power map
    const paletteScale = d3.scale.linear()
        .domain([20, 60, 110])
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
    // legend
    const colors = ["#B2D9DE", "#8BC5CD", "#65B2BD", "#3E9FAC", "#28666E", "#205258"]
    const colorBoxes = document.querySelectorAll('.colorbox')
    colorBoxes.forEach((_colorbox, _key) => {
        _colorbox.style.backgroundColor = colors[_key]
    })
    redirection()
})

// VIOLENCE
const violenceButton = document.querySelector('.violence-button')
violenceButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set colors for violence map
    const paletteScale = d3.scale.linear()
        .domain([-30, 50, 150])
        .range(["black", "#B43838", "white"])
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        if (_country.violence_score != null) {
            _country.violence_score = parseFloat(_country.violence_score)
            const score = _country.violence_score
            const color = paletteScale(score)
            dataset[country] = { score: score, fillColor: color }
        }
    })
    createMap(dataset)
    // legend
    const colors = ["#E1AFAF", "#D28888", "#C36060", "#B43838", "#732424", "#5C1D1D"]
    const colorBoxes = document.querySelectorAll('.colorbox')
    colorBoxes.forEach((_colorbox, _key) => {
        _colorbox.style.backgroundColor = colors[_key]
    })
    redirection()
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
    // Set database for the global map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.global_score = parseFloat(_country.global_score)
        const score = _country.global_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color }
    })
    createMap(dataset)
    // legend
    const colors = ["#FFD8B4", "#FFC48E", "#FFB169", "#FF9D43", "#C47833", "#9D6129"]
    const colorBoxes = document.querySelectorAll('.colorbox')
    colorBoxes.forEach((_colorbox, _key) => {
        _colorbox.style.backgroundColor = colors[_key]
    })
    redirection()
})



