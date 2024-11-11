/**
 * (c) Greg Priday, freely distributable under the terms of the GPL 2.0 license.
 */
(function ($) {
    "use strict";

    $(window).load(function () {
        bp_element_google_map.load();
    });


    var bp_element_google_map = {

        load: function () {
            if ($('.bp-element-google-map').length > 0) {
                if ($(this).data('cover')) {
                    bp_element_google_map.cover();
                } else {
                    bp_element_google_map.load_api();
                }
            }
        },
        load_api: function () {
            var apiKey = $('.ob-google-map-canvas').data('api_key');
            var apiUrl = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=bp_element_google_map_init';

            if (apiKey) {
                apiUrl += '&key=' + apiKey;
            } else {
                var api = 'AIzaSyBzgriuC-Yjx9v7zoeILcIMPEI6WjrhlKw';
                apiUrl += '&key=' + api;
            }
            var script = $('<script type="text/javascript" src="' + apiUrl + '"></script>');
            $('body').append(script);
        },

        cover: function () {
            $('.bp-element-google-map .map-cover').on('hover', function () {
                $(this).remove();
                bp_element_google_map.load_api();
            });
        }

    };


})(jQuery);


/**
 * function bp_element_google_map_init
 * create google map
 */
function bp_element_google_map_init() {
    bp_element_google_map_create_map(window.jQuery);
}


/**
 * create map
 * @param $ : jquery
 */
function bp_element_google_map_create_map($) {
    $('.ob-google-map-canvas').each(function () {
        var $$ = $(this);
        // We use the ob_geocoder
        var ob_geocoder = new google.maps.Geocoder();
        ob_geocoder.geocode({'address': $$.data('address')}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                var zoom = Number($$.data('zoom'));
                if (!zoom) zoom = 14;
                var userMapTypeId = 'user_map_style';
                var mapOptions = {
                    zoom: zoom,
                    scrollwheel: Boolean($$.data('scroll-zoom')),
                    //   draggable: Boolean( $$.data('draggable') ),
                    center: results[0].geometry.location,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, userMapTypeId]
                    }
                };

                var map = new google.maps.Map($$.get(0), mapOptions);


                var userMapStyles = $$.data('style');

                var mapname = userMapStyles;
                if (userMapStyles === 'import_json') {
                    mapname = 'Custom';
                }
                var userMapOptions = {
                    name: mapname
                };

                var style_light = [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 17}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 18}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 16}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{"color": "#dedede"}, {"lightness": 21}]
                }, {
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]
                }, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#fefefe"}, {"lightness": 20}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
                }];


                var style_dark = [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#333333"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#212121"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.locality",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#2b2b2b"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#1b1b1b"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#fa4f35"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#8a8a8a"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#373737"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#3c3c3c"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway.controlled_access",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#fa4f35"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#2b2b2b"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#2b2b2b"
                            }
                        ]
                    }
                ];


                var style_json = $$.data('json');

                if (userMapStyles && userMapStyles !== 'default') {
                    switch (userMapStyles) {
                        case 'light':
                            userMapStyles = style_light;
                            break;
                        case 'dark':
                            userMapStyles = style_dark;
                            break;
                        case 'import_json':
                            userMapStyles = style_json;
                            break;
                        default:
                            break;
                    }
                    var userMapType = new google.maps.StyledMapType(userMapStyles, userMapOptions);

                    map.mapTypes.set(userMapTypeId, userMapType);
                    map.setMapTypeId(userMapTypeId);
                }

                // if (Boolean($$.data('marker-at-center'))) {

                new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    //  draggable: Boolean( $$.data('markers-draggable') ),
                    icon: $$.data('marker-icon'),
                    title: ''
                });
                // }
                var markerPositions = $$.data('marker-positions');
                if (markerPositions && markerPositions.length) {
                    markerPositions.forEach(
                        function (mrkr) {
                            ob_geocoder.geocode({'address': mrkr.place}, function (res, status) {
                                if (status === google.maps.GeocoderStatus.OK) {
                                    new google.maps.Marker({
                                        position: res[0].geometry.location,
                                        map: map,
                                        // draggable: Boolean( $$.data('markers-draggable') ),
                                        icon: $$.data('marker-icon'),
                                        title: ''
                                    });
                                }
                            });
                        }
                    );
                }
                var directions = $$.data('directions');
                if (directions) {

                    if (directions.waypoints && directions.waypoints.length) {
                        directions.waypoints.map(
                            function (wypt) {
                                wypt.stopover = Boolean(wypt.stopover);
                            }
                        );
                    }

                    var directionsRenderer = new google.maps.DirectionsRenderer();
                    directionsRenderer.setMap(map);

                    var directionsService = new google.maps.DirectionsService();
                    directionsService.route({
                            origin: directions.origin,
                            destination: directions.destination,
                            travelMode: directions.travelMode.toUpperCase(),
                            avoidHighways: Boolean(directions.avoidHighways),
                            avoidTolls: Boolean(directions.avoidTolls),
                            waypoints: directions.waypoints,
                            optimizeWaypoints: Boolean(directions.optimizeWaypoints)

                        },
                        function (result, status) {
                            if (status === google.maps.DirectionsStatus.OK) {
                                directionsRenderer.setDirections(result);
                            }
                        });
                }
            }
            else if (status === google.maps.GeocoderStatus.ZERO_RESULTS) {
                $$.append('<div><p><strong>There were no results for the place you entered. Please try another.</strong></p></div>');
            }
        });
    });
}