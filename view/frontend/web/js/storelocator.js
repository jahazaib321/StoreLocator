define(["uiComponent", "jquery"], function (Component, $) {
    "use strict";
    return Component.extend({
        initialize: function (config, node) {
            // sb se phele ye chele ga
            // console.log(config);
            // console.log(node);
            this.StoresMap();
            this.GoogleMap( );
            this.bindStoreGridFunction();s
        }, StoresMap: function () {
            $('.get_location').on('click', function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        if (window.map) {
                            window.map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                        }
                    });
                }
            })

            $('.flyTo').on('click', function (store) {
                setTimeout(() => {
                    window.map.panTo(new google.maps.LatLng(store.lat, store.lng), location);
                    window.map.setZoom(12);
                }, 1000);
            })
        },
        GoogleMap: function () {
            // console.log("data")
            let MapContent = document.getElementById("Google_Map")
            let map = new google.maps.Map(MapContent, {
                center: {lat: 28.7041, lng: 77.1025}, zoom: 12
            });

            let marker = new google.maps.Marker({
                position: new google.maps.LatLng(28.6315, 77.2167), map: map, animate: google.maps.Animation.BOUNCE,
            });
            let address = '<div><p><b>Organization  Address</b></p></div>';
            marker.addListener('click',  () => {

                let infowindow = new google.maps.InfoWindow({
                    content: address
                });
                infowindow.open(map, marker);
                // window.initMap = GoogleMap;
            });

        },


        bindStoreGridFunction: function () {
        },
    });

    window.initMap= GoogleMap;
});


// googlemaps
