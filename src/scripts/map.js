const map = new Datamap({
    element: document.getElementById('container'),
    // projection: 'mercator',
    setProjection: function (element) {
        const projection = d3.geo.equirectangular()
            .center([15, 50])
            // .rotate([4.4, 0])
            .scale(1000)
            .translate([element.offsetWidth / 2, element.offsetHeight / 2]);
        const path = d3.geo.path()
            .projection(projection)

        return { path: path, projection: projection };
    }
});

