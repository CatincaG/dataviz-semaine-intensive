// Datas
const datajson = JSON.parse(data)
// const dataset_global = {}

datajson.forEach((_country) => {
    console.log(_country.country)
    // console.log(_country.global_score)
    // const data_global[_country] = { score: _country.global_score, fillColor: "#B3DDBF" };
})

// Datamaps expect data in format:
// { "USA": { "fillColor": "#42a844", numberOfWhatever: 75},
//   "FRA": { "fillColor": "#8dc386", numberOfWhatever: 43 } }

// console.log(dataset_global)

// map
const map = new Datamap({
    element: document.getElementById('container'),
    // datas
    // data: dataset_global,
    // colors
    fills: {
        VERYHIGH: '#41A95E',
        HIGH: '#67BA7E',
        MEDIUM: '#8DCB9E',
        LOW: '#B3DDBF',
        VERYLOW: '#D9EEDF',
        defaultFill: '#FFFFFF'
    },
    // Europe mercator view
    setProjection: function (element) {
        const projection = d3.geo.mercator()
            .center([15, 53])
            .scale(950)
            .translate([element.offsetWidth / 2, element.offsetHeight / 2]);
        const path = d3.geo.path()
            .projection(projection)
        return { path: path, projection: projection };
    }
});

