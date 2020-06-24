// Choice of category
const categoryChoice = document.querySelector('.selected-category')
const menu = document.querySelector('.menu')
categoryChoice.addEventListener('click', () => {
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden')
    } else {
        menu.classList.add('hidden')
    }
})

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
        // hover
        geographyConfig: {
            highlightFillColor: '#FFFFFF',
            highlightBorderColor: '#FFFFFF',
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

// Send to the country page on click
const redirection = () => {
    // get the countries we have datas on
    const authorizedCountries = []
    datajson.forEach((_country) => {
        authorizedCountries.push(_country.country)
    })
    // get country path
    const getPath = document.querySelectorAll('#map-container svg g path')
    // click on the country
    getPath.forEach((_path) => {
        _path.addEventListener('click', () => {
            const idCountry = _path.classList[1]
            // redirection only if we have datas
            if (authorizedCountries.indexOf(idCountry) != -1) {
                window.location.href = `country.php?id=${idCountry}`
            }
        })
    })
}


// Colors
const paletteScale = d3.scale.linear()
    .domain([10, 65, 100])
    .range(["#2E2256", "#5941A9", "#DED9EE"])


// Set database for the global map at first
datajson.forEach((_country) => {
    const country = _country.country
    _country.global_score = parseFloat(_country.global_score)
    const score = _country.global_score
    const color = paletteScale(score)
    dataset[country] = { score: score, fillColor: color, highlightFillColor: '#FFAB84', highlightBorderColor: '#FFEE90' }
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
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.studies_score = parseFloat(_country.studies_score)
        const score = _country.studies_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color, highlightFillColor: '#FFAB84', highlightBorderColor: '#FFEE90' }
    })
    createMap(dataset)
    redirection()
    // display categorie
    const categorySelected = document.querySelector('.selected-category-text')
    categorySelected.innerText = 'education'
})

// WORK
const workButton = document.querySelector('.work-button')
workButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set database for the work map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.work_score = parseFloat(_country.work_score)
        const score = _country.work_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color, highlightFillColor: '#FFAB84', highlightBorderColor: '#FFEE90' }
    })
    createMap(dataset)
    redirection()
    // display categorie
    const categorySelected = document.querySelector('.selected-category-text')
    categorySelected.innerText = 'work'
})

// HEALTH
const healthButton = document.querySelector('.health-button')
healthButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.health_score = parseFloat(_country.health_score)
        const score = _country.health_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color, highlightFillColor: '#FFAB84', highlightBorderColor: '#FFEE90' }
    })
    createMap(dataset)
    redirection()
    // display categorie
    const categorySelected = document.querySelector('.selected-category-text')
    categorySelected.innerText = 'health'
})

// POWER
const powerButton = document.querySelector('.power-button')
powerButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set database for the education map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.power_score = parseFloat(_country.power_score)
        const score = _country.power_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color, highlightFillColor: '#FFAB84', highlightBorderColor: '#FFEE90' }
    })
    createMap(dataset)
    redirection()
    // display categorie
    const categorySelected = document.querySelector('.selected-category-text')
    categorySelected.innerText = 'responsability'
})


// GLOBAL
const globalButton = document.querySelector('.global-button')
globalButton.addEventListener('click', () => {
    // delete former map
    const mapContainer = document.querySelector('#map-container')
    const mapSvg = mapContainer.querySelector('svg')
    mapContainer.removeChild(mapSvg)
    // Set database for the global map
    const dataset = {}
    datajson.forEach((_country) => {
        const country = _country.country
        _country.global_score = parseFloat(_country.global_score)
        const score = _country.global_score
        const color = paletteScale(score)
        dataset[country] = { score: score, fillColor: color, highlightFillColor: '#FFAB84', highlightBorderColor: '#FFEE90' }
    })
    createMap(dataset)
    redirection()
    // display categorie
    const categorySelected = document.querySelector('.selected-category-text')
    categorySelected.innerText = 'all categories'
})


