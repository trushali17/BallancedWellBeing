(function($) {
    "use strict";

    google.maps.event.addDomListener(window, 'load', init);

    var map;

    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(MAP.lat, MAP.lng),
            zoom: 7,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            panControl: true,
            disableDoubleClickZoom: false,
            mapTypeControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: false,
            streetViewControl: false,
            draggable : true,
            overviewMapControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: []
        }

        var mapElement = document.getElementById('mapBox');
        map = new google.maps.Map(mapElement, mapOptions);

        var locations = [['', MAP.lat, MAP.lng]];

        for (var i = 0; i < locations.length; i++) {
            new google.maps.Marker({
                icon: MAP.marker,
                animation: google.maps.Animation.BOUNCE,
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });
        }
    }
})(jQuery)