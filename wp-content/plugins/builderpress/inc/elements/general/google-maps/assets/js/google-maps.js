(function ($) {
    "use strict";

    $(document).ready(function () {
        $('.content_maps .content_hidden li').click(function () {
            ob_loadMap($, $(this).data('address'));
            $('.content_maps .title_place').click();
            $('.content_maps .title_place span').text($(this).text());
            var num = $(this).index()+1;
            $('.content_maps .content_place .item_pace').hide();
            $('.content_maps .content_place .item_pace:nth-child('+num+')').show();
            return false;
        });
        $('.content_maps .title_place').click(function () {
            $(this).parent().find('.content_hidden').slideToggle();
            $(this).find('.fa').toggleClass('open');
        });
        $(window).scroll(function() {
            if($('.ob-google-map-canvas').length){
                if ($(window).scrollTop() + $(window).height() >= ($('.ob-google-map-canvas').length ? $('.ob-google-map-canvas').offset().top : '') && !$('.ob-google-map-canvas').hasClass('loaded')) {
                    $('.ob-google-map-canvas').addClass('loaded');
                    if (window.google) {
                        ob_loadMap($, '');
                    } else {
                        ob_loadApi($);
                    }
                }
            }
        });
    });

})(jQuery);

function ob_loadMap($, str) {
    if($('.ob-google-map-canvas').length){
        $('.ob-google-map-canvas').each(function () {
            var $$ = $(this);

            // We use the ob_geocoder
            var ob_geocoder = new google.maps.Geocoder();

            if( $$.data('display_by') && $$.data('display_by') != 'address' ) {
                var thim_map = {'location': {lat: 36.3030403, lng: -115.2881221} };
            }else{
                if(str!='')
                    var thim_map = {'address': str};
                else
                    var thim_map = {'address': $$.data('address')};
            }
            ob_geocoder.geocode( thim_map , function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var zoom = Number($$.data('zoom'));
                    if ( !zoom ) zoom = 14;
                    var userMapTypeId = 'user_map_style';
                    var mapOptions = {
                        zoom: zoom,
                        scrollwheel: Boolean( $$.data('scroll-zoom') ),
                        //   draggable: Boolean( $$.data('draggable') ),
                        center: results[0].geometry.location,
                        mapTypeControlOptions: {
                            mapTypeIds: [google.maps.MapTypeId.ROADMAP, userMapTypeId]
                        }
                    };

                    var map = new google.maps.Map($$.get(0), mapOptions);

                    var userMapOptions = {
                        name: $$.data('map-name')
                    };

                    var userMapStyles = $$.data('map-styles');

                    if ( userMapStyles ) {
                        var userMapType = new google.maps.StyledMapType(userMapStyles, userMapOptions);

                        map.mapTypes.set(userMapTypeId, userMapType);
                        map.setMapTypeId(userMapTypeId);
                    }

                    if ( Boolean( $$.data('marker-at-center' ) ) ) {

                        new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            //  draggable: Boolean( $$.data('markers-draggable') ),
                            icon: $$.data('marker-icon'),
                            title: ''
                        });
                    }
                    var markerPositions = $$.data('marker-positions');
                    if ( markerPositions && markerPositions.length ) {
                        markerPositions.forEach(
                            function(mrkr) {
                                ob_geocoder.geocode( { 'address': mrkr.place }, function (res, status) {
                                    if ( status == google.maps.GeocoderStatus.OK ) {
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
                    if ( directions ) {

                        if ( directions.waypoints && directions.waypoints.length ) {
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
                                avoidHighways: Boolean( directions.avoidHighways ),
                                avoidTolls: Boolean( directions.avoidTolls ),
                                waypoints: directions.waypoints,
                                optimizeWaypoints: Boolean( directions.optimizeWaypoints )

                            },
                            function(result, status) {
                                if (status == google.maps.DirectionsStatus.OK) {
                                    directionsRenderer.setDirections(result);
                                }
                            });
                    }
                }
                else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                    $$.append('<div><p><strong>There were no results for the place you entered. Please try another.</strong></p></div>');
                }
            });
        });
    }
}

function ob_loadApi($) {
    var apiKey = $('.ob-google-map-canvas').data('api-key');

    if( apiKey ) {
        var apiUrl = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initialize';
        if(apiKey) {
            apiUrl += '&key=' + apiKey;
        }
        var script = $('<script type="text/javascript" src="' + apiUrl + '">');
        $('body').append(script);
    }
}

function initialize() {
    ob_loadMap(window.jQuery, '');
}